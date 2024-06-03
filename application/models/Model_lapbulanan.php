<?php

class Model_lapbulanan extends Ci_Model
{

    public function bulanan($thn)
    {
        return $this->db->select('tgl_trf,sum(grand_total) as gtotal')
            ->from('detail_penjualan')
            ->where('YEAR(tgl_trf)', $thn)
            ->group_by('MONTH(tgl_trf)')
            ->get()
            ->result();
    }

    public function income()
    {
        return $this->db->select('sum(grand_total) as gtotal')
            ->from('detail_penjualan')
            ->where('month(tgl_trf) = month(CURRENT_date())')
            ->get()
            ->row();
    }

    public function total_penjualan()
    {
        return $this->db->select('sum(jumlah_stok) as total')
            ->join('detail_penjualan', 'detail_penjualan.id = penjualan.id_dtlpen', 'left')
            ->where('month(detail_penjualan.tgl_trf) = month(CURRENT_date())')
            ->from('penjualan')->get()->row();
    }

    public function total_transaksi()
    {
        return $this->db->select('count(id) as total')
            ->where('month(tgl_trf) = month(CURRENT_date())')
            ->from('detail_penjualan')->get()->row();
    }

    public function total_produk()
    {
        return $this->db->select('sum(jumlah_stok) as total')
            ->from('penjualan')->get()->row();
    }
    public function produk_laris()
    {
        $query =  $this->db->select('produk.nama_produk,sum(jumlah_stok) as total,produk.gambar_produk,detail_penjualan.tgl_trf')
            ->from('penjualan')
            ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
            ->join('detail_penjualan', 'detail_penjualan.id = penjualan.id_dtlpen', 'left')
            ->group_by('produk.nama_produk')
            ->order_by('total', 'ASC')
            ->where('month(detail_penjualan.tgl_trf) = month(CURRENT_date())')
            ->limit('1')
            ->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
}
