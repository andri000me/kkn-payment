<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_m extends CI_Model {
	
	public static $table = 'mahasiswa';
	
	public static $pk = 'idmahasiswa';
	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	public function addNew($data)
	{
		$this->db->insert(self::$table,$data);
	}
	public function getAll()
	{
		$this->db->order_by(self::$pk, 'desc');
		return $this->db->get_where(self::$table,['status <>'=>'Selesai'])->result();
	}
	public function isValExist($nim)
	{
		return $this->db->get_where(self::$table,['nim'=>$nim])->row();
	}
	public function delete($id){
		$data = [
			'is_deleted'=>'true',
			'delete_at'=>get_dateTime(),
			'delete_by'=>user()['idusers']
		];
		$this->db->where(self::$pk, $id);
		$this->db->update(self::$table, $data);
	}
	public function selesai($id){
		$data = [
			'status'=>'Selesai',
			'update_at'=>get_dateTime(),
			'update_by'=>user()['idusers']
		];
		$this->db->where(self::$pk, $id);
		$this->db->update(self::$table, $data);
	}
	public function restore($id){
		$data = [
			'is_deleted'=>'false',
			'delete_at'=>get_dateTime(),
			'delete_by'=>user()['idusers']
		];
		$this->db->where(self::$pk, $id);
		$this->db->update(self::$table, $data);
	}
	public function delete_permanen($id){
		$this->db->where(self::$pk, $id);
		$this->db->delete(self::$table);
	}

}

/* End of file Mahasiswa_m.php */
