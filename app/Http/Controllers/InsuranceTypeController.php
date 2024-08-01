<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\InsuranceType;
    use App\Models\Insurance;
    use App\Models\Role;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;

    class InsuranceTypeController extends Controller
    {
        public function index()
        {
            Auth::user()->access("LISTE TYPE D'ASSURANCE");
            $insurance_types = InsuranceType::paginate(100);
            $insurances = Insurance::paginate(100);
            return view('insurance-type.index',compact('insurance_types','insurances'));
        }

        public function add($id)
        {
            $insurance_type = InsuranceType::find($id);

            if(!is_null($insurance_type)){
                $title = "Modifier $insurance_type->name";

                Auth::user()->access('EDITION TYPE D\'ASSURANCE');
            }else{
                $insurance_type = new InsuranceType;
                $title = 'Ajouter un type d\'assurance';

                Auth::user()->access('AJOUT TYPE D\'ASSURANCE');
            }
            
            $insurances = Insurance::all();
            
            return view('insurance-type.save',compact('insurance_type','insurances','title'));
        }

        public function save(Request $request)
        {
            
            if($request->id){
                Auth::user()->access('EDITION UTILISATEUR');
            }else{
                Auth::user()->access('AJOUT UTILISATEUR');
            }

            $validator = $request->validate([
                'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'care_network' => 'nullable|file|mimes:docx,pdf|max:5000',
                'file_description' => 'nullable|file|mimes:docx,pdf|max:5000',
                'newsletter' => 'nullable|file|mimes:docx,pdf|max:5000',
                'name' => 'required|string',
                'description' => 'required|string',
            ]);
            
            $data = $request->except(['banner']);
            $insurance_type = InsuranceType::where('name', $data['name'])->where('id', '!=', $request->id)->first();

            if ($insurance_type) {
                return response()->json(['message' => 'Ce type d\'assurance existe déjà.',"status"=>"error"]);
            } else {
                
                $file = $request->file('banner');
                if ($file) {
                    $filePath = $file->storeAs('public/banner', $file->hashName());
                    $data['banner'] = $filePath ?? '';
                    $data['banner'] = str_replace('public/','',$data['banner']);
                }

                $file = $request->file('care_network');
                if ($file) {
                    $filePath = $file->storeAs('public/care_network', $file->hashName());
                    $data['care_network'] = $filePath ?? '';
                    $data['care_network'] = str_replace('public/','',$data['care_network']);
                }

                $file = $request->file('file_description');
                if ($file) {
                    $filePath = $file->storeAs('public/file_description', $file->hashName());
                    $data['file_description'] = $filePath ?? '';
                    $data['file_description'] = str_replace('public/','',$data['file_description']);
                }

                $file = $request->file('newsletter');
                if ($file) {
                    $filePath = $file->storeAs('public/newsletter', $file->hashName());
                    $data['newsletter'] = $filePath ?? '';
                    $data['newsletter'] = str_replace('public/','',$data['newsletter']);
                }
                
                $data['formules'] = [];
                $data['text'] = htmlspecialchars($data['text']);
                $data['conditions'] = [];

                $i = 0;

                foreach($request->formule_name ?? [] as $formule_name){
                    $data['formules'][] = [
                        "formule_name"=>$formule_name,
                        "formule_prime"=>$request->formule_prime[$i],
                        "formule_piece"=>$request->formule_piece[$i],
                        "formule_rate"=>$request->formule_rate[$i],
                        "formule_death"=>$request->formule_death[$i],
                        "formule_amount"=>$request->formule_amount[$i],
                        "formule_limit"=>$request->formule_limit[$i],
                        "formule_data"=>htmlspecialchars($request->formule_data[$i]),
                    ];
                    $i++;
                }
                
                $i = 0;

                foreach($request->condition_name ?? [] as $condition_name){
                    $data['conditions'][] = [
                        "condition_name"=>$condition_name,
                        "condition_type"=>$request->have_right[$i],
                        "condition_option"=>$request->condition_option[$i],
                        "condition_condition"=>$request->condition_condition[$i],
                        "condition_value"=>$request->condition_value[$i],
                    ];
                    $i++;
                }

                $data['formules'] = json_encode($data['formules']);
                $data['conditions'] = json_encode($data['conditions']);

                $insurance_type = InsuranceType::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }
            
            return response()->json(['message' => 'Type d\'assurance enregistré avec succès', 'status' => 'success']);
        }

        public function delete(Request $request){

            Auth::user()->access('SUPPRESSION TYPE D\'ASSURANCE');

            $insurance_type = InsuranceType::find($request->id);

            if($insurance_type->delete()){
                return response()->json(['message' => 'Type d\'assurance supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }

        public function insurance_types($insurance_id){
            $insurance_types = InsuranceType::where('insurance_id',$insurance_id)->get();
            echo json_encode(["insurance_types"=>$insurance_types]);
        }

        public function options($insurance_type_id){

            $insurance_type = InsuranceType::findOrfail($insurance_type_id);
			$logo = Storage::url($insurance_type->banner);
			$care_network = Storage::url($insurance_type->care_network);
			$newsletter = Storage::url($insurance_type->newsletter);
			$file_description = Storage::url($insurance_type->file_description);
			
            $options = [];

            foreach(json_decode($insurance_type->formules) as $formule){
                
                $data = explode(' ',$formule->formule_name);

                if(count($data)==3){
                    $options[]= str_replace(['(',')'],['',''],$data[1]);
                }else{
                    $options[]= $data[0];
                }

            }

            $options = array_unique($options);
            echo json_encode(["text"=>htmlspecialchars_decode($insurance_type->text),"options"=>$options,"logo"=>$logo,"care_network"=>$care_network,"file_description"=>$file_description,"newsletter"=>$newsletter]);
        }


        public function insurance_types_data($option,$insurance_type_id){
            
            $insurance_type = InsuranceType::findOrfail($insurance_type_id);
            $formules = [];

            foreach(json_decode($insurance_type->formules) as $formule){

                $position = strpos($formule->formule_name, $option);

                if ($position !== false) {

                    $data = explode(' ',$formule->formule_name);
                    if(count($data)==3){
                        $formule->formule_name_original = $data[0].' '.$data[1];
                        $formule->formule_name = $data[0].' '.str_replace(['[',']'],['',''],$data[2]);
                    }else{
                        $formule->formule_name_original = $data[0];
                        $formule->formule_name = $data[0].' '.str_replace(['[',']'],['',''],$data[1]);
                    }

                    $formule->formule_amount = $formule->formule_prime + $formule->formule_piece + $formule->formule_rate+ $formule->formule_death+ $formule->formule_amount;
                    $formules[]=$formule;
                }

            }
            
            echo json_encode(["formules"=>$formules]);
        }

        public function formules($insurance_type_id){
            
            $insurance_type = InsuranceType::findOrfail($insurance_type_id);
            $logo = Storage::url($insurance_type->banner);
            $care_network = Storage::url($insurance_type->care_network);
            $newsletter = Storage::url($insurance_type->newsletter);
            $file_description = Storage::url($insurance_type->file_description);
            $formules = [];

            foreach(json_decode($insurance_type->formules) as $formule){
                $formule->formule_amount = $formule->formule_prime + $formule->formule_piece + $formule->formule_rate+ $formule->formule_death+ $formule->formule_amount;
                $formules[]=$formule;
            }
            
            echo json_encode(["formules"=>$formules,"logo"=>$logo,"care_network"=>$care_network,"file_description"=>$file_description,"newsletter"=>$newsletter]);
        }

        public function conditions($formule_name,$insurance_type_id){
            $insurance_type = InsuranceType::findOrfail($insurance_type_id);
            $conditions = [];
            $affections = [];
            $datas = [];
            foreach (json_decode($insurance_type->conditions) as $condition) {
                if(count(explode('*',$condition->condition_name))==1){
                    $data = explode(',',$condition->condition_name);
                    if(count($data)==1){
                        $condition->condition_name = $data[0];
                        $conditions[] = $condition;
                    }
                    elseif(count($data)==2){
                        if($data[1]==$formule_name){
                            $condition->condition_name = $data[0];
                            $conditions[] = $condition;
                            $datas[$condition->condition_type][] = $condition->condition_type;
                        }
                    }
                }else{
                    $condition->condition_name = str_replace('*affection','',$condition->condition_name);
                    $data = explode(',',$condition->condition_name);
                    if(count($data)==1){
                        $condition->condition_name = str_replace('*affection','',$data[0]);
                        $affections[] = $condition;
                    }
                    elseif(count($data)==2){
                        if($data[1]==$formule_name){
                            $condition->condition_name = str_replace('*affection','',$data[0]);
                            $affections[] = $condition;
                            $datas[$condition->condition_type][] = $condition->condition_type;
                        }
                    }
                }
            }
            echo json_encode(["conditions"=>$conditions,"affections"=>$affections,"datas"=>count($datas)]);
        }
    }