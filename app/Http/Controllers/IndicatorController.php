<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Indicator;
    use App\Models\Quizze;
    use Illuminate\Support\Facades\Auth;

    class IndicatorController extends Controller
    {
        public function index($quizze_id)
        {
            Auth::user()->access('LISTE QUESTION');

            $indicators = Indicator::where('quizze_id',$quizze_id)->paginate(10);
            $quizze = Quizze::findOrfail($quizze_id);

            return view('indicator.index',compact('indicators','quizze'));
        }
        
        public function add($indicator_id,$quizze_id)
        {

            Auth::user()->access('AJOUT QUESTION');
            
            $indicator = Indicator::find($indicator_id);
            $quizze = Quizze::find($quizze_id);

            if(!is_null($indicator)){
                $title = "Modifier";
            }else{
                $indicator = new Indicator;
                $title = 'Ajouter un indicateur';
            }

            return view('indicator.save',compact('indicator','title','quizze'));
        }

        public function save(Request $request)
        {

            if($request->id){
                Auth::user()->access('EDITION QUESTION');
            }else{
                Auth::user()->access('AJOUT QUESTION');
            }
            

            $validator = $request->validate([
                'question' => 'required|string',
                'method_id' => 'required|string',
                'unity_id' => 'required|string',
                'periodicity_id' => 'required|string',
                'type' => 'required|string',
            ]);
            
            $data = $request->except([]);
            $data['user_id'] = Auth::user()->id;
            $data['data'] = json_encode($data['data'] ?? []);
            $method = Indicator::where('question', $data['question'])->where('id', '!=', $request->id)->first();
            
            if ($method) {
                return response()->json(['message' => 'Cette question a déjà été enregistrer',"status"=>"error"]);
            } else {
                $method = Indicator::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }
            
            return response()->json(['message' => 'Question enregistré avec succès',"status"=>"success"]);
        }

        public function delete(Request $request){

            Auth::user()->access('SUPPRESSION QUESTION');

            $indicator = Indicator::find($request->id);

            if($indicator->delete()){
                return response()->json(['message' => 'Question supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }