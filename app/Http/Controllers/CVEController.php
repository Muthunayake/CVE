<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CVEImport;
use App\CVE;

class CVEController extends Controller
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
        return view('cve', [
            'page' => 'cve'
        ]);
    }

    public function upload(Request $request)
    {
        try {
            Excel::import(new CVEImport, $request->file('cve_csv')->store('temp'));
        } catch (\Exception $e) {
            return back()->with('error', 'Your Data has benn uploaed failed');
        }

        return back()->with('success', 'Your Data has benn uploaed successfully');
    }

    public function all(Request $request)
    {
        return response()->json([
            'data' => CVE::orderBy('id', 'DESC')->get()
        ]);
    }

    public function delete($id)
    {

        return response()->json([
            'success' => CVE::find($id)->delete()
        ]);
    }

    public function edit($id, Request $request)
    {
        CVE::find($id)->update($request->all());
        return back()->with('success', 'Your Changes has been updated successfully');
    }
}
