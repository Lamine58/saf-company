<?php 
    namespace App\Http\Controllers;

    use App\Models\Collection;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class CollectionController extends Controller
    {
        public function index($type)
        {
           Auth::user()->access("LISTE ENQUETE");

           $departement_id = Auth::user()->departement_id;
           $region_id = Auth::user()->region_id;

           if(!is_null($departement_id)){

                if($type=="en-attentes"){

                    $type="en attentes";

                    $collections = Collection::where('state', 'pending')
                    ->whereHas('exploitation', function($query) use ($departement_id) {
                        $query->where('departement_id', $departement_id);
                    })
                    ->paginate(100);

                }elseif($type=="validees"){

                    $type="validées";

                    $collections = Collection::where('state', 'success')
                    ->whereHas('exploitation', function($query) use ($departement_id) {
                        $query->where('departement_id', $departement_id);
                    })
                    ->paginate(100);

                }elseif($type=="annulees"){

                    $type="annulées";

                    $collections = Collection::where('state', 'faild')
                    ->whereHas('exploitation', function($query) use ($departement_id) {
                        $query->where('departement_id', $departement_id);
                    })
                    ->paginate(100);
                }

            }elseif(!is_null($region_id)){

                $departement_ids = Auth::user()->region->departements->pluck('id');

                if($type=="en-attentes"){

                    $type="en attentes";

                    $collections = Collection::where('state', 'pending')
                    ->whereHas('exploitation', function($query) use ($departement_ids,$region_id) {
                        $query->whereIn('departement_id', $departement_ids);
                        $query->orWhere('region_id', $region_id);
                    })
                    ->paginate(100);

                }elseif($type=="validees"){

                    $type="validées";

                    $collections = Collection::where('state', 'success')
                    ->whereHas('exploitation', function($query) use ($departement_ids,$region_id) {
                        $query->whereIn('departement_id', $departement_ids);
                        $query->orWhere('region_id', $region_id);
                    })
                    ->paginate(100);

                }elseif($type=="annulees"){

                    $type="annulées";

                    $collections = Collection::where('state', 'faild')
                    ->whereHas('exploitation', function($query) use ($departement_ids,$region_id) {
                        $query->whereIn('departement_id', $departement_ids);
                        $query->orWhere('region_id', $region_id);
                    })
                    ->paginate(100);
                }

            }else{

               if($type=="en-attentes"){

                    $type="en attentes";
                    $collections = Collection::where('state','pending')->paginate(100);
    
               }elseif($type=="validees"){
    
                    $type="validées";
                    $collections = Collection::where('state','success')->paginate(100);
    
               }elseif($type=="annulees"){
    
                    $type="annulées";
                    $collections = Collection::where('state','faild')->paginate(100);
               }
            }
            

           return view('collection.index',compact('type','collections'));

        }


        public function data($collection_id)
        {
           Auth::user()->access("VOIR ENQUETE");
           $collection = Collection::findOrfail($collection_id);
           return view('collection.data',compact('collection'));
        }

        public function state($state,Request $request){

            Auth::user()->access('VALIDATION ENQUETE');

            $collection = Collection::find($request->id);
            $collection->state = $state;
            $collection->admin_id = Auth::user()->id;

            if($collection->save()){
                return response()->json(['message' => 'Opération effectuée avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de l\'opération veuillez réessayer',"status"=>"error"]);
            }
        }
    }
