<?php 
    namespace App\Http\Controllers;

    use App\Models\SousPrefecture;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class DepartementController extends Controller
    {
        public function sous_prefectures($departement_id)
        {
            $sous_prefectures = SousPrefecture::where('departement_id', $departement_id)->get();
            return response()->json($sous_prefectures);
        }
    }
