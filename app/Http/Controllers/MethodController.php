<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Method;
    use Illuminate\Support\Facades\Auth;

    class MethodController extends Controller
    {
        public function index()
        {
            $methods = Method::paginate(10);
            return view('method.index',compact('methods'));
        }

        public function save(Request $request)
        {

            $validator = $request->validate([
                'name' => 'required|string',
            ]);
            
            $data = $request->except(['data']);
            $data['user_id'] = Auth::user()->id;
            $method = Method::where('name', $data['name'])->where('id', '!=', $request->id)->first();
            
            if ($method) {
                return response()->json(['message' => 'Cette méthode de collecte a déjà été enregistrer ',"status"=>"error"]);
            } else {
                $method = Method::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }
            
            return response()->json(['message' => 'Méthode enregistré avec succès',"status"=>"success"]);
        }

        public function delete(Request $request){

            $method = Method::find($request->id);

            if($method->delete()){
                return response()->json(['message' => 'Méthode supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }