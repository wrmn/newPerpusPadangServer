<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookkeeping extends Model
{
    protected $primaryKey = 'no_ik_jk';
    protected $keyType = 'string';

    protected $fillable = [
        'no_ik_jk', 'tanggal', 'sumber'
    ];

    public function bookDetail()
    {
        return $this->hasMany('App\Book', 'no_ik_jk');
    }
}
