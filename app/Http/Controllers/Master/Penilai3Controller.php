<?php


namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penilai3;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Penilai3Controller extends Controller
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
        $pageTitle = 'Master Penilai3';
        $pen3 = Penilai3::all();
        return view('content.KPI.Master.Penilai.Penilai3.index', compact('pageTitle', 'pen3'));
    }
    public function create()
    {
        $pageTitle = 'Input Data Penilai 3';
        $pen3 = Penilai3::all();
        return view('content.KPI.Master.Penilai.Penilai3.create', compact('pageTitle', 'pen3'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'nama_penilai3' => 'Nama Penilai-3 sudah ada'
        ];
        $validator = Validator::make($request->all(), [
            'nama_penilai3' => 'required|unique:penilai3s,name'
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $penilai3 = new Penilai3;
        $maxId = Penilai3::max('id');
        $penilai3->id = $maxId + 1;
        $penilai3->name = $request->nama_penilai3;
        $penilai3->save();
        return redirect()->route('pen3.index');
    }
    public function destroy($id)
    {
        $penilai3 = Penilai3::find($id);
        $penilai3->delete();

        // Reorder the IDs sequentially
        $allPenilai3 = Penilai3::all();
        foreach ($allPenilai3 as $index => $penilai3) {
            $penilai3->id = $index + 1;
            $penilai3->save();
        }

        return redirect()->route('pen3.index');
    }
}
