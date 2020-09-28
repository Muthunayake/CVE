<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZeroDay extends Model
{
    protected $fillable = [
        'cve_id',
        'affected_vendor',
        'vulnerability',
    ];
}
