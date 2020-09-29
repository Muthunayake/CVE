<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrioritizedVanalability extends Model
{
    protected $fillable = [
        'ip_address',
        'host_name',
        'vulnerability',
        'solution',
        'vps',
        'cve_id',
        'cvss_v3'
    ];
}
