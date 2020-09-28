<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CVE extends Model
{
    protected $table = "cve";

    protected $fillable = [
        'severity_v2',
        'severity_v3',
        'type',
        'title',
        'cve',
        'cvss_v2',
        'cvss_v3',
        'cwe_id',
        'cwe_label',
        'affected_vendors',
        'affected_cpes',
    ];
}
