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
        $j = $k = $l = 1;
        for ($i = 1; $i <= 150; $i++) {

            $statusNum = rand(0, 1);
            $statusReg = 0;
            $positionNum = rand(1, 8);
            $phoneNum = rand(100000000, 9999999999);
            if ($statusNum == true) {
                $statusReg = rand(0, 1);
                if ($statusReg) {
                    if ($k < 10) {
                        $id = "00{$k}";
                    } elseif ($k < 100) {
                        $id = "0{$k}";
                    } else {
                        $id = "{$k}";
                    }
                    $no = "M.2106.$id";
                    $k++;
                } else{
                    if ($l < 10) {
                        $id = "00{$l}";
                    } elseif ($l < 100) {
                        $id = "0{$l}";
                    } else {
                        $id = "{$l}";
                    }
                    $no = "REG.$id";
                    $l++;
                }
            } else {
                if ($j < 10) {
                    $id = "00{$j}";
                } elseif ($j < 100) {
                    $id = "0{$j}";
                } else {
                    $id = "{$j}";
                }
                $no = "$id";
                $j++;
            }


            $data[$i] = [
                'member_no' => $no,
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
