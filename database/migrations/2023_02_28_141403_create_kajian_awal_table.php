<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKajianAwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kajian_awal', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->enum('status', ['Kepala Keluarga', 'Suami', 'Istri', 'Anak', 'Orang Tua', 'Menantu', 'ART', 'Lain-lain',]);
            $table->string('alamat');
            $table->string('riwayat_penyakit_terdahulu');
            $table->string('riwayat_penyakit_keluarga');
            $table->string('pengkajian_psikologis');
            $table->string('riwayat_gangguan_jiwa');
            $table->string('keluarga_gangguan_jiwa');
            $table->string('tinggal_dengan');
            $table->string('hambatan_bahasa');
            $table->string('hambatan_budaya');
            $table->string('hambatan_mobilitas');
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
        Schema::dropIfExists('kajian_awal');
    }
}
