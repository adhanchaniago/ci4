<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = array(
			'title' => 'Home',
			'isi' => 'vhome'
		);
		return view('layout/wrapper', $data);
	}

	//--------------------------------------------------------------------

}
