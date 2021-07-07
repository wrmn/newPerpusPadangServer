<?php

namespace App\Http\Controllers;

use App\Book;
use App\Ddc;
use App\Bookkeeping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    private $rule = [
        'ddc' => 'required|max:3',
        'no_ik_jk' => 'required',
        'no' => 'required',
        'judul' => 'required|max:100',
        'penulis' => 'required|max:100',
        'harga' => 'required',
        'cover' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
    ];

    /**
     * Memastikan user login sebelum mengakses fungsi
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->forget('forms.title');
        session()->forget('forms.author');
        session()->put('forms.ddc', "10");
        $booksRes = Book::paginate(10);

        return view('admin.book.table',  compact('booksRes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function printAll()
    {
        $booksRes = Book::get();

        return view('admin.book.printAll',  compact('booksRes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookkeepings = Bookkeeping::all();
        $ddcs = DDC::all();
        $add = true;
        return view('admin.book.form',  compact('bookkeepings', 'add', 'ddcs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $validator = Validator::make(request()->all(), $this->rule);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $book = request('judul');

        $bookRes = new Book;
        $bookRes->ddc = request('ddc');
        $bookRes->no_ik_jk = request('no_ik_jk');
        $bookRes->no = request('no');
        $bookRes->judul = request('judul');
        $bookRes->status = true;
        $bookRes->penulis = request('penulis');
        $bookRes->harga = request('harga');
        if (request('cover')) {
            $cover = time() . '-id.' . request('cover')->extension();
            request('cover')->move(public_path('images/book'), $cover);
            $bookRes->cover = $cover;
        }
        $bookRes->save();

        return redirect("admin/books")->with('success', "Buku $book berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bookRes = Book::find($id);

        return view('admin.book.detail',  compact('bookRes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $bookRes = Book::find($id);

        return view('admin.book.print',  compact('bookRes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(string $book)
    {
        $bookRes = Book::find($book);
        $bookkeepings = Bookkeeping::all();
        $ddcs = DDC::all();
        $edit = true;
        return view('admin.book.form',  compact('bookRes', 'ddcs', 'bookkeepings', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(string $book)
    {
        $validator = Validator::make(request()->all(), $this->rule);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $title = request('judul');

        $bookRes = Book::find($book);
        $bookRes->ddc = request('ddc');
        $bookRes->no_ik_jk = request('no_ik_jk');
        $bookRes->no = request('no');
        $bookRes->judul = request('judul');
        $bookRes->penulis = request('penulis');
        $bookRes->harga = request('harga');
        if (request('cover')) {
            $cover = time() . '-id.' . request('cover')->extension();
            request('cover')->move(public_path('images/book'), $cover);
            $bookRes->cover = $cover;
        }
        $bookRes->save();

        return redirect("admin/book/$book/detail")->with('success', "Buku $title berhasil diupdate");
    }

    /**
     * Mencari buku.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $cat = 0;
        $ncat = 999;
        $title = request('title');
        $author = request('author');
        $ddc = request('ddc');
        if ($ddc != 10) {
            $cat = $ddc * 100;
            $ncat = $cat + 99;
        }

        $booksRes = Book::query()
            ->where('judul', 'like', "%{$title}%")
            ->where('penulis', 'like', "%{$author}%")
            ->whereBetween('ddc', [$cat, $ncat])
            ->orderBy('ddc')
            ->paginate(10)
            ->appends(request()->query());

        session()->put('forms.title', request('title'));
        session()->put('forms.author', request('author'));
        session()->put('forms.ddc', request('ddc'));

        return view('admin.book.table',  compact('booksRes'));
    }
}
