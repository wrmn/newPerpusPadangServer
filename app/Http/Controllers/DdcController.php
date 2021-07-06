<?php

namespace App\Http\Controllers;

use App\Ddc;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
        $ddcGroups = Ddc::select('group')
            ->groupBy('group')
            ->get();
        return view('admin.ddc.tableGroup',  compact('ddcGroups'));
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

        $ddcList = Ddc::select('ddc', 'group', 'nama')
            ->where('ddc', '<', $tlimit)
            ->where('ddc', '>=', $blimit)
            ->orderBy('ddc')
            ->paginate(10);
        return view('admin.ddc.table',  compact('ddcList'));
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
     * @param  \App\Ddc  $ddc
     * @return \Illuminate\Http\Response
     */
    public function show(Ddc $ddc)
    {
        //
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

        $idx =  intval($ddc/100)+1;
        $page = intval(($ddc-(($idx-1)*100))/10)+1;

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ddc  $ddc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ddc $ddc)
    {
        //
    }
}
