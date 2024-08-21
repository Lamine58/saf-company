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

class PaymentController extends Controller
{
    public function index()
        {
            $payments = Payment::with('customer','souscription')
            ->paginate(100);

            return view('payment.index',compact('payments'));
        }



    public function add($id)
        {
            $souscription = Souscription::with('customer')->findOrFail($id);
            $title = 'Ajouter Paiement';
            
            return view('payment.save', compact('souscription','title'));
        }


        public function save(Request $request)
        {
            Auth::user()->access('AJOUT PAIEMENT');

            $validator = $request->validate([
                'customer_id' => 'required|string|exists:customers,id',
                'souscription_id' => 'required|string|exists:souscriptions,id',
                'ref_payment' => 'nullable|string',
                'mode_payment' => 'nullable|string',
                'date_payment' => 'required|date',
                'amount' => 'required|numeric',
            ]);

            $paymentData = $request->only(['customer_id', 'ref_payment', 'mode_payment', 'date_payment', 'amount']);
            $paymentData['souscription_id'] = $request->input('souscription_id');
            
            Payment::create($paymentData);

            return response()->json(['message' => 'Paiement enregistré avec succès', 'status' => 'success']);
        }


        public function delete(Request $request){

            $payments = Payment::find($request->id);

            if($souscription->delete()){
                return response()->json(['message' => 'Souscription supprimé avec succès',"status"=>"success"]);
            }else{
                return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
            }
        }


        public function edit($id)
        {
            Auth::user()->access('EDITION PAIEMENT');
            $title = 'Modifier le Paiement';

            $payment = Payment::find($id);
            $customers = Customer::all();

            return view('payment.edit', compact('payment', 'title', 'customers'));
        }


        public function save_edit(Request $request)
{
    Auth::user()->access('EDITION PAIEMENT');

    $validator = $request->validate([
        'customer_id' => 'required|string|exists:customers,id',
        'ref_payment' => 'nullable|string',
        'mode_payment' => 'nullable|string',
        'date_payment' => 'required|date',
        'amount' => 'required|numeric',
    ]);

    $payment = Payment::findOrFail($request->id);

    $paymentData = $request->only(['customer_id', 'ref_payment', 'mode_payment', 'date_payment', 'amount']);
    $payment->update($paymentData);

    return response()->json(['message' => 'Paiement modifié avec succès', 'status' => 'success']);
}

}
