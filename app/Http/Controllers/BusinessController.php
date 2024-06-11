<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Business;
    use App\Models\Category;
    use App\Models\Region;
    use App\Models\BusinessQuizze;
    use App\Models\BusinessCategory;
    use App\Models\TypeExploitation;
    use App\Models\Exploitation;
    use App\Models\Departement;
    use App\Models\Filiere;
    use Illuminate\Support\Facades\Auth;

    class BusinessController extends Controller
    {
        public function index()
        {

            Auth::user()->access('LISTE FOURNISSEUR');

            $departement_id = Auth::user()->departement_id;
            $region_id = Auth::user()->region_id;
            $sous_prefecture_id = Auth::user()->sous_prefecture_id;

            if(!is_null($sous_prefecture_id)){

                $businesses = Business::where('sous_prefecture_id',$sous_prefecture_id)->paginate(100);

            }elseif(!is_null($departement_id)){

                $businesses = Business::where('departement_id',$departement_id)->paginate(100);

            }elseif(!is_null($region_id)){

                $businesses = Business::where('region_id',$region_id)->paginate(100);

            }else{
                $businesses = Business::paginate(100);
            }

            return view('business.index',compact('businesses'));
        }

        public function add($id)
        {
            $business = Business::find($id);

            if(!is_null($business)){
                $title = "Modifier $business->legal_name";
                Auth::user()->access('EDITION FOURNISSEUR');
            }else{
                $business = new Business;
                $title = 'Ajouter un fournisseur';
                Auth::user()->access('AJOUT FOURNISSEUR');
            }

            $departements = [];
            $regions = Region::all();
            $filieres = Filiere::all();

            return view('business.save',compact('business','title','departements','regions','filieres'));
        }

        public function save(Request $request)
        {
            
            if($request->id){
                Auth::user()->access('EDITION FOURNISSEUR');
            }else{
                Auth::user()->access('AJOUT FOURNISSEUR');
            }

            $validator = $request->validate([
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'legal_name' => 'required|string',
                'region_id' => 'required|string',
                'departement_id' => 'required|string',
                'phone' => 'required|string',
                'location' => 'required|string',
                'email' => 'required|email',
            ]);
            
            $data = $request->except(['logo']);
            
            $data['user_id'] = Auth::user()->id;
            
            $business = Business::where('email', $data['email'])->where('id', '!=', $request->id)->first();

            
            if ($business) {
                return response()->json(['message' => 'L\'adresse e-mail est déjà utilisée.',"status"=>"error"]);
            } else {
                $file = $request->file('logo');
                if($file){
                    $filePath = $file->storeAs('public/logo', $file->hashName());
                    $data['logo'] = $filePath ?? '';
                    $data['logo'] = str_replace('public/','',$data['logo']);
                }
                $business = Business::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }

            // $business->categories()->sync($request->category_id);
            // $business->quizzes()->sync($request->quizze_id);

            $business->type_filieres()->sync($request->filiere_ids);
            
            return response()->json(['message' => 'Fournisseur enregistré avec succès',"status"=>"success"]);

        }

        public function save_exploitation(Request $request)
        {
            
            if($request->id){
                Auth::user()->access('EDITION EXPLOITATION');
            }else{
                Auth::user()->access('AJOUT EXPLOITATION');
            }

            $validator = $request->validate([
                'business_id' => 'required|string',
                'category_id' => 'required|string',
                'type_exploitation_id' => 'required|string',
                'region_id' => 'required|string',
                'departement_id' => 'required|string',
                'area' => 'required|string',
                'location' => 'required|string',
            ]);
            
            $data = $request->except(['data']);
            
            $data['user_id'] = Auth::user()->id;
    
            $business = Business::find($request->business_id);

            $exploitation = Exploitation::updateOrCreate(
                ['id' => $request->id],
                $data
            );

            $exploitation->type_filieres()->sync($request->filiere_ids);

            BusinessQuizze::where('exploitation_id',$exploitation->id)->delete();
            BusinessCategory::where('exploitation_id',$exploitation->id)->delete();

            $business_category = new BusinessCategory;
            $business_category->exploitation_id = $exploitation->id;
            $business_category->business_id = $request->business_id;
            $business_category->category_id = $request->category_id;
            $business_category->save();

            foreach($request->quizze_id as $quizze_id){
                    
                $business_quizze = new BusinessQuizze;
                $business_quizze->exploitation_id = $exploitation->id;
                $business_quizze->business_id = $request->business_id;
                $business_quizze->quizze_id = $quizze_id;
                $business_quizze->save();
            }

            return response()->json(['message' => 'Exploitation enregistré avec succès',"status"=>"success"]);

        }

        
        public function exploitation($id)
        {

            Auth::user()->access('EDITION EXPLOITATION');

            $exploitation = Exploitation::find($id);
            $business = Business::find($exploitation->business_id);
            $departements = Departement::all();
            $regions = Region::all();
            $type_exploitations = TypeExploitation::all();
            $categories = Category::all();
            $filieres = Filiere::all();

            return view('business.exploitation',compact('exploitation','business','departements','regions','type_exploitations','categories','filieres'));
        }

        public function data($id)
        {

            Auth::user()->access('DETAILS FOURNISSEUR');
            $business = Business::find($id);
            $departements = [];
            $regions = Region::all();
            $type_exploitations = TypeExploitation::all();
            $categories = Category::all();
            $filieres = Filiere::all();

            return view('business.data',compact('business','departements','regions','type_exploitations','categories','filieres'));
        }

        public function delete_exploitation(Request $request){

            Auth::user()->access('SUPPRESSION EXPLOITATION');

            $exploitation = Exploitation::find($request->id);

            BusinessQuizze::where('exploitation_id',$request->id)->delete();
            BusinessCategory::where('exploitation_id',$request->id)->delete();

            if($exploitation->delete()){
                return response()->json(['message' => 'Exploitation supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }

        public function delete(Request $request){

            Auth::user()->access('SUPPRESSION FOURNISSEUR');

            $business = Business::find($request->id);

            if($business->delete()){
                return response()->json(['message' => 'Fournisseur supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }