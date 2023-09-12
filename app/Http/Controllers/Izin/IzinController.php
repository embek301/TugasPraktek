<?php


namespace App\Http\Controllers\Izin;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cabang;
use App\Models\User;






class IzinController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        $pageTitle = 'Izin Terlambat';
        return view('content.Employee.izin.dashboard', compact('pageTitle'));
    }
    public function create()
    {
        
    }


    public function store(Request $request)
    {
        
    }
    public function edit(string $id)
    {
        
    }

    public function update(Request $request, string $id)
    {
       
    }

    public function destroy($id)
    {
        
    }
}