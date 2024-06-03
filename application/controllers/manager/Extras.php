<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Extras extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('level') != 'Admin') {
            $this->session->set_flashdata('message', '<div class="alert
			alert-primary" role="alert"><div class="alert-body">Login terlebih dahulu!</div></div>');
            $url=base_url('auth');
            redirect($url);
        };
        $this->load->model('Extras_model','extras_model');
        $this->load->model('Bahan_model','bahan_model');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->library('datatables'); //load library ignited-dataTable
    }   
   
    public function index()   
    {	  
		$x['kode_extras'] = $this->extras_model->kode_extras();
        $x['data'] = $this->extras_model->get_all_extras();
        $this->manager->display('manager/extras/list_extras',$x); 
    }
  
    function get_json() { //data data produk by JSON object
        header('Content-Type: application/json');
        echo $this->extras_model->get_json();
      }
    
    
    public function add(){
        $x['bahan']=$this->bahan_model->get_all_bahan(); 
        $x['menu']=$this->extras_model->get_menu(); 
        $x['kode_extras'] = $this->extras_model->kode_extras();  
        
        $this->manager->display('manager/extras/create_extras',$x);
        }
     

    public function update($id){
        $id =  $this->uri->segment(4);
        $x['bahan']=$this->bahan_model->get_all_bahan(); 
        $x['menu']=$this->extras_model->get_menu(); 
        $x['kode_extras'] = $this->extras_model->kode_extras();  
        $x['record'] = $this->extras_model->get_one($id)->row_array();   
        
        $getKodeProduk = $this->extras_model->get_one($id)->row_array(); 
        $extraskode = $getKodeProduk['kode_extras'];
        $x['bahankode']=$this->extras_model->get_bahanbyid($extraskode)->result(); 
        
        $this->manager->display('manager/extras/edit_extras',$x);
    }
          

    public function create(){  
        $idx = $this->input->post('produk_id',TRUE);
        $product = $this->input->post('product_id');
        $getKodeProduk = $this->extras_model->get_produk($product)->row_array(); 
       
		$kode_produk = $getKodeProduk['kode_produk'];;
        // var_dump($kode_produk);die;
        $kode_extras = ($this->input->post('kode_extras'));
        $nama_extras = $this->input->post('nama_extras');
        $harga_extras = $this->input->post('harga_extras');
		// $product = $this->input->post('product_id');
		$bahan_id = $this->input->post('bahan_id',TRUE);
		$this->extras_model->create_extras($kode_extras, $kode_produk,$nama_extras,$harga_extras,$bahan_id,$product);  
        $this->session->set_flashdata('success', 'Extras Berhasil Dibuat!'); 
		redirect('manager/extras'); 
    }  


    public function edit(){ 
        $id = $this->input->post('kode',TRUE);
        $kode_extras = ($this->input->post('kode_extras'));
        $nama_extras = ($this->input->post('nama_extras'));
        $harga_extras = ($this->input->post('harga_extras')); 
        $id_produk = ($this->input->post('id_produk')); 
        $getKodeProduk = $this->extras_model->getKodeProduk($id_produk)->row_array();
        $kode_produk = $getKodeProduk['kode_produk'];
        // var_dump($kode_produk);die;
		$this->extras_model->edit_extras($id,$kode_extras,$nama_extras,$harga_extras, $id_produk, $kode_produk);
		$this->session->set_flashdata('success','Berhasil di Edit');
        // redirect($_SERVER['HTTP_REFERER']);
        redirect('manager/extras'); 
    } 
 
    public function delete_extras(){
		$id = $this->input->post('kode',TRUE); 
		$extraskode = $this->input->post('kode_extras',TRUE); 
		$this->extras_model->delete_extras($id, $extraskode);
		$this->session->set_flashdata('success','Berhasil Menghapus Extras');
        redirect($_SERVER['HTTP_REFERER']);
    }

}
