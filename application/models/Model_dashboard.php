<?php

class Model_dashboard extends CI_Model
{

    public function total($table)
    {
        $query = $this->db->get($table)->num_rows();
        return $query;
    }

    public function total_penjualan()
    {
        return $this->db->select('sum(jumlah_stok) as total')
            ->from('penjualan')->get()->row();
    }

    public function total_stok()
    {
        return $this->db->select('sum(stok_bahan) as total')
            ->from('bahan')->get()->row();
    }

    public function graph_stok()
    {
        return $this->db->select('bahan.nama_bahan,sum(stok_bahan) as total')
            ->from('bahan')->join('produk_bahan', 'bahan.id_bahan = produk_bahan.bahan_id', 'left')
            ->group_by('bahan.id_bahan')
            ->get()
            ->result();
    }

    // public function graph_bahan()
    // {
    //     return $this->db->select('produk.id_produk,produk.kode_produk,produk.nama_produk, sum(bahan.stok_bahan) as total')
    //         ->from('produk')
    //         ->join('produk_bahan', 'produk.kode_produk = produk_bahan.kode_produk', 'left')
    //         ->join('bahan','bahan.id_bahan = produk_bahan.bahan_id')
    //         ->group_by('bahan.id_bahan')
    //         ->get()
    //         ->result();
    // }

    public function graph_bahan()
    {
        return $this->db->select('bahan.id_bahan, bahan.kode_bahan, bahan.nama_bahan, sum(bahan.stok_bahan) as total')
            ->from('bahan')
            // ->join('produk_bahan', 'bahan.id_bahan = produk_bahan.bahan_id', 'left')
            // ->join('bahan','bahan.id_bahan = produk_bahan.bahan_id')
            ->group_by('bahan.id_bahan')
            ->get()
            ->result();
    }

    // public function barang_laris()
    // {
    //     return $this->db->select('produk.nama_produk,produk.gambar_produk,sum(penjualan.jumlah_stok) as total,detail_penjualan.tgl_trf')
    //         ->from('penjualan')
    //         ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
    //         ->join('detail_penjualan', 'detail_penjualan.id = penjualan.id_dtlpen', 'left')
    //         ->group_by('produk.nama_produk')
    //         ->order_by('total', 'ASC')
    //         ->where('month(detail_penjualan.tgl_trf) = month(CURRENT_date())')
    //         ->limit('5')
    //         ->get()->result();
    // }

    function barang_laris(){
        $query = $this->db->query("SELECT produk_name,created_penjualan,SUM(jumlah_stok) AS stok FROM penjualan GROUP BY created_penjualan");
          
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
}
