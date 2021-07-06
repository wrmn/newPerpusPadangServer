<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ddcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = array(
            "karya umum",
            "filsafat",
            "agama",
            "ilmu sosial",
            "bahasa",
            "ilmu murni",
            "ilmu terapan",
            "seni dan olahraga",
            "kesusastraan",
            "sejarah dan geografi"
        );

        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {

            $cat = $i * 100;

            for ($j = 0; $j < 100; $j++) {

                $num = $cat + $j;

                if ($num < 10) {
                    $id = "00{$num}";
                } else if ($num < 100) {
                    $id = "0{$num}";
                } else {
                    $id = "{$num}";
                }

                $data[$num] = [
                    'ddc' => $id,
                    'group' => $name[$i],
                    'nama' => $faker->realText(10),
                ];
            }
        }
        DB::table('ddcs')->insert($data);
    }
}
