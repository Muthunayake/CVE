<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\EXP;
use App\Imports\EXPImport;

class EXPController extends Controller
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
        return view('exp', [
            'page' => 'exp'
        ]);
    }

    public function upload(Request $request)
    {
        try {
            Excel::import(new EXPImport, $request->file('exp_csv')->store('temp'));
        } catch (\Exception $e) {
            return back()->with('error', 'Your Data has been uploaed failed');
        }

        return back()->with('success', 'Your Data has been uploaed successfully');
    }

    public function all(Request $request)
    {
        return response()->json([
            'data' => EXP::orderBy('id', 'DESC')->get()
        ]);
    }

    public function delete($id)
    {

        return response()->json([
            'success' => EXP::find($id)->delete()
        ]);
    }

    public function edit($id, Request $request)
    {
        EXP::find($id)->update($request->all());
        return back()->with('success', 'Your Changes has been updated successfully');
    }
}
