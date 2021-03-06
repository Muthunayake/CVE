<?php

namespace App\Http\Controllers;

use App\ActiveExploit;
use App\CurrentControl;
use App\CVE;
use App\EXP;
use App\PrioritizedVanalability;
use App\ScanData;
use App\ZeroDay;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
        return view('dashboard', [
            'page' => 'dashboard',
            'pv' => $this->getPrioritizedVanalability(),
            'heapMap' => $this->getHeapMap(),
            'affteced_vendors' => $this->afftecedVendors()
        ]);
    }

    public function getPrioritizedVanalability()
    {
        return PrioritizedVanalability::orderBy('vps', 'DESC')->limit(20)->get();
    }

    public function getHeapMap()
    {
        $scanData = ScanData::whereNotNull('exposure')->get();
        $high_ips = 0;
        $high_edr = 0;
        $high_ant = 0;
        $high_otr = 0;
        $high_count = 0;

        $me_ips = 0;
        $me_edr = 0;
        $me_ant = 0;
        $me_otr = 0;
        $me_count = 0;

        $low_ips = 0;
        $low_edr = 0;
        $low_ant = 0;
        $low_otr = 0;
        $low_count = 0;

        $data = [];
        $groupData = $scanData->groupBy('exposure');

        #high
        if (isset($groupData['High'])) {
            foreach ($groupData['High'] as $key => $high) {
                // $currentControl = CurrentControl::where('cve_id', 'like', '%' . $high['cve_id'] . '%')->first();
                $currentControl = CurrentControl::where('cve_id', $high['cve_id'])->first();
                if ($currentControl['ips_signature'] == "Yes")
                    $high_ips += 1;
                if ($currentControl['edr_prevention'] == "Yes")
                    $high_edr += 1;
                if ($currentControl['anti_malware_prevention'] == "Yes")
                    $high_ant += 1;
                if ($currentControl['other'] == "Yes")
                    $high_otr += 1;
            }

            $high_count = count($groupData['High']);
        }

        #medium
        if (isset($groupData['Medium'])) {
            foreach ($groupData['Medium'] as $key => $medium) {
                // $currentControl = CurrentControl::where('cve_id', 'like', '%' . $high['cve_id'] . '%')->first();
                $currentControl = CurrentControl::where('cve_id', $medium['cve_id'])->first();
                if ($currentControl['ips_signature'] == "Yes")
                    $me_ips += 1;
                if ($currentControl['edr_prevention'] == "Yes")
                    $me_edr += 1;
                if ($currentControl['anti_malware_prevention'] == "Yes")
                    $me_ant += 1;
                if ($currentControl['other'] == "Yes")
                    $me_otr += 1;
            }
            $me_count = count($groupData['Medium']);
        }

        #low
        if (isset($groupData['Low'])) {
            foreach ($groupData['Low'] as $key => $low) {
                // $currentControl = CurrentControl::where('cve_id', 'like', '%' . $high['cve_id'] . '%')->first();
                $currentControl = CurrentControl::where('cve_id', $low['cve_id'])->first();
                if ($currentControl['ips_signature'] == "Yes")
                    $low_ips += 1;
                if ($currentControl['edr_prevention'] == "Yes")
                    $low_edr += 1;
                if ($currentControl['anti_malware_prevention'] == "Yes")
                    $low_ant += 1;
                if ($currentControl['other'] == "Yes")
                    $low_otr += 1;
            }
            $low_count = $low_count;
        }

        $data[] = [
            'criticality' => 'High',
            'ips_signature' => $high_count == 0 ? 0 : ($high_ips /  $high_count * 100),
            'edr_prevention' => $high_count == 0 ? 0 : ($high_edr / $high_count * 100),
            'anti_malware_prevention' => $high_count == 0 ? 0 : ($high_ant / $high_count * 100),
            'other' => $high_count == 0 ? 0 : ($high_otr / $high_count * 100),
        ];
        $data[] = [
            'criticality' => 'Medium',
            'ips_signature' => $me_count == 0 ? 0 : ($me_ips / $me_count * 100),
            'edr_prevention' => $me_count == 0 ? 0 : ($me_edr / $me_count * 100),
            'anti_malware_prevention' => $me_count == 0 ? 0 : ($me_ant / $me_count * 100),
            'other' => $me_count == 0 ? 0 : ($me_otr / $me_count * 100),
        ];
        $data[] = [
            'criticality' => 'Low',
            'ips_signature' => $low_count == 0 ? 0 : ($low_ips / $low_count * 100),
            'edr_prevention' => $low_count == 0 ? 0 : ($low_edr / $low_count * 100),
            'anti_malware_prevention' => $low_count == 0 ? 0 : ($low_ant / $low_count * 100),
            'other' => $low_count == 0 ? 0 : ($low_otr / $low_count * 100),
        ];

        return $data;
    }

    public function prioritizedVanalability()
    {
        $CVES = CVE::select('cve', 'cvss_v3')->limit(1000)->get()->chunk(100);

        foreach ($CVES as $key => $value) {
            $data = [];

            foreach ($value as $key => $cve) {

                // foreach (explode(',', $cve['cve']) as $key => $cveId) {

                $cveId = $cve['cve'];

                // $scanData = ScanData::where('cve_id', 'like', '%' . $cveId . '%')->first();
                $scanData = ScanData::where('cve_id', $cveId)->first();

                if (!$scanData)
                    continue;

                $vps = floatval($cve['cvss_v3']) ?? 0;
                $es = 0;
                $temp = [];

                // $vps += EXP::where('cve_id', 'like', '%' . $cveId . '%')->where('exploit', 'Yes')->count() > 0 ? 1 : 0;
                // $vps += ActiveExploit::where('cve_id', 'like', '%' . $cveId . '%')->count() > 0 ? 1 : 0;
                // $vps += ZeroDay::where('cve_id', 'like', '%' . $cveId . '%')->count() > 0 ? 1 : 0;
                $vps += EXP::where('cve_id', $cveId)->where('exploit', 'Yes')->count() > 0 ? 1 : 0;
                $vps += ActiveExploit::where('cve_id', $cveId)->count() > 0 ? 1 : 0;
                $vps += ZeroDay::where('cve_id', $cveId)->count() > 0 ? 1 : 0;

                if ($scanData) {
                    if ($scanData['criticality'] = "High") {
                        $vps += 1;
                    } elseif ($scanData['criticality'] = "Medium") {
                        $vps += 0.5;
                    } elseif ($scanData['criticality'] = "Low") {
                        $vps += 0.1;
                    }

                    if ($scanData['exposure'] = "High") {
                        $vps += 1;
                    } elseif ($scanData['exposure'] = "Medium") {
                        $vps += 0.5;
                    } elseif ($scanData['exposure'] = "Low") {
                        $vps += 0.1;
                    }
                }
                $currentControl = CurrentControl::where('cve_id', $cveId)->first();

                if ($currentControl) {
                    if ($currentControl['ips_signature'] == "Yes") {
                        $es += 1;
                    }
                    if ($currentControl['edr_prevention'] == "Yes") {
                        $es += 1;
                    }
                    if ($currentControl['xdr_prevention'] == "Yes") {
                        $es += 1;
                    }
                    if ($currentControl['sandbox_prevention'] == "Yes") {
                        $es += 1;
                    }
                    if ($currentControl['anti_malware_prevention'] == "Yes") {
                        $es += 1;
                    }
                    if ($currentControl['multi_factor_authentication'] == "Yes") {
                        $es += 1;
                    }
                    if ($currentControl['virtual_patching'] == "Yes") {
                        $es += 1;
                    }
                    if ($currentControl['zero_day_prevention'] == "Yes") {
                        $es += 1;
                    }
                    if ($currentControl['exploit_prevention'] == "Yes") {
                        $es += 1;
                    }
                    if ($currentControl['other'] == "Yes") {
                        $es += 1;
                    }
                }

                $vps = $vps - $es;

                $temp['ip_address'] = $scanData['ip_address'];
                $temp['host_name'] = $scanData['host_name_fdqn'];
                $temp['vulnerability'] = $scanData['vulnerability'];
                $temp['solution'] = $scanData['solution'];
                $temp['cvss_v3'] = $cve['cvss_v3'];
                $temp['vps'] = $vps;
                $temp['cve_id'] = $cveId;
                $data[] = $temp;
                // }
            }

            PrioritizedVanalability::insert($data);
            dump(count($data));
            dump('rows inserted');
        }
        return $data;
    }

    public function afftecedVendors()
    {
        $data = [];
        $sdCount = ScanData::count();
        $vendors = CVE::whereNotNull('affected_vendors')->get()->groupBy('affected_vendors');

        foreach ($vendors as $key => $vendor) {
            $data[$key] = round((count($vendor) / $sdCount) * 100, 3);
        }
        return $data;
    }
}
