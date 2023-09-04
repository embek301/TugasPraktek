<?php


namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
        $jab = Jabatan::all();
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
        return redirect()->route('jab.index');
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

        return redirect()->route('jab.index');
    }
}
