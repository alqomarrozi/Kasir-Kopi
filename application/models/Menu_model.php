<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Menu_model extends CI_Model {
 
 
	function get_all_menu(){
        $this->db->order_by("id_produk", "desc");
		$this->db->join('produk_kategori', 'id_kategori = kategori_id');
		// $this->db->join('produk_bahan', 'produk_id = id_produk');
		$result = $this->db->get('produk');
		return $result; 
	} 
 
	function get_kategori(){ //ambil data kategori dari table kategori
		$hsl=$this->db->get('produk_kategori');
		return $hsl;
	} 
 
	function get_one($id)
	{
		$param = array('kode_produk' => $id);
		$this->db->join('produk_kategori','produk_kategori.id_kategori = produk.kategori_id');
		return $this->db->get_where('produk', $param);
	}

	function get_bahanproduk($id)
	{
		$param = array('kode_produk' => $id); 
		$this->db->join('bahan', 'bahan.id_bahan=produk_bahan.bahan_id');
		return $this->db->get_where('produk_bahan', $param);
	} 

	

	function edit($data, $id)
	{
		$this->db->where('kode_produk', $id);
		$this->db->update('produk', $data);
	}

	function get_all_produk() {
		 //ambil data barang dari table barang yang akan di generate ke datatable
			$this->datatables->select('id_produk,kode_produk,nama_produk,harga_produk,modal_produk,gambar_produk,kategori_id,nama_kategori,pajak_produk,detail_produk');
			$this->datatables->from('produk');
			// $this->db->order_by("id_produk", "DESC"); 
			$this->datatables->join('produk_kategori', 'id_kategori=kategori_id');
			$this->datatables->add_column('view', 
			'
			<div class="btn-group">
			<a href="'.base_url('manager/menu/edit/$2').'" class="edit_record btn btn-relief-dark btn-sm" 
			data-id_produk="$1"
			data-kode_produk="$2"
			data-nama_produk="$3"
			data-harga_produk="$4"
			data-modal_produk="$5"
			data-gambar_produk="$6"
			data-kategori_id="$7"
			data-pajak_produk="$8"
			data-detail_produk="$9"
			><i class="fa fa-edit"></i></a>
			<a href="javascript:void(0);" class="hapus_record btn btn-relief-danger btn-sm" data-id_produk="$1" data-kode_produk="$2"><i class="fa fa-trash"></i></a>
			</div>
			',
			'id_produk,
			kode_produk,
			nama_produk,
			harga_produk,
			modal_produk,
			gambar_produk,
			kategori_id,
			pajak_produk,
			detail_produk,
			created_at_produk,
			updated_at_produk');
			$this->datatables->add_column('gambar_produk', '<img src="'.base_url('images/produk/').'/$1" class="img-rounded" height="32">', 'gambar_produk');
		
			return $this->datatables->generate();
	}
	function get_all_kategori(){

        $this->db->order_by("id_kategori", "desc");
		$result = $this->db->get('produk_kategori');
		return $result; 
	}
    
	function get_produk_by_id(){
		 
	}

	function kodeproduk(){
	$this->db->select('RIGHT(produk.kode_produk,2) as kode_produk', FALSE);
		  $this->db->order_by('kode_produk','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('produk');  //cek dulu apakah ada sudah ada kode di tabel.    
		  if($query->num_rows() <> 0){      
			   //cek kode jika telah tersedia    
			   $data = $query->row();      
			   $kode = intval($data->kode_produk) + 1; 
		  }
		  else{      
			   $kode = 1;  //cek jika kode belum terdapat pada table
		  }
			  $tgl=date('dmY'); 
			  $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
			  $kodetampil = "DC".$batas;  //format kode
			  return $kodetampil;  
	}


	function delete_produk_bahan_menu($kd){

		$this->db->where('kode_produk', $kd);
		$this->db->delete('produk_bahan');
	}
	function delete_produk_extras_menu($id){

		$this->db->where('produk_id', $id);
		$this->db->delete('produk_extras');
	}
}