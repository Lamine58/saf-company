<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Quizze;
    use App\Models\ValueChain;
    use App\Models\Category;
    use App\Models\Investigation;
    use App\Models\Collection;
    use App\Models\Departement;
    use App\Models\Region;
    use App\Models\Indicator;
    use Illuminate\Support\Facades\Auth;
    use DB;

    class QuizzeController extends Controller
    {
        public function index($category_id)
        {

            Auth::user()->access("LISTE CHAINE DE VALEUR D'UNE CATEGORIE");

            $quizzes = Quizze::where('category_id',$category_id)->paginate(100);
            $value_chains = ValueChain::all();
            $category = Category::find($category_id);
            return view('quizze.index',compact('quizzes','category_id','value_chains','category'));
        }

        public function stats($quizze_id,Request $request)
        {
            // $indicators = [
            //     'Capacité de stockage des chambres froides',
            //     'Nombre de commerçants grossistes par type de viande',
            //     'Nombre de détaillants par type de viande',
            //     'Nombre de commerçants grossistes d\'œuf',
            //     'Nombre de commerçants détaillants d\'œuf',
            //     'Quantité de produits dérivés importés (coquilles, viandes...)',
            //     'Nombre d\'importateurs des OAC',
            //     'Nombre d\'employés',
            // ];
            
            // // IDs des éléments associés
            // $user_id = '6f17daf0-3356-46f2-894e-387e99baf377';
            // $quizze_id = '8502fba0-b5f3-42eb-8506-ded6d602e2bf';
            // $method_id = 'b4aa65b8-f9e6-483d-868d-0b4f37847fd2';
            // $unity_id = 'adaebc21-bd15-4c14-8eb8-8954982b3810';
            // $periodicity_id = '246a6677-8fdb-48d9-b3c5-11259f12e62d';
            
            // // Insérer chaque indicateur dans la base de données
            // foreach ($indicators as $question) {
            //     Indicator::create([
            //         'question' => $question,
            //         'type' => 'Nombre', // ou 'Texte', 'Booléen', etc. selon le type d'indicateur
            //         'data' => '[]', // ou une autre valeur par défaut
            //         'user_id' => $user_id,
            //         'quizze_id' => $quizze_id,
            //         'method_id' => $method_id,
            //         'unity_id' => $unity_id,
            //         'periodicity_id' => $periodicity_id,
            //     ]);
            // }

            $user = Auth::user();

            $user->access("DONNEES STATISTIQUES");

            $quizze = Quizze::find($quizze_id);
            $indicators_ids = $quizze->indicators->pluck('id');


            if(is_null($request->departement_id)){
                $departement_id = $user->departement_id;
            }else{
                $departement_id = $request->departement_id;
            }

            if(is_null($request->region_id)){
                $region_id = $user->region_id;
            }else{
                $region_id = $request->region_id;
            }

           if(!is_null($departement_id)){


                $collection_ids = Collection::where('state', 'success')
                ->whereHas('exploitation', function($query) use ($departement_id) {
                    $query->where('departement_id', $departement_id);
                })->pluck('id');

                $investigation_ids = Investigation::whereIn('collection_id',$collection_ids)->pluck('id');

                $results = DB::table('investigations')
                    ->join('indicators', 'investigations.indicator_id', '=', 'indicators.id')
                    ->whereIn('investigations.indicator_id', $indicators_ids)
                    ->whereIn('investigations.id', $investigation_ids)
                    ->select('indicators.id as indicator_id', 'indicators.question', DB::raw('SUM(investigations.value) as total_value'))
                    ->groupBy('indicators.id', 'indicators.question')->get();

            }elseif(!is_null($region_id)){


                if(is_null($request->region_id)){
                    $departement_ids = $user->region->departements->pluck('id');
                }else{
                    $departement_ids  = Departement::where('region_id',$region_id)->pluck('id');
                }

                $collection_ids = Collection::where('state', 'success')
                ->whereHas('exploitation', function($query) use ($departement_ids,$region_id) {
                    $query->whereIn('departement_id', $departement_ids);
                    $query->orWhere('region_id', $region_id);
                })->pluck('id');
                
                $investigation_ids = Investigation::whereIn('collection_id',$collection_ids)->pluck('id');

                $results = DB::table('investigations')
                    ->join('indicators', 'investigations.indicator_id', '=', 'indicators.id')
                    ->whereIn('investigations.indicator_id', $indicators_ids)
                    ->whereIn('investigations.id', $investigation_ids)
                    ->select('indicators.id as indicator_id', 'indicators.question', DB::raw('SUM(investigations.value) as total_value'))
                    ->groupBy('indicators.id', 'indicators.question')->get();

            }else{

                $collection_ids = Collection::where('state', 'success')->pluck('id');
                
                $investigation_ids = Investigation::whereIn('collection_id',$collection_ids)->pluck('id');

                $results = DB::table('investigations')
                    ->join('indicators', 'investigations.indicator_id', '=', 'indicators.id')
                    ->whereIn('investigations.indicator_id', $indicators_ids)
                    ->whereIn('investigations.id', $investigation_ids)
                    ->select('indicators.id as indicator_id', 'indicators.question', DB::raw('SUM(investigations.value) as total_value'))
                    ->groupBy('indicators.id', 'indicators.question')->get();
                
            }

            $currentMonth = date('n'); 
            $monthNames = [
                'Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jui', 'Juil', 'Aoû', 'Sep', 'Oct', 'Nov', 'Dec'
            ];
            $monthsJSON = array_slice($monthNames, 0, $currentMonth);

            $months = [];
            for ($i = 1; $i <= $currentMonth; $i++) {
                $month = str_pad($i, 2, '0', STR_PAD_LEFT); // Ajouter un zéro initial si nécessaire
                $months[] = $month;
            }

            if(is_null($request->region_id)){
                $departements = [];
            }else{
                $departements  = Departement::where('region_id',$region_id)->get();
            }

            $regions = Region::all();

            return view('quizze.stats',compact('quizze','results','investigation_ids','months','monthsJSON','departements','regions','user','departement_id','region_id'));
        }


        public function save(Request $request)
        {
            Auth::user()->access("AJOUT CHAINE DE VALEUR A UNE CATEGORIE");

            $validator = $request->validate([
                'category_id' => 'required|string',
                'value_chain_id' => 'required|string',
            ]);
            
            $data = $request->except(['data']);
            $data['user_id'] = Auth::user()->id;
            $quizze = Quizze::where('category_id', $data['category_id'])->where('value_chain_id', $data['value_chain_id'])->first();
            
            if ($quizze) {
                return response()->json(['message' => 'Cette chaîne de valeur existe déjà sur cette catégorie',"status"=>"error"]);
            } else {
                $quizze = Quizze::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }
            
            return response()->json(['message' => 'Chaîne de valeur ajouté à la catégorie',"status"=>"success"]);
        }

        public function delete(Request $request){

            Auth::user()->access('SUPPRESSION CHAINE DE VALEUR A UNE CATEGORIE');

            $quizze = Quizze::find($request->id);

            if($quizze->delete()){
                return response()->json(['message' => 'Chaîne de valeur supprimé de cette catégotrie',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }