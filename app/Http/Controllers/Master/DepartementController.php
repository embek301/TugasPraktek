<?php


namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Dept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DepartementController extends Controller
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
        $pageTitle = 'Master Departement';
        $dept = Dept::all();
        return view('content.KPI.Master.Departement.index', compact('pageTitle', 'dept'));
    }
    public function create()
    {
        $pageTitle = 'Input Data Departement';
        $dept = Dept::all();
        return view('content.KPI.Master.Departement.create', compact('pageTitle', 'dept'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'nama_dept' => 'Departemen sudah ada'

        ];
        $validator = Validator::make($request->all(), [
            'nama_dept' => 'required|unique:depts,name'
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $dept = new Dept;
        $maxId = Dept::max('id');
        $dept->id = $maxId + 1;
        $dept->name = $request->nama_dept;
        $dept->save();
        return redirect()->route('departement.index');
    }

    public function destroy($id)
    {
        $dept = Dept::find($id);
        $dept->delete();

        // Reorder the IDs sequentially
        $allDepts = Dept::all();
        foreach ($allDepts as $index => $dept) {
            $dept->id = $index + 1;
            $dept->save();
        }

        return redirect()->route('departement.index');
    }
}
