<?php

class Lapbulanan extends CI_Controller
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
        $this->load->model('Model_lapbulanan');
    }

    function index() 
    {
        $data['tahun'] = $this->uri->segment(4);
        $thn = $this->uri->segment(4);
        $data['bulanan'] = $this->Model_lapbulanan->bulanan($thn);
        $data['cards'] = $this->cards();
        $this->manager->display('manager/laporan/lap_bulanan', $data);
    }

    public function cards()
    {
        $data['laris'] = $this->Model_lapbulanan->produk_laris();
        if ($data['laris'] == FALSE) {
            $laris = 'kosong';
        } else {
            $laris = $data['laris']->nama_produk;
        }
        $card = [
            [ 
                'box'         => 'green',
                'total'     => 'Rp.' . number_format($this->Model_lapbulanan->income()->gtotal),
                'title'        => 'Pendapatan',
                'description'    => 'Total Pendapatan',
                'icon'        => 'dollar'
            ],
            [
                'box'         => 'blue',
                'total'     => $this->Model_lapbulanan->total_penjualan()->total,
                'title'        => 'Barang Terjual',
                'description'    => 'Total Barang Terjual',
                'icon'        => 'shopping-cart'
            ],
            [
                'box'         => 'yellow-active',
                'total'     =>  $this->Model_lapbulanan->total_transaksi()->total,
                'title'        => 'Total Penjualan',
                'description'    => 'Total Penjualan',
                'icon'        => 'shopping-basket'
            ],
            [
                'box'         => 'red',
                'total'     => $laris,
                'title'        => 'Produk Terlaris',
                'description'    => 'Produk Terlaris',
                'icon'        => 'cube'
            ],

        ];
        $info_card = json_decode(json_encode($card), FALSE);
        return $info_card;
    }
}
