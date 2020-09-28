<?php

namespace App\Http\Controllers;

use App\Imports\ActiveExploitImport;
use App\Imports\ZeroDaysImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
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
        return view('upload', [
            'page' => 'upload'
        ]);
    }

    public function uploadZeroDay(Request $request)
    {
        try {
            Excel::import(new ZeroDaysImport, $request->file('zero_day_csv')->store('temp'));
        } catch (\Exception $e) {
            return back()->with('error', 'Your Data has been uploaed failed');
        }

        return back()->with('success', 'Your Data has been uploaed successfully');
    }

    public function ActiveExploit(Request $request)
    {
        try {
            Excel::import(new ActiveExploitImport, $request->file('active_exp_csv')->store('temp'));
        } catch (\Exception $e) {
            return back()->with('error', 'Your Data has been uploaed failed');
        }

        return back()->with('success', 'Your Data has been uploaed successfully');
    }
}
