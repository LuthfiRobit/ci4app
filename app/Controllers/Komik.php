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
			],
			'penulis' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} komik harus diisi.'
				]
			],
			'penerbit' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} komik harus diisi.'
				]
			],
			'sampul' => [
				'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size' => 'Ukuran gambar maksimal 1 Mb',
					'is_image' => 'Yang anda pilih bukan gambar',
					'mime_in' => 'Yang anda pilih bukan gambar'
				]
			]
		])){
			// $validation = \Config\Services::validation();
			// return redirect()->to('/Komik/create')->withInput()->with('validation', $validation);
			return redirect()->to('/komik/create')->withInput();
		}

		//ambil gambar
		$fileSampul = $this->request->getFile('sampul');
		//is sampul empty?
		if ($fileSampul->getError() == 4) {
			$namaSampul = 'default.png';
		} else {
			//generate random sampul name
			$namaSampul = $fileSampul->getRandomName();
			//pindah file
			$fileSampul->move('img', $namaSampul);
		}
	
		//simpan
		$slug = url_title($this->request->getPost('judul'), '-' , true);
		$data =[
			'judul' => $this->request->getPost('judul'),
			'slug' => $slug,
			'penulis' => $this->request->getPost('penulis'),
			'penerbit' => $this->request->getPost('penerbit'),
			'sampul' => $namaSampul
		];
		$save = $this->komikModel->add($data);
		session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
		return redirect()->to('/komik');
		
	}

	public function edit($slug){
		// session();
		$data = [
			'title' => 'Form Ubah Data Komik',
			'validation' => \Config\Services::validation(),
			'komik' => $this->komikModel->getKomik($slug)
		];

		return view('komik/edit', $data);
	}

	public function update($id){
		//cek judul
		$judulLama = $this->komikModel->getKomik($this->request->getVar('slug'));
		if ($judulLama['judul'] == $this->request->getVar('judul')) {
			$rule_judul = 'required';
		} else {
			$rule_judul = 'required|is_unique[tb_komik.judul]';
		}

		//validation
		if(!$this->validate([
			'judul' => [
				'rules' => $rule_judul,
				'errors' => [
					'required' => '{field} komik harus diisi.',
					'is_unique' => '{field} komik sudah terdaftar'
				]
			],
			'penulis' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} komik harus diisi.'
				]
			],
			'penerbit' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} komik harus diisi.'
				]
			],
			'sampul' => [
				'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size' => 'Ukuran gambar maksimal 1 Mb',
					'is_image' => 'Yang anda pilih bukan gambar',
					'mime_in' => 'Yang anda pilih bukan gambar'
				]
			]
		])){
			// $validation = \Config\Services::validation();
			return redirect()->to('/komik/edit/'. $this->request->getVar('slug'))->withInput();
		}

		$fileSampul = $this->request->getFile('sampul');

		//cek ganti gambar?
		if ($fileSampul->getError() == 4) {
			$namaSampul = $this->request->getVar('sampulLama');
		} else {
			$namaSampul = $fileSampul->getRandomName();
			$fileSampul->move('img', $namaSampul);
			unlink('img/' . $this->request->getVar('sampulLama'));
		}
		//simpan
		$slug = url_title($this->request->getPost('judul'), '-' , true);
		$data =[
			'id_komik' => $id,
			'judul' => $this->request->getPost('judul'),
			'slug' => $slug,
			'penulis' => $this->request->getPost('penulis'),
			'penerbit' => $this->request->getPost('penerbit'),
			'sampul' => $namaSampul
		];
		$save = $this->komikModel->ganti($data);
		session()->setFlashdata('pesan', 'Data Berhasil Diubah');
		return redirect()->to('/komik');
	}

	public function delete($id){

		// find 
		$komik = $this->komikModel->where('id_komik', $id)->first();
		//cek default
		if ($komik['sampul'] != 'default.png') {
			//hapus Gambar
			unlink('img/'. $komik['sampul']);
		}
		

		$delete = $this->komikModel->where('id_komik', $id)->delete();
		session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
		return redirect()->to('/komik');
	}
}