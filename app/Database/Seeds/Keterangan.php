<?php

namespace App\Database\Seeds;

use App\Models\KeteranganModel;
use CodeIgniter\Database\Seeder;

class Keterangan extends Seeder
{
    public function run()
    {
        $data_keterangan = [
            [
                'nama_keterangan' => 'menunggu analisis data'
            ],
            [
                'nama_keterangan' => 'sedang dalam analisis'
            ],
            [
                'nama_keterangan' => 'selesai analisis data'
            ]
        ];
        $keterangan = new KeteranganModel();
        foreach ($data_keterangan as $data) {
            $keterangan->insert($data);
        }
    }
}
