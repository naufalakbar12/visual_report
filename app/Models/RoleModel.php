<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table      = 'table_role';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_role'];
}