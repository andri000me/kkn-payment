<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_m extends CI_Model {
	
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
	public function getAllVerifikasi()
	{
		$this->db->join('mahasiswa', 'mahasiswa.idmahasiswa = pembayaran.mahasiswa_id', 'left');
		$this->db->join('rekening', 'rekening.idrek = pembayaran.rek_id', 'left');
		$this->db->order_by('idbayar', 'desc');
		return $this->db->get_where('pembayaran',['is_verified'=>'no'])->result();
	}
	public function cekStatus($idm)
	{
		return $this->db->get_where(self::$table,[self::$pk=>$idm])->row();
	}
	public function updateStatusBayar($idm,$sts){
		$data = [
			'status_bayar'=>$sts
		];
		$this->db->where(self::$pk, $idm);
		$this->db->update(self::$table,$data);
	}
	public function updateStatus($idm,$sts){
		$data = [
			'status'=>$sts
		];
		$this->db->where(self::$pk, $idm);
		$this->db->update(self::$table,$data);
	}
	public function updateVerify($idm,$sts){
		$data = [
			'is_verified'=>$sts
		];
		$this->db->where('mahasiswa_id', $idm);
		$this->db->update('pembayaran',$data);
	}

}

/* End of file Pembayaran_m.php */
