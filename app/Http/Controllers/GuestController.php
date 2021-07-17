<?php

namespace App\Http\Controllers;

use App\Visitor;
use App\Job;
use App\Book;
use App\Member;
use App\Borrow;
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

        $memberLastSemester = Visitor::memberJobs()
            ->select(DB::raw("YEAR(waktu_kunjungan) AS 'year', MONTH(waktu_kunjungan) as month, MONTHNAME(waktu_kunjungan) as monthName"), DB::raw('count(*) as total'))
            ->where('members.verivied', '=', true)
            ->groupBy("year", "month", "monthName")
            ->orderBy("year", "desc")
            ->orderBy("month", "desc")
            ->limit(6)
            ->pluck('total', 'monthName')->all();

        $visitorLastSemester = Visitor::memberJobs()
            ->select(DB::raw("YEAR(waktu_kunjungan) AS 'year', MONTH(waktu_kunjungan) as month, MONTHNAME(waktu_kunjungan) as monthName"), DB::raw('count(*) as total'))
            ->where('members.verivied', '=', false)
            ->groupBy("year", "month", "monthName")
            ->orderBy("year", "desc")
            ->orderBy("month", "desc")
            ->limit(6)
            ->pluck('total', 'monthName')->all();

        $bookBorrow = Borrow::getBook()
            ->select(DB::raw("books.judul"), DB::raw('count(*) as total'))
            ->groupBy("judul")
            ->orderBy("total", "desc")
            ->limit(6)
            ->pluck('total', 'judul')->all();

        $visitMonth = (array_reverse(array_keys($visitorLastSemester)));
        $visitorData2 = (array_reverse(array_values($memberLastSemester)));
        $visitorData = (array_reverse(array_values($visitorLastSemester)));
        $borrowData = (array_values($bookBorrow));
        $titleData = (array_keys($bookBorrow));

        return view('guest.index', compact("visitorRes", "visitMonth", "visitorData", "visitorData2", "borrowData", "titleData"));
    }

    public function guest()
    {
        $jobsRes = Job::get();
        return view('guest.form', compact('jobsRes'));
    }

    public function searchBook(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $result = Book::where('judul', 'LIKE', "%{$data['judul']}%")->where('penulis', 'LIKE', "%{$data['penulis']}%")->get();
        return response()->json($result);
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

    public function member($no)
    {
        $member = Member::find($no);
        if (!$member) {
            return response()->json(
                [
                    'fail' => "Data Member Tidak Ditemukan",
                    'code' => 404
                ],
                404
            );
        }
        return response()->json(
            [
                'success' => $member,
                'code' => 200
            ],
            200
        );
    }

    public function book($no)
    {
        $book = Book::find($no);
        if (!$book) {
            return response()->json(
                [
                    'fail' => "Data Buku Tidak Ditemukan",
                    'code' => 404
                ],
                404
            );
        }
        return response()->json(
            [
                'success' => $book,
                'code' => 200
            ],
            200
        );
    }

    public function bookByDdc($ddc, $no)
    {
        $book = Book::where('ddc', '=', $ddc)
            ->where('no', '=', $no)
            ->first();

        if (!$book) {
            return response()->json(
                [
                    'fail' => "Data Buku Tidak Ditemukan",
                    'code' => 404
                ],
                404
            );
        }
        return response()->json(
            [
                'success' => $book,
                'code' => 200
            ],
            200
        );
    }

    public function checkin($no)
    {
        $member = Member::find($no);

        if (!$member) {
            return redirect()->back()->withErrors("Data member tidak ditemukan!");
        }

        $visitorRes = new Visitor;
        $visitorRes->waktu_kunjungan = now();
        $visitorRes->member_no = $no;
        $visitorRes->save();


        $name = ucwords($member->nama);

        return view('guest.welcome', compact('name'));
    }
}
