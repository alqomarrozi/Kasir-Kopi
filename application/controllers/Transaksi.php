<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    public function __construct()

	{
		parent::__construct();
		if($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert
			alert-primary" role="alert"><div class="alert-body">Login terlebih dahulu!</div></div>');
            $url=base_url('auth');
            redirect($url);
        }; 
        
        $this->load->model('Pos_model','pos_model');
        $this->load->model('Cart_model','cart_model');
        $this->load->model('Bahan_model','bahan_model');
        $this->load->model('Model_penjualan');
        $this->load->model('Model_kategori');
        $this->load->model('Model_produk'); 
        $this->load->library('fungsi'); 
	
	}   
     

    function index()
    {
        // $x['data'] = $this->cart->contents(); 

        // $kode_produk = $items['kode_produk'];
        // $where = array('kode_produk' => $kode_produk);
        // $jumlahbahan = $this->db->get_where('produk_bahan', $where)->result_array();
        $this->manager->display('datapayment');
    }
     
    function proses(){         
    $no_trf = $this->Model_penjualan->get_byr($this->input->post('metode'));
    if ($no_trf->id_byr == 1) { 
        $metode = strtoupper($no_trf->metode);
        $notrf = substr($metode, 0, 1);
    } else if ($no_trf->id_byr == 2) {
        $metode = strtoupper($no_trf->metode);
        $notrf = substr($metode, 0, 1);
    } else {
        $notrf = "0";
    } 
    
    $bayar = $this->input->post('bayar');
    $grandtotal = $this->input->post('grandtotal');
   
    if($bayar>=$grandtotal){
        $kode = $this->Model_penjualan->get_nourut();
        $nourut = $this->formatNbr($kode[0]->nomor);
        $tgl = date('Ymd');
        $kodeurut = $notrf . $tgl . $nourut;
        $payment = array(
            'no_trf' => $kodeurut,
            'nama_pelanggan' => $this->input->post('pelanggan'),
            'totalpure' => $this->input->post('totalpure'),
            'grand_total ' => $grandtotal,
            'diskon' => $this->input->post('diskon'),
            'bayar' => $bayar,
            'kembalian' => $this->input->post('kembalian'),
            'catatan' => $this->input->post('note'), 
            'tgl_trf' => date('Y-m-d'),
            'jam_trf' => date('H:i:s'),
            'id_pembayaran' => $this->input->post('metode'),
            'no_rek' => $this->input->post('norek'),
            'atas_nama' => $this->input->post('atas_nama'),
            'id_bank' => $this->input->post('payments'),
            'operator' => $this->session->userdata['username'], 
            'kode_register' => $this->session->userdata['kode_register'],  
        ); 
        $detail_penjualan =  $this->Model_penjualan->tambah_trf($payment);
        $id_dtlpenjualan = $this->Model_penjualan->get_id($kodeurut);
    
        // $pjl = array();
        foreach ($this->cart->contents() as $q) {
            // var_dump($q);die;
            $pjl[] = array( 
                'id_bahan' => $_POST['id_bahan'], 
                'kode_produk' => $q['kode_produk'],
                // 'stok_bahan' => intval($this->Model_penjualan->total_produk($q['id_bahan'])->row()->total) - intval($q['qty']),
                'tanggal_stok' => date('Y-m-d'),
            ); 
        }
        
        foreach ($this->cart->contents() as $items) {
            $penjualan[] = array(
                'id_dtlpen'    => $id_dtlpenjualan['id'],
                'id_produk'     => $items['id_produk'],
                'jumlah_stok'     => $items['qty'],
                'harga_produk' => $items['price'], 
                'produk_name'     => $items['name'],
                'sub_total' => $items['subtotal'],
                'id_extras'     => isset($items['id_extras']), 
                'kode_register' => $this->session->userdata['kode_register'], 
            );
        } 
       
        // PROSES Pengurangan Stok Bahan 
        $kode_produk= $this->input->post('kode_produk',TRUE);
        $id_bahan= $this->input->post('id_bahan',TRUE);
        $kurangi = $this->input->post('kurangi');
        $stok = $this->input->post('stok');
        $this->db->trans_start();
         
        $result = array();
            foreach($stok AS $key => $val){
                 $result[] = array(
                    'id_bahan'   => $_POST['id_bahan'][$key],
                  'stok_bahan' => $_POST['stokupdate'][$key]
                 );
            }      
            // var_dump($result);die;
        //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->trans_complete();
        $this->db->update_batch('bahan', $result, 'id_bahan'); 
        // PROSES PENGURANGAN SELESAI
    
       
        $pjl = $this->Model_penjualan->tambah_pjl($penjualan);
// 		$this->db->insert_batch('penjualan', $pjl);;
    }else{
        $this->session->set_flashdata('failed', 'Ooopss! Uang yang dibayar Kurang!');
        redirect('transaksi');
    }
   
    if (!$detail_penjualan && !$pjl) {
        $this->session->set_flashdata('success', 'Penjualan Sukses');
        $this->cart->destroy();
        redirect('transaksi/struk/' . $id_dtlpenjualan['id']);
    } else {
        $this->session->set_flashdata('failed', 'Ooopss! Penjualan Gagal, Namun Stok Data Berubah!');
        redirect('app');
    }
    }

    function detail_order(){ //Fungsi untuk menampilkan Cart
        $output = ''; 
        $no = 0;
        $itemarray = $this->cart->contents();
        
        foreach ($this->cart->contents() as $items) { 

            $no++;
            $output .=' 
            
                <tr>
                <input type="hidden" id="idbrg"
                name="idproduk[]"  
                value="'.$items['id_produk'].'">
                <input type="hidden" id="kode_produk"
                name="kode_produk[]" 
                value="'.$items['kode_produk'].'">
                <input type="hidden" name="rowid"
                value="'.$items['rowid'].'">
            
                    // <td>'.$no.'</td>
                    <td>'.$items['kode_produk'].'</td>
                    <td>'.$items['name'].'</td>
                    <td>'.number_format($items['price']).'</td>
                    <td>'.$items['qty'].'</td>
                    <td>'.number_format($items['subtotal']).'</td>
                </tr>
            ';
        }
        $output .= '
            <tr>
                <th colspan="3">Total</th>
                <th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>
            </tr>
        ';
        return $output;
    }
     
    
