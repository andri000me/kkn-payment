<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_m extends CI_Model {

	public static $table = 'informasi';
	
	public static $pk = 'idinfo';
	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	public function addNew($data)
	{
		$this->db->insert(self::$table,$data);
	}
	public function edit($id,$data)
	{
		$this->db->where(self::$pk, $id);
		$this->db->update(self::$table,$data);
	}
	public function addNewRek($data)
	{
		$this->db->insert('rekening',$data);
	}
	public function editRek($id,$data)
	{
		$this->db->where('idrek', $id);
		$this->db->update('rekening',$data);
	}
	public function getAll()
	{
		$this->db->order_by(self::$pk, 'desc');
		return $this->db->get_where(self::$table)->result();
	}
	public function getAllUsers()
	{
		$this->db->order_by('idusers', 'desc');
		return $this->db->get_where('users')->result();
	}
	public function getAllRek()
	{
		$this->db->order_by('idrek', 'desc');
		return $this->db->get_where('rekening')->result();
	}
	public function blocked($id)
	{
		$data = [
			'is_block' => 1
		];
		$this->db->where('idusers', $id);
		$this->db->update('users', $data);
		
	}
	public function unblocked($id)
	{
		$data = [
			'is_block' => 0
		];
		$this->db->where('idusers', $id);
		$this->db->update('users', $data);
		
	}

}

/* End of file Settings_m.php */
