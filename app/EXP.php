<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EXP extends Model
{
    protected $table = "exp";

    protected $fillable = [
        'exploit',
        'cve_id',
    ];
}
