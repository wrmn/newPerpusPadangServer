<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->char('member_no','8')->primary();
            $table->string('nama');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat');
            $table->char('job_id');
            $table->foreign('job_id')
                ->references('job_id')
                ->on('jobs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('nama_instansi');
            $table->char('telepon_no', 24)->nullable();
            $table->char('identitas_no', 24)->nullable();
            $table->string('foto_file')->nullable();
            $table->string('identitas_file')->nullable();
            $table->boolean('verivied')->default(false);
            $table->boolean('status_terdaftar')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
