<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('level') != 'Admin') {
            $this->session->set_flashdata('message', '<div class="alert
			alert-primary" role="alert"><div class="alert-body">Login terlebih dahulu!</div></div>');
            $url=base_url('auth');
            redirect($url);
        };
        $this->load->model('Menu_model','menu_model');
        $this->load->model('Kategori_model','kategori_model');
        $this->load->helper('url');
        $this->load->helper('form'); 
    } 
  
    public function index() 
    {	
         
        // $x['data'] = $this->menu_model->get_all_menu();
        $x['data'] = $this->menu_model->get_all_kategori();
        $this->manager->display('manager/menu/menu_kategori',$x);  
    }

    public function add_kategori(){
        $data=array(
            'nama_kategori' => $this->input->post('nama_kategori'),
          );
          $this->db->insert('produk_kategori', $data);
          $this->session->set_flashdata('success', 'Berhasil Membuat Kategori!'); 
          redirect($_SERVER['HTTP_REFERER']); 
    } 
 
    public function edit_kategori(){

        $id = $this->input->post('kode',TRUE);
        $nama_kategori=strip_tags($this->input->post('nama_kategori'));
		$this->kategori_model->edit_kategori($id,$nama_kategori);
        $this->session->set_flashdata('success', 'Kategori Berhasil di Edit!'); 
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_kategori(){ 
		$id = $this->input->post('kode',TRUE);
		$this->kategori_model->delete_kategori($id);
		$this->session->set_flashdata('success','Kategori dihapus');
        redirect($_SERVER['HTTP_REFERER']);
    }
    // List Stock 
    
}