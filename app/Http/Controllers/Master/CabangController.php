<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cabang;
use Illuminate\Support\Facades\DB;


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
        return redirect()->route('cabang.index');
    }



    public function destroy($id)
    {
        $cabang = Cabang::find($id);
        $cabang->delete();

        // Find the maximum ID in the "depts" table
        $maxId = Cabang::max('id');

        // Reset the auto-increment counter
        $allCabang = Cabang::all();
        foreach ($allCabang as $index => $cabang) {
            $cabang->id = $index + 1;
            $cabang->save();
        }
        return redirect()->route('cabang.index');
    }
}
