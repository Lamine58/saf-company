<?php 
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Insurance;

    class SimulatorController extends Controller
    {
        public function index()
        {
            $insurances = Insurance::all();
            return view('simulator.index',compact('insurances'));
        }

    }
