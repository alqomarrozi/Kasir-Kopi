<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Harga_online extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('level') != 'Admin') {
            $this->session->set_flashdata('message', '<div class="alert
			alert-primary" role="alert"><div class="alert-body">Login terlebih dahulu!</div></div>');
            $url = base_url('auth');
            redirect($url);
        };
        $this->load->model('Harga_online_model', 'harga_online_model');
        $this->load->model('Extras_model', 'extras_model');
        $this->load->model('Bahan_model', 'bahan_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('datatables'); //load library ignited-dataTable
    }

    public function index()
    {
        // $x['kode_extras'] = $this->extras_model->kode_extras();
        $x['data'] = $this->harga_online_model->get_all_harga_online();
        $this->manager->display('manager/harga_online/list_harga_online', $x);
    }


    public function edit()
    {
        $harga_online_id = $this->input->post('harga_online_id', TRUE);
        $harga_online_nama = ($this->input->post('harga_online_nama'));
        $harga_online = ($this->input->post('harga_online'));
        $data = array(
            'harga_online_nama' => $harga_online_nama,
            'harga_online' => $harga_online,
        );
        $this->db->where('harga_online_id', $harga_online_id);
        $this->db->update('type_harga_online', $data);
        $this->session->set_flashdata('success', 'Berhasil di Edit');
        // redirect($_SERVER['HTTP_REFERER']);
        redirect('manager/harga_online');
    }

    public function delete_extras()
    {
        $id = $this->input->post('kode', TRUE);
        $extraskode = $this->input->post('kode_extras', TRUE);
        $this->extras_model->delete_extras($id, $extraskode);
        $this->session->set_flashdata('success', 'Berhasil Menghapus Extras');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
