<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class borrowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = faker\Factory::create();

        $book = DB::table('books')
            ->select('*')
            ->get();
        $member = DB::table('members')
            ->select('*')
            ->get();
        $c = 0;
        for ($i = 0; $i < 50; $i++) {
            $bookNum = rand(0, 599);
            $memberNum = rand(0, 149);
            $statusNum = rand(0, 1);
            if ($book[$bookNum]->status == 1 && $member[$memberNum]->verivied == 1) {
                DB::table('books')
                    ->where('book_id', $book[$bookNum]->book_id)
                    ->update(['status' => 0]);
                $data[$c] = [
                    'book_id' => $book[$bookNum]->book_id,
                    'member_no' => $member[$memberNum]->member_no,
                    'status_denda' => $statusNum,
                    'tanggal_peminjaman' => Carbon::parse($faker->dateTimeBetween('-30 week', 'now')),
                    'admin_username' => 'admin'
                ];
                $c++;
            }
        }
        DB::table('borrows')->insert($data);
    }
}
