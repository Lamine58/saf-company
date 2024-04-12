<?php 
    namespace App\Http\Controllers;

    use App\Models\Departement;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class RegionController extends Controller
    {
        public function departements($region_id)
        {
            $departements = Departement::where('region_id', $region_id)->get();
            return response()->json($departements);
        }
    }
