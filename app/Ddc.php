<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ddc extends Model
{
    //
    protected $primaryKey = 'ddc';

    protected $fillable = [
        'nama'
    ];
}
