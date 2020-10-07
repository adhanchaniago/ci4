<?php

namespace App\Controllers;

use App\Models\Mdepartemen;

class Departemen extends BaseController
{

    public function __construct()
    {
        $this->Mdepartemen = new Mdepartemen();
        helper('form');
    }

    public function index()
    {
        $data = array(
            'title' => 'Departemen',
            'departemen' => $this->Mdepartemen->getData(),
            'isi' => 'vdepartemen'
        );
        return view('layout/wrapper', $data);
    }

    public function add()
    {
        $data = array('nama_departemen' => $this->request->getPost('nama_departemen'));
        $this->Mdepartemen->add($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to(base_url('departemen'));
    }

    public function edit($id)
    {
        $data = array(
            'id_departemen' => $id,
            'nama_departemen' => $this->request->getPost(),
        );
        $this->Mdepartemen->edit($data);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to(base_url('departemen'));
    }

    public function delete($id)
    {
        $data = array(
            'id_departemen' => $id,
        );
        $this->Mdepartemen->hapus($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('departemen'));
    }
}
