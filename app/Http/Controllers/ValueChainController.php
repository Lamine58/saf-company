<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\ValueChain;
    use App\Models\Role;
    use Illuminate\Support\Facades\Auth;

    class ValueChainController extends Controller
    {
        public function index()
        {
            Auth::user()->access('LISTE CHAINE DE VALEUR');

            $value_chains = ValueChain::paginate(100);
            return view('value-chain.index',compact('value_chains'));
        }
        
        public function add($id)
        {
            $value_chain = ValueChain::find($id);

            if(!is_null($value_chain)){
                $title = "Modifier $value_chain->name";
                Auth::user()->access('EDITION CHAINE DE VALEUR');
            }else{
                $value_chain = new ValueChain;
                $title = 'Ajouter une chaîne de valeur';
                Auth::user()->access('AJOUT CHAINE DE VALEUR');
            }

            return view('value-chain.save',compact('value_chain','title'));
        }

        public function save(Request $request)
        {
            if($request->id){
                Auth::user()->access('EDITION CHAINE DE VALEUR');
            }else{
                Auth::user()->access('AJOUT CHAINE DE VALEUR');
            }
            
            $validator = $request->validate([
                'name' => 'required|string',
            ]);
            
            $data = $request->except(['data']);
            $data['user_id'] = Auth::user()->id;
            
            $value_chain = ValueChain::where('name', $data['name'])->where('id', '!=', $request->id)->first();
            
            if ($value_chain) {
                return response()->json(['message' => 'Cette chaîne de valeur a déjà été  enregisté.',"status"=>"error"]);
            } else {
                $value_chain = ValueChain::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }
            
            return response()->json(['message' => 'Chaîne de valeur enregistré avec succès',"status"=>"success"]);

        }

        public function delete(Request $request){

            Auth::user()->access('SUPPRESSION CHAINE DE VALEUR');

            $value_chain = ValueChain::find($request->id);

            if($value_chain->delete()){
                return response()->json(['message' => 'Chaîne de valeur supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }