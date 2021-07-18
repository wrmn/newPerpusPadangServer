<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookkeeping extends Model
{
    protected $primaryKey = 'no_induk';
    protected $keyType = 'string';

    protected $fillable = [
        'no_induk', 'tanggal', 'sumber'
    ];

    public function bookDetail()
    {
        return $this->hasMany('App\Book', 'no_induk');
    }
}
