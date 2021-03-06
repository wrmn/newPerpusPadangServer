<?php

namespace App\Http\Controllers;

use App\Borrow;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class BorrowController extends Controller
{

    /**
     * Memastikan user login sebelum mengakses fungsi
     *
     */
    public function __construct()
    {
        $this->middleware('auth');

        $borrows = Borrow::get();
        foreach ($borrows as $borrow) {
            $date1 = date_create($borrow->tanggal_peminjaman);
            $date2 = date_create(now());
            $diff = date_diff($date1, $date2);
            $sub = $diff->format("%a");
            if ($sub > 10 && $borrow->tanggal_pengembalian == NULL) {
                $this->fineMakerAlt($borrow->borrow_id);
            }
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrowsRes = Borrow::orderBy("tanggal_peminjaman", "desc")->paginate(10);

        return view('admin.borrow.table',  compact('borrowsRes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($no, $id)
    {
        $fineCount = Borrow::select(DB::raw('count(*) as total'))
            ->where('member_no', '=', $no)
            ->where('status_denda', '=', true)
            ->where('tanggal_pembayaran', '=', NULL)
            ->first();
        if ($fineCount->total != 0) {
            return redirect()->back()->withErrors("Peminjaman GAGAL! Member sedang terdenda");
        }

        $borrowCount = Borrow::select(DB::raw('count(*) as total'))
            ->where('member_no', '=', $no)
            ->where('tanggal_pengembalian', '=', NULL)
            ->first();
        if ($borrowCount->total > 2) {
            return redirect()->back()->withErrors("Peminjaman GAGAL! Member telah mencapai batas peminjaman");
        }

        $bookRes = Book::find($id);

        if (!($bookRes->status)) {
            return redirect()->back()->withErrors("Peminjaman GAGAL! Buku Masih Dipinjam");
        }

        $borrowRes = new Borrow;
        $borrowRes->member_no = $no;
        $borrowRes->book_id = $id;
        $borrowRes->admin_username = "admin";
        $borrowRes->status_denda = false;
        $borrowRes->tanggal_peminjaman = now();
        $borrowRes->save();

        $bookRes->status = false;
        $bookRes->save();

        return redirect("admin/member/$no/detail")->with('success', "Peminjaman member berhasil ditambahkan");
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
    public function fineMakerAlt($id)
    {
        $borrowRes = Borrow::find($id);
        $borrowRes->status_denda = true;
        $borrowRes->save();
        return;
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

        $nice = explode("-", request('bulan'));
        $borrowsRes = Borrow::whereMonth('tanggal_peminjaman', $nice[1])
            ->whereYear('tanggal_peminjaman', $nice[0])
            ->get();

        return view('admin.borrow.print',  compact('borrowsRes'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        if (request('bulan') && request('no')) {
            $nice = explode("-", request('bulan'));
            $no = request('no');
            $borrowsRes = Borrow::whereMonth('tanggal_peminjaman', $nice[1])
                ->whereYear('tanggal_peminjaman', $nice[0])
                ->where('member_no', 'like', "%{$no}%")
                ->paginate(10)
                ->appends(request()->query());
        } else if (request('bulan')) {
            $nice = explode("-", request('bulan'));
            $borrowsRes = Borrow::whereMonth('tanggal_peminjaman', $nice[1])
                ->whereYear('tanggal_peminjaman', $nice[0])
                ->paginate(10)
                ->appends(request()->query());
        } else {
            $no = request('no');

            $borrowsRes = Borrow::where('member_no', 'like', "%{$no}%")
                ->paginate(10)
                ->appends(request()->query());
        }
        return view('admin.borrow.table',  compact('borrowsRes'));
    }
}
