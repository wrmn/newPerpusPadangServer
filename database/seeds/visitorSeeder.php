<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class visitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member = DB::table('members')
            ->get();
        $faker = faker\Factory::create();
        for ($i = 0; $i < 300; $i++) {
            $memberNum = rand(0, 149);
            if (!($member[$memberNum]->status_terdaftar && !$member[$memberNum]->verivied)) {
                $data[$i] = [
                    'member_no' => $member[$memberNum]->member_no,
                    'waktu_kunjungan' => Carbon::parse($faker->dateTimeBetween('-30 week', 'now')),
                ];
            }
        }
        DB::table('visitors')->insert($data);
    }
}
