<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class jobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = array(
            'SD',
            'SLTP',
            'SLTA',
            'Mahasiswa',
            'Pegawai',
            'Dosen / Guru',
            'ABRI',
            'Umum',
        );

        $i = 0;
        foreach ($jobs as $job){
            $data[$i] = [
                'job_id' => $i+1,
                'pekerjaan' => $job
            ];
            $i++;
        }

        DB::table('jobs')->insert($data);
    }
}
