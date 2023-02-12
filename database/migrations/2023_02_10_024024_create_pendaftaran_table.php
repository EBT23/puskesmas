<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('nama');
            $table->integer('nik');
            $table->date('tgl_lahir');
            $table->string('tempat_lahir');
            $table->string('alamat');
            $table->string('nama_kk');
            $table->enum('jk', ['Laki-laki', 'Perempuan']);
            $table->enum('status', ['Belum Kawin', 'Sudah Kawin', 'Cerai Hidup', 'Cerai Mati']);
            $table->enum('agama', ['Budha', 'Hindu', 'Islam', 'Kristen', 'Katolik', 'Konghucu']);
            $table->string('no_telp');
            $table->string('pekerjaan');
            $table->string('pendidikan_terakhir');
            $table->enum('jaminan_asuransi', ['BPJS', 'JKN', 'Jamkesda', 'Jamkesos']);
            $table->string('no_jaminan');
            $table->string('no_rm');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
}
