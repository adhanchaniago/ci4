<?php

namespace App\Models;

use CodeIgniter\Model;

class Mkategori extends Model
{
    public function getData()
    {
        return $this->db->table('kategori')
            ->orderBy('id_kategori', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function add($data)
    {
        $this->db->table('kategori')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('kategori')
            ->where('id_kategori', $data['id_kategori'])
            ->update($data);
    }

    public function hapus($data)
    {
        $this->db->table('kategori')
            ->where('id_kategori', $data['id_kategori'])
            ->delete($data);
    }
}
