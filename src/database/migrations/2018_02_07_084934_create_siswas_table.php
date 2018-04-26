\<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
			$table->string('nomor_un');
			$table->string('nik');
			$table->string('nama_siswa');
			$table->string('no_kk');
			$table->text('alamat_kk');
			$table->string('province_id')->nullable();
			$table->string('city_id')->nullable();
			$table->string('district_id')->nullable();
			$table->string('village_id')->nullable();
			$table->string('tempat_lahir');
			$table->date('tgl_lahir');
			$table->string('jenis_kelamin');
			$table->string('agama');
			$table->string('nisn');
			$table->string('tahun_lulus');
			$table->integer('sekolah_id')->nullable();
			$table->integer('prodi_sekolah_id')->nullable();
			$table->integer('user_id')->nullable();
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
