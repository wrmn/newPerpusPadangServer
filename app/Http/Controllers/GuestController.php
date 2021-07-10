<?php

namespace App\Http\Controllers;

use App\Visitor;
use App\Job;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $visitorRes = Visitor::get();

        $finesRes = DB::table('borrows')
            ->join('books', 'borrows.book_id', '=', 'books.book_id')
            ->join('members', 'borrows.member_no', '=', 'members.member_no')
            ->select('borrows.member_no', 'nama', DB::raw('sum(harga) as total'))
            ->groupBy('member_no')
            ->get();

        return view('guest.index', compact("visitorRes", "finesRes"));
    }

    public function guest()
    {
        $jobsRes = Job::get();
        return view('guest.formGuest', compact('jobsRes'));
    }
}
