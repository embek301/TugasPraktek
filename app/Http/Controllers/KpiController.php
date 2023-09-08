<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class KpiController extends Controller
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
        $pageTitle = 'KPI';
        $users = User::where('hak', '<>', 10)->get();
        return view('content.KPI.dashboard', compact('pageTitle', 'users'));
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
}
