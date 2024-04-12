<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\User;
    use App\Models\Business;
    use App\Models\Role;
    use App\Models\Region;
    use Illuminate\Support\Facades\Auth;

    class UserController extends Controller
    {
        public function index()
        {
            Auth::user()->access('LISTE UTILISATEUR');
            
            $users = User::paginate(100);
            return view('user.index',compact('users'));
        }

        public function add($id)
        {
            $user = User::find($id);

            if(!is_null($user)){
                $title = "Modifier $user->fist_name $user->last_name";

                Auth::user()->access('EDITION UTILISATEUR');
            }else{
                $user = new User;
                $title = 'Ajouter un utilisateur';

                Auth::user()->access('AJOUT UTILISATEUR');
            }
            
            $departements = [];
            $reigons = Region::all();
            $roles = Role::all();
            return view('user.save',compact('user','title','departements','reigons','roles'));
        }




        public function save(Request $request)
        {
            
            if($request->id){
                Auth::user()->access('EDITION UTILISATEUR');
            }else{
                Auth::user()->access('AJOUT UTILISATEUR');
            }

            $validator = $request->validate([
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'matricule' => 'required|string',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'phone' => 'required|string',
                'email' => 'required|email',
                'password' => 'nullable|string|min:6|confirmed',
            ]);
            
            $data = $request->except(['avatar']);
            $user = User::where('email', $data['email'])->where('id', '!=', $request->id)->first();

            if ($user) {
                return response()->json(['message' => 'L\'adresse e-mail est déjà utilisée.',"status"=>"error"]);
            } else {
                
                $file = $request->file('avatar');
                if ($file) {
                    $filePath = $file->storeAs('public/avatar', $file->hashName());
                    $data['avatar'] = $filePath ?? '';
                    $data['avatar'] = str_replace('public/','',$data['avatar']);
                }
            
                if ($request->filled('password')) {
                    $data['password'] = bcrypt($request->password);
                }else{
                    $user = User::find($request->id);
                    $data['password'] = $user->password;
                }
            
                $user = User::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }
            
            return response()->json(['message' => 'Utilisateur enregistré avec succès', 'status' => 'success']);
            

        }

        public function delete(Request $request){

            Auth::user()->access('SUPPRESSION UTILISATEUR');

            $user = User::find($request->id);

            if($user->delete()){
                return response()->json(['message' => 'Utilisateur supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }