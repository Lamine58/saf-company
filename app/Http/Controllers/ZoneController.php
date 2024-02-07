<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Zone;
    use Illuminate\Support\Facades\Auth;

    class ZoneController extends Controller
    {
        public function index()
        {
            $zones = Zone::paginate(10);
            return view('zone.index',compact('zones'));
        }

        public function add($id)
        {
            $zone = Zone::find($id);

            if(!is_null($zone)){
                $title = "Modifier $zone->name";
            }else{
                $zone = new Zone;
                $title = 'Ajouter une zone';
            }

            return view('zone.save',compact('zone','title'));
        }

        public function save(Request $request)
        {
            
            $validator = $request->validate([
                'name' => 'required|string',
                'departement' => 'required|string',
            ]);
            
            $data = $request->except(['data']);
            $data['user_id'] = Auth::user()->id;
            
            $zone = Zone::where('name', $data['name'])->where('id', '!=', $request->id)->first();
            
            if ($zone) {
                return response()->json(['message' => 'Cette zone a déjà été  enregisté.',"status"=>"error"]);
            } else {
                $zone = Zone::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }
            
            return response()->json(['message' => 'Zone enregistré avec succès',"status"=>"success"]);

        }

        public function delete(Request $request){

            $zone = Zone::find($request->id);

            if($zone->delete()){
                return response()->json(['message' => 'Zone supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }