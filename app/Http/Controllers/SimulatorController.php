<?php 
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Insurance;
    use App\Models\InsuranceType;

    class SimulatorController extends Controller
    {
        public function index()
        {
            $insurances = Insurance::all();
            $images = InsuranceType::images();
            $insurance_types = InsuranceType::all();
            return view('simulator.index',compact('insurances','insurance_types','images'));
        }

    }
