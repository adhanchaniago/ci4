<?php

namespace App\Controllers;

use App\Models\Mkategori;

class Kategori extends BaseController
{

    public function __construct()
    {
        $this->Mkategori = new Mkategori();
        helper('form');
    }

    public function index()
    {
        $data = array(
            'title' => 'Kategori',
            'kategori' => $this->Mkategori->getData(),
            'isi' => 'vkategori'
        );
        return view('layout/wrapper', $data);
    }

    public function add()
    {
        $data = array('nama_kategori' => $this->request->getPost('nama_kategori'));
        $this->Mkategori->add($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to(base_url('kategori'));
    }

    public function edit($id)
    {
        $data = array(
            'id_kategori' => $id,
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        );
        $this->Mkategori->edit($data);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to(base_url('kategori'));
    }

    public function delete($id)
    {
        $data = array(
            'id_kategori' => $id,
        );
        $this->Mkategori->hapus($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('kategori'));
    }
}
