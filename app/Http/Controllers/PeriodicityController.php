<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Periodicity;
    use Illuminate\Support\Facades\Auth;

    class PeriodicityController extends Controller
    {
        public function index()
        {
            $periodicities = Periodicity::paginate(10);
            return view('periodicity.index',compact('periodicities'));
        }

        public function save(Request $request)
        {

            $validator = $request->validate([
                'name' => 'required|string',
            ]);
            
            $data = $request->except(['data']);
            $data['user_id'] = Auth::user()->id;
            $periodicity = Periodicity::where('name', $data['name'])->where('id', '!=', $request->id)->first();
            
            if ($periodicity) {
                return response()->json(['message' => 'Cette periodicité de collecte a déjà été enregistrer ',"status"=>"error"]);
            } else {
                $periodicity = Periodicity::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }
            
            return response()->json(['message' => 'Periodicité enregistré avec succès',"status"=>"success"]);
        }

        public function delete(Request $request){

            $periodicity = Periodicity::find($request->id);

            if($periodicity->delete()){
                return response()->json(['message' => 'Periodicité supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }