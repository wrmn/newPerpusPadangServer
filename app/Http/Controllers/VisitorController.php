<?php

namespace App\Http\Controllers;

use App\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VisitorController extends Controller
{
    /**
     * Memastikan user login sebelum mengakses fungsi
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Menampilkan semua pengunjung.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitorsRes = Visitor::paginate(10);
        $stats = 'all';

        return view('admin.visitor.table',  compact('visitorsRes', 'stats'));
    }

    /**
     * Menampilkan hasil pencarian pengunjung.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        if (request('bulan') && request('no')) {
            $nice = explode("-", request('bulan'));
            $no = request('no');
            $visitorsRes = Visitor::whereMonth('waktu_kunjungan', $nice[1])
                ->whereYear('waktu_kunjungan', $nice[0])
                ->where('member_no', 'like', "%$no%")
                ->orderBy('waktu_kunjungan', 'desc')
                ->paginate(10)
                ->appends(request()->query());
        } else if (request('bulan')) {
            $nice = explode("-", request('bulan'));
            $visitorsRes = Visitor::whereMonth('waktu_kunjungan', $nice[1])
                ->whereYear('waktu_kunjungan', $nice[0])
                ->orderBy('waktu_kunjungan', 'desc')
                ->paginate(10)
                ->appends(request()->query());
        } else {
            $no = request('no');
            $visitorsRes = Visitor::where('member_no', 'like', "%$no%")
                ->orderBy('waktu_kunjungan', 'desc')
                ->paginate(10)
                ->appends(request()->query());
        }
        if (request('type') == 2) {
            $stats = "mem";
        } else if (request('type') == 3) {
            $stats = "nme";
        } else {
            $stats = "all";
        }

        return view('admin.visitor.table',  compact('visitorsRes', 'stats'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function print()
    {
        if (request('bulan') && request('pekerjaan') == 0) {
            $nice = explode("-", request('bulan'));
            $visitorsRes = Visitor::memberJobs()
                ->whereMonth('waktu_kunjungan', $nice[1])
                ->whereYear('waktu_kunjungan', $nice[0])
                ->orderBy('waktu_kunjungan', 'desc')
                ->get();
        } else if (request('bulan')) {
            $nice = explode("-", request('bulan'));
            $visitorsRes = Visitor::memberJob(request('pekerjaan'))
                ->whereMonth('waktu_kunjungan', $nice[1])
                ->whereYear('waktu_kunjungan', $nice[0])
                ->orderBy('waktu_kunjungan', 'desc')
                ->get();
        } else {
            $visitorsRes = Visitor::memberJobs()
                ->where('member_no', request('no'))
                ->orderBy('waktu_kunjungan', 'desc')
                ->paginate(10)
                ->appends(request()->query());
        }
        return view('admin.visitor.print',  compact('visitorsRes'));
    }
}
