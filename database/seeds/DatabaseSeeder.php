<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(userSeeder::class);
        $this->call(jobSeeder::class);
        $this->call(ddcSeeder::class);
        $this->call(bookkeepingSeeder::class);
        // $this->call(bookSeeder::class);
        // $this->call(memberSeeder::class);
        // $this->call(borrowSeeder::class);
        // $this->call(visitorSeeder::class);
    }
}
