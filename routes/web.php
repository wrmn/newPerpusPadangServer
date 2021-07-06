<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/guest', function () {
    return view('guest.index');
}); 

Route::get('/', function () {
    return view('guest.checkin');
}); //menampilkan halaman checkin tamu

Auth::routes(); //auth route untuk login admin
Route::get('/logout', 'HomeController@logout');// logout dari akun admin

Route::get('/admin', 'HomeController@index')->name('home'); //menampilkan halaman utama admin

// === ddc ===
Route::get('/admin/ddcs', 'DdcController@index'); //menampilkan halaman ddc group
Route::get('/admin/ddcs/{num}', 'DdcController@select'); //menampilkan halaman list ddc berdasarkan group yang dipilih

Route::get('/admin/ddc/edit/{num}', 'DdcController@edit'); //menampilkan form edit ddc
Route::post('/admin/ddc/edit/{num}', 'DdcController@update'); //post update data ddc

// === pembukuan/bookeeping ===
Route::get('/admin/bookkeepings', 'BookkeepingController@index'); //menampilkan halaman list pembukuan

Route::get('/admin/bookkeeping/new', 'BookkeepingController@create'); //menampilkan halaman form tambah pembukuan
Route::post('/admin/bookkeeping/new', 'BookkeepingController@store'); //menyimpan data pembukuan baru

Route::get('/admin/bookkeeping/edit/{no}', 'BookkeepingController@edit'); //menampilkan form edit pembukuan
Route::post('/admin/bookkeeping/edit/{no}', 'BookkeepingController@update'); //menyimpan hasil edit pembukuan

// === buku/book ===
Route::get('/admin/books', 'BookController@index'); //menampilkan halaman list buku
Route::get('/admin/books/search', 'BookController@search'); //menampilkan halaman list buku

Route::get('/admin/book/{id}/detail', 'BookController@show'); //menampilkan halaman buku id pilihan
Route::get('/admin/book/{id}/print', 'BookController@print'); //mencetak detail buku

Route::get('/admin/book/new', 'BookController@create'); //menampilkan halaman form buku baru
Route::post('/admin/book/new', 'BookController@store'); //menyimpan data buku baru

Route::get('/admin/book/edit/{no}', 'BookController@edit'); //menampilkan halaman form buku baru
Route::post('/admin/book/edit/{no}', 'BookController@update'); //menyimpan data buku baru

// === member/anggota ===
Route::get('/admin/members/registered', 'MemberController@index'); //menampilkan halaman list member yang telah terdaftar
Route::get('/admin/members/unregistered', 'MemberController@unregistered'); //menampilkan halaman list member yang belum mendaftar

Route::get('/admin/members/{stat}/search', 'MemberController@search'); //menampilkan halaman list member yang telah terdaftar

Route::get('/admin/member/{no}/detail', 'MemberController@show'); //melihat detail data member yang dipilih
Route::get('/admin/member/{no}/print', 'MemberController@print'); //melihat kartu member data yang dipilih
Route::get('/admin/member/{no}/accept', 'MemberController@accept'); //melihat detail data member yang dipilih
Route::get('/admin/member/{no}/delete', 'MemberController@destroy'); //menghapus data member yang dipilih
Route::get('/admin/member/{no}/edit', 'MemberController@edit'); //melihat detail data member yang dipilih
Route::post('/admin/member/{no}/edit', 'MemberController@update'); //melihat detail data member yang dipilih

// === visitor/pengunjung ===
Route::get('/admin/visitors', 'VisitorController@index'); //menampilkan halaman list kunjungan member yang telah terdaftar
Route::get('/admin/visitors/search', 'VisitorController@search'); //menampilkan halaman list kunjungan member yang telah terdaftar

// === borrow/peminjaman ===
Route::get('/admin/borrows', 'BorrowController@index'); //menampilkan halaman list kunjungan member yang tidak terdaftar
Route::get('/admin/borrow/{id}/return', 'BorrowController@returnBorrow'); //mengembalikan buku
Route::get('/admin/borrow/{id}/fine', 'BorrowController@fineMaker'); //memberikan peminjaman denda
Route::get('/admin/borrow/{id}/pay', 'BorrowController@finePay'); //melakukan pembayaran denda