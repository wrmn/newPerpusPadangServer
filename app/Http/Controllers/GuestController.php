<?php

namespace App\Http\Controllers;

use App\Visitor;
use App\Job;
use App\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    public function index()
    {
        $m = date('m');
        $y = date('Y');

        $visitorRes = Visitor::whereMonth('waktu_kunjungan', $m)
            ->whereYear('waktu_kunjungan', $y)
            ->orderBy('waktu_kunjungan', 'desc')
            ->get();

        $finesRes = DB::table('borrows')
            ->join('books', 'borrows.book_id', '=', 'books.book_id')
            ->join('members', 'borrows.member_no', '=', 'members.member_no')
            ->select('borrows.member_no', 'nama', DB::raw('sum(harga) as total'))
            ->orderBy('total', 'desc')
            ->groupBy('member_no')
            ->get();

        return view('guest.index', compact("visitorRes", "finesRes"));
    }

    public function guest()
    {
        $jobsRes = Job::get();
        return view('guest.form', compact('jobsRes'));
    }

    public function guestPost()
    {
        $validator = Validator::make(request()->all(), [
            'nama' => 'required|max:50',
            'alamat' => 'required|max:100',
            'pekerjaan' => 'required',
            'nama_instansi' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $member = Member::where('nama', '=', request('nama'))
            ->where('nama_instansi', '=', request('nama_instansi'))
            ->where('status_terdaftar', '=', false)
            ->where('job_id', '=', request('pekerjaan'))
            ->groupBy('member_no')
            ->first();

        $visitorRes = new Visitor;
        $visitorRes->waktu_kunjungan = now();

        if ($member == NULL) {
            $total = Member::select(DB::raw('count(*) as total'))
                ->where('status_terdaftar', '=', false)
                ->first();

            $count = $total->total + 1;

            $id = strval($count);
            while (strlen($id) != 8) {
                $id = "0$id";
            }
            $memberRes = new Member;
            $memberRes->member_no = $id;
            $memberRes->nama = strtolower(request('nama'));
            $memberRes->nama_instansi = strtolower(request('nama_instansi'));
            $memberRes->alamat = strtolower(request('alamat'));
            $memberRes->job_id = request('pekerjaan');
            $memberRes->created_at = now();
            $memberRes->save();

            $visitorRes->member_no = $id;
        } else {
            $visitorRes->member_no = $member->member_no;
        }
        
        $name = ucwords(request('nama'));
        $visitorRes->save();

        return view('guest.welcome', compact('name'));
    }
}
