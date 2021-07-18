<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class bookkeepingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[0] = [
            'no_induk' => 'B/DPK/2018',
            'tanggal' => Carbon::parse('2018-06-01'),
            'sumber' => 'Dinas Pustaka Kearsipan',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $data[1] = [
            'no_induk' => 'A/DHB/2019',
            'tanggal' => Carbon::parse('2019-02-10'),
            'sumber' => 'Dana Hibah dan Bantuan',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $data[2] = [
            'no_induk' => 'C/DPK/2016',
            'tanggal' => Carbon::parse('2016-03-05'),
            'sumber' => 'Dana Dinas Pustaka Kearsipan',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('bookkeepings')->insert($data);
    }
}
