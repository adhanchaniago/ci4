<?php

namespace App\Controllers;

use App\Models\Marsip;
use App\Models\Mkategori;

class Arsip extends BaseController
{

    public function __construct()
    {
        $this->Marsip = new Marsip();
        $this->Mkategori = new Mkategori();
        helper('form', 'number');
    }

    public function index()
    {
        $data = array(
            'title' => 'Arsip',
            'arsip' => $this->Marsip->getData(),
            'isi' => 'arsip/index'
        );
        return view('layout/wrapper', $data);
    }

    public function add()
    {
        $data = array(
            'title' => 'Add Arsip',
            'kategori' => $this->Mkategori->getData(),
            'isi' => 'arsip/add'
        );
        return view('layout/wrapper', $data);
    }

    public function insert()
    {
        if ($this->validate([
            'nama_arsip' => [
                'label' => 'Nama Arsip',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required'
                ]
            ],
            'idkategori' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required',
                ]
            ],
            'deskripsi' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required',
                ]
            ],
            'file_arsip' => [
                'label' => 'File',
                'rules' => 'uploaded[file_arsip]|max_size[file_arsip,2048]|ext_in[file_arsip,pdf]',
                'errors' => [
                    'uploaded' => '{field} required',
                    'max_size' => 'Max {field} 2mb',
                    'ext_in' => 'Hanya diperbolehkan upload {field} berformat pdf',
                ]
            ],
        ])) {
            //upload foto
            $file_arsip = $this->request->getFile('file_arsip');
            //random name
            $nama_file = $file_arsip->getRandomName();
            //ukuran file
            $ukuran_file = $file_arsip->getSize('kb');
            //if valid
            $data = array(
                'no_arsip' => $this->request->getPost('no_arsip'),
                'idkategori' => $this->request->getPost('idkategori'),
                'nama_arsip' => $this->request->getPost('nama_arsip'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'tgl_upload' => date('Y-m-d'),
                'tgl_update' => date('Y-m-d'),
                'iddepartemen' => session()->get('iddepartemen'),
                'iduser' => session()->get('id_user'),
                'file_arsip' => $nama_file,
                'ukuran_file' => $ukuran_file,
            );
            $file_arsip->move('dokumen', $nama_file); //directory file
            $this->Marsip->add($data);
            session()->setFlashdata('pesan', 'Arsip berhasil ditambahkan.');
            return redirect()->to(base_url('arsip'));
        } else {
            //if not valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('arsip/add'));
        }
    }

    public function edit($id)
    {
        $data = array(
            'title' => 'Add Arsip',
            'kategori' => $this->Mkategori->getData(),
            'arsip' => $this->Marsip->detailData($id),
            'isi' => 'arsip/edit'
        );
        return view('layout/wrapper', $data);
    }

    public function update($id)
    {
        if ($this->validate([
            'nama_arsip' => [
                'label' => 'Nama Arsip',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required'
                ]
            ],
            'idkategori' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required',
                ]
            ],
            'deskripsi' => [
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required',
                ]
            ],
            'file_arsip' => [
                'label' => 'File',
                'rules' => 'max_size[file_arsip,2048]|ext_in[file_arsip,pdf]',
                'errors' => [
                    'max_size' => 'Max {field} 2mb',
                    'ext_in' => 'Hanya diperbolehkan upload {field} berformat pdf',
                ]
            ],
        ])) {
            $file_arsip = $this->request->getFile('file_arsip');
            if ($file_arsip->getError() == 4) {
                //kondisi file tak diganti
                $data = array(
                    'id_arsip' => $id,
                    'no_arsip' => $this->request->getPost('no_arsip'),
                    'idkategori' => $this->request->getPost('idkategori'),
                    'nama_arsip' => $this->request->getPost('nama_arsip'),
                    'deskripsi' => $this->request->getPost('deskripsi'),
                    'tgl_update' => date('Y-m-d'),
                    'iddepartemen' => session()->get('iddepartemen'),
                    'iduser' => session()->get('id_user'),
                );
                $this->Marsip->edit($data);
            } else {
                //jika file diganti
                $arsip =  $this->Marsip->detailData($id);
                if ($arsip['file_arsip'] != "") {
                    unlink('dokumen/' . $arsip['file_arsip']);
                }
                //random name
            $nama_file = $file_arsip->getRandomName();
            //ukuran file
            $ukuran_file = $file_arsip->getSize('kb');
            //if valid
            $data = array(
                'id_arsip' => $id,
                'no_arsip' => $this->request->getPost('no_arsip'),
                'idkategori' => $this->request->getPost('idkategori'),
                'nama_arsip' => $this->request->getPost('nama_arsip'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'tgl_update' => date('Y-m-d'),
                'iddepartemen' => session()->get('iddepartemen'),
                'iduser' => session()->get('id_user'),
                'file_arsip' => $nama_file,
                'ukuran_file' => $ukuran_file,
            );
            $file_arsip->move('dokumen', $nama_file); //directory file
            $this->Marsip->edit($data);
            }
            session()->setFlashdata('pesan', 'Arsip berhasil diubah.');
            return redirect()->to(base_url('arsip'));
        } else {
            //if not valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('arsip/edit'));
        }
    }

    public function delete($id)
    {
        $arsip =  $this->Marsip->detailData($id);
        if ($arsip['file_arsip'] != "") {
            unlink('dokumen/' . $arsip['file_arsip']);
        }

        $data = array(
            'id_arsip' => $id,
        );
        $this->Marsip->hapus($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('arsip'));
    }

    public function viewpdf($id)
    {
        $data = array(
            'title' => 'View Dokumen',
            'arsip' => $this->Marsip->detailData($id),
            'isi' => 'arsip/vpdf'
        );
        return view('layout/wrapper', $data);
    }
}
