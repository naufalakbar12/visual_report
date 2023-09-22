<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data_user = [
            [
                'nama' => 'Data Analis',
                'username' => 'admin',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'id_role' => 1
            ],
            [
                'nama' => 'Keke',
                'username' => 'user',
                'password' => password_hash('user', PASSWORD_DEFAULT),
                'id_role' => 2
            ]
        ];
        $user = new UserModel();
        foreach ($data_user as $data) {
            $user->insert($data);
        }
    }
}
