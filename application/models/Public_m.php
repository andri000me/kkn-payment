<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Public_m extends CI_Model {

	public static $table = 'mahasiswa';

	public static $pk = 'idmahasiswa';

	public function qSearch($nim){
		return $this->db->get_where(self::$table,['nim'=>$nim])->row();
	}
	public function getMhsById($id){
		return $this->db->get_where(self::$table,[self::$pk=>$id])->row();
	}
	public function getBayarById($id){
		return $this->db->get_where('pembayaran',['mahasiswa_id'=>$id]);
	}
	public function getAllInfo(){
		return $this->db->get('informasi')->result();
	}

}

/* End of file Public_m.php */