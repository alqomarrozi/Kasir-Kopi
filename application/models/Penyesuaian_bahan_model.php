<?php
class Penyesuaian_bahan_model extends CI_Model{
  
    function get_all_penyesuaian(){
        $this->db->order_by("penyesuaian_stok.id_penyesuaian", "desc"); 
		$result = $this->db->query('SELECT * FROM penyesuaian_stok LEFT JOIN users on penyesuaian_stok.user_id=users.id');
		return $result; 
    } 
    function get_penanggung_jawab(){
        $this->db->order_by("id_penyesuaian", "desc"); 
		$result = $this->db->query('SELECT * FROM penyesuaian_stok_bahan LEFT JOIN users as u on penyesuaian_stok.karyawan_id = u.id');
		return $result; 
    } 

    function get_penyesuaian_by_no_ref($noref){
		$query = $this->db->query("SELECT * FROM penyesuaian_stok_bahan LEFT JOIN penyesuaian_stok ON no_ref=no_referensi LEFT JOIN bahan on bahan_id=id_bahan 
		WHERE no_referensi='$noref' ORDER BY id_penyesuaian_stok_bahan");
		return $query;
	}
    
    function get_detail_penyesuaian_bahan($noref){
		$query = $this->db->query("SELECT * FROM penyesuaian_stok_bahan LEFT JOIN penyesuaian_stok ON no_ref=no_referensi LEFT JOIN bahan on bahan_id=id_bahan 
		WHERE no_referensi='$noref' ORDER BY id_penyesuaian_stok_bahan");
		return $query;
	} 
    function get_detail_penyesuaian($noref){
		$query = $this->db->query("SELECT * FROM penyesuaian_stok WHERE no_referensi='$noref'");
		return $query;
	}

	function get_no_ref(){
        // $q = $this->db->query("SELECT MAX(RIGHT(no_referensi,4)) AS kd_max FROM penyesuaian_stok WHERE DATE(tanggal_penyesuaian)=CURDATE()");
        // $kd = "";
        // if($q->num_rows()>0){
        //     foreach($q->result() as $k){
        //         $tmp = ((int)$k->kd_max)+1;
        //         $kd = sprintf("%04s", $tmp);
        //     }
        // }else{
        //     $kd = "0001";
        // }
        // date_default_timezone_set('Asia/Jakarta');
        // return date('dmy').$kd;

    //     $this->db->select('RIGHT(bahan.kode_bahan,5) as kode_bahan', FALSE);
    // $this->db->order_by('kode_bahan','DESC');    
    // $this->db->limit(1);    
    // $query = $this->db->get('bahan');
    //     if($query->num_rows() <> 0){      
    //          $data = $query->row();
    //          $kode = intval($data->kode_bahan) + 1; 
    //     }
    //     else{      
    //          $kode = 1;  
    //     }
    // $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
    // $kodetampil = "DC".$batas;
    // return $kodetampil;  
    }
    
	function kode(){
    $this->db->select('RIGHT(penyesuaian_stok.no_referensi,2) as no_referensi', FALSE);
		  $this->db->order_by('no_referensi','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('penyesuaian_stok');  //cek dulu apakah ada sudah ada kode di tabel.    
		  if($query->num_rows() <> 0){      
			   //cek kode jika telah tersedia    
			   $data = $query->row();      
			   $kode = intval($data->no_referensi) + 1; 
		  }
		  else{      
			   $kode = 1;  //cek jika kode belum terdapat pada table
		  }
			  $tgl=date('dmY'); 
			  $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
			  $kodetampil = "REF".$tgl.$batas;  //format kode
			  return $kodetampil;  
	}
    
  // public function add_stock_in($post)
  //   {
  //       $data = [
  //           'bahan_id' => $post['bahan_id'],
  //           'status_penyesuaian' => 'Plus', 
  //           'no_ref' => $post['no_referensi'],
  //           // 'supplier_id' => $post['supplier'] == null ? null : $post['supplier'],
  //           'qty_penyesuaian' => $post['qty_penyesuaian'],
  //           // 'date' => $post['date'],
  //           // 'user_id' => $this->session->userdata('userid')
  //       ];

  //       $this->db->insert('penyesuaian_stok_bahan', $data);
  //   }
	
  public function update_stock_in($data2)
  {  
      $qty =  $_POST['bahan_id'];
      $id = $_POST['qty_penyesuaian']; 
      $sql = "UPDATE bahan SET stock_bahan = stock_bahan + '$qty' WHERE bahan_id = '$id'";
      $this->db->query($sql);
  }
}