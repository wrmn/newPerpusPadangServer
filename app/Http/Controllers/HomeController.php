<?php

namespace App\Http\Controllers;

use App\Job;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * menampilkan halaman cetak laporan
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function report()
    {
        $jobsRes = Job::get();
        return view('admin.other.report', compact('jobsRes'));
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
