<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Settings_m','m');
		
	}
	

	public function index()
	{
		$data['title'] = 'Pengaturan Umum';
		$data['settings'] = $data['general'] = true;
		$data['content'] = 'backend/general';
		$this->load->view('index', $data);
	}
	public function information()
	{
		$data['title'] = 'Pengaturan Informasi';
		$data['settings'] = $data['information'] = true;
		$data['informasi'] = $this->m->getAll();
		$data['rekening'] = $this->m->getAllRek();
		$data['content'] = 'backend/informasi';
		$this->load->view('index', $data);
	}
	public function pengguna()
	{
		$data['title'] = 'Pengaturan Pengguna';
		$data['settings'] = $data['pengguna'] = true;
		$data['alluser'] = $this->m->getAllUsers();
		$data['content'] = 'backend/pengguna';
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
	public function edit(){
		if($this->validation()){
			$this->m->edit($this->input->post('id'),$this->data());
			$this->toastr->success('Updated Successfully');
		}else{
			echo validation_errors();
		}
	}
	public function addRek(){
		if($this->validationRek()){
			$datarek = $this->dataRek();
			$datarek['create_at'] = get_dateTime();
			$datarek['create_by'] = user()['idusers'];
			$this->m->addNewRek($this->dataRek());
			$this->toastr->success('Add New Successfully');
		}else{
			echo validation_errors();
		}
	}
	public function editRek(){
		if($this->validationRek()){
			$datarek = $this->dataRek();
			$datarek['update_at'] = get_dateTime();
			$datarek['update_by'] = user()['idusers'];
			$this->m->editRek($this->input->post('id'),$datarek);
			$this->toastr->success('Updated Successfully');
		}else{
			echo validation_errors();
		}
	}
	public function editGeneral()
	{
		$data = [
			'setting_value'=>$this->input->post('value', true),
			"updated_at" => get_dateTime(),
			"updated_by" => user()['idusers']
		];
		$this->db->where('id', $this->input->post('id', true));
		$this->db->update('settings', $data);
		$this->toastr->success('Setting Value Updated');
		redirect('settings');
	}
	public function editFavicon()
	{
		$id = $this->input->post('id', true);
		$image = $this->input->post('image', true);
		$cek = $this->db->get_where('settings',['id'=>$id])->row();
		if (!empty($_FILES['image']['name'])) {
			if(!empty($cek->setting_value) && $cek->setting_value!='icon.png'){
				unlink('uploads/'.$cek->setting_value);
			}
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = settings('general','file_allowed_types');
			$config['max_size']             = settings('general','upload_max_filesize');
			$config['file_name']             = 'favicon-'.time();
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image')){
				$this->toastr->error('Image Upload Failed');
				redirect('settings');
			}else{
				$gbr = $this->upload->data();
				$data = [
					"setting_value" => $gbr['file_name'],
					"updated_at" => get_dateTime(),
					"updated_by" => user()['idusers']
				];
				$this->db->where('id', $id);
				$this->db->update('settings', $data);
				$this->toastr->success('Update Successfully');
				redirect('settings');
				
			}
		}else{
			$this->toastr->error('No Image Uploaded');
			redirect('settings');
		}
	}
	public function addNewUser(){
		$data = [
			'user_name' => htmlspecialchars($this->input->post('user_name', true)),
			'user_password' => password_hash(htmlspecialchars($this->input->post('user_password', true)), PASSWORD_DEFAULT),
			'user_fullname' => htmlspecialchars($this->input->post('user_fullname', true)),
			'user_telp' => htmlspecialchars($this->input->post('user_telp', true)),
			'user_type' => htmlspecialchars($this->input->post('user_type', true)),
			'is_active' => 1,
			'is_block' => 0,
			'create_at' => get_dateTime(),
			'create_by' => user()['idusers']
		];
		$this->db->insert('users', $data);
		$this->toastr->success('Created Successfully');
		redirect('settings/pengguna');
	}
	public function updateUser()
	{
		if($this->input->post('idusers', true)==1){
			$user_type = 'super_user';
		}else{
			$user_type = htmlspecialchars($this->input->post('user_type', true));
		}
		$data = [
			'user_name' => htmlspecialchars($this->input->post('user_name', true)),
			'user_fullname' => htmlspecialchars($this->input->post('user_fullname', true)),
			'user_telp' => htmlspecialchars($this->input->post('user_telp', true)),
			'user_type' => $user_type,
			"update_at"=>get_dateTime(),
			"update_by"=>user()['idusers']
		];
		$this->db->where('idusers', $this->input->post('idusers', true));
		$this->db->update('users', $data);
	}
	public function changepassword()
	{
		$data = [
			"user_password"=>password_hash(htmlspecialchars($this->input->post('user_password', true)), PASSWORD_DEFAULT),
			"update_at"=>get_dateTime(),
			"update_by"=>user()['idusers']
		];
		$this->db->where('idusers', $this->input->post('idusers', true));
		$this->db->update('users', $data);
		$this->toastr->success('Change Password Successfully');
		redirect('settings/pengguna');
	}
	public function editprofil()
	{
		if(!empty($this->input->post('user_password',true))){
			$data = [
				'user_fullname'=>$this->input->post('user_fullname', true),
				'user_telp'=>$this->input->post('user_telp', true),
				'user_password'=>password_hash(htmlspecialchars($this->input->post('user_password', true)), PASSWORD_DEFAULT),
				'update_at'=>get_dateTime(),
				'update_by'=>$this->input->post('idusers', true)
			];
		}else{
				$data = [
					'user_fullname'=>$this->input->post('user_fullname', true),
					'user_telp'=>$this->input->post('user_telp', true),
					'update_at'=>get_dateTime(),
					'update_by'=>$this->input->post('idusers', true)
				];
			
		}
		$this->db->where('idusers', $this->input->post('idusers', true));
		$this->db->update('users', $data);
		$this->toastr->success('Your Profile Updated');
		redirect('dashboard/user_profile/'.enc_url($this->input->post('idusers',true)));
	}
	/**
	* Data
	* @return Array
	*/
	private function data() {
		return [
			'info_nama'=>$this->input->post('info_nama', true),
			'info_isi'=>$this->input->post('info_isi', true),
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
		$val->set_rules('info_nama', 'Nama Informasi', 'trim|required');
		$val->set_rules('info_isi', 'Isi Informasi', 'trim|required');
		return $val->run();
	}
	/**
	* Data Rekening
	* @return Array
	*/
	private function dataRek() {
		return [
			'rek_bank'=>$this->input->post('rek_bank', true),
			'rek_nama'=>$this->input->post('rek_nama', true),
			'rek_nomor'=>$this->input->post('rek_nomor', true)
		];
	}
	/**
	* Validation Form Rekening
	* @return Boolean
	*/
	private function validationRek() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('rek_bank', 'Nama Bank', 'trim|required');
		$val->set_rules('rek_nama', 'Nama Pemilik Rekening', 'trim|required');
		$val->set_rules('rek_nomor', 'Nomor Rekening', 'trim|required');
		return $val->run();
	}
	/**
	* View Settings By Id
	* @return Array
	*/
	public function view()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('settings',['id'=>$id])->row();
		echo json_encode($data);
	}
	/**
	* View Info By Id
	* @return Array
	*/
	public function viewInfo()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('informasi',['idinfo'=>$id])->row();
		echo json_encode($data);
	}
	/**
	* View Rekening By Id
	* @return Array
	*/
	public function viewRek()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('rekening',['idrek'=>$id])->row();
		echo json_encode($data);
	}
	/**
	* View User By Id
	* @return Array
	*/
	public function viewUser()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('users',['idusers'=>$id])->row();
		echo json_encode($data);
	}
	/**
	* Blocked By ID
	* @return Boolean
	*/
	public function block()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->m->blocked($id[$i]);
			}
		}
	}
	/**
	* Unblocked By ID
	* @return Boolean
	*/
	public function unblock()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->m->unblocked($id[$i]);
			}
		}
	}
}

/* End of file Settings.php */