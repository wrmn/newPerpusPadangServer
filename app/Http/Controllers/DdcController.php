<?php

namespace App\Http\Controllers;

use App\Ddc;
use App\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DdcController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a group listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ddcGroups = Ddc::select(DB::raw('DISTINCT(ddcs.group)'))
            ->get();
        $ddcs = Ddc::get();
        return view('admin.ddc.tableGroup',  compact('ddcGroups', 'ddcs'));
    }

    /**
     * Display a group listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function select($num)
    {
        $tlimit = $num * 100;
        $blimit = $num * 100 - 100;

        if ($num == 0) {
            $blimit = 0;
            $tlimit = 1000;
        }

        $ddcList = Ddc::where('ddc', '<', $tlimit)
            ->where('ddc', '>=', $blimit)
            ->orderBy('ddc')
            ->paginate(10);
        foreach ($ddcList as $item) {
            $totalBook = Ddc::find($item->ddc)
                ->bookDetail()
                ->select(DB::raw('count(*) as total'))
                ->first();
            $item['total'] = $totalBook->total;
        }
        return view('admin.ddc.table',  compact('ddcList'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $validator = Validator::make(request()->all(), [
            'ddc' => 'required|max:3|min:3'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $ddc = request('ddc');
        return $this->searchBook($ddc);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchBook($ddc)
    {
        $booksRes = Book::where('ddc', $ddc)
            ->orderBy('ddc', 'asc')
            ->orderByRaw('abs(no) asc')
            ->paginate(10);
        $ddcInfo = Ddc::find($ddc);

        session()->forget('forms.title');
        session()->forget('forms.author');
        session()->put('forms.ddc', "10");

        return view('admin.book.table',  compact('booksRes', 'ddcInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $ddc
     * @return \Illuminate\Http\Response
     */
    public function update($ddc)
    {
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return $this->editForm($ddc)
                ->withErrors($validator);
        }

        $ddcRes = Ddc::find($ddc);
        $ddcRes->nama = request('nama');
        $ddcRes->save();

        $idx =  intval($ddc / 100) + 1;
        $page = intval(($ddc - (($idx - 1) * 100)) / 10) + 1;

        return redirect("admin/ddcs/$idx?page=$page")->with('success', "Ddc $ddc berhasil diperbarui");;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $ddc
     * @return \Illuminate\Http\Response
     */
    public function edit($ddc)
    {
        $ddcRes = Ddc::find($ddc);
        return view('admin.ddc.form',  compact('ddcRes'));
    }

    public function printDdc($ddc)
    {
        $booksRes = Book::where('ddc', $ddc)->get();
        $ddcInfo = Ddc::find($ddc);

        return view('admin.book.printAll',  compact('booksRes', 'ddcInfo'));
    }

    public function print($num)
    {
        $tlimit = $num * 100;
        $blimit = $num * 100 - 100;

        if ($num == 0) {
            $blimit = 0;
            $tlimit = 1000;
        }

        $ddcList = Ddc::where('ddc', '<', $tlimit)
            ->where('ddc', '>=', $blimit)
            ->orderBy('ddc')
            ->get();
        foreach ($ddcList as $item) {
            $totalBook = Ddc::find($item->ddc)
                ->bookDetail()
                ->select(DB::raw('count(*) as total'))
                ->first();
            $item['total'] = $totalBook->total;
        }
        return view('admin.ddc.print',  compact('ddcList'));
    }
}
