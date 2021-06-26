<?php

namespace App\Models;

use CodeIgniter\Model;
use db;

class OrangModel extends Model
{
    protected $table = 'tb_orang';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'alamat'];

    // public function search($keyword) {
    //     // $builder = $this->table('tb_orang');
    //     // $builder->like('nama', $keyword);
    //     // return $builder;
    //     return $this->table('tb_orang')->like('nama', $keyword)->orLike('alamat', $keyword);
    // }
}