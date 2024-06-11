<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Filiere;
    use App\Models\Category;
    use App\Models\TypeFiliere;
    use Illuminate\Support\Facades\Auth;

    class FiliereController extends Controller
    {
        public function index()
        {
            Auth::user()->access('LISTE FILIERE');

            $filieres = Filiere::paginate(10);
            return view('filiere.index',compact('filieres'));
        }

        public function save(Request $request)
        {

            Auth::user()->access('AJOUT FILIERE');

            $validator = $request->validate([
                'name' => 'required|string',
            ]);
            
            $data = $request->except(['data']);
            $data['user_id'] = Auth::user()->id;
            $filiere = Filiere::where('name', $data['name'])->where('id', '!=', $request->id)->first();
            
            if ($filiere) {
                return response()->json(['message' => 'Cette filière a déjà été enregistrer ',"status"=>"error"]);
            } else {
                $filiere = Filiere::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }
            
            return response()->json(['message' => 'Filière enregistré avec succès',"status"=>"success"]);
        }

        public function save_type_filiere(Request $request)
        {

            Auth::user()->access('AJOUT TYPE FILIERE');

            $validator = $request->validate([
                'name' => 'required|string',
                'filiere_id' => 'required|string',
            ]);
            
            $data = $request->except(['data']);
            $data['user_id'] = Auth::user()->id;
            $type_filiere = TypeFiliere::where('name', $data['name'])->where('id', '!=', $request->id)->first();
            
            if ($type_filiere) {
                return response()->json(['message' => 'Ce type filière a déjà été enregistrer ',"status"=>"error"]);
            } else {
                $type_filiere = TypeFiliere::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }
            
            return response()->json(['message' => 'Type de filière enregistré avec succès',"status"=>"success"]);
        }

        public function delete(Request $request){

            Auth::user()->access('SUPPRESSION FILIERE');

            $filiere = Filiere::find($request->id);

            if($filiere->delete()){
                return response()->json(['message' => 'Filière supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }

        public function get_type_filiere($filiere_id){

            $categories = Category::where('filiere_id',$filiere_id)->get();

            $data = [];

            foreach($categories as $filiere){

                $data [] = [
                    "id"=>$filiere->id,
                    "name"=>$filiere->name,
                ];
            }

            return response()->json($data);
        }

        public function delete_type_filiere(Request $request){

            Auth::user()->access('SUPPRESSION TYPE FILIERE');

            $type_filiere = TypeFiliere::find($request->id);

            if($type_filiere->delete()){
                return response()->json(['message' => 'Type filière supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
        
    }