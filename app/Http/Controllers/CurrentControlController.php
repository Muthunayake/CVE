<?php

namespace App\Http\Controllers;

use App\CurrentControl;
use App\ScanData;
use Illuminate\Http\Request;

class CurrentControlController extends Controller
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
        return view('current-control', [
            'page' => 'current-control'
        ]);
    }

    public function all(Request $request)
    {
        return response()->json([
            'data' => ScanData::orderBy('id', 'DESC')
                ->select(
                    'sd.*',
                    'cc.ips_signature',
                    'cc.edr_prevention',
                    'cc.xdr_prevention',
                    'cc.sandbox_prevention',
                    'cc.anti_malware_prevention',
                    'cc.multi_factor_authentication',
                    'cc.virtual_patching',
                    'cc.zero_day_prevention',
                    'cc.exploit_prevention',
                    'cc.other'
                )->from('scan_data as sd')
                ->leftJoin('current_controls as cc', 'cc.ip_address', 'sd.ip_address')
                ->get()
        ]);
    }

    public function update(Request $request)
    {
        $data = json_decode($request->input('data'), true);
        foreach ($data as $key => $value) {

            $obj = CurrentControl::where('ip_address', $value['ip_address'])->first();

            if ($obj) {
                $obj->update($value);
            } else {
                $obj = new CurrentControl();
                $obj->create($value);
            }
        }

        return back()->with('success', 'Your Data has been uploaed successfully');
    }
}
