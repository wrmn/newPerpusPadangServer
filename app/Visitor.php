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

    public function memberDetail()
    {
        return $this->belongsTo('App\Member', 'member_no');
    }

    public static function memberJob($job)
    {
        return static::leftJoin(
            'members',
            'members.member_no',
            '=',
            'visitors.member_no'
        )->leftJoin(
            'jobs',
            'members.job_id',
            '=',
            'jobs.job_id'
        )->where('members.job_id', '=', $job);
    }

    public static function memberJobs()
    {
        return static::leftJoin(
            'members',
            'members.member_no',
            '=',
            'visitors.member_no'
        )->leftJoin(
            'jobs',
            'members.job_id',
            '=',
            'jobs.job_id'
        );
    }
}
