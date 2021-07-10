<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('book_id');
            $table->char('no', 4);
            $table->char('ddc', 3);
            $table->foreign('ddc')
                ->references('ddc')
                ->on('ddcs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('judul');
            $table->string('penulis');
            $table->string('no_ik_jk');
            $table->foreign('no_ik_jk')
                ->references('no_ik_jk')
                ->on('bookkeepings')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->boolean('status');
            $table->integer('harga');
            $table->string('cover')->default('default.jpeg');
            $table->timestamps();
            $table->unique(['ddc', 'no']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
