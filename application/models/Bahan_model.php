<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Bahan_model extends CI_Model {
 

	function get_all_bahan(){
        $this->db->order_by("id_bahan", "desc");
		$this->db->join('bahan_kategori', 'id_kategori = bahan_kat_id');
		$result = $this->db->get('bahan');
		return $result; 
	} 
	
	function get_bahan_habis(){
        $this->db->order_by("id_bahan", "desc");
		$this->db->join('bahan_kategori', 'id_kategori = bahan_kat_id');
		$this->db->where('stok_bahan <= minimum_stock');
		$result = $this->db->get('bahan');
		return $result; 
	} 
	
	function get($id = null){
		$this->db->order_by("id_bahan", "desc");
		$this->db->join('bahan_kategori', 'id_kategori = bahan_kat_id');
		
        if ($id != null) {
            $this->db->where('id_bahan', $id);
        }
		$result = $this->db->get('bahan');
		return $result; 
	}
	// public function get($id = null)
    // {
    //     $this->db->select('p_item.*, p_item.stock,  p_category.name as name_category, p_unit.name as name_unit');
    //     $this->db->from('p_item');
    //     $this->db->join('p_category', 'p_item.category_id = p_category.category_id');
    //     $this->db->join('p_unit', 'p_item.unit_id = p_unit.unit_id');
    //     if ($id != null) {
    //         $this->db->where('item_id', $id);
    //     }
    //     $this->db->order_by('barcode', 'ASC');
    //     $query = $this->db->get();
    //     return $query;
    // }


    
	function get_users_list(){
        $this->db->order_by("id", "desc");
		$result = $this->db->get('users');
		return $result; 
	}
	function get_all_kategori(){
        $this->db->order_by("id_kategori", "desc");
		$result = $this->db->query('SELECT * FROM bahan_kategori LEFT JOIN users ON added_by=id');
		return $result; 
	}

	function get_karyawan_id($id){
		$query = $this->db->query("SELECT * FROM
		penyesuaian_stok LEFT JOIN users ON karyawan_id=id 
		WHERE karyawan_id='$id'");
		return $query;
	}
 
	function get_penyesuaian_stock(){
        $this->db->order_by("id_penyesuaian", "desc");
		$result = $this->db->query('SELECT * FROM penyesuaian_stok LEFT JOIN penyesuaian_stok_bahan ON penyesuaian_id=id_penyesuaian LEFT JOIN bahan ON id_bahan=bahan_id');
		return $result; 
	}
	function get_bahan_by_slug($slug){
		$query = $this->db->query("SELECT * FROM
		bahan LEFT JOIN bahan_kategori ON bahan_kat_id=id_kategori 
		WHERE bahan_slug='$slug'");
		return $query;
	}
	
	function get_kategori_id($id){
		$query = $this->db->query("SELECT * FROM
		bahan LEFT JOIN bahan_kategori ON bahan_kat_id=id_kategori 
		WHERE id_kategori='$id'");
		return $query;
	}

	function insert_penyesuaian($id){
		
        $id = $this->input->post('id_penyesuaian');
		$data = array(
          
            'bahan_id' => $this->input->post('bahan_id'),  
            'qty_penyesuaian' => $this->input->post('qty_penyesuaian'), 
            'penyesuaian_id' => $this->input->post('penyesuaian_id'), 
            'status_penyesuaian' => $this->input->post('status_penyesuaian'), 
        ); 
        $this->db->insert('penyesuaian_stok_bahan', $data);
	}

	function edit_bahan_kategori($id,$nama_kategori,$deskripsi,$bahan_slug){
		$data = array(
	        'nama_kategori' => $nama_kategori,
	        'deskripsi' => $deskripsi,
			'bahan_slug' => $bahan_slug
		);
		$this->db->where('id_kategori', $id);
		$this->db->update('bahan_kategori', $data);
	}
	
	function edit_bahan($id,$kode_bahan,$nama_bahan,$bahan_kat_id,$minimum_stock,$harga_bahan){
		$data = array(
	        'kode_bahan' => $kode_bahan,
	        'nama_bahan' => $nama_bahan,
			'bahan_kat_id' => $bahan_kat_id,
			'minimum_stock' => $minimum_stock,
			'harga_bahan' => $harga_bahan
		);
		$this->db->where('id_bahan', $id);
		$this->db->update('bahan', $data);
	}
	
	function delete_kategori($id){
		$this->db->where('id_kategori', $id);
		$this->db->delete('bahan_kategori'); 
	}

	function hapusBahanSaatKategoriDihapus($id){
		$this->db->where('bahan_kat_id', $id);
		$this->db->delete('bahan'); 
	}
	function get_bahan($bahan_id){   
        $query = $this->db->get_where('bahan', array('id_bahan' => $bahan_id));
        return $query;
	}

	function delete_bahan($id){
		$this->db->where('id_bahan', $id);
		$this->db->delete('bahan'); 
	}

	function kode_bahan(){
		$this->db->select('RIGHT(bahan.kode_bahan,2) as kode_bahan', FALSE);
			  $this->db->order_by('kode_bahan','DESC');    
			  $this->db->limit(1);    
			  $query = $this->db->get('bahan');  //cek dulu apakah ada sudah ada kode di tabel.    
			  if($query->num_rows() <> 0){      
				   //cek kode jika telah tersedia    
				   $data = $query->row();      
				   $kode = intval($data->kode_bahan) + 1; 
			  }
			  else{      
				   $kode = 1;  //cek jika kode belum terdapat pada table
			  }
				  $tgl=date('dmY'); 
				  $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
				  $kodetampil = $batas;  //format kode
				  return $kodetampil;  
		}

		public function update_stock_in($data)
		{
			$qty = $data['qty'];
			$id = $data['bahan_id']; 
			$sql = "UPDATE bahan SET stok_bahan = stok_bahan + '$qty' WHERE id_bahan = '$id'";
			$this->db->query($sql);
		}
		
		public function update_stock_out($data)
		{
			$qty = $data['qty'];
			$id = $data['bahan_id'];
			$sql = "UPDATE bahan SET stok_bahan = stok_bahan - '$qty' WHERE id_bahan = '$id'";
			$this->db->query($sql);
		}
	
		public function penggunaan_bahan_transaksi($data)
		{
			$kurangi = $data['kurangi'];
			$id = $data['bahan_id'];
			$sql = "UPDATE bahan SET stok_bahan = stok_bahan - '$kurangi' WHERE id_bahan = '$id'";
			$this->db->query($sql);
		}
}