<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Unity;
    use Illuminate\Support\Facades\Auth;

    class UnityController extends Controller
    {
        public function index()
        {
            $unities = Unity::paginate(10);
            return view('unity.index',compact('unities'));
        }

        public function save(Request $request)
        {

            $validator = $request->validate([
                'name' => 'required|string',
            ]);
            
            $data = $request->except(['data']);
            $data['user_id'] = Auth::user()->id;
            $unity = Unity::where('name', $data['name'])->where('id', '!=', $request->id)->first();
            
            if ($unity) {
                return response()->json(['message' => 'Cette unité de mesure a déjà été enregistrer ',"status"=>"error"]);
            } else {
                $unity = Unity::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }
            
            return response()->json(['message' => 'Unité de mesure enregistré avec succès',"status"=>"success"]);
        }

        public function delete(Request $request){

            $unity = Unity::find($request->id);

            if($unity->delete()){
                return response()->json(['message' => 'Unité de mesure supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }