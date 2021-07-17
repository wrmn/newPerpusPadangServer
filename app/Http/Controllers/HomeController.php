<?php

namespace App\Http\Controllers;

use App\Job;
use App\Member;
use App\Book;
use App\Visitor;
use App\Borrow;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $d = date('d');
        $m = date('m');
        $y = date('Y');

        $memberData = Member::memberJobs()
            ->select('jobs.*', DB::raw('count(*) as total'))
            ->groupBy('pekerjaan', 'jobs.job_id')
            ->orderBy('jobs.job_id')
            ->where('verivied',  '=', true)
            ->pluck('total', 'pekerjaan')->all();

        $bookData = Book::bookType()
            ->select('ddcs.group', DB::raw('count(*) as total'))
            ->groupBy('group')
            ->pluck('total', 'group')->all();

        $memberTotal = Member::select(DB::raw('count(*) as total'))
            ->where('verivied',  '=', true)
            ->first();

        $bookTotal = Book::select(DB::raw('count(*) as total'))
            ->first();


        $borrowToday = Borrow::select(DB::raw('count(*) as total'))
            ->where('tanggal_peminjaman', '=', now())
            ->first();

        $visitorToday = Visitor::select(DB::raw('count(*) as total'))
            ->whereDate('waktu_kunjungan', $d)
            ->whereMonth('waktu_kunjungan', $m)
            ->whereYear('waktu_kunjungan', $y)
            ->first();

        $visitorRes = Visitor::whereMonth('waktu_kunjungan', $m)
            ->whereYear('waktu_kunjungan', $y)
            ->orderBy('waktu_kunjungan', 'desc')
            ->get();

        $memberLastSemester = Visitor::memberJobs()
            ->select(DB::raw("YEAR(waktu_kunjungan) AS 'year', MONTH(waktu_kunjungan) as month, MONTHNAME(waktu_kunjungan) as monthName"), DB::raw('count(*) as total'))
            ->where('members.verivied', '=', true)
            ->groupBy("year", "month", "monthName")
            ->orderBy("year", "desc")
            ->orderBy("month", "desc")
            ->limit(6)
            ->pluck('total', 'monthName')->all();

        $visitorLastSemester = Visitor::memberJobs()
            ->select(DB::raw("YEAR(waktu_kunjungan) AS 'year', MONTH(waktu_kunjungan) as month, MONTHNAME(waktu_kunjungan) as monthName"), DB::raw('count(*) as total'))
            ->where('members.verivied', '=', false)
            ->groupBy("year", "month", "monthName")
            ->orderBy("year", "desc")
            ->orderBy("month", "desc")
            ->limit(6)
            ->pluck('total', 'monthName')->all();

        $bookBorrow = Borrow::getBook()
            ->select(DB::raw("books.judul"), DB::raw('count(*) as total'))
            ->groupBy("judul")
            ->orderBy("total", "desc")
            ->limit(6)
            ->pluck('total', 'judul')->all();


        $borrowSemester = Borrow::select(DB::raw("YEAR(tanggal_peminjaman) AS 'year', MONTH(tanggal_peminjaman) as month, MONTHNAME(tanggal_peminjaman) as monthName"), DB::raw('count(*) as total'))
            ->groupBy("year", "month", "monthName")
            ->orderBy("year", "desc")
            ->orderBy("month", "desc")
            ->limit(6)
            ->pluck('total', 'monthName')->all();


        $visitMonth = (array_reverse(array_keys($visitorLastSemester)));
        $visitorData2 = (array_reverse(array_values($memberLastSemester)));
        $visitorData = (array_reverse(array_values($visitorLastSemester)));
        $borrowData2 = (array_reverse(array_values($borrowSemester)));
        $borrowData = (array_values($bookBorrow));
        $titleData = (array_keys($bookBorrow));
        $memberCount = (array_values($memberData));
        $bookCount = (array_values($bookData));
        $jobName = (array_keys($memberData));
        $groupName = (array_keys($bookData));
        return view('home', compact('memberCount', 'jobName', 'memberTotal', 'bookTotal', 'groupName', 'bookCount', "visitorRes", "visitMonth", "visitorData", "visitorData2", "borrowData", "titleData", "visitorToday", "borrowToday", "borrowData2"));
    }

    /**
     * menampilkan halaman cetak laporan
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function report()
    {
        $jobsRes = Job::get();
        return view('admin.other.report', compact('jobsRes'));
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
