<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $primaryKey = 'member_no';
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'job_id',
        'nama_instansi',
        'telepon_no',
        'identitas_no',
        'foto_file',
        'identitas_file',
        'verivied',
        'status_terdaftar',
    ];

    public function jobDetail()
    {
        return $this->belongsTo('App\Job', 'job_id');
    }

    public function borrowDetail()
    {
        return $this->hasMany('App\Borrow', 'member_no');
    }
    public function visitDetail()
    {
        return $this->hasMany('App\Visitor', 'member_no');
    }
}
