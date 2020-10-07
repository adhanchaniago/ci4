<?php

namespace App\Models;

use CodeIgniter\Model;

class Marsip extends Model
{
    public function getData()
    {
        return $this->db->table('arsip')
            ->join('departemen', 'departemen.id_departemen = arsip.iddepartemen', 'left')
            ->join('user', 'user.id_user = arsip.iduser', 'left')
            ->join('kategori', 'kategori.id_kategori = arsip.idkategori', 'left')
            ->orderBy('id_arsip', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function detailData($id)
    {
        return $this->db->table('arsip')
            ->join('departemen', 'departemen.id_departemen = arsip.iddepartemen', 'left')
            ->join('user', 'user.id_user = arsip.iduser', 'left')
            ->join('kategori', 'kategori.id_kategori = arsip.idkategori', 'left')
            ->where('id_arsip', $id)
            ->get()
            ->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('arsip')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('arsip')
            ->where('id_arsip', $data['id_arsip'])
            ->update($data);
    }

    public function hapus($data)
    {
        $this->db->table('arsip')
            ->where('id_arsip', $data['id_arsip'])
            ->delete($data);
    }
}
