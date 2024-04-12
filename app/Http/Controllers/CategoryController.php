<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Category;
    use App\Models\Quizze;
    use Illuminate\Support\Facades\Auth;

    class CategoryController extends Controller
    {
        public function index()
        {
            Auth::user()->access('LISTE CATEGORIE');

            $categories = Category::paginate(10);
            return view('category.index',compact('categories'));
        }

        public function add($id)
        {
            $category = Category::find($id);

            if(!is_null($category)){
                $title = "Modifier $category->name";
                Auth::user()->access('EDITION CATEGORIE');
            }else{
                $category = new Category;
                $title = 'Ajouter une categorie';
                Auth::user()->access('AJOUT CATEGORIE');
            }

            return view('category.save',compact('category','title'));
        }

        public function save(Request $request)
        {
            
            if($request->id){
                Auth::user()->access('EDITION CATEGORIE');
            }else{
                Auth::user()->access('AJOUT CATEGORIE');
            }

            $validator = $request->validate([
                'name' => 'required|string',
            ]);
            
            $data = $request->except(['data']);
            $data['user_id'] = Auth::user()->id;
            
            $category = Category::where('name', $data['name'])->where('id', '!=', $request->id)->first();
            
            if ($category) {
                return response()->json(['message' => 'Cette categorie a déjà été enregisté.',"status"=>"error"]);
            } else {
                $category = Category::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }
            
            return response()->json(['message' => 'Categorie enregistré avec succès',"status"=>"success"]);

        }

        

        public function categories($category_ids){

            $category_ids = explode(',',$category_ids);
            $quizzes = Quizze::whereIn('category_id',$category_ids)->get();

            $data = [];

            foreach($quizzes as $quizze){

                $data [] = [
                    "id"=>$quizze->id,
                    "name"=>$quizze->value_chain->name.' '.$quizze->category->name,
                ];
            }

            return response()->json($data);
        }

        public function delete(Request $request){

            Auth::user()->access('SUPPRESSION CATEGORIE');

            $category = Category::find($request->id);

            if($category->delete()){
                return response()->json(['message' => 'Categorie supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }