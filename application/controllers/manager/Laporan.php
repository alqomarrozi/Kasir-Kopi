<?php


class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('level') != 'Admin') {
            $this->session->set_flashdata('message', '<div class="alert
			alert-primary" role="alert"><div class="alert-body">Login terlebih dahulu!</div></div>');
            $url=base_url('auth');
            redirect($url);
        };
        $this->load->model('Model_laporan');
    }  

    function index($start = null , $end = null)
    {
        if (isset($_POST['search'])) {
            $start = $this->input->post('start_date');
            $end = $this->input->post('end_date');
            $metode = $this->input->post('metode');
            $data['laporan'] = $this->Model_laporan->get_range($start,$end,$metode);
            $data['metode'] = $this->Model_laporan->get_metode();
            $this->manager->display('manager/laporan/penjualan',$data);
        } else {
            $data['laporan'] = $this->Model_laporan->get_data();
            $data['metode'] = $this->Model_laporan->get_metode();
            $this->manager->display('manager/laporan/penjualan',$data);
        }
    }

    function hapus($id)
    {
        $this->Model_laporan->hapus_trf($id);
        $this->Model_laporan->hapus_id($id);
    }
 
}
