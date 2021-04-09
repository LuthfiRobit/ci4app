<?php

namespace App\Models;

use CodeIgniter\Model;
use db;

class KomikModel extends Model
{
    protected $table = 'tb_komik';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];


    public function getKomik($slug = false){
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function add($data){
        //$this->db->table('tb_komik')->insert($data);
        $this->db->table('tb_komik')->insert($data);
    }

    // public function delete($id){
    //     $this->db->table('tb_komik')->where('id_komik', $id)->delete();
    // }
}