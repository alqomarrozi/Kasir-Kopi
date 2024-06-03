<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {
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
        $this->load->model('Extras_model','extras_model');
        $this->load->model('Model_penjualan');
        $this->load->model('Model_kategori');
        $this->load->model('Model_produk');
        $this->load->model('Register_model', 'register_model');
        $this->load->model('Harga_online_model','harga_online_model');
        $this->load->library('form_validation');

	 
	}   
    
    public function store()
    {  
          // kondisi jika menekan tombol filter
          if (isset($_POST['filter'])) {
            // $this->input->post untuk memproses data dari form $_POST
            $kategori = $this->input->post('kategori');
            // ---- $this->input->post untuk memproses data dari form $_POST
            $total = $this->Model_penjualan->produk_bahan_list();
            // load library pagination(halaman) beserta confignya
            $this->load->library('pagination');
            $config['base_url'] = base_url('app');  //halaman utama
            $config['total_rows'] = $total; //total baris berdasarkan dari databse
            $config['per_page']         = 0; // set 0 karena masuk kondisi ketika memilih filter "pilih semua"
            $config['first_link']       = 'First'; // config tombol halaman awal
            $config['last_link']        = 'Last'; // config tombol halaman akhir
            $config['next_link']        = 'Next'; // config tombol halaman selanjutnya
            $config['prev_link']        = 'Prev'; // config tombol halaman sebelumnya
            $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close']    = '</span></li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close']  = '</span>Next</li>';
            $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close']  = '</span></li>';
            $this->pagination->initialize($config); // setelah config , config tersebut akan di inialisasi, jika tidak config tersebut tidak akan berfungsi
            $from = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            
            //sebuah kumpulan variable yang di satukan menjadi array pada variable $data
            $data = array(
                'halaman'     => $this->pagination->create_links(),
                'result'    => $this->Model_penjualan->filter_produk($kategori, $config['per_page'], $from),
                'kategori' => $this->Model_kategori->tampilkan_data(),
                'customertype' => $this->harga_online_model->get_all_harga_online()
                // 'extras' => $this->Extras_model->tampilkan_extras()->result(),
            );
            $this->manager->display('pointofsale',$data); 
         }else{
                $total = $this->Model_penjualan->produk_bahan_list(); 
                $this->load->library('pagination');
                $config['base_url'] = base_url('app/store/');
                $config['per_page']         = 6;
                $config['total_rows'] = $total;
                $config['first_link']       = 'First';
                $config['last_link']        = 'Last';
                $config['next_link']        = 'Next';
                $config['prev_link']        = 'Prev';
                $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
                $config['full_tag_close']   = '</ul></nav></div>';
                $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
                $config['num_tag_close']    = '</span></li>';
                $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
                $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
                $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
                $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
                $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
                $config['prev_tagl_close']  = '</span>Next</li>';
                $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
                $config['first_tagl_close'] = '</span></li>';
                $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
                $config['last_tagl_close']  = '</span></li>';
                $this->pagination->initialize($config);
                $from = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $data = array(  
                    'halaman'     => $this->pagination->create_links(),
                    'result'    => $this->Model_penjualan->halaman($config['per_page'], $from),
                    'kategori' => $this->Model_kategori->tampilkan_data(),
                    'customertype' => $this->harga_online_model->get_all_harga_online()
                );
                if (!$this->session->userdata('kode_register')) {
                    if ($register = $this->register_model->registerData($this->session->userdata('kode_register'))) {
                        $register_data = array('register_id' => $register->id, 'cash_in_hand' => $register->cash_in_hand, 'register_open_time' => $register->date);
                        $this->session->set_userdata($register_data);
                       
                    } else {
                        $this->session->set_flashdata('failed', 'Lakukan Register Shift Terlebih Dahulu');
                        redirect('app/open_register');
                    }
                }
                 $this->manager->display('pointofsale',$data);
 
                }
 
    } 
 
