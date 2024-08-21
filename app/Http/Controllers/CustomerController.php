<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Customer;
    use App\Models\Insurance;
    use App\Models\Role;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;

    class CustomerController extends Controller
    {
        public function index()
        {
            Auth::user()->access("LISTE CLIENT");
            $customers = Customer::paginate(100);
            return view('customer.index',compact('customers'));
        }
 
        public function add($id)
        {
            $customer = Customer::find($id);

            if(!is_null($customer)){
                $title = "Modifier $customer->first_name $customer->last_name";

                Auth::user()->access('EDITION CLIENT');
            }else{
                $customer = new Customer;
                $title = 'Ajouter un client';

                Auth::user()->access('AJOUT CLIENT');
            } 
            
            return view('customer.save',compact('customer','title'));
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
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'nullable|email|unique:customers,email',
                'phone_number' => 'nullable|string|max:20',
                'date_of_birth' => 'required|date',
                'address' => 'required|string|max:255',
            ]);
            
            $data = $request->except(['avatar']);
            $customer = Customer::where('phone_number', $data['phone_number'])->where('id', '!=', $request->id)->first();

            if ($customer) {
                return response()->json(['message' => 'Ce client existe déjà.',"status"=>"error"]);
            } else {
                
                $file = $request->file('avatar');
                if ($file) {
                    $filePath = $file->storeAs('public/avatar', $file->hashName());
                    $data['avatar'] = $filePath ?? '';
                    $data['avatar'] = str_replace('public/','',$data['avatar']);
                }
                $customer = Customer::updateOrCreate(
                    ['id' => $request->id],
                    $data
                );
            }
            
            return response()->json(['message' => 'Client enregistré avec succès', 'status' => 'success']);
        }

        public function delete(Request $request){

            Auth::user()->access('SUPPRESSION CLIENT');

            $customer = Customer::find($request->id);

            if($customer->delete()){
                return response()->json(['message' => 'Client supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }
    }