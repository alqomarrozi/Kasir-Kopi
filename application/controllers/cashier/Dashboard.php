<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert
			alert-primary" role="alert"><div class="alert-body">Login terlebih dahulu!</div></div>');
            $url=base_url('auth');
            redirect($url);
        }; 
        $this->load->model('Register_model', 'register_model');
        $this->load->model('Model_dashboard');
        $this->load->model('Bahan_model','bahan_model');
        $this->load->library('form_validation');

    } 

    public function index() 
    {
        
        $data['graph'] = $this->Model_dashboard->graph_stok();
        $data['bahan'] = $this->Model_dashboard->graph_bahan();
        $data['laris'] = $this->Model_dashboard->barang_laris();
        $data['box'] = $this->box();
        $data['bahan_habis'] = $this->bahan_model->get_bahan_habis();
        $this->manager->display('manager/dashboard',$data);
    }

    public function box()
    {
        $box = [
            [ 
                'box'         => 'light-blue',
                'total'     => $this->Model_dashboard->total('produk'),
                'title'        => 'Total Produk',
                'link'    => 'Barang',
                'svg'       => '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box avatar-icon">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>'
            ],
            [
                'box'         => 'yellow-active',
                'total'     =>  $this->Model_dashboard->total_penjualan()->total,
                'title'        => 'Total Penjualan',
                'link'    => 'laporan',
                'svg'       => '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up avatar-icon"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>'
            ],
            [
                'box'         => 'red',
                'total'     => $this->Model_dashboard->total_stok()->total.' Gram',
                'title'        => 'Total Stok Bahan',
                'link'    => 'stok',
                'icon'        => 'retweet',
                'svg'       => '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box avatar-icon">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>'
            ],
        ];
        $info_box = json_decode(json_encode($box), FALSE);
        return $info_box;
    }
    
}