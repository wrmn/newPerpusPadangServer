<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $primaryKey = 'visitor_id';
    protected $fillable = [
        'waktu_kunjungan',
        'member_no',
    ];

    public function memberDetail(){
        return $this->belongsTo('App\Member', 'member_no');
    }
}
