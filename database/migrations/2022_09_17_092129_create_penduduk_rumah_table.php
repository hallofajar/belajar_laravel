<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('penduduk_rumah', function (Blueprint $table) {
			$table->id('idpendudukrumah')->autoIncrement();
			$table->timestamps();
			$table->string('nama_kk');
			$table->string('noKK');
			$table->integer('rt');
			$table->integer('jumlah_anggota');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('penduduk_rumah');
	}
};
