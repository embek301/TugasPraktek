<?php


namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penilai2;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Penilai2Controller extends Controller
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
        $pageTitle = 'Master Penilai2';
        $pen2 = Penilai2::all();
        return view('content.KPI.Master.Penilai.Penilai2.index', compact('pageTitle', 'pen2'));
    }
    public function create()
    {
        $pageTitle = 'Input Data Penilai 2';
        $pen2 = Penilai2::all();
        return view('content.KPI.Master.Penilai.Penilai2.create', compact('pageTitle', 'pen2'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'nama_penilai2' => 'Nama Penilai-2 sudah ada'
        ];
        $validator = Validator::make($request->all(), [
            'nama_penilai2' => 'required|unique:penilai2s,name'
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $penilai2 = new Penilai2;
        $maxId = Penilai2::max('id');
        $penilai2->id = $maxId + 1;
        $penilai2->name = $request->nama_penilai2;
        $penilai2->save();
        return redirect()->route('pen2.index');
    }

    public function destroy($id)
    {
        $penilai2 = Penilai2::find($id);
        $penilai2->delete();

        // Reorder the IDs sequentially
        $allPenilai2 = Penilai2::all();
        foreach ($allPenilai2 as $index => $penilai2) {
            $penilai2->id = $index + 1;
            $penilai2->save();
        }

        return redirect()->route('pen2.index');
    }
}
