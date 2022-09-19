<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendudukRumahTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('penduduk_rumah')->delete();

        DB::table('penduduk_rumah')->insert(array (
            0 =>
            array (
                'idpendudukrumah' => 1,
                'nama_kk' => 'Muhammad Fajar Sulistyo',
                'noKK' => '912371029371',
                'rt' => 1,
                'jumlah_anggota' => 2,
                'koor_x' => '110.2594703435898',
                'koor_y' => '-7.970508312516608',
                'created_at' => '2022-09-19 11:16:13',
                'updated_at' => '2022-09-19 11:16:13',
            ),
            1 =>
            array (
                'idpendudukrumah' => 2,
                'nama_kk' => 'Aziz umar',
                'noKK' => '1234123',
                'rt' => 3,
                'jumlah_anggota' => 5,
                'koor_x' => '110.26042789220811',
                'koor_y' => '-7.970189556664583',
                'created_at' => '2022-09-19 11:16:52',
                'updated_at' => '2022-09-19 11:16:52',
            ),
            2 =>
            array (
                'idpendudukrumah' => 3,
                'nama_kk' => 'Yati',
                'noKK' => '901237190827412',
                'rt' => 1,
                'jumlah_anggota' => 4,
                'koor_x' => '110.2578127384186',
                'koor_y' => '-7.970072679456622',
                'created_at' => '2022-09-19 11:30:41',
                'updated_at' => '2022-09-19 11:30:41',
            ),
        ));


    }
}
