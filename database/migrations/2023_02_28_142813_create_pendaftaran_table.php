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
            $table->increments('id_pendaftaran');
            $table->integer('id_user');
            $table->string('nik', 16);
            $table->date('tgl_lahir');
            $table->string('tempat_lahir', 50);
            $table->string('alamat', 60);
            $table->string('nama_kk', 50);
            $table->enum('jk', ['Laki-laki', 'Perempuan']);
            $table->enum('sk', ['Belum Kawin', 'Sudah Kawin', 'Cerai Hidup', 'Cerai Mati']);
            $table->enum('agama', ['Budha', 'Hindu', 'Islam', 'Kristen', 'Katolik', 'Konghucu']);
            $table->string('no_telp', 15);
            $table->string('pekerjaan', 20);
            $table->string('pendidikan_terakhir', 20);
            $table->enum('jaminan_asuransi', ['BPJS', 'JKN', 'Jamkesda', 'Jamkesos']);
            $table->string('no_jaminan', 20);
            $table->string('no_rm', 20);
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
