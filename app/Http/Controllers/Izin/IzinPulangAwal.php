<?php


namespace App\Http\Controllers\Izin;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cabang;
use App\Models\User;
use Carbon\Carbon;






class IzinPulangAwal extends Controller
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
        $users = User::all();
        $dateInGMTPlus7 = Carbon::now()->setTimezone('Asia/Jakarta');
        $currentHour = $dateInGMTPlus7->format('H'); // Get the current hour in 24-hour format
        $idPulangAwal = 'ASR' . $dateInGMTPlus7->format('y') . $dateInGMTPlus7->format('m') . '0001';
        $pageTitle = 'Form Izin Pulang Awal';

        // Check if the current hour is within the allowed time frame (08:00 - 15:59)
        $isWithinAllowedTime = ($currentHour >= 8 && $currentHour < 16);

        return view('content.Employee.izin.pulangawal', compact('pageTitle', 'users', 'dateInGMTPlus7', 'idPulangAwal', 'isWithinAllowedTime'));
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