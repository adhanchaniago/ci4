<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdepartemen extends Model
{
    public function getData()
    {
        return $this->db->table('departemen')
            ->orderBy('id_departemen', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function add($data)
    {
        $this->db->table('departemen')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('departemen')
            ->where('id_departemen', $data['id_departemen'])
            ->update($data);
    }

    public function hapus($data)
    {
        $this->db->table('departemen')
            ->where('id_departemen', $data['id_departemen'])
            ->delete($data);
    }
}
