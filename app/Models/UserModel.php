<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'table_user';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'username', 'password', 'id_role'];
}