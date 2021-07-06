<?php

namespace App\Http\Controllers;

use App\Bookkeeping;
use App\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookkeepingController extends Controller
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
     * Menampilkan list pemukuan
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookkeepingsRes = Bookkeeping::paginate(10);

        foreach ($bookkeepingsRes as $bookkeeping) {
            $bookCount = Book::select(DB::raw('count(*) as total'))
                ->where('no_ik_jk', '=', $bookkeeping->no_ik_jk)
                ->first();

            $bookkeeping->count = $bookCount->total;
        }

        return view('admin.bookkeeping.table',  compact('bookkeepingsRes'));
    }

    /**
     * Menampilkan form menambahkan pembukuan baru
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $add = true;
        return view('admin.bookkeeping.form',  compact('add'));
    }

    /**
     * Menyimpan data pembukuan baru
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'no_ik_jk' => 'required|max:40|unique:bookkeepings',
            'tanggal' => 'required|max:255',
            'sumber' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $bookkeeping = request('no_ik_jk');

        $bookkeepingRes = new Bookkeeping;
        $bookkeepingRes->no_ik_jk = request('no_ik_jk');
        $bookkeepingRes->tanggal = request('tanggal');
        $bookkeepingRes->sumber = request('sumber');
        $bookkeepingRes->save();

        return redirect("admin/bookkeepings")->with('success', "Pembukuan $bookkeeping berhasil dibuat");;
    }

    /**
     * Menampilkan form edit
     *
     * @param  string $bookkeeping
     * @return \Illuminate\Http\Response
     */
    public function edit($bookkeeping)
    {
        $link = str_replace("&", "/", $bookkeeping);
        $bookkeepingRes = Bookkeeping::find($link);
        $edit = true;
        return view('admin.bookkeeping.form',  compact('bookkeepingRes', 'edit'));
    }

    /**
     * Menyimpan hasil edit
     *
     * @param  string $bookkeeping
     * @return \Illuminate\Http\Response
     */
    public function update($bookkeeping)
    {
        $validator = Validator::make(request()->all(), [
            'no_ik_jk' => 'required|max:40',
            'tanggal' => 'required|max:255',
            'sumber' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $link = str_replace("&", "/", $bookkeeping);

        $bookkeepingRes = Bookkeeping::find($link);
        $bookkeepingRes->tanggal = request('tanggal');
        $bookkeepingRes->sumber = request('sumber');
        $bookkeepingRes->save();

        return redirect("admin/bookkeepings")->with('success', "Pembukuan $link berhasil diperbarui");;
    }
}
