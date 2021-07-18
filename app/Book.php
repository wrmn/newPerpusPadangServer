<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $primaryKey = 'book_id';
    protected $fillable = [
        'no',
        'ddc',
        'judul',
        'penulis',
        'no_induk',
        'status',
        'harga'
    ];

    public function ddcDetail()
    {
        return $this->belongsTo('App\Ddc', 'ddc');
    }

    public function bookkeepingDetail()
    {
        return $this->belongsTo('App\Bookkeeping', 'no_induk');
    }

    public static function bookType()
    {
        return static::leftJoin(
            'ddcs',
            'ddcs.ddc',
            '=',
            'books.ddc'
        );
    }
}
