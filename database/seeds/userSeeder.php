<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'name' => 'admin',
            'password' => '$2y$10$2FE.Norg3qsoRRiKwbQ.teauJURBdmlFIB8180w.IBqqLuhvWsz/K',
            'created_at' => now(),
        ]);
    }
}
