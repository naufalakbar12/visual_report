<?php

namespace App\Models;

use CodeIgniter\Model;

class VisualModel extends Model
{
    protected $table      = 'table_visual';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_dataset', 'nama_file', 'id_user', 'link_visual'];
}