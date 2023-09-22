<?php

namespace App\Models;

use CodeIgniter\Model;

class KeteranganModel extends Model
{
    protected $table      = 'table_keterangan';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_keterangan'];
}