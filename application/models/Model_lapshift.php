<?php

class Model_lapshift extends CI_Model
{

    function get_data()
    {
        return
            $this->db
            ->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
            ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
            ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner')
            ->group_by('detail_penjualan.no_trf')
            ->distinct()
            ->order_by('detail_penjualan.id', 'DESC')
            ->get('detail_penjualan')->result();
    }

    function get_data_produk()
    {
        return
            $this->db
            ->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
            ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
            ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner')
            // ->group_by('detail_penjualan.no_trf')
            ->distinct()
            ->order_by('detail_penjualan.id', 'DESC')
            ->get('detail_penjualan')->result();
    }

    function get_metode()
    {
        return $this->db->get('pembayaran')->result();
    }

    function get_produk()
    {
        return $this->db->get('produk')->result();
    }


    function get_range($start, $end, $metode)
    {
        if ($metode != '') {
            return $this->db->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
            ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
                ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner')
                ->where("tgl_trf >=", $start)
                ->where("tgl_trf <=", $end)
                ->where('id_pembayaran', $metode)
                ->group_by('detail_penjualan.no_trf')
                ->distinct()
                ->order_by('detail_penjualan.id', 'ASC')
                ->get('detail_penjualan')->result();
        } else {
            return $this->db->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
            ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
                ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner')
                ->where("tgl_trf >=", $start)
                ->where("tgl_trf <=", $end)
                ->group_by('detail_penjualan.no_trf')
                ->distinct()
                ->order_by('detail_penjualan.id', 'ASC')
                ->get('detail_penjualan')->result();
        }
    }

    function get_range_produk($start, $end, $produk)
    {
        if ($produk != '') {
            return $this->db->join('detail_penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
            ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
                ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner')
                ->where("tgl_trf >=", $start)
                ->where("tgl_trf <=", $end)
                
                 ->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
            // ->group_by('detail_penjualan.no_trf')
                ->distinct()
                ->where('produk.id_produk', $produk)
                ->group_by('detail_penjualan.no_trf')
                ->get('detail_penjualan')->result();
        } else {
            return $this->db->join('detail_penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
                ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
                // ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner')
                ->where("tgl_trf >=", $start)
                ->where("tgl_trf <=", $end)
                ->group_by('penjualan.id_produk')
                ->order_by('detail_penjualan.no_trf', 'DESC')
                ->get('detail_penjualan')->result();
        }
    }

    function hapus_trf($id)
    {
        $this->db->where('id', $id)->delete('detail_penjualan');
    }
    function hapus_id($id)
    {
        $this->db->where('id_dtlpen', $id)->delete('penjualan');
    }

    
    public function view(){
        return
            $this->db
            ->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
            ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
            ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner')
            // ->group_by('detail_penjualan.no_trf')
            ->distinct()
            ->order_by('detail_penjualan.id', 'DESC')
            ->get('detail_penjualan')->result();
      }

      public function view_by_date($date){
        $this->db->join('users', 'users.id = registers.user_id', 'left');
          $this->db
        // ->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
        // ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
        // ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner')
        ->where('DATE(date)', $date)
        ->order_by('registers.id', 'DESC');
        return $this->db->get('registers')->result();
    }
    
  public function view_by_month($month, $year){
      
    $this->db->join('users', 'users.id = registers.user_id', 'left');
    $this->db->order_by('registers.date', 'DESC');
    $this->db
    // ->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
    // ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
    // ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner')
    // ->distinct()
    ->where('MONTH(date)', $month)
    ->where('YEAR(date)', $year);
    // ->order_by('detail_penjualan.id', 'DESC')
    return $this->db->get('registers')->result();
  }
    
  public function view_by_year($year){
        $this->db->where('YEAR(date)', $year); // Tambahkan where tahun
        
    $this->db->join('users', 'users.id = registers.user_id', 'left');
    $this->db->order_by('registers.date', 'DESC');
        // $this->db->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
        // ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
        // ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner');
    return $this->db->get('registers')->result(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
  }
    
  public function view_all(){
      $this->db->select('*');
      $this->db->join('users', 'users.id = registers.user_id', 'left');
      $this->db->order_by('registers.date', 'DESC');
    $this->db->from('registers');
    return $this->db->get('')->result();
  }
     
    public function option_tahun(){
        $this->db->select('YEAR(date) AS tahun'); // Ambil Tahun dari field tgl
        $this->db->from('registers'); // select ke tabel transaksi
        $this->db->join('users', 'users.id = registers.user_id', 'left');
        $this->db->order_by('YEAR(date)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(date)'); // Group berdasarkan tahun pada field tgl
        
    //         $this->db->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
    // ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
    // ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner');
        return $this->db->get('')->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }


    function close_register($total_cash, $pendapatan, $pengeluaran, $note, $kode_register){
        $data = array(
	        // 'id' => $this->session->userdata('register_id'),
	        'date' => $this->session->userdata('register_open_time'),
			'closed_by' => $this->session->userdata('id'),
			'closed_at' => date('Y-m-d H:i:s'),
			'status_shift' => 'close',
            'total_cash' => $total_cash,
            'pendapatan' => $pendapatan,
            'pengeluaran' => $pengeluaran,
            'note' => $note, 
		);
		$this->db->where('kode_register', $kode_register);
		$this->db->update('registers', $data);
	}

    
    public function getRegisterPendapatan($kode_register = NULL) {
        // $date = $this->session->userdata('register_open_time');
        $this->db->select('COUNT(' . $this->db->dbprefix('detail_penjualan') . '.id) as total_cc_slips, SUM( COALESCE( detail_penjualan.grand_total, 0 ) ) AS total, SUM( COALESCE( bayar, 0 ) ) AS paid',  FALSE)
            ->join('penjualan', 'penjualan.id_dtlpen=detail_penjualan.id', 'left')
            // ->where('CONCAT(detail_penjualan.tgl_trf, detail_penjualan.jam_trf) >', $register_open)
            ->where("{$this->db->dbprefix('detail_penjualan')}.id_pembayaran", '1');
        $this->db->where('detail_penjualan.kode_register', $kode_register);

        $q = $this->db->get('detail_penjualan');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }
 
    
    public function getRegisterPenjualan($kode_register = NULL) {
        $this->db->select('SUM( COALESCE( grand_total, 0 ) ) AS total, SUM( COALESCE( bayar, 0 ) ) AS paid, tgl_trf', FALSE)
            ->join('penjualan', 'penjualan.id_dtlpen=detail_penjualan.id', 'left');
            // ->where('penjualan.created_penjualan >', $register_open);
            $this->db->where('detail_penjualan.kode_register', $kode_register);

            $q = $this->db->get('detail_penjualan');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    } 
    
    public function getRegisterExpenses($kode_register = NULL) {
        $this->db->select('SUM( COALESCE( total, 0 ) ) AS total', FALSE);
        // ->where('tanggal >', $register_open);
        $this->db->where('kode_register', $kode_register);

        $q = $this->db->get('pengeluaran');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }
}
