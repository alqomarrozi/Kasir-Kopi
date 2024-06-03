<?php

class Model_penjualan extends CI_Model
{

	public $id = 'id_produk';

	function lihat_produk($id)
	{
		return $this->db->select('SUM(jumlah) as jumlah')
			->join('produk_bahan', 'produk.kode_produk = produk_bahan.kode_produk')
			->where('produk.id_produk', $id)
			->get('produk');
	}

	function hasilcari($key)
	{
		return $this->db->or_like('nama_produk', $key)
			->get('produk')
			->result();
	}

	function produk_bahan_list()
	{
		return $this->db->join('produk', 'produk.kode_produk = produk_bahan.kode_produk', 'left')
			// ->join('ukuran', 'ukuran.id_ukuran = produk.ukuran', 'left')
			->get('produk_bahan')->num_rows();
	}
 
	function halaman($number, $offset)
	{ 
		// return $this->db->join('produk_bahan', 'produk_bahan.kode_produk = produk.kode_produk', 'left')
			// ->join('ukuran', 'ukuran.id_ukuran = produk.ukuran', 'left')
			return $this->db->get('produk', $number, $offset)->result();
	}

	function cart($id)
	{
		return $this->db->where('produk.id_produk', $id)
		->join('produk_bahan', 'produk_bahan.kode_produk = produk.kode_produk', 'left')
		->join('bahan', 'produk_bahan.bahan_id = bahan.id_bahan', 'left')
		->join('extras', 'extras.id_produk = produk.id_produk', 'left')
		->get('produk')
		->row();
	}

	function tambah_trf($payment)
	{
		$this->db->insert('detail_penjualan', $payment);
	}

	function get_byr($id)
	{
		return $this->db->where('id_byr', $id)->get('pembayaran')->row();
	}

	function get_nourut()
	{
		return $this->db->select('max(id) as nomor')
			->from('detail_penjualan')->get()->result();
	}

	function get_id($id) 
	{
		return $this->db->select('id')->where('no_trf', $id)->get('detail_penjualan')->row_array();
	}

	function tambah_pjl($penjualan)
	{
		$this->db->insert_batch('penjualan', $penjualan);
	}

	function pengurangan_stok($pjl)
	{
		$this->db->join('produk_bahan', 'produk_bahan.bahan_id = bahan.id_bahan', 'left')
		->join('produk', 'produk.kode_produk = produk_bahan.kode_produk', 'left')
		->update_batch('bahan', $pjl, 'id_bahan');
	}

	function cek_transaksi($id)
	{
		return $this->db->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
		// ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
			->join('pembayaran', 'pembayaran.id_byr = detail_penjualan.id_pembayaran', 'inner')
			->join('bank', 'bank.id = detail_penjualan.id_bank', 'left')
			->where('detail_penjualan.id', $id)->get('detail_penjualan')->result();
	}

	function get_detail_modal($id)
	{
		return $this->db->where('produk.id_produk', $id)
		->join('produk_bahan', 'produk_bahan.kode_produk = produk.kode_produk', 'left')
		// ->join('extras_menu', 'extras_menu.id_produk = produk.id_produk', 'left')
		->join('extras', 'extras.kode_produk = produk.kode_produk', 'left')
			// ->join('ukuran', 'ukuran.id_ukuran = produk.ukuran', 'left')
			->get('produk')
			->row();
	}

	function total_produk($id)
	{
		return $this->db->select('sum(id_bahan) as total')
			->where('id_bahan', $id)
			->get('bahan');
	}

	function filter_produk($kategori, $number, $offset)
	{
		if ($kategori != '') {
			// return $this->db->join('produk_bahan', 'produk.kode_produk = produk_bahan.kode_produk', 'left')
				// ->where('produk.ukuran', $ukuran)
				return $this->db->where('produk.kategori_id', $kategori)
				// ->join('ukuran', 'ukuran.id_ukuran = produk.ukuran', 'left')
				->get('produk')->result();
		} else if ($kategori != '') {
			// return $this->db->join('produk_bahan', 'produk.kode_produk = produk_bahan.kode_produk', 'left')
			return $this->db->w->where('produk.kategori_id', $kategori)
				// ->join('ukuran', 'ukuran.id_ukuran = produk.ukuran', 'left')
				->get('produk')->result();
		} else if ($kategori == '') {
			// return $this->db->join('produk_bahan', 'produk.kode_produk = produk_bahan.kode_produk', 'left')
				// ->where('produk.ukuran', $ukuran)
				// ->join('ukuran', 'ukuran.id_ukuran = produk.ukuran', 'left')
				return $this->db->get('produk')->result();
				
		} else {
			// return $this->db->join('produk_bahan', 'produk.kode_produk = produk_bahan.kode_produk', 'left')
				// ->join('ukuran', 'ukuran.id_ukuran = produk.ukuran', 'left')
				return $this->db->get('produk', $number, $offset)->result();
		}
	}
}
