<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Models\Category;
    use App\Models\Investigation;
    use App\Models\Business;
    use App\Models\Quizze;
    use App\Models\User;
    use App\Models\Region;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    

    class ApiController extends Controller
    {

        public function __construct()
        {   
            // $this->middleware('authorization');
        }

        public function investigations(Request $request)
        {
            $investigations = Investigation::with('indicator')
            ->where('user_id', $request->user_id)
            ->where('state', $request->state)
            ->get();
            
            return response()->json([
                'status'=>"success",
                'investigations'=>$investigations,
            ], 200);

        }

        public function categories(Request $request)
        {

            // $investigations = json_decode($request->investigations);

            // if(count($investigations)>0){

            //     foreach($investigations as $data){

            //         $investigation = new Investigation;
            //         $investigation->value = $data->value;
            //         $investigation->indicator_id = $data->indicator_id;
            //         $investigation->user_id = $data->user_id;
            //         $investigation->date = $data->date;
            //         $investigation->state = 'pending';

            //         $investigation->save();
            //     }
            // }

            // $categories = Category::with('value_chain')->get();

            $user = User::findOrfail($request->user_id);

            // foreach ($categories as $category) {
            //     foreach ($category->value_chain as $quizze) {
            //         $quizze->value_chain->name;
            //         $quizze->indicators;

            //         if(!is_null($user->departement_id)){
            //             $quizze->businesses = Business::with(['business_category', 'business_quizze'])
            //                 ->where('departement_id',$user->departement_id)
            //                 ->whereHas('business_category', function ($query) use ($category) {
            //                     $query->where('category_id', $category->id);
            //                 })
            //                 ->get();
            //         }elseif(!is_null($user->region_id)){
            //             $quizze->businesses = Business::with(['business_category', 'business_quizze'])
            //                 ->where('region_id',$user->region_id)
            //                 ->whereHas('business_category', function ($query) use ($category) {
            //                     $query->where('category_id', $category->id);
            //                 })
            //                 ->get();
            //         }else{
            //             $quizze->businesses = [];
            //         }
            //     }
            // }

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

            $investigations = Investigation::with('indicator')->where('user_id',$request->user_id)->orderBy('created_at', 'desc')->get();
            $investigations_success = Investigation::with('indicator')->where('user_id',$request->user_id)->where('state','success')->orderBy('created_at', 'desc')->get();
            $investigations_wait = Investigation::with('indicator')->where('user_id',$request->user_id)->where('state','pending')->orderBy('created_at', 'desc')->get();
            $investigations_faild = Investigation::with('indicator')->where('user_id',$request->user_id)->where('state','faild')->orderBy('created_at', 'desc')->get();

            $user->role;

            return response()->json([
                'user'=>$user,
                'businesses'=>$businesses,
                'region'=>$region,
                'departement_name'=>$departement_name,
                'status'=>"success",
                'investigations'=>$investigations->count(),
                'investigations_all'=>$investigations,
                'investigations_success'=>$investigations_success,
                'investigations_wait'=>$investigations_wait,
                'investigations_faild'=>$investigations_faild
            ], 200);

        }

        public function update_investigation(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'value' => 'required',
                'indicator_id' => 'required',
                'user_id' => 'required',
                'date' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $investigation = Investigation::find($request->id);
            $investigation->value = $request->value;
            $investigation->date = $request->date;
            $investigation->state = 'pending';

            if ($investigation->save()) {

                return response()->json(['message' => 'Enquête modifié avec succès', 'status' => 'success'], 200);

            } else {
                return response()->json(["message"=>"Echec de la modification veuillez réessayer","status"=>"error"], 401);
            }
        }

        public function add_investigation(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'value' => 'required',
                'indicator_id' => 'required',
                'user_id' => 'required',
                'date' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $investigation = new Investigation;
            $investigation->value = $request->value;
            $investigation->indicator_id = $request->indicator_id;
            $investigation->user_id = $request->user_id;
            $investigation->date = $request->date;
            $investigation->state = 'pending';

            if ($investigation->save()) {

                return response()->json(['message' => 'Enquête enregistré avec succès', 'status' => 'success'], 200);

            } else {
                return response()->json(["message"=>"Echec de l'enregistrement veuillez réessayer","status"=>"error"], 401);
            }
        }

    }