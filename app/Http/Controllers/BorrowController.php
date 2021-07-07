<?php

namespace App\Http\Controllers;

use App\Borrow;
use App\Book;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrowsRes = Borrow::paginate(10);

        return view('admin.borrow.table',  compact('borrowsRes'));
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
     * @param  \App\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function show(Borrow $borrow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrow $borrow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrow $borrow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrow $borrow)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function returnBorrow($id)
    {
        $borrowRes = Borrow::find($id);
        $bookRes = Book::find($borrowRes->book_id);
        $borrowRes->tanggal_pengembalian = now();
        $bookRes->status = true;
        $bookRes->save();
        $borrowRes->save();

        return redirect()->back()->with('success', "Peminjaman buku $bookRes->judul telah dikembalikan");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fineMaker($id)
    {
        $borrowRes = Borrow::find($id);
        $borrowRes->status_denda = true;
        $borrowRes->save();

        $bookRes = Book::find($borrowRes->book_id);

        return redirect()->back()->with('success', "Peminjaman $bookRes->judul telah diberi denda");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function finePay($id)
    {

        $borrowRes = Borrow::find($id);
        $borrowRes->tanggal_pembayaran = now();
        $borrowRes->save();

        $bookRes = Book::find($borrowRes->book_id);

        return redirect()->back()->with('success', "Denda peminjaman $bookRes->judul telah dibayar");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print()
    {
        echo request('bulan');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        echo request('bulan');
    }
}
