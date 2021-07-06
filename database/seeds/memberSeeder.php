<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class memberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 150; $i++) {
            $statusNum = rand(0, 1);
            $statusReg = 0;
            $positionNum = rand(1, 8);
            $phoneNum = rand(100000000, 9999999999);
            if ($statusNum == true) {
                $statusReg = rand(0, 1);
            }
            $data[$i] = [
                'member_no' => $i + 1,
                'nama' => $faker->name,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date,
                'alamat' => $faker->address,
                'job_id' => $positionNum,
                'nama_instansi' => $faker->company,
                'telepon_no' => "08$phoneNum",
                'identitas_no' => $faker->creditCardNumber,
                'identitas_file' => "default.png",
                'foto_file' => "default.png",
                'verivied' => $statusReg,
                'status_terdaftar' => $statusNum,
                'created_at' => now(),
            ];
        }
        DB::table('members')->insert($data);
    }
}
