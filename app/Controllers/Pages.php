<?php

namespace App\Controllers;

class Pages extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Home | RPL NJ'
		];
		return view('pages/home', $data);
	}

	public function about()
	{
		$data = [
			'title' => 'About | RPL NJ'
		];
		echo view('pages/about',$data);
	}

	public function contact()
	{
		$data = [
			'title' => 'Contact Us | RPL NJ',
			'alamat' => [
				[
					'tipe' => 'Home',
					'alamat' => 'Jln. KH. Zaini Munim',
					'kota' => 'Probolinggo'
				],
				[
					'tipe' => 'Office',
					'alamat' => 'Jln. KH. Zaini Munim',
					'kota' => 'Probolinggo'
				]
			]
		];

		return view('pages/contact', $data);
	}

	public function form(){
		$data = [
			'title' => 'Form | RPL NJ',
			'email' => 'luthfirobit@gmail.com',
			'alamat' => 'Pakuniran Probolinggo'
		];
		return view('pages/form', $data);
	}
}