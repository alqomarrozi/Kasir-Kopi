<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Model_produk extends CI_Model {
 
	function tampil_data()
	{
		return
			$this->db->get('barang')->join('produk_kategori', 'produk_kategori.id_kategori = produk.kategori_id', 'left')
			// ->join('ukuran', 'ukuran.id_ukuran = barang.ukuran', 'left')
			->distinct();
	}

	function tampilkan_variant()
	{
		return  $this->db->get('extras');
	}

	function tampil_dropdown()
	{
		return
			$this->db->select('id_produk, nama_produk')
			->from('produk')
			->get();
	}

	function post($data)
	{
		$this->db->insert('produk', $data);
	}

	function get_one($id)
	{
		$param = array('id_produk' => $id);
		return $this->db->get_where('produk', $param);
	}

	function edit($data, $id)
	{
		$this->db->where('id_produk', $id);
		$this->db->update('produk', $data);
	}

	function hapus($id)
	{
		$this->db->where('id_produk', $id);
		$this->db->delete('produk');
	}

	function get_detail_modal($id)
	{
		return $this->db->where('id_produk', $id)
			->get('produk')
			->row();
	}
}