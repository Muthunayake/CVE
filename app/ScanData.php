<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScanData extends Model
{
    protected $fillable = [
        'ip_address',
        'host_name_fdqn',
        'vuln_name',
        'severity',
        'protocol',
        'port',
        'vulnerability',
        'solution',
        'cvssv3_score',
        'cve_id',
        'criticality',
        'exposure'
    ];
}
