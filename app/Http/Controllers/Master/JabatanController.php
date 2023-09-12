<?php


namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class JabatanController extends Controller
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
        $pageTitle = 'Master Jabatan';
        $jab = Jabatan::orderBy('name', 'asc')->get();
        confirmDelete();
        return view('content.KPI.Master.Jabatan.index', compact('pageTitle', 'jab'));
    }
    public function create()
    {
        $pageTitle = 'Input Data Jabatan';
        $jab = Jabatan::all();
        return view('content.KPI.Master.Jabatan.create', compact('pageTitle', 'jab'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'nama_jab' => 'Jabatan sudah ada'
        ];
        $validator = Validator::make($request->all(), [
            'nama_jab' => 'required|unique:jabatans,name'
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $jab = new Jabatan;
        $maxId = Jabatan::max('id');
        $jab->id = $maxId + 1;
        $jab->name = $request->nama_jab;
        $jab->save();
        Alert::success('Berhasil Ditambahkan', 'Data Jabatan Berhasil Ditambahkan');
        return redirect()->route('jabatan.index');
    }
    public function edit(string $id)
    {
        $pageTitle = 'Edit Departement';
        $jab = Jabatan::find($id);
        if ($id == 1) {
            return redirect()->route('jabatan.index');
        }
        return view('content.KPI.Master.Jabatan.edit', compact('pageTitle', 'jab'));
    }


    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
        ];
        $validator = Validator::make($request->all(), [
            'nama_jab' => 'required|unique:jabatans,name,' . $id // Add the ID to exclude from unique check
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Find the existing cabang record to update
        $jab = Jabatan::find($id);
        if (!$jab) {
            return redirect()->route('jabatan.index');
        }
        $jab->name = $request->nama_jab;
        $jab->save();
        Alert::success('Berhasil Diedit', 'Data Jabatan Berhasil Diedit');
        return redirect()->route('jabatan.index');
    }

    public function destroy($id)
    {
        $jab = Jabatan::find($id);
        $jab->delete();

        // Reorder the IDs sequentially
        $allJabatan = Jabatan::all();
        foreach ($allJabatan as $index => $jab) {
            $jab->id = $index + 1;
            $jab->save();
        }
        Alert::success('Berhasil Dihapus', 'Data Jabatan Berhasil Dihapus');
        return redirect()->route('jabatan.index');
    }
}
