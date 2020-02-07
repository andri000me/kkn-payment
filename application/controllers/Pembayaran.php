<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Pembayaran_m','m');
		
	}
	
	public function index()
	{
		$data['title'] = 'Pembayaran';
		$data['pembayaran'] = true;
		$data['bayar'] = $this->m->getAll();
		$data['content'] = 'backend/pembayaran';
		$this->load->view('index', $data);
	}
	public function verifikasi()
	{
		$data['title'] = 'Verifikasi Pembayaran';
		$data['verifikasi'] = true;
		$data['verdata'] = $this->m->getAllVerifikasi();
		$data['content'] = 'backend/verifikasi';
		$this->load->view('index', $data);
	}
	public function editStatus(){
		$id = $this->input->post('id');
		$cek = $this->m->cekStatus($id);
		if($cek->status_bayar=='Belum Bayar'){
			$this->m->updateStatusBayar($id,'Sudah Bayar');
			$this->m->updateStatus($id,'Proses');
		}else{
			$this->m->updateStatusBayar($id,'Belum Bayar');
			$this->m->updateStatus($id,'Baru');
		}
	}
	public function verified(){
		$id = $this->input->post('id');
		$this->m->updateStatusBayar($id,'Sudah Bayar');
		$this->m->updateStatus($id,'Proses');
		$this->m->updateVerify($id,'yes');
	}
}

/* End of file Pembayaran.php */