function tambah_produk($id)
{ 
    $produk = $this->Model_penjualan->lihat_produk($this->input->post('id_produk'));
    if ($produk->row()->jumlah > 100) {
        $this->session->set_flashdata('failed', 'Stok produk melebihi kapasitas!');
        redirect(base_url('app'));
    } else {
        $result = $this->Model_penjualan->cart($id);
        $getSessionCustomerType = $this->session->userdata('customer_type');
        $getCustomerType = $this->db->query("SELECT * FROM
        type_harga_online WHERE harga_online_id=$getSessionCustomerType")->row_array();
        $harga_produk = $result->harga_produk + $getCustomerType['harga_online'];
        $getProduct = $this->db->query("SELECT * FROM produk WHERE id_produk ='$id'")->row_array();
        $data = array(
                      'id'    => $id,
            'id_produk'    => $getProduct['id_produk'],
            'kode_produk'  => $getProduct['kode_produk'], 
            // 'id_bahan'  => $getProduct['id_bahan'],  
            // 'stok_bahan'  => $getProduct['stok_bahan'], 
            'name'      => $getProduct['nama_produk'],
            'price'     => $harga_produk,
            'qty'       => 1,
            );
            
        // var_dump($data); die;
        $this->cart->insert($data);
        redirect(base_url('app'));
    }
}


function tambah_produk_extras($id, $id_extras)
{
    $produk = $this->Model_penjualan->lihat_produk($this->input->post('id_produk'));
    if ($produk->row()->jumlah > 100) {
        $this->session->set_flashdata('failed', 'Stok produk melebihi kapasitas!');
        redirect(base_url('app'));
    } else {
        
        $result = $this->Model_penjualan->cart($id); 
        $kode_produk =  $result->kode_produk;
        
        
        $extras = $this->db->query("SELECT * FROM extras WHERE id_extras='$id_extras'")->row();
        
        $getSessionCustomerType = $this->session->userdata('customer_type');
        $getCustomerType = $this->db->query("SELECT * FROM
        type_harga_online WHERE harga_online_id=$getSessionCustomerType")->row_array();
        $harga_produk = intval($result->harga_produk) + intval($extras->harga_extras) + intval($getCustomerType['harga_online']);
        
            $data = array(
            'id_produk'    => $id,
            'kode_produk'  => $result->kode_produk, 
            'id_bahan'  => $result->id_bahan, 
            'id_extras'  => $extras->id_extras, 
            'stok_bahan'  => $result->stok_bahan, 
            'id'        => $extras->kode_extras,
            'name'      => $result->nama_produk.' dengan '.$extras->nama_extras,
            'price'     => $harga_produk,
            'qty'       => 1,
            'option'    => array(
                'nama_extras' => $extras->nama_extras,
                )
    
        );
        // var_dump($data); die;
        $this->session->set_flashdata('success', 'Item + Extras Berhasil Dimasukan Ke Keranjang!');
        $this->cart->insert($data); 
        redirect(base_url('app'));
    }
}
function cariproduk()
{ 
    $key = $this->input->get('q');
    $data = $this->Model_penjualan->hasilcari($key);
    foreach ($data as $result) { 
        echo '<li class="d-flex align-items-center justify-content-between w-100">
        <a class="d-flex align-items-center justify-content-between w-100" href="' . base_url() . 'app/tambah_produk/' . $result->id_produk . '">
                <div class="d-flex">
                    <div class="search-data">
                        <p class="search-data-title mb-0">' . $result->nama_produk . '</p><small class="text-muted"> Rp.' . $result->harga_produk . '</small>
                    </div>
                </div>
        </a></li>';
    }
}

function ubah_qty()
{
    $produk = $this->Model_penjualan->lihat_produk($this->input->post('idproduk'));
    // $cekstokbahan = $this->Model_penjualan->cekStokBahan();
    $permintaan = intval($this->input->post('qty'));
    $jumlahstok = intval($produk->row()->jumlah);
    // if ($permintaan >= $jumlahstok) {
        
    //     // var_dump($permintaan); die;
    //     $this->session->set_flashdata('message', 'Jumlah permintaan melebihi stok produk');
    //     redirect(base_url('app'));
    // } else {
        $data = array(
            'rowid' => $this->input->post('rowid'),
            'qty'   => $this->input->post('qty')
        );
        // var_dump($data); die;
        $this->cart->update($data);
        redirect(base_url('app'));
    // }
}
// function hapus_cart($row)
// {
//     $data = array(
//         'rowid' => $row,
//         'qty'   => 0,
//     );
//     $this->cart->update($data);
//     redirect(base_url('app'));
// }
function cancel()
{
    $this->cart->destroy();
    
    $this->session->set_flashdata('success', 'Berhasil di Cancel'); 
    redirect(base_url('app'));
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

function transaksi()
{
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
    $kode = $this->Model_penjualan->get_nourut();
    $nourut = $this->formatNbr($kode[0]->nomor);
    $tgl = date('Ymd');
    $kodeurut = $notrf . $tgl . $nourut;
    $payment = array(
        'no_trf' => $kodeurut,
        'nama_pelanggan' => $this->input->post('pelanggan'),
        'totalpure' => $this->input->post('totalpure'),
        'grand_total ' => $this->input->post('grandtotal'),
        'diskon' => $this->input->post('diskon'),
        'bayar' => $this->input->post('bayar'),
        'kembalian' => $this->input->post('kembalian'),
        'catatan' => $this->input->post('note'),
        'tgl_trf' => date('Y-m-d'),
        'jam_trf' => date('H:i:s'),
        'id_pembayaran' => $this->input->post('metode'),
        'no_rek' => $this->input->post('norek'),
        'atas_nama' => $this->input->post('atas_nama'),
        'id_bank' => $this->input->post('payments'),
        'operator' => $this->session->userdata['username'],
    ); 
    $detail_penjualan =  $this->Model_penjualan->tambah_trf($payment);
    $id_dtlpenjualan = $this->Model_penjualan->get_id($kodeurut);

    $pjl = array();
    foreach ($this->cart->contents() as $q) {
        $pjl[] = array( 
            'id_bahan' => $q['id_bahan'], 
            'kode_produk' => $q['kode_produk'],
            'stok_bahan' => intval($this->Model_penjualan->total_produk($q['id_bahan'])->row()->total) - intval($q['qty']),
            'tanggal_stok' => date('Y-m-d'),
        );
    }
    foreach ($this->cart->contents() as $items) {
        $penjualan[] = array(
            'id_dtlpen'    => $id_dtlpenjualan['id'],
            'id_produk'     => $items['id_produk'],
            'kode_produk'     => $items['kode_produk'],
            'jumlah_stok'     => $items['qty'],
            'harga_produk' => $items['price'],
            'sub_total' => $items['subtotal'],
        );
    }
  
    $png = $this->Model_penjualan->pengurangan_stok($pjl); 
    $pjl = $this->Model_penjualan->tambah_pjl($penjualan);
    if (!$detail_penjualan && !$pjl && !$png) {
        $this->cart->destroy();
        $this->session->set_flashdata('success', 'Penjualan Sukses');
        redirect('penjualan/struk/' . $id_dtlpenjualan['id']);
    } else {
        $this->session->set_flashdata('success', 'Ooopss! Penjualan Gagal, Namun Stok Data Berubah!');
        redirect('penjualan');
    }
}

function struk($id)
{
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
    );
    $this->template->load('template/template', 'penjualan/struk', $data);
}

function detail_modal($id)
{
    $id = $this->input->get('id');
    $data['detail'] = $this->Model_penjualan->get_detail_modal($id);
    $this->load->view('modal_detail', $data);
}

function proses_transaksi()
{
    $this->manager->display('datapayment');
}

function transaction(){ 

    $id_bahan= $this->input->post('id_bahan');
    $stok_bahan = $this->input->post('stok_bahan');
    // Pengurangan Stok Bahan 
    $result = array();
    foreach ($id_bahan as $key => $val) {
       $result[] = array(
          'id_bahan' => $id_bahan[$key],
          'stok_bahan' => $stok_bahan[$key],          
       );
    }         
    $this->db->update_batch('bahan', $result, 'id_bahan'); 

}
 
function add_to_cart(){ //fungsi Add To Cart
    
    $data = array(
    $kode_produk = $this->input->post('kode_produk'),
    $where = array('kode_produk' => $kode_produk),
    $jumlahbahan = $this->db->get_where('produk_bahan', $where)->result_array(),
        'id' => $this->input->post('id_produk'), 
        'kode_produk' => $kode_produk, 
        'id_produk' => $this->input->post('id_produk'), 
        'name' => $this->input->post('nama_produk'), 
        'price' => $this->input->post('harga_produk'), 
        'qty' => $this->input->post('quantity'),   
    );
    $this->cart->insert($data); 
    echo $this->show_cart(); //tampilkan cart setelah added 
}

function add_to_cartExtras($kode_produk){
   
    $data2 = array(
        $kode_produk = $this->input->post('kode_produk'),
        $where = array('kode_produk' => $kode_produk),
        $jumlahbahan = $this->db->get_where('produk_bahan', $where)->result_array(),
            'id' => $this->input->post('id_produk'), 
            'kode_produk' => $kode_produk, 
            'name' => $this->input->post('nama_produk'), 
            'price' => $this->input->post('harga_produk'), 
            'qty' => $this->input->post('quantity'),   
             );

        $this->cart->insert($data2);
        $this->session->set_flashdata('success', 'Berhasil di Masukan Ke Keranjang'); 
        echo $this->show_cart(); //tampilkan cart setelah added
}

function show_cart(){ //Fungsi untuk menampilkan Cart
    $output = ''; 
    $no = 0;
    foreach ($this->cart->contents() as $items) { 
        $no++;
        
        $output .=' 
            <tr>
            <input type="hidden" id="idbrg"
            name="idproduk" 
            value="'.$items['id'].'">
            <input type="hidden" id="kode_produk"
            name="kode_produk" 
            value="'.$items['kode_produk'].'">
            
            <input type="hidden" name="rowid"
            value="'.$items['rowid'].'">

                <td>'.$items['name'].'</td>
                <td>'.number_format($items['price']).'</td>
                <td>'.$items['qty'].'</td>
                <td>'.number_format($items['subtotal']).'</td>
                <td><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-relief-danger btn-sm">Batal</button></td>
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

function load_cart(){ //load data cart
    echo $this->show_cart();
}

function hapus_cart(){ //fungsi untuk menghapus item cart
    $data = array(
        'rowid' => $this->input->post('row_id'), 
        'qty' => 0, 
    );
    $this->cart->update($data);
    echo $this->show_cart();
}

function payment(){
 
}

function change_customer_type(){
    $harga_online_id = $this->input->post('harga_online_id');
    $data = array(
        'customer_type' => $harga_online_id,
    );
    $this->session->set_userdata($data);
    redirect('app');
}

function open_register() {
    $this->form_validation->set_rules('cash_in_hand', 'Kas_awal', 'trim|required|numeric');
    if ($this->form_validation->run() == true) {
        $data = array('date' => date('Y-m-d H:i:s'),
            'cash_in_hand' => $this->input->post('cash_in_hand'),
            'kode_register' => $this->input->post('kode_register'),
            'user_id' => $this->session->userdata('id'),
            'store_id' => 1,
            'status_shift' => 'open',
            // 'customer_type' => 1,
            'shift_name' => $this->session->userdata('username'),
            );
            $this->session->set_userdata('customer_type', 1);
            $this->session->set_userdata($data);
    } 
    
    if ($this->form_validation->run() == true && $this->register_model->openRegister($data)) {
        $this->session->set_flashdata('success', 'Selamat datang di Point Of Sale');
        redirect("app");
    } else {
          
        $this->data['kode_register'] = $this->register_model->kode_register();  
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->manager->display('register/open_register', $this->data);
    }
} 
 
function close_register($user_id = NULL) {
        $id = $this->session->userdata('register_id');
        $user_id = $this->session->userdata('id');
        $status_shift = 'close'; 
        $date = $this->session->userdata('register_open_time');
        $closed_by = $user_id; 
        $total_cash = $this->input->post('total_cash');
        $pendapatan = $this->input->post('pendapatan');
        $pengeluaran = $this->input->post('pengeluaran');
        $note = $this->input->post('note');
        $this->register_model->close_register($total_cash, $pendapatan,$pengeluaran, $note);
        $this->session->unset_userdata('register_id');
        $this->session->unset_userdata('cash_in_hand');
        $this->session->unset_userdata('register_open_time');
        $this->session->unset_userdata('shift_name');
        $this->session->unset_userdata('costumer_type');
        $this->session->unset_userdata('status_shift');
        $this->session->unset_userdata('store_id');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('kode_register');
        $this->session->set_flashdata('success', 'Sukses Close Register');
        redirect("app/open_register");
     
}
  
        function register_detail(){
             
            // var_dump($_SESSION);die;
            $id_user = $this->session->userdata('id');
            $user_id = $this->session->userdata('user_id');
            $kode_register = $this->session->userdata('kode_register');
            if ($id_user == $user_id) {
                if ($register = $this->register_model->registerData($this->session->userdata('id'))) {
                    $register_data = array('register_id' => $register->user_id, 'cash_in_hand' => $register->cash_in_hand, 'register_open_time' => $register->date);
                    $this->session->set_userdata($register_data);   
                    $register_open_time = $this->session->userdata('register_open_time');
                    $this->data['cashsales'] = $this->register_model->getRegisterCashSales($kode_register);
                    $this->data['totalsales'] = $this->register_model->getRegisterSales($kode_register);
                    $this->data['expenses'] = $this->register_model->getRegisterExpenses($kode_register);
                    $this->manager->display('register/detail_register', $this->data);
                }           
            }elseif ($user_id == NULL){
            
                $this->session->set_flashdata('failed', 'Mohon Register atau Buka Kas Kasir');
                redirect("app/open_register");
                }
            elseif ($user_id != $id_user) {
                $kode_register = $this->session->userdata('kode_register');
                $this->data['cashsales'] = $this->register_model->getRegisterCashSalesBefore($kode_register);
                $this->data['totalsales'] = $this->register_model->getRegisterSalesBefore($kode_register);
                $this->data['expenses'] = $this->register_model->getRegisterExpensesBefore($kode_register);
                $this->session->set_flashdata('failed', 'Mohon Tutup Register Kasir Shift Sebelumnya');
                
                 redirect("shift");
            
         } 
           
        
        }
   
   
   function session(){
       var_dump($_SESSION);
   }




}
