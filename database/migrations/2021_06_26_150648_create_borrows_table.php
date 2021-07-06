<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->increments('borrow_id');
            $table->char('member_no', '8');
            $table->foreign('member_no')
                ->references('member_no')
                ->on('members')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('book_id')
                ->unsigned();
            $table->foreign('book_id')
                ->references('book_id')
                ->on('books')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->boolean('status_denda');
            $table->string('admin_username');
            $table->foreign('admin_username')
                ->references('username')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian')->nullable();
            $table->date('tanggal_pembayaran')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrows');
    }
}
