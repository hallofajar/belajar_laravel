<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->insert([
			'nama' => 'Fajar Sulistyo',
			'nomerhp' => '085743750165',
			'email' => 'muhammad.fajar1991@gmail.com',
			'password' => '$2y$10$MOeFj./3Jfnn1M/yOntwseqO98sPjv500DR.RtfASJcn56.IctF1a',
			'created_at' => '2021-01-01 00:00:00',
			'updated_at' => '2021-01-01 00:00:00'
		]);
	}
}
