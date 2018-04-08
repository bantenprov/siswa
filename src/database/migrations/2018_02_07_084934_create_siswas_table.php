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
			 //$table->bigInteger('pendaftaran_id')->unique();
			 $table->bigInteger('nik');
			 $table->string('nama_siswa');
			 $table->bigInteger('no_kk');
			 $table->text('alamat_kk');
			 $table->integer('province_id')->nullable();
			 $table->integer('city_id')->nullable();
			 $table->integer('district_id')->nullable();
			 $table->integer('village_id')->nullable();
			 $table->string('tempat_lahir');
			 $table->date('tgl_lahir');
			 $table->string('jenis_kelamin');
			 $table->string('agama');
			 $table->bigInteger('nisn');	
			 $table->string('tahun_lulus');
			 $table->integer('sekolah_id')->nullable();
			 $table->integer('user_id');
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
