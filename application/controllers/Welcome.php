<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Public_m','m');
		
	}
	
	public function index()
	{
		$data['dashboard'] = true;
		$data['content'] = 'backend/dashboard';
		$this->load->view('index', $data);
	}
	public function konfirmasi()
	{
		$id = _toInteger(dec_url($this->uri->segment(2)));
		$data['dashboard'] = true;
		$data['row'] = $this->m->getMhsById($id);
		$data['verifikasi'] = $this->m->getBayarById($id);
		$data['content'] = 'backend/mhs_konfirmasi';
		$this->load->view('index', $data);
	}
	public function informasi()
	{
		$data['informasi'] = true;
		$data['row'] = $this->m->getAllInfo();
		$data['content'] = 'backend/mhs_informasi';
		$this->load->view('index', $data);
	}
	public function verifikasi()
	{
		$idrek = $this->input->post('rek_id', true);
		$idmhs = $this->input->post('mahasiswa_id', true);
		$total = delMask($this->input->post('total_bayar', true));
		$nim = $this->input->post('nim', true);
		$url = base_url('konfirmasi_pembayaran/').enc_url($idmhs);
		if (!empty($_FILES['image']['name'])) {
			$config['upload_path']          = './uploads/bukti/';
			$config['allowed_types']        = settings('general','file_allowed_types');
			$config['max_size']             = settings('general','upload_max_filesize');
			$config['file_name']             = 'bukti-'.$nim.'-'.time();
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image')){
				$this->toastr->error('Image Upload Failed');
				redirect($url);
			}else{
				$gbr = $this->upload->data();
				$data = [
					"mahasiswa_id" => $idmhs,
					"rek_id" => $idrek,
					"total_bayar" => $total,
					"bukti" => $gbr['file_name'],
					"is_verified" => 'no',
					"create_at" => get_dateTime(),
					"create_by" => $idmhs
				];
				$this->db->insert('pembayaran', $data);
				$this->toastr->success('Update Successfully');
				redirect($url);
				
			}
		}else{
			$this->toastr->error('No Image Uploaded');
			redirect($url);
		}
	}
	public function page_not_found()
	{
		$this->load->view('errors/404');
	}
}
