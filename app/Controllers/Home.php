<?php

namespace App\Controllers;
use App\Models\Mhome;

class Home extends BaseController
{
	
	public function __construct()
	{
		$this->Mhome = new Mhome();
	}
	

	public function index()
	{
		$data = array(
			'title' => 'Home',
			'tArsip' => $this->Mhome->tArsip(),
			'tUser' => $this->Mhome->tUser(),
			'tDepartemen' => $this->Mhome->tDepartemen(),
			'tKategori' => $this->Mhome->tKategori(),
			'isi' => 'vhome'
		);
		return view('layout/wrapper', $data);
	}
}
