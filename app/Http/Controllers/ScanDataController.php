<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ScanDataImport;
use App\ScanData;

class ScanDataController extends Controller
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
        return view('scan-data', [
            'page' => 'scan-data'
        ]);
    }

    public function upload(Request $request)
    {
        try {
            Excel::import(new ScanDataImport, $request->file('scan_csv')->store('temp'));
        } catch (\Exception $e) {
            return back()->with('error', 'Your Data has been uploaed failed');
        }

        return back()->with('success', 'Your Data has been uploaed successfully');
    }

    public function all(Request $request)
    {
        return response()->json([
            'data' => ScanData::orderBy('id', 'DESC')->get()
        ]);
    }

    public function delete($id)
    {

        return response()->json([
            'success' => ScanData::find($id)->delete()
        ]);
    }

    public function edit($id, Request $request)
    {
        ScanData::find($id)->update($request->all());
        return back()->with('success', 'Your Changes has been updated successfully');
    }
}
