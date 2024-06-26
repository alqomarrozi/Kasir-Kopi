<?php

class Lapharian extends CI_Controller
{

    public function __construct()
    { 
        parent::__construct();
        if($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert
			alert-primary" role="alert"><div class="alert-body">Login terlebih dahulu!</div></div>');
            $url=base_url('auth');
            redirect($url);
        };
        $this->load->model('Model_lapharian');
    }


    function index($year = NULL, $month = NULL)
    {
        $data['calender'] = $this->Model_lapharian->getcalender($year, $month);

        $data['cards'] = $this->cards();
        $this->manager->display('manager/laporan/lap_harian', $data);
    }

    public function cards()
    {
        $data['laris'] = $this->Model_lapharian->barang_laris();
        if ($data['laris'] == FALSE) {
            $laris = 'kosong';
        } else {
            $laris = $this->Model_lapharian->barang_laris()->nama_produk;
        }
        $card = [ 
            [
                'box'         => 'green',
                'total'     => 'Rp.' . number_format($this->Model_lapharian->income()->gtotal),
                'title'        => 'Pendapatan',
                'description'    => 'Total Pendapatan',
                'icon'        => 'dollar'
            ],
            [
                'box'         => 'blue',
                'total'     => $this->Model_lapharian->total_penjualan()->total,
                'title'        => 'Barang Terjual',
                'description'    => 'Total Barang Terjual',
                'icon'        => 'shopping-cart'
            ],
            [
                'box'         => 'yellow-active',
                'total'     =>  $this->Model_lapharian->total_transaksi()->total,
                'title'        => 'Total Penjualan',
                'description'    => 'Total Penjualan',
                'icon'        => 'shopping-basket'
            ],
            [
                'box'         => 'red',
                'total'     => $laris,
                'title'        => 'Barang Terlaris',
                'description'    => 'Barang Terlaris',
                'icon'        => 'cube'
            ],
        ];
        $info_card = json_decode(json_encode($card), FALSE);
        return $info_card;
    }
}
