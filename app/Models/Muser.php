<?php

namespace App\Models;

use CodeIgniter\Model;

class Muser extends Model
{
    public function getData()
    {
        return $this->db->table('user')
            ->join('departemen', 'departemen.id = user.id_departemen', 'left')
            ->orderBy('id_user', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function detailData($id)
    {
        return $this->db->table('user')
            ->join('departemen', 'departemen.id_departemen = user.id_departemen', 'left')
            ->where('id_user', $id)
            ->get()
            ->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('user')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('user')
            ->where('id_user', $data['id_user'])
            ->update($data);
    }

    public function hapus($data)
    {
        $this->db->table('user')
            ->where('id_user', $data['id_user'])
            ->delete($data);
    }
}
