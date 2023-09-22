<?php

namespace App\Models;

use CodeIgniter\Model;

class DatasetModel extends Model
{
    protected $table      = 'table_dataset';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_dataset', 'nama_file', 'deskripsi', 'id_keterangan', 'id_user'];
}