<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'borrow_id';
    protected $fillable = [
        'member_no',
        'book_id',
        'status_denda',
        'admin_username',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'tanggal_pembayaran'
    ];


    public function memberDetail()
    {
        return $this->belongsTo('App\Member', 'member_no');
    }

    public function bookDetail()
    {
        return $this->belongsTo('App\Book', 'book_id');
    }
}
