<?php


namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penilai4;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class Penilai4Controller extends Controller
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
        $pageTitle = 'Master Penilai-4';
        $pen4 = Penilai4::all();
        confirmDelete();
        return view('content.KPI.Master.Penilai.Penilai4.index', compact('pageTitle', 'pen4'));
    }
    public function create()
    {
        $pageTitle = 'Input Data Penilai-4';
        $pen4 = Penilai4::all();
        return view('content.KPI.Master.Penilai.Penilai4.create', compact('pageTitle', 'pen4'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'nama_penilai4' => 'Nama Penilai-4 sudah ada'
        ];
        $validator = Validator::make($request->all(), [
            'nama_penilai4' => 'required|unique:penilai4s,name'
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $penilai4 = new Penilai4;
        $maxId = Penilai4::max('id');
        $penilai4->id = $maxId + 1;
        $penilai4->name = $request->nama_penilai4;
        $penilai4->save();
        Alert::success('Penilai-4 Ditambahkan', 'Data Penilai-4 Baru Berhasil Ditambahkan');
        return redirect()->route('pen4.index');
    }
    public function edit(string $id)
    {
        $pageTitle = 'Edit Penilai-4';
        if ($id == 1) {
            return redirect()->route('pen4.index');
        }
        $penilai4 = Penilai4::find($id);
        return view('content.KPI.Master.penilai.Penilai4.edit', compact('pageTitle', 'penilai4'));
    }


    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
        ];
        $validator = Validator::make($request->all(), [
            'nama_penilai4' => 'required|unique:Penilai4s,name,' . $id // Add the ID to exclude from unique check
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Find the existing cabang record to update
        $penilai4 = Penilai4::find($id);
        if (!$penilai4) {
            return redirect()->route('pen4.index');
        }
        $penilai4->name = $request->nama_penilai4;
        $penilai4->save();
        Alert::success('Penilai-4 Diedit', 'Data Penilai-4 Baru Berhasil Diedit');
        return redirect()->route('pen4.index');
    }

    public function destroy($id)
    {
        $penilai4 = Penilai4::find($id);
        $penilai4->delete();

        // Reorder the IDs sequentially
        $allPenilai4 = Penilai4::all();
        foreach ($allPenilai4 as $index => $penilai4) {
            $penilai4->id = $index + 1;
            $penilai4->save();
        }
        Alert::success('Penilai-4 Dihapus', 'Data Penilai-4 Berhasil Dihapus');
        return redirect()->route('pen4.index');
    }
}
