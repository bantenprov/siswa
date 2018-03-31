<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Carbon\Carbon;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('siswas', function (Blueprint $table) {
			 $table->increments('id');
			 $table->bigInteger('nomor_un');
			 $table->integer('user_id');
			 //$table->bigInteger('pendaftaran_id')->unique();
			 $table->bigInteger('nik');
			 $table->string('label');
			 $table->string('nama_siswa')->nullable();
			 $table->text('alamat_kk');
			 //$table->integer('prov_id')->unsigned()->index();
			 //$table->integer('kabkota_id')->index();
			 //$table->integer('kecamatan_id')->index();
			 //$table->integer('kelurahan_id')->index();
			 $table->string('tempat_lahir');
			 $table->date('tgl_lahir');
			 $table->string('jenis_kelamin');
			 $table->string('agama');
			 //$table->integer('asal_sekolah_id')->unsigned()->index();
			 $table->bigInteger('nisn');
			 $table->string('tahun_lulus');
			 //$table->integer('sekolah_tujuan_id')->unsigned()->index();
			 $table->text('description');
			 $table->timestamps();
			 $table->softDeletes();
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
	public function down()
	{
		Schema::drop('siswas');
	}
}
