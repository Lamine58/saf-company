<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Quizze;
    use App\Models\ValueChain;
    use App\Models\Category;
    use Illuminate\Support\Facades\Auth;

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