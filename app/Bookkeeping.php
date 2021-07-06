<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;

class Bookkeeping extends Model
{
    protected $primaryKey = 'no_ik_jk';
    protected $keyType = 'string';

    protected $fillable = [
        'no_ik_jk', 'tanggal', 'sumber'
    ];

}
