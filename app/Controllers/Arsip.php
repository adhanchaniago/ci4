<?php

namespace App\Controllers;

use App\Models\Marsip;

class Arsip extends BaseController
{

    public function __construct()
    {
        $this->Marsip = new Marsip();
        helper('form');
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
            'isi' => 'arsip/add'
        );
        return view('layout/wrapper', $data);
    }

}
