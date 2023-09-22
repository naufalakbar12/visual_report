<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Base extends Seeder
{
    public function run()
    {
        $this->call('Role');
        $this->call('Keterangan');
        $this->call('User');
    }
}
