<?php

namespace App\Models;

use CodeIgniter\Model;

class Mhome extends Model
{
    public function tArsip()
    {
        return $this->db->table('arsip')->countAll();
    }

    public function tDepartemen()
    {
        return $this->db->table('departemen')->countAll();
    }

    public function tKategori()
    {
        return $this->db->table('kategori')->countAll();
    }

    public function tUser()
    {
        return $this->db->table('user')->countAll();
    }
}