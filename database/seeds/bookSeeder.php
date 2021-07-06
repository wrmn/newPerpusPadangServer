<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class bookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookkeepings = DB::table('bookkeepings')
            ->select('no_ik_jk as id')
            ->get();

        $faker = Faker\Factory::create();

        foreach ($bookkeepings as $bookkeeping) {

            for ($j = 0; $j < 200; $j++) {
                $ddcCurrent = rand(0, 999);
                $num = rand(1, 99);
                $price = rand(40, 500);

                if ($ddcCurrent < 10) {
                    $id = "00{$ddcCurrent}";
                } else if ($ddcCurrent < 100) {
                    $id = "0{$ddcCurrent}";
                } else {
                    $id = "{$ddcCurrent}";
                }
                $data[$j]=[
                    'no' => $num,
                    'ddc' => $id,
                    'no_ik_jk' => $bookkeeping->id,
                    'judul' => $faker->realText(40),
                    'penulis' => $faker->name,
                    'harga' => $price * 1000,
                    'status' => true,
                    'created_at' => now(),
                ];
            }

            DB::table('books')->insert($data);
        }
    }
}
