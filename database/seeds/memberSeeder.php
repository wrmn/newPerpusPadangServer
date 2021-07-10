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
                    $id = strval($k);
                    while (strlen($id) != 3) {
                        $id = "0$id";
                    }
                    $no = "M.2106.$id";
                    $k++;
                } else {
                    $id = strval($l);
                    while (strlen($id) != 8) {
                        $id = "0$id";
                    }
                    $no = "REG.$id";
                    $l++;
                }
                $data[$i] = [
                    'member_no' => $no,
                    'nama' => strtolower($faker->name),
                    'tempat_lahir' => strtolower($faker->city),
                    'tanggal_lahir' => $faker->date,
                    'alamat' => strtolower($faker->address),
                    'job_id' => $positionNum,
                    'nama_instansi' => strtolower($faker->company),
                    'telepon_no' => "08$phoneNum",
                    'identitas_no' => $faker->creditCardNumber,
                    'identitas_file' => "default.png",
                    'foto_file' => "default.png",
                    'verivied' => $statusReg,
                    'status_terdaftar' => $statusNum,
                    'created_at' => now(),
                ];
            } else {
                $id = strval($j);
                while (strlen($id) != 8) {
                    $id = "0$id";
                }
                $no = "$id";
                $j++;

                $data[$i] = [
                    'member_no' => $no,
                    'nama' => strtolower($faker->name),
                    'tempat_lahir' => NULL,
                    'tanggal_lahir' => NULL,
                    'alamat' => strtolower($faker->address),
                    'job_id' => $positionNum,
                    'nama_instansi' => strtolower($faker->company),
                    'telepon_no' => NULL,
                    'identitas_no' => NULL,
                    'identitas_file' => NULL,
                    'foto_file' => NULL,
                    'verivied' => $statusReg,
                    'status_terdaftar' => $statusNum,
                    'created_at' => now(),
                ];
            }
        }
        DB::table('members')->insert($data);
    }
}
