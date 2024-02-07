<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Indicator;
    use App\Models\Category;
    use Illuminate\Support\Facades\Auth;

    class IndicatorController extends Controller
    {
        public function index($categorie_id)
        {
            $indicators = Indicator::where('categorie_id',$categorie_id)->paginate(10);
            $category = Category::find($categorie_id);

            return view('indicator.index',compact('indicators','category'));
        }
        
        public function add($indicator_id,$categorie_id)
        {
            $indicator = Indicator::find($indicator_id);
            $category = Category::find($categorie_id);

            if(!is_null($indicator)){
                $title = "Modifier $indicator->name";
            }else{
                $indicator = new Indicator;
                $title = 'Ajouter un indicateur';
            }

            return view('indicator.save',compact('indicator','title','category'));
        }

        public function save(Request $request)
        {

            $validator = $request->validate([
                'indicator' => 'required|string',
                'categorie_id' => 'required|string',
                'type' => 'required|string',
            ]);
            
            $data = $request->except([]);
            $data['user_id'] = Auth::user()->id;
            $data['data'] = json_encode($data['data'] ?? []);
            $method = Indicator::where('indicator', $data['indicator'])->where('id', '!=', $request->id)->first();
            
            if ($method) {
                return response()->json(['message' => 'Ce Indicateur a déjà été enregistrer',"status"=>"error"]);
            } else {
                $method = Indicator::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }
            
            return response()->json(['message' => 'Indicateur enregistré avec succès',"status"=>"success"]);
        }

        public function delete(Request $request){

            $indicator = Indicator::find($request->id);

            if($indicator->delete()){
                return response()->json(['message' => 'Indicateur supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }