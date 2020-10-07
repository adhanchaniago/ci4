<?php

namespace App\Controllers;

use App\Models\Muser;
use App\Models\Mdepartemen;

class User extends BaseController
{

    public function __construct()
    {
        $this->Muser = new Muser();
        $this->Mdepartemen = new Mdepartemen();
        helper('form');
    }

    public function index()
    {
        $data = array(
            'title' => 'User',
            'user' => $this->Muser->getData(),
            'isi' => 'user/index'
        );
        return view('layout/wrapper', $data);
    }

    public function add()
    {
        $data = array(
            'title' => 'Tambah User',
            'departemen' => $this->Mdepartemen->getData(),
            'isi' => 'user/add'
        );
        return view('layout/wrapper', $data);
    }

    public function insert()
    {
        if ($this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|is_unique[user.email]',
                'errors' => [
                    'required' => '{field} required',
                    'is_unique' => '{field} Sudah ada, Gunakan {field} lain',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required',
                ]
            ],
            'level' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required',
                ]
            ],
            'id_departemen' => [
                'label' => 'Departemen',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required',
                ]
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'uploaded[foto]|max_size[foto,1824]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'uploaded' => '{field} required',
                    'max_size' => 'Max {field} 2mb',
                    'mime_in' => 'Hanya diperbolehkan upload {field} berformat png/jpg/jpeg',
                ]
            ],
        ])) {
            //upload foto
            $foto = $this->request->getFile('foto');
            //random name
            $nama_file = $foto->getRandomName();
            //if valid
            $data = array(
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'level' => $this->request->getPost('level'),
                'id_departemen' => $this->request->getPost('id_departemen'),
                'foto' => $nama_file,
            );
            $foto->move('img', $nama_file); //directory file
            $this->Muser->add($data);
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to(base_url('user'));
        } else {
            //if not valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('user/add'));
        }
    }

    public function edit($id)
    {
        $data = array(
            'title' => 'Edit User',
            'user' => $this->Muser->detailData($id),
            'departemen' => $this->Mdepartemen->getData(),
            'isi' => 'user/edit'
        );
        return view('layout/wrapper', $data);
    }

    public function update($id)
    {
        if ($this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required',
                ]
            ],
            'level' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required',
                ]
            ],
            'id_departemen' => [
                'label' => 'Departemen',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required',
                ]
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'max_size[foto,1824]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'Max {field} 2mb',
                    'mime_in' => 'Hanya diperbolehkan upload {field} berformat png/jpg/jpeg',
                ]
            ],
        ])) {
            $foto = $this->request->getFile('foto');
            if ($foto->getError() == 4) {
                $data = array(
                    'id_user' => $id,
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),
                    'level' => $this->request->getPost('level'),
                    'id_departemen' => $this->request->getPost('id_departemen'),
                    // 'foto' => $nama_file,
                );
                // $foto->move('img', $nama_file); //directory file
                $this->Muser->edit($data);
            } else {
                //Replace Foto
                $user =  $this->Muser->detailData($id);
                if ($user['foto'] != "") {
                    unlink('img/' . $user['foto']);
                }
                //random name
                $nama_file = $foto->getRandomName();
                $data = array(
                    'id_user' => $id,
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),
                    'level' => $this->request->getPost('level'),
                    'id_departemen' => $this->request->getPost('id_departemen'),
                    'foto' => $nama_file,
                );
                $foto->move('img', $nama_file); //directory file
                $this->Muser->edit($data);
            }
            //upload foto
            // $foto = $this->request->getFile('foto');
            //random name
            // $nama_file = $foto->getRandomName();
            //if valid

            session()->setFlashdata('pesan', 'Data berhasil diubah.');
            return redirect()->to(base_url('user'));
        } else {
            //if not valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('user/edit' . $id));
        }
    }

    public function delete($id)
    {
        $user =  $this->Muser->detailData($id);
        if ($user['foto'] != "") {
            unlink('img/' . $user['foto']);
        }

        $data = array(
            'id_user' => $id,
        );
        $this->Muser->hapus($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('user'));
    }
}
