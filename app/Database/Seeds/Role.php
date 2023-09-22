<?php

namespace App\Database\Seeds;

use App\Models\RoleModel;
use CodeIgniter\Database\Seeder;

class Role extends Seeder
{
    public function run()
    {
        $data_role = [
            [
                'nama_role' => 'staff'
            ],
            [
                'nama_role' => 'user'
            ]
        ];
        $role = new RoleModel();
        foreach ($data_role as $data) {
            $role->insert($data);
        }
    }
}
