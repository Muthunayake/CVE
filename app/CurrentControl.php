<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentControl extends Model
{
    protected $fillable = [
        'ip_address',
        'host_name',
        'protocol',
        'port',
        'ips_signature',
        'edr_prevention',
        'xdr_prevention',
        'sandbox_prevention',
        'anti_malware_prevention',
        'multi_factor_authentication',
        'virtual_patching',
        'zero_day_prevention',
        'exploit_prevention',
        'other',
        'cve_id',
    ];
}
