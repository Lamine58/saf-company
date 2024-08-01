<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Insurance;
    use Illuminate\Support\Facades\Auth;

    class InsuranceController extends Controller
    {

        public function save(Request $request)
        {

            Auth::user()->access('AJOUT TYPE D\'ASSURANCE');

            $validator = $request->validate([
                'name' => 'required|string',
            ]);
            
            $data = $request->except(['data']);
            $data['user_id'] = Auth::user()->id;
            $insurance = Insurance::where('name', $data['name'])->where('id', '!=', $request->id)->first();
            
            if ($insurance) {
                return response()->json(['message' => 'Cette assuance déjà été enregistrer ',"status"=>"error"]);
            } else {
                $insurance = Insurance::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }
            
            return response()->json(['message' => 'Assuancee enregistré avec succès',"status"=>"success"]);
        }

        public function delete(Request $request){

            Auth::user()->access('SUPPRESSION TYPE D\'ASSURANCE');

            $insurance = Insurance::find($request->id);

            if($insurance->delete()){
                return response()->json(['message' => 'Assuancee supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }