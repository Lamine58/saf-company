<?php 
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Customer;
    use App\Models\Mailing;
    use App\Models\Message;
    use Illuminate\Support\Facades\Mail;
    

    class CRMController extends Controller
    {
      public function index()
      {
         Auth::user()->access('CRM');
         return view('crm.index');
      }

      public function mail()
      {
         Auth::user()->access('MAILING');
         $mailings = Mailing::orderBy('created_at', 'desc')->paginate(100);
         return view('crm.mail',compact('mailings'));
      }

      public function sms()
      {
         Auth::user()->access('SMS');
         $messages = Message::orderBy('created_at', 'desc')->paginate(100);
         return view('crm.sms',compact('messages'));
      }

      public function send_mail(Request $request)
      {

         Auth::user()->access('MAILING');

         $data = $request->validate([
             'recipient' => 'required|string',
             'cc' => 'nullable|string',
             'bcc' => 'nullable|string',
             'subject' => 'required|string|max:255',
             'message' => 'required|string',
         ]);

         $data['user_id'] = Auth::id();
         $mailing = Mailing::create($data);

         Mail::send([], [], function ($message) use ($data) {

            $recipients = explode(',', $data['recipient']);
            $recipientEmails = [];
      
            foreach ($recipients as $recipient) {

               $recipient = trim($recipient);

               if (filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                  $recipientEmails[] = $recipient;
               } else {
                  switch ($recipient) {
                        case 'Souscripteurs':
                           $emails = Customer::pluck('email')->toArray();
                           $recipientEmails = array_merge($recipientEmails, $emails);
                        break;
                        case 'Prospects':
                           $emails = Customer::pluck('email')->toArray();
                           $recipientEmails = array_merge($recipientEmails, $emails);
                        break;
                  }
               }
            }
      
            $ccs = explode(',', $data['cc']);
            $bccs = explode(',', $data['bcc']);
      
            foreach ($recipientEmails as $recipientEmail) {
               $message->to($recipientEmail);
            }
      
            foreach ($ccs as $cc) {
               $cc = trim($cc);
               if (filter_var($cc, FILTER_VALIDATE_EMAIL)) {
                  $message->cc($cc);
               }
            }
      
            foreach ($bccs as $bcc) {
               $bcc = trim($bcc);
               if (filter_var($bcc, FILTER_VALIDATE_EMAIL)) {
                  $message->bcc($bcc);
               }
            }
      
            $message->subject($data['subject'])
                  ->html($data['message']);
         });

         return response()->json(['message' => 'Mail envvoyé avec succès avec succès', 'status' => 'success']);
      }


      public function send_sms(Request $request)
      {

         Auth::user()->access('SMS');

         $data = $request->validate([
             'recipient' => 'required|string',
             'message' => 'required|string',
         ]);

         $data['user_id'] = Auth::id();
         $message = Message::create($data);

         $recipients = explode(',', $data['recipient']);
         $recipientPhoneNumbers = [];
   
         foreach ($recipients as $recipient) {

            $recipient = trim($recipient);

            if ($recipient!='Souscripteurs' && $recipient!='Prospects') {
               $recipientPhoneNumbers[] = $recipient;
            } else {
               switch ($recipient) {
                     case 'Souscripteurs':
                        $phone_numbers = Customer::pluck('phone_number')->toArray();
                        $recipientPhoneNumbers = array_merge($recipientPhoneNumbers, $phone_numbers);
                     break;
                     case 'Prospects':
                        $phone_numbers = Customer::pluck('phone_number')->toArray();
                        $recipientPhoneNumbers = array_merge($recipientPhoneNumbers, $phone_numbers);
                     break;
               }
            }
         }

         $this->sms_api($message->message,$recipientPhoneNumbers);

         return response()->json(['message' => 'SMS envvoyé avec succès avec succès', 'status' => 'success']);
      }


      public static function sms_api($message,$phone){

         $curl = curl_init();

         $data = array("api_key" => "TLexO4btRYvSn30HrfgosIbtZGknV6rxT6Ip2cDtun2LReGLW641lbMJAxL6LS", "to" => $phone,  "from" => "UpDev",
         "sms" => $message,  "type" => "plain",  "channel" => "generic" );
         $post_data = json_encode($data);

         curl_setopt_array($curl, array(
             CURLOPT_URL => "https://api.ng.termii.com/api/sms/send",
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => "",
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 0,
             CURLOPT_FOLLOWLOCATION => true,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => "POST",
             CURLOPT_POSTFIELDS => $post_data,
             CURLOPT_HTTPHEADER => array(
             "Content-Type: application/json"
             ),
         ));

         $response = curl_exec($curl);
         curl_close($curl);
     }

      public function delete_mail(Request $request){

         Auth::user()->access('SUPPRESSION ARCHIVE MAILING');

         $mailing = Mailing::find($request->id);

         if($mailing->delete()){
             return response()->json(['message' => 'Archive mail supprimé avec succès',"status"=>"success"]);
         }else{
             return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
         }
     }

     public function delete_sms(Request $request){

        Auth::user()->access('SUPPRESSION ARCHIVE SMS');

        $message = Message::find($request->id);

        if($message->delete()){
            return response()->json(['message' => 'Archive SMS supprimé avec succès',"status"=>"success"]);
        }else{
            return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
        }
    }

}
