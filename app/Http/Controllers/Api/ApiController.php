<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Models\Category;
    use App\Models\Investigation;
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

            $investigations = json_decode($request->investigations);

            if(count($investigations)>0){

                foreach($investigations as $data){

                    $investigation = new Investigation;
                    $investigation->value = $data->value;
                    $investigation->indicator_id = $data->indicator_id;
                    $investigation->user_id = $data->user_id;
                    $investigation->date = $data->date;
                    $investigation->state = 'pending';

                    $investigation->save();
                }
            }

            $categories = Category::with('indicators')->get();
            $investigations = Investigation::with('indicator')->where('user_id',$request->user_id)->orderBy('created_at', 'desc')->get();
            $investigations_success = Investigation::with('indicator')->where('user_id',$request->user_id)->where('state','success')->orderBy('created_at', 'desc')->get();
            $investigations_wait = Investigation::with('indicator')->where('user_id',$request->user_id)->where('state','pending')->orderBy('created_at', 'desc')->get();
            $investigations_faild = Investigation::with('indicator')->where('user_id',$request->user_id)->where('state','faild')->orderBy('created_at', 'desc')->get();

            $formattedData = [];
            foreach ($categories as $category) {
                $formattedCategory = [
                    'name' => $category->name,
                    'indicators' => $category->indicators->map(function ($indicator) {
                        return [
                            'id' => $indicator->id,
                            'indicator' => $indicator->indicator,
                            'definition' => $indicator->definition,
                            'type' => $indicator->type,
                            'data' => $indicator->data,
                        ];
                    }),
                ];
                $formattedData[] = $formattedCategory;
            }

            return response()->json([
                'data'=>$formattedData,
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