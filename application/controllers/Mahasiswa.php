<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Mahasiswa_m','m');
		
	}
	
	public function index()
	{
		$data['title'] = 'Mahasiswa';
		$data['mahasiswa'] = true;
		$data['mhs'] = $this->m->getAll();
		$data['content'] = 'backend/mahasiswa';
		$this->load->view('index', $data);
	}
	public function import()
	{
		$data['title'] = 'Import Mahasiswa';
		$data['mahasiswa'] = true;
		$data['content'] = 'backend/import';
		$this->load->view('index', $data);
	}
	public function add(){
		if($this->validation()){
			$this->m->addNew($this->data());
			$this->toastr->success('Add New Successfully');
		}else{
			echo validation_errors();
		}
	}
	public function import_proses()
	{
		$rows = explode("\n",$this->input->post('mhs'));
		$success = 0;
		$failed = 0;
		$exist = 0;
		foreach ($rows as $row) {
			$exp = explode("\t", $row);
			if (count($exp) != 6) continue;
			$fill_data = [];
			$fill_data['nim'] = trim($exp[0]);
			$fill_data['nama_lengkap'] = trim($exp[1]);
			$fill_data['jk'] = trim($exp[2]);
			$fill_data['jenjang'] = trim($exp[3]);
			$fill_data['fakultas'] = trim($exp[4]);
			$fill_data['program_studi'] = trim($exp[5]);
			$fill_data['status_bayar'] = trim("Belum Bayar");
			$fill_data['status'] = trim("Baru");
			$fill_data['create_at'] = get_dateTime();
			$fill_data['create_by'] = user()['idusers'];
			$cek = $this->m->isValExist(trim($exp[0]));
			if(!$cek){
				$this->db->insert('mahasiswa',$fill_data)?$success++:$failed++;
			}else{
				$exist++;
			}
		}
		$this->toastr->info($success.' Success. '.$failed.' Failed. '.$exist.' Exist. ');
		redirect('mahasiswa');
	}
	/**
	* Data
	* @return Array
	*/
	private function data() {
		return [
			'nim'=>$this->input->post('nim', true),
			'nama_lengkap'=>$this->input->post('nama_lengkap', true),
			'jk'=>$this->input->post('jk', true),
			'tempat_lahir'=>$this->input->post('tempat_lahir', true),
			'tanggal_lahir'=>$this->input->post('tanggal_lahir', true),
			'jenjang'=>$this->input->post('jenjang', true),
			'fakultas'=>$this->input->post('fakultas', true),
			'program_studi'=>$this->input->post('program_studi', true),
			'create_at'=>get_dateTime(),
			'create_by'=>user()['idusers']
		];
	}
	/**
	* Validation Form
	* @return Boolean
	*/
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('nim', 'NIM', 'trim|required|is_unique[mahasiswa.nim]');
		$val->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
		$val->set_rules('jk', 'Jenis Kelamin', 'trim|required');
		$val->set_rules('jenjang', 'Jenjang', 'trim|required');
		$val->set_rules('fakultas', 'Fakultas', 'trim|required');
		$val->set_rules('program_studi', 'Program Studi', 'trim|required');
		return $val->run();
	}
	/**
	* View By Id
	* @return Array
	*/
	public function view()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('product',['idproduct'=>$id])->row();
		echo json_encode($data);
	}
	/**
	* Delete By ID
	* @return Boolean
	*/
	public function delete()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->m->delete($id[$i]);
			}
		}else{
			$id = $this->input->post('idx');
			for ($i=0; $i < count($id); $i++) { 
				$this->m->delete_permanen($id[$i]);
			}
		}
	}
	/**
	* Selesai By ID
	* @return Boolean
	*/
	public function selesai()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->m->selesai($id[$i]);
			}
		}
	}
	/**
	* Restore By ID
	* @return Boolean
	*/
	public function restore()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->m->restore($id[$i]);
			}
		}
	}
}

/* End of file Mahasiswa.php */