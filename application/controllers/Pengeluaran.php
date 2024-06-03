<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {
 
    public function __construct()
    { 
        parent::__construct();
		if($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert
			alert-primary" role="alert"><div class="alert-body">Login terlebih dahulu!</div></div>');
            $url=base_url('auth');
            redirect($url);
        };
        $this->load->model('Pengeluaran_model','pengeluaran_model');
        $this->load->model('Bahan_model','bahan_model');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->library('datatables'); //load library ignited-dataTable
    }   
    
    public function index()   
    {	  
       
        $x['pengeluaran']=$this->pengeluaran_model->get_pengeluaran(); 
        if ($this->session->userdata['level'] == 'Admin') {
        $this->manager->display('pengeluaran/list_pengeluaran',$x); 
        } elseif ($this->session->userdata['level'] == 'Kasir') {
          $this->manager->display('cashier/pengeluaran/list_pengeluaran',$x); 
        }else{
          redirect('auth');
        }
    }
   
    function get_pengeluaran_json() { //data data produk by JSON object
        header('Content-Type: application/json');
        echo $this->pengeluaran_model->get_all_pengeluaran();
    }
    
    function get_pengeluaran_kasir_json() { //data data produk by JSON object
      header('Content-Type: application/json');
      echo $this->pengeluaran_model->get_all_kasir();
  }
  
     
      function simpan(){ //function simpan data
        $data=array(
            'tanggal'     => date('Y-m-d H:i:s'),
            'date'     => date('Y-m-d'),
          'catatan'     => $this->input->post('catatan'),
          'total'    => $this->input->post('total'),
          'created_by' => $this->session->userdata('id'),
          'created_by_name' => $this->session->userdata('username'),
          'kode_register' => $this->session->userdata('kode_register'),
        ); 
        $this->session->set_flashdata('success', 'Berhasil dibuat'); 
        $this->db->insert('pengeluaran', $data);
        redirect('pengeluaran');
      }
     
      function update(){ //function update data
        $kode=$this->input->post('id_pengeluaran');
        $data=array(
          'catatan'     => $this->input->post('catatan'),
          'total'    => $this->input->post('total'),
        //   'created_by' => $this->input->post('kategori')
        );
        $this->db->where('id_pengeluaran',$kode); 
        $this->db->update('pengeluaran', $data);
        $this->session->set_flashdata('success', 'Berhasil diedit'); 
        redirect('pengeluaran');
      }
     
      function delete(){ //function hapus data
        $kode=$this->input->post('id_pengeluaran');
        $this->db->where('id_pengeluaran',$kode);
        $this->db->delete('pengeluaran');
        $this->session->set_flashdata('success', 'Berhasil dihapus'); 
        redirect('pengeluaran');
      }
}