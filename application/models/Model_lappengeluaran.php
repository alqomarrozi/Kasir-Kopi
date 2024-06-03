<?php

class Model_lappengeluaran extends CI_Model
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
          $this->db
        // ->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
        // ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
        // ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner')
        ->where('DATE(date)', $date)
        ->order_by('pengeluaran.id_pengeluaran', 'DESC');
        return $this->db->get('pengeluaran')->result();
    }
    
  public function view_by_month($month, $year){
      
    $this->db
    // ->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
    // ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
    // ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner')
    // ->distinct()
    ->where('MONTH(date)', $month)
    ->where('YEAR(date)', $year);
    // ->order_by('detail_penjualan.id', 'DESC')
    return $this->db->get('pengeluaran')->result();
  }
    
  public function view_by_year($year){
        $this->db->where('YEAR(date)', $year); // Tambahkan where tahun
        
        // $this->db->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
        // ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
        // ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner');
    return $this->db->get('pengeluaran')->result(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
  }
    
  public function view_all(){
      $this->db->select('*');
      $this->db->order_by('pengeluaran.id_pengeluaran', 'DESC');
    $this->db->from('pengeluaran');
    return $this->db->get('')->result();
  }
    
    public function option_tahun(){
        $this->db->select('YEAR(date) AS tahun'); // Ambil Tahun dari field tgl
        $this->db->from('pengeluaran'); // select ke tabel transaksi
        $this->db->order_by('YEAR(date)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(date)'); // Group berdasarkan tahun pada field tgl
        
    //         $this->db->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
    // ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
    // ->join('pembayaran', ' detail_penjualan.id_pembayaran = pembayaran.id_byr ', 'inner');
        return $this->db->get('')->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }
}
