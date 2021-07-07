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

    public function bookDetail()
    {
        return $this->hasMany('App\Book', 'ddc');
    }
}
