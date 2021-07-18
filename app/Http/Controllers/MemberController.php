<?php

namespace App\Http\Controllers;

use App\Member;
use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
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
     * Menampilkan data member terverifikasi
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->forget('forms.no');
        session()->forget('forms.name');
        $membersRes = Member::where('status_terdaftar', true)
            ->where('verivied', true)
            ->orderBy('member_no', 'asc')
            ->paginate(10);

        $verif = true;

        return view('admin.member.table',  compact('membersRes', 'verif'));
    }
    /**
     * menampilkan data member tidak terverifikasi
     *
     * @return \Illuminate\Http\Response
     */
    public function unregistered()
    {
        session()->forget('forms.no');
        session()->forget('forms.name');
        $membersRes = Member::where('status_terdaftar', true)
            ->where('verivied', false)
            ->paginate(10);

        return view('admin.member.table',  compact('membersRes'));
    }

    /**
     * Menampilkan data member pilihan
     *
     * @param  string
     * @return \Illuminate\Http\Response
     */
    public function show($no)
    {
        $memberRes = Member::find($no);
        if (!$memberRes) {
            return redirect()->back()->withErrors("Member $no tidak ditemkan")->withInput();
        }
        $visitRes = Member::find($no)->visitDetail()->orderBy('waktu_kunjungan', 'desc')->get();
        $borrowRes = Member::find($no)->borrowDetail()->orderBy('tanggal_peminjaman', 'desc')->get();

        return view('admin.member.detail',  compact('memberRes', 'visitRes', 'borrowRes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($no)
    {
        $memberRes = Member::find($no);
        $jobsRes = Job::get();

        return view('admin.member.form',  compact('memberRes', 'jobsRes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update($no)
    {
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|max:50',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required|max:100',
            'pekerjaan' => 'required',
            'nama_instansi' => 'required',
            'telepon_no' => array(
                'required',
                'regex:/^[\+0-9 \-]+$/u'
            ),
            'identitas_no' => array(
                'required',
                'regex:/^[0-9]+$/u'
            ),
            'identitas_file' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'foto_file' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $memberRes = Member::find($no);
        $memberRes->nama = request('nama');
        $memberRes->tempat_lahir = request('tempat_lahir');
        $memberRes->tanggal_lahir = request('tanggal_lahir');
        $memberRes->alamat = request('alamat');
        $memberRes->job_id = request('pekerjaan');
        $memberRes->nama_instansi = request('nama_instansi');
        $memberRes->telepon_no = request('telepon_no');
        $memberRes->identitas_no = request('identitas_no');

        if (request('foto_file')) {
            $fotoFile = time() . '-id.' . request('foto_file')->extension();
            request('foto_file')->move(public_path('images/picture'), $fotoFile);
            $memberRes->foto_file = $fotoFile;
        }

        if (request('identitas_file')) {
            $identitasFile = time() . '-id.' . request('identitas_file')->extension();
            request('foto_file')->move(public_path('images/identity'), $identitasFile);
            $memberRes->foto_file = $identitasFile;
        }

        $memberRes->save();
        return redirect("admin/member/$no/detail")->with('success', "Member $memberRes->nama berhasil diupdate");
    }

    /**
     * Verifikasi data member
     *
     * @return \Illuminate\Http\Response
     */
    public function accept($member)
    {
        $memberRes = Member::find($member);
        $memberRes->verivied = true;
        $m = date('m');
        $y = date('y');
        $no = "M.$y$m.";

        $totalMember = Member::select(DB::raw('count(*) as total'))
            ->where('member_no', 'like', "%{$no}%")
            ->first();
        $count = $totalMember->total + 1;

        if ($count < 10) {
            $id = "00{$count}";
        } elseif ($count < 100) {
            $id = "0{$count}";
        } else {
            $id = "{$count}";
        }
        $memberRes->member_no = "$no$id";
        $memberRes->save();

        return redirect("admin/member/$no$id/detail")->with('success', "Member $memberRes->nama berhasil diverifikasi");
    }

    /**
     * Menghapus user pilihan
     *
     * @param string 
     * @return \Illuminate\Http\Response
     */
    public function destroy($no)
    {
        $memberRes = Member::find($no);
        $memberRes->delete();
        return redirect("admin/members/unregistered")->with('success', "Member $memberRes->nama berhasil dihapus");
    }

    /**
     * Mencari member.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($stat)
    {
        if ($stat == "registered") {
            $verif = true;
        } else if ($stat == "unregistered") {
            $verif = false;
        }

        $no = request('no');
        $name = request('nama');

        $membersRes = Member::query()
            ->where('member_no', 'like', "%{$no}%")
            ->where('nama', 'like', "%{$name}%")
            ->where('status_terdaftar', true)
            ->where('verivied', $verif)
            ->paginate(10)
            ->appends(request()->query());

        session()->put('forms.no', request('no'));
        session()->put('forms.name', request('nama'));

        return view('admin.member.table',  compact('membersRes', 'verif'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function print($no)
    {
        $memberRes = Member::find($no);

        return view('admin.member.print',  compact('memberRes'));
    }
}
