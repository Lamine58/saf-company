<?php 
    namespace App\Http\Controllers;

    use App\Models\Collection;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class DashboardController extends Controller
    {
        public function index()
        {
            $collections = Collection::all();
            $collections_pending = Collection::where('state','pending')->get();
            $collections_success = Collection::where('state','success')->get();
            $collections_faild = Collection::where('state','faild')->get();
           
           return view('dashboard.index',compact('collections','collections_pending','collections_success','collections_faild'));

        }

    }
