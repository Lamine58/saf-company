<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Models\Category;
    use App\Models\Investigation;
    use App\Models\Collection;
    use App\Models\Business;
    use App\Models\Quizze;
    use App\Models\User;
    use App\Models\Region;
    use App\Models\Indicator;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    

    class ApiController extends Controller
    {

        public function __construct()
        {   
            // $this->middleware('authorization');
        }

        public function categories(Request $request)
        {

            $collections = $request->collections;

            if(count($collections)>0){

                foreach($collections as $data){

                    $quizze = Quizze::find($data['investigations'][0]['quizze_id']);

                    $collection = new Collection;
                    $collection->value_chain_id = $quizze->value_chain_id;
                    $collection->category_id = $quizze->category_id;
                    $collection->user_id = $data['user_id'];
                    $collection->date = $data['date'];
                    $collection->business_id = $data['business_id'];
                    $collection->state = 'pending';
                    $collection->location = json_encode($data['location']);
                    $collection->save();
        
                    foreach($data['investigations'] as $investigation_data){
        
                        $investigation = new Investigation;
                        $investigation->value = $investigation_data['value'];
                        $investigation->indicator_id = $investigation_data['id'];
                        $investigation->collection_id = $collection->id;
                        $investigation->save();
                    }
                }
            }


            $user = User::findOrfail($request->user_id);

            $businesses = [];
            $region = null;
            $departement_name = '';

            if(!is_null($user->departement_id)){
                $businesses = Business::where('departement_id',$user->departement_id)->get();
                $departement_name = $user->departement->name;
            }elseif(!is_null($user->region_id)){
                $region = Region::find($user->region_id);
            }

            foreach ($businesses as $business) {
                foreach($business->business_category as $business_category){
                    foreach ($business_category->value_chain as $quizze) {
                        $quizze->value_chain->name;
                        $quizze->indicators;
                        foreach($quizze->indicators as $indicator){

                            $indicator->value="";
                            $array = [];

                            foreach (json_decode($indicator->data ?? []) as $key => $value) {
                                $array[] = [
                                        "value" => $value,
                                        "selected" => false,
                                ];
                            }

                            $indicator->data = $array;

                        }
                    }
                }
            }

            foreach($region->departements ?? [] as $departement){
                $departement->businesses = Business::where('departement_id',$departement->id)->get();
                foreach ($departement->businesses as $business) {
                    foreach($business->business_category as $business_category){
                        foreach ($business_category->value_chain as $quizze) {
                            $quizze->value_chain->name;
                            foreach($quizze->indicators as $indicator){

                                $indicator->value="";
                                $array = [];
    
                                foreach (json_decode($indicator->data ?? []) as $key => $value) {
                                    $array[] = [
                                            "value" => $value,
                                            "selected" => false,
                                    ];
                                }
    
                                $indicator->data = $array;
                            }
                        }
                    }
                }
            }

            $collections_wait = Collection::with('investigations', 'value_chain', 'category', 'business')
            ->where('user_id', $request->user_id)
            ->where('state', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

            $collectionss_success = Collection::with('investigations', 'value_chain', 'category', 'business')
            ->where('user_id', $request->user_id)
            ->where('state', 'success')
            ->orderBy('created_at', 'desc')
            ->get();

            $collections_faild = Collection::with('investigations', 'value_chain', 'category', 'business')
            ->where('user_id', $request->user_id)
            ->where('state', 'faild')
            ->orderBy('created_at', 'desc')
            ->get();

            foreach ($collections_wait as $collection) {
                $indicators = Quizze::where('category_id', $collection->category_id)
                    ->where('value_chain_id', $collection->value_chain_id)
                    ->first()
                    ->indicators;

                $collection->indicators = $indicators;
            }

            foreach ($collectionss_success as $collection) {
                $indicators = Quizze::where('category_id', $collection->category_id)
                    ->where('value_chain_id', $collection->value_chain_id)
                    ->first()
                    ->indicators;

                $collection->indicators = $indicators;
            }

            foreach ($collections_faild as $collection) {
                $indicators = Quizze::where('category_id', $collection->category_id)
                    ->where('value_chain_id', $collection->value_chain_id)
                    ->first()
                    ->indicators;

                $collection->indicators = $indicators;
            }

            $user->role;

            return response()->json([
                'user'=>$user,
                'businesses'=>$businesses,
                'region'=>$region,
                'departement_name'=>$departement_name,
                'status'=>"success",
                'collections'=>0,
                'collections_all'=> [],
                'collections_success'=> $collectionss_success,
                'collections_wait'=> $collections_wait,
                'collections_faild'=> $collections_faild
            ], 200);

        }

        public function update_collection(Request $request)
        {

            $validator = Validator::make($request->all(), [
                'investigations' => 'required',
                'date' => 'required',
                
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            foreach($request->investigations as $investigation_data){

                $investigation = Investigation::find($investigation_data['id']);
                $investigation->value = $investigation_data['value'];
                $investigation->save();
            }

            return response()->json(['message' => 'Enquête modifié avec succès', 'status' => 'success'], 200);
        }

        public function add_collection(Request $request)
        {

            $validator = Validator::make($request->all(), [
                'business_id' => 'required',
                'user_id' => 'required',
                'investigations' => 'required',
                'date' => 'required',
                
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $quizze = Quizze::find($request->investigations[0]['quizze_id']);

            $collection = new Collection;
            $collection->value_chain_id = $quizze->value_chain_id;
            $collection->category_id = $quizze->category_id;
            $collection->user_id = $request->user_id;
            $collection->date = $request->date;
            $collection->business_id = $request->business_id;
            $collection->state = 'pending';
            $collection->location = json_encode($request->location);
            $collection->save();

            foreach($request->investigations as $investigation_data){

                $investigation = new Investigation;
                $investigation->indicator_id = $investigation_data['id'];
                $investigation->value = $investigation_data['value'];
                $investigation->collection_id = $collection->id;
                $investigation->save();
            }

            if ($collection->save()) {

                return response()->json(['message' => 'Enquête enregistré avec succès', 'status' => 'success'], 200);

            } else {
                return response()->json(["message"=>"Echec de l'enregistrement veuillez réessayer","status"=>"error"], 401);
            }
        }

    }