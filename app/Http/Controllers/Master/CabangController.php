<?php


namespace App\Http\Controllers\Master;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cabang;






class CabangController extends Controller
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
        $pageTitle = 'Master Cabang';
        $cabang = Cabang::all();
        confirmDelete();
        return view('content.KPI.Master.Cabang.index', compact('pageTitle', 'cabang'));
    }
    public function create()
    {
        $pageTitle = 'Input Data Cabang';
        $cabang = Cabang::all();
        return view('content.KPI.Master.Cabang.Create', compact('pageTitle', 'cabang'));
    }


    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'nama_cabang' => 'Cabang sudah ada'
        ];
        $validator = Validator::make($request->all(), [
            'nama_cabang' => 'required|unique:cabs,name'
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $cabang = new Cabang;
        $maxId = Cabang::max('id');
        $cabang->id = $maxId + 1;
        $cabang->name = $request->nama_cabang;
        $cabang->admin_unit = $request->nama_admin;
        $cabang->pic = $request->nama_pic;
        $cabang->head = $request->nama_head;
        $cabang->kabeng = $request->nama_kabeng;
        $cabang->save();
        Alert::success('Cabang Ditambahkan', 'Data Cabang Baru Berhasil Ditambahkan');
        return redirect()->route('cabang.index');
    }
    public function edit(string $id)
    {
        $pageTitle = 'Edit Cabang';
        $cabang = Cabang::find($id);
        if ($id == 1) {
            return redirect()->route('cabang.index');
        }
        return view('content.KPI.Master.Cabang.edit', compact('pageTitle', 'cabang'));
    }

    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'nama_cabang' => 'Cabang sudah ada'
        ];
        $validator = Validator::make($request->all(), [
            'nama_cabang' => 'required|unique:cabs,name,' . $id // Add the ID to exclude from unique check
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Find the existing cabang record to update
        $cabang = Cabang::find($id);
        if (!$cabang) {
            return redirect()->route('cabang.index');
        }

        $cabang->name = $request->nama_cabang;
        $cabang->admin_unit = $request->nama_admin;
        $cabang->pic = $request->nama_pic;
        $cabang->head = $request->nama_head;
        $cabang->kabeng = $request->nama_kabeng;
        $cabang->save();
        Alert::success('Cabang Diedit', 'Data Cabang Baru Berhasil Diedit');
        return redirect()->route('cabang.index');
    }

    public function destroy($id)
    {
        $cabang = Cabang::find($id);
        $cabang->delete();


        // Reset the auto-increment counter
        $allCabang = Cabang::all();
        foreach ($allCabang as $index => $cabang) {
            $cabang->id = $index + 1;
            $cabang->save();
        }
        Alert::success('Deleted Successfully', 'Cabang Berhasil Dihapus.');
        return redirect()->route('cabang.index');
    }
}