<?php

namespace App\Http\Controllers;

use App\Imports\TransfertMoneyImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\TransfertMoney;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;

class TransfertMoneyController extends Controller 
{

    public function index()
    {
        Auth::user()->access('LISTE TRANSFERT');

        $title = 'Historique des transactions';

        $TransfertMoneys = TransfertMoney::paginate(100);
        return view('transfert_money.index',compact('title', 'TransfertMoneys'));
    }

    public function add()
    {
        Auth::user()->access('AJOUT TRANSFERT');

        $title = 'Charger un rapport Excel';
        return view('transfert_money.save',compact('title'));
    }


    public function import(Request $request)
    {
        Auth::user()->access('AJOUT TRANSFERT');

        $request->validate([
            'file_upload' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new TransfertMoneyImport, $request->file('file_upload'));

        return response()->json(['message' => 'Les données ont été importées avec succès.', 'status' => 'success']);
    }

    public function delete(Request $request){

        Auth::user()->access('SUPPRESSION TRANSFERT');

        $TransfertMoneys = TransfertMoney::find($request->id);

        if($TransfertMoneys->delete()){
            return response()->json(['message' => 'Transaction supprimé avec succès',"status"=>"success"]);
        }else{
            return response()->json(['message' => 'Echec de la suppression veuillez réessayer',"status"=>"error"]);
        }
    }
    
}
