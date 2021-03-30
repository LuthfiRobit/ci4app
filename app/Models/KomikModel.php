<?php

namespace App\Models;

use CodeIgniter\Model;

class KomikModel extends Model
{
    protected $table = 'tb_komik';
    protected $primaryKey = 'id_komik';
    protected $useTimestamps = true;
}