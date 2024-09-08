<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Customer;
    use App\Models\Payment;
    use App\Models\Insurance;
    use App\Models\Role;
    use App\Models\Souscription;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Response;
    use Illuminate\Support\Facades\DB;
    

    class SouscriptionController extends Controller
    {

        public function index()
        {
            Auth::user()->access('LISTE SOUSCRIPTION EN COURS');

            $currentDate = Carbon::now();
            $souscriptions = Souscription::with(['customer', 'payment'])
            ->where('date_of_expiration', '>', $currentDate)
            ->paginate(100);
            
            foreach ($souscriptions as $souscription) {
                $montantPayé = DB::table('payments')
                    ->where('customer_id', $souscription->customer_id)
                    ->where('souscription_id', $souscription->id)
                    ->sum('amount');
        
                $souscription->paid = $montantPayé;
        
                $souscription->stay_paid = $souscription->amount_souscription - $montantPayé;
            }

            return view('souscription.index', compact('souscriptions'));
        }

        public function expired()
        {
            Auth::user()->access('LISTE SOUSCRIPTION EXPIRE');

            $currentDate = Carbon::now();
            $expiredSubscriptions = Souscription::with(['customer', 'payment'])
            ->where('date_of_expiration', '<', $currentDate)
            ->paginate(100);
            
            foreach ($expiredSubscriptions as $expiredSubscription) {
                $montantPayé = DB::table('payments')
                    ->where('customer_id', $expiredSubscription->customer_id)
                    ->where('souscription_id', $expiredSubscription->id)
                    ->sum('amount');
        
                $expiredSubscription->paid = $montantPayé;
        
                $expiredSubscription->stay_paid = $expiredSubscription->amount_souscription - $montantPayé;
            }
    
            return view('souscription.expired', compact('expiredSubscriptions'));
        }

        public function downloadFile($id)
        {
            $souscription = Souscription::findOrFail($id);
            $filePath = 'public/' . $souscription->file_souscriptions;

            return Response::download(storage_path('app/' . $filePath));
           
        }


        public function add($id)
        {
            Auth::user()->access('AJOUT SOUSCRIPTION');
            $title = 'Ajouter une souscription';

            $souscription = Souscription::find($id);
            
            $customers = Customer::all();
            return view('souscription.save',compact('souscription','title', 'customers'));
        }


        public function save(Request $request)
        {
            Auth::user()->access('AJOUT SOUSCRIPTION');

            $validator = $request->validate([
                'file_souscriptions' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:2048',
                'number_souscriptions' => 'required|string',
                'customer_id' => 'nullable|string|exists:customers,id',
                'formule' => 'required|string',
                'date_of_expiration' => 'required|date',
                'amount_souscription' => 'required|numeric',
                //Les champs de la table Paiement
                'ref_payment' => 'nullable|string',
                'mode_payment' => 'nullable|string',
                'date_payment' => 'required|date',
                'amount' => 'required|numeric',
            ]);

            $data = $request->except(['file_souscriptions', 'ref_payment', 'mode_payment', 'date_payment', 'amount']);
            
            $file = $request->file('file_souscriptions');
            if ($file) {
                $filePath = $file->storeAs('public/souscriptions', $file->hashName());
                $data['file_souscriptions'] = $filePath ? str_replace('public/', '', $filePath) : '';
            }
            
            $souscription = Souscription::updateOrCreate(
                ['id' => $request->id],
                $data
            );

            $paymentData = $request->only(['customer_id', 'ref_payment', 'mode_payment', 'date_payment', 'amount']);
            $paymentData['souscription_id'] = $souscription->id;
            
            $payment = Payment::updateOrCreate(
                ['souscription_id' => $souscription->id],
                $paymentData
            );

            return response()->json(['message' => 'Souscription et paiement enregistrés avec succès', 'status' => 'success']);
        }

        public function delete(Request $request){

            Auth::user()->access('SUPPRESSION SOUSCRIPTION');

            $souscription = Souscription::find($request->id);

            if($souscription->delete()){
                return response()->json(['message' => 'Souscription supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }

        public function edit($id)
        {
            Auth::user()->access('EDITION SOUSCRIPTION');
            $title = 'Modifier la souscription';

            $souscription = Souscription::find($id);
            $customers = Customer::all();

            return view('souscription.edit', compact('souscription', 'title', 'customers'));
        }

        public function save_edit(Request $request)
        {
            Auth::user()->access('EDITION SOUSCRIPTION');

            $validator = $request->validate([
                'file_souscriptions' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:2048',
                'number_souscriptions' => 'required|string',
                'customer_id' => 'nullable|string|exists:customers,id',
                'formule' => 'required|string',
                'amount_souscription' => 'required|numeric',
                'date_of_expiration' => 'required|date',
            ]);

            $data = $request->except(['file_souscriptions']);
              
            $file = $request->file('file_souscriptions');
            if ($file) {
                $filePath = $file->storeAs('public/souscriptions', $file->hashName());
                $data['file_souscriptions'] = $filePath ? str_replace('public/', '', $filePath) : '';
            }
            
            $souscription = Souscription::find($request->id);

            $souscription->update($data);

            return response()->json(['message' => 'Souscription modifiée avec succès', 'status' => 'success']);
            
        }


    }
 