<?php

namespace App\Controllers;
use App\Models\KomikModel;
use CodeIgniter\HTTP\Request;
// use CodeIgniter\HTTP\IncomingRequest;

class Komik extends BaseController
{

	
	protected $komikModel;
	public function __construct()
	{
		$this->komikModel = new KomikModel();
	}

	public function index()
	{
		// $komik = $this->komikModel->findAll();
		$data = [
			'title' => 'Daftar Komik',
			'komik' => $this->komikModel->getKomik()
		];

		// dd($komik);
		return view('komik/index', $data);
	}

	public function detail($slug){
		// $komik = $this->komikModel->getKomik($slug);
		$data = [
			'title' => 'Detail Komik',
			'komik' => $this->komikModel->getKomik($slug)
		];

		//ika komik tidak ditemukan
		if (empty($data['komik'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik' . $slug . 'tidak ditemukan.');
			// $data = [
			// 	'title' => 'Form Tambah Data Komik',
			// ];
			// return view('komik/create', $data);
		}

		return view('komik/detail', $data);
	}

	public function create(){
		// session();
		$data = [
			'title' => 'Form Tambah Data Komik',
			'validation' => \Config\Services::validation()
		];

		return view('komik/create', $data);
	}

	public function save(){

		//validation
		if(!$this->validate([
			'judul' => [
				'rules' => 'required|is_unique[tb_komik.judul]',
				'errors' => [
					'required' => '{field} komik harus diisi.',
					'is_unique' => '{field} komik sudah terdaftar'
				]
			]
		])){
			$validation = \Config\Services::validation();
			return redirect()->to('/Komik/create')->withInput()->with('validation', $validation);
		}

		//simpan
		$slug = url_title($this->request->getPost('judul'), '-' , true);
		$data =[
			'judul' => $this->request->getPost('judul'),
			'slug' => $slug,
			'penulis' => $this->request->getPost('penulis'),
			'penerbit' => $this->request->getPost('penerbit'),
			'sampul' => $this->request->getPost('sampul')
		];
		$save = $this->komikModel->add($data);
		session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
		return redirect()->to('/komik');
		// var_dump($save);
		// $request = service('request');
		// $komik = new KomikModel();
		//mendapatkan request form
		// $this->request->getVar();
		// $slug = url_title($this->request->getVar('judul'), '-' , true);
		// $save = $this->komikModel->insert('tb_komik',[
		// 	'judul' => $this->request->getVar('judul'),
		// 		'slug' => 'sdsd',
		// 		'penulis' => $this->request->getVar('penulis'),
		// 		'penerbit' => $this->request->getVar('penerbit'),
		// 		'sampul' => $this->request->getVar('sampul')
		// ]);
		// var_dump($save);
		// if ($save) {
		// 	echo json_encode($save);
		// }
		// echo "gagal simpan";
		// $data = [
		// 	'judul' => $this->request->getVar('judul'),
		// 	'slug' => $slug,
		// 	'penulis' => $this->request->getVar('penulis'),
		// 	'penerbit' => $this->request->getVar('penerbit'),
		// 	'sampul' => $this->request->getVar('sampul')
		// 	];
		// echo json_encode($data);

		// $cok = $this->komikModel->halimi("hehehehe");
		// return $cok;
		
	}

	public function delete($id){
		$delete = $this->komikModel->where('id_komik', $id)->delete();
		return redirect()->to('/komik');
	}
}