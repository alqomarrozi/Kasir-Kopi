<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Extras_model extends CI_Model {
 

	function get_all_extras(){

                $this->db->order_by("id_extras", "desc");
		// $this->db->join('extras_bahan', 'extras_kode = kode_extras');
		$result = $this->db->get('extras');
		return $result; 
	}   

	function tampilkan_extras()
	{
		return  $this->db->get('extras');
	}
        function get_product($package_id){
                $this->db->select('*');
                $this->db->from('product');
                $this->db->join('detail', 'detail_product_id=product_id');
                $this->db->join('package', 'package_id=detail_package_id');
                $this->db->where('package_id',$package_id);
                $query = $this->db->get();
                return $query;
        }

	// get all product
	function get_menu(){
		$query = $this->db->get('produk');
		return $query;
	} 

	function get_json() { //ambil data barang dari table barang yang akan di generate ke datatable
        $this->datatables->select('id_extras,kode_extras,nama_extras,harga_extras');
        $this->datatables->from('extras');
        // $this->db->order_by("id_produk", "DESC"); 
        // $this->datatables->join('extras_bahan', 'extras_id=id_extras');
        $this->datatables->add_column('view', 
        '
        <a href="javascript:void(0);" class="image_record btn btn-relief-dark btn-sm" data-id_produk="$1"><i class="fa fa-eye"></i></a>
        <a href="/manager/extras/update/$1" class="edit_record btn btn-relief-primary btn-sm" 
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
        <a href="javascript:void(0);" class="hapus_record btn btn-relief-danger btn-sm" data-id_produk="$1"><i class="fa fa-trash"></i></a>',
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
        $this->datatables->add_column('gambar_produk', '<img src="'.base_url().'/$1" class="img-rounded" height="32">', 'gambar_produk');
    
        return $this->datatables->generate();
}
	function kode_extras(){
		$this->db->select('RIGHT(extras.kode_extras,2) as kode_extras', FALSE);
			  $this->db->order_by('kode_extras','DESC');    
			  $this->db->limit(1);    
			  $query = $this->db->get('extras');  //cek dulu apakah ada sudah ada kode di tabel.    
			  if($query->num_rows() <> 0){      
				   //cek kode jika telah tersedia    
				   $data = $query->row();      
				   $kode = intval($data->kode_extras) + 1; 
			  }
			  else{      
				   $kode = 1;  //cek jika kode belum terdapat pada table
			  }
				  $tgl=date('dmY'); 
				  $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
				  $kodetampil = 'EXTRAS'.$batas;  //format kode
				  return $kodetampil;  
        }

        // CREATE
	function create_extras($kode_extras,$kode_produk,$nama_extras,$harga_extras,$bahan_id,$product){
		$this->db->trans_start();
			//INSERT TO EXTRAS 
			date_default_timezone_set("Asia/Bangkok");
			$data  = array(
				'kode_extras' => $kode_extras,
                                'id_produk' => $product,
                                'kode_produk' => $kode_produk,
                                'nama_extras' => $nama_extras,
                                'harga_extras' => $harga_extras,
				'created_at_extras' => date('Y-m-d') 
			);
			$this->db->insert('extras', $data);

			  //GET ID BAHAN 
                          $id_extras = $this->db->insert_id();
                          $result = array();
                              foreach($bahan_id AS $key => $val){
                                       $result[] = array( 
				        'extras_kode' => $kode_extras,
                                        'bahan_id'  	=> $_POST['bahan_id'][$key],
                                        'jumlah_xb'  	=> $_POST['jumlah_xb'][$key],
                                       );
                              }      
                          //MULTIPLE INSERT TO BAHAN TABLE
                          $this->db->insert_batch('extras_bahan', $result);
                          
                        //GET ID EXTRAS 
			$id_extras = $this->db->insert_id();
			// $result = array();
                        
			$data2  = array(
				'extras_id' => $id_extras,
                                'produk_id' => $product,
                                // 'harga_extras' => $harga_extras,
				// 'created_at_extras' => date('Y-m-d') 
			);
			//     foreach($product AS $key => $val){
			// 	     $result[] = array( 
			// 	      'extras_id'  	=> $id_extras,
			// 	      'produk_id'  	=> $_POST['product']
			// 	     );
			//     }      
		        //MULTIPLE INSERT TO PRODUCT EXTRAS TABLE
		        // $this->db->insert_batch('produk_extras', $result);
                        
			$this->db->insert('produk_extras', $data2);
                        
		$this->db->trans_complete();
	} 

         
        function edit_extras($id,$kode_extras,$nama_extras,$harga_extras, $id_produk, $kode_produk){
		$data = array(
	    'kode_extras' => $kode_extras,
	    'nama_extras' => $nama_extras,
		'harga_extras' => $harga_extras,
		'id_produk' => $id_produk,
		'kode_produk' => $kode_produk
		);
		$this->db->where('id_extras', $id);
		$this->db->update('extras', $data);
	}
	function getKodeProduk($id_produk)
	{
		$param = array('id_produk' => $id_produk);
		// $this->db->join('produk','extras.id_produk = produk.id_produk');
		return $this->db->get_where('produk', $param);
	}
	function get_one($id)
	{
		$param = array('id_extras' => $id);
		$this->db->join('produk','extras.id_produk = produk.id_produk');
		return $this->db->get_where('extras', $param);
	}
	function get_produk($idx)
	{
		$param = array('id_produk' => $idx);
		// $this->db->join('extras','extras.id_produk = produk.id_produk');
		return $this->db->get_where('produk', $param);
	}
	
	function get_bahanbyid($extraskode)
	{
		$param = array('extras_kode' => $extraskode); 
		$this->db->join('bahan', 'bahan.id_bahan=extras_bahan.bahan_id');
		return $this->db->get_where('extras_bahan', $param);
	} 

	
	function delete_extras($id, $extraskode){
		$this->db->where('id_extras', $id);
		$this->db->delete('extras'); 
		$this->db->where('extras_kode', $extraskode);
		$this->db->delete('extras_bahan'); 
	}

}
