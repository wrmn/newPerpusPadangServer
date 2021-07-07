<?php

namespace App\Http\Controllers;

use App\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VisitorController extends Controller
{
    /**
     * Menampilkan semua pengunjung.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitorsRes = Visitor::paginate(10);

        return view('admin.visitor.table',  compact('visitorsRes'));
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
            $visitorsRes = Visitor::whereMonth('waktu_kunjungan', $nice[1])
                ->whereYear('waktu_kunjungan', $nice[0])
                ->where('member_no', request('no'))
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
            $visitorsRes = Visitor::where('member_no', request('no'))
                ->orderBy('waktu_kunjungan', 'desc')
                ->paginate(10)
                ->appends(request()->query());
        }
        return view('admin.visitor.table',  compact('visitorsRes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitor $visitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        //
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
