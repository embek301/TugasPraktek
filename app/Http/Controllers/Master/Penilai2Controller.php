<?php


namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\penilai2;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

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
        $pageTitle = 'Master Penilai-2';
        $pen2 = penilai2::orderBy('name', 'asc')->get();
        confirmDelete();
        return view('content.KPI.Master.Penilai.penilai2.index', compact('pageTitle', 'pen2'));
    }
    public function create()
    {
        $pageTitle = 'Input Data Penilai-2';
        $pen2 = penilai2::orderBy('name', 'asc')->get();
        $user = User::where('hak', '<>', 10)->where('aktif', '<>', 0)->get();
        return view('content.KPI.Master.Penilai.penilai2.create', compact('pageTitle', 'pen2', 'user'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'unique' => 'Penilai-2 dengan nama ":input" sudah ada'
        ];

        $validator = Validator::make($request->all(), [
            'nama_penilai2' => 'required|unique:penilai2s,name'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $penilai2 = new penilai2;
        $maxId = penilai2::max('id');
        $penilai2->id = $maxId + 1;
        $penilai2->name = $request->input('nama_penilai2');
        $penilai2->save();

        Alert::success('Berhasil Ditambahkan', 'Data Penilai-2 Baru Berhasil Ditambahkan');
        return redirect()->route('penilai2.index');
    }

    public function edit(string $id)
    {
        $pageTitle = 'Edit Penilai-2';
        $penilai2 = penilai2::find($id);
        if ($id == 1) {
            return redirect()->route('penilai2.index');
        }
        return view('content.KPI.Master.penilai.penilai2.edit', compact('pageTitle', 'penilai2'));
    }


    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
        ];
        $validator = Validator::make($request->all(), [
            'nama_penilai2' => 'required|unique:penilai2s,name,' . $id // Add the ID to exclude from unique check
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Find the existing cabang record to update
        $penilai2 = penilai2::find($id);
        if (!$penilai2) {
            return redirect()->route('penilai2.index');
        }
        $penilai2->name = $request->nama_penilai2;
        $penilai2->save();
        Alert::success('Berhasil Diedit', 'Data Penilai-2 Baru Berhasil Diedit');
        return redirect()->route('penilai2.index');
    }

    public function destroy($id)
    {
        $penilai2 = penilai2::find($id);
        $penilai2->delete();

        // Reorder the IDs sequentially
        $allpenilai2 = penilai2::all();
        foreach ($allpenilai2 as $index => $penilai2) {
            $penilai2->id = $index + 1;
            $penilai2->save();
        }
        Alert::success('Berhasil Dihapus', 'Data Penilai-2 Berhasil Dihapus');
        return redirect()->route('penilai2.index');
    }
}
