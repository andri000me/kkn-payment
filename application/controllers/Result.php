<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Public_m','m');
		
	}
	
	public function index()
	{
		$data['dashboard'] = true;
		$data['row'] = $this->m->qSearch($_GET['qcari']);
		$data['content'] = 'backend/dashboard';
		$this->load->view('index', $data);
	}

}

/* End of file Result.php */