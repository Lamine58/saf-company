<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Business;
    use App\Models\Category;
    use App\Models\Region;
    use Illuminate\Support\Facades\Auth;

    class BusinessController extends Controller
    {
        public function index()
        {
            Auth::user()->access('LISTE FOURNISSEUR');

            $businesses = Business::paginate(100);
            return view('business.index',compact('businesses'));
        }

        public function add($id)
        {
            $business = Business::find($id);
            $categories = Category::all();

            if(!is_null($business)){
                $title = "Modifier $business->legal_name";
                Auth::user()->access('EDITION FOURNISSEUR');
            }else{
                $business = new Business;
                $title = 'Ajouter un fournisseur';
                Auth::user()->access('AJOUT FOURNISSEUR');
            }

            $departements = [];
            $reigons = Region::all();

            return view('business.save',compact('business','title','categories','departements','reigons'));
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

            $business->categories()->sync($request->category_id);
            $business->quizzes()->sync($request->quizze_id);
            
            return response()->json(['message' => 'Fournisseur enregistré avec succès',"status"=>"success"]);

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