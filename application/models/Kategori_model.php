<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Kategori_model extends CI_Model {

	function edit_kategori($id,$nama_kategori){
		$data = array(
	        'nama_kategori' => $nama_kategori,
		);
		$this->db->where('id_kategori', $id);
		$this->db->update('produk_kategori', $data);
	}

	function delete_kategori($id){
		$this->db->where('id_kategori', $id);
		$this->db->delete('produk_kategori'); 
	}

}
 
