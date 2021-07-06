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

        $fromDate = request('from');
        $toDate = request('to');

        if ($fromDate == '') {
            $fromDate = '1970-01-01';
        }

        if ($toDate == '') {
            $toDate = Carbon::tomorrow();
        }

        $visitorsRes = Visitor::query()
            ->whereBetween('waktu_kunjungan', [$fromDate, $toDate])
            ->orderBy('waktu_kunjungan', 'desc')
            ->paginate(10)
            ->appends(request()->query());

        return view('admin.visitor.table', compact('visitorsRes'));
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
}