function struk($id)
{ 
    $id = $this->uri->segment(3);
    $cek = $this->Model_penjualan->cek_transaksi($this->uri->segment(3));
    $data = array(
        'tanggal' => $cek[0]->tgl_trf, 
        'jam' => $cek[0]->jam_trf,
        'nota' => $cek[0]->no_trf,
        'operator' => $cek[0]->operator,
        'pelanggan' => $cek[0]->nama_pelanggan,
        'total' => $cek[0]->totalpure,
        'diskon' => $cek[0]->diskon,
        'grand_total' => $cek[0]->grand_total,
        'result' => $cek,
        'metode' => $cek[0]->metode,
        'bayar' => $cek[0]->bayar,
        'kembalian' => $cek[0]->kembalian,
        'rekening' => $cek[0]->no_rek,
        'bank' => $cek[0]->nama_bank,
        'atasnama' => $cek[0]->atas_nama,
        'catatan' => $cek[0]->catatan,
    );

    $this->manager->display('struk', $data);
}


function load_cart(){ //load data cart
    echo $this->detail_order();
}


function formatNbr($nbr)
{
    if ($nbr == 0 || $nbr == NULL)
        return "001";
    else if ($nbr < 10)
        return "00" . $nbr;
    elseif ($nbr >= 10 && $nbr < 100)
        return "0" . $nbr;
    else
        return strval($nbr);
}


public function cetak_struk($id) {
    // me-load library escpos
$this->load->view('cetak_struk');    
}

public function test(){
    
$this->load->view('test');    
}

public function print($id){
    
    $id = $this->uri->segment(3);
    $cek = $this->Model_penjualan->cek_transaksi($this->uri->segment(3));
    $data = array(
        'tanggal' => $cek[0]->tgl_trf, 
        'jam' => $cek[0]->jam_trf,
        'nota' => $cek[0]->no_trf,
        'operator' => $cek[0]->operator,
        'pelanggan' => $cek[0]->nama_pelanggan,
        'total' => $cek[0]->totalpure,
        'diskon' => $cek[0]->diskon,
        'grand_total' => $cek[0]->grand_total,
        'result' => $cek,
        'metode' => $cek[0]->metode,
        'bayar' => $cek[0]->bayar,
        'kembalian' => $cek[0]->kembalian,
        'rekening' => $cek[0]->no_rek,
        'bank' => $cek[0]->nama_bank,
        'atasnama' => $cek[0]->atas_nama,
        'catatan' => $cek[0]->catatan,
    );
    $this->load->view('print-area',$data);    
    }
    

function rupiah($nominal)
{
    $rp = number_format($nominal, 0, ',', '.');
    return $rp;

}
}