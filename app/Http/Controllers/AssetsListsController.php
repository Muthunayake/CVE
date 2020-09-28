<?php

namespace App\Http\Controllers;

use App\ScanData;
use Illuminate\Http\Request;

class AssetsListsController extends Controller
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
        return view('asset-list', [
            'page' => 'asset-list'
        ]);
    }

    public function all(Request $request)
    {
        return response()->json([
            'data' => ScanData::orderBy('id', 'DESC')->get()
        ]);
    }

    public function update(Request $request)
    {
        $data = json_decode($request->input('data'), true);
        foreach ($data as $key => $value) {
            ScanData::where('id', $value['id'])->update($value);
        }

        return back()->with('success', 'Your Data has been uploaed successfully');
    }
}
