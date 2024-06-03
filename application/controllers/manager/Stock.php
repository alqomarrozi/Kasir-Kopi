<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('level') != 'Admin') {
            $this->session->set_flashdata('message', '<div class="alert
			alert-primary" role="alert"><div class="alert-body">Login terlebih dahulu!</div></div>');
            $url=base_url('auth');
            redirect($url);
        };
        $this->load->model('Bahan_model','bahan_model');
        $this->load->model('Stock_m','stock_m');
        $this->load->model('Penyesuaian_bahan_model','penyesuaian_bahan_model');
        $this->load->helper('url');
        $this->load->helper('form'); 
    } 

    
   
    public function index() 
    {	
        $x['noref']=$this->penyesuaian_bahan_model->get_no_ref();
        $x['bahan']=$this->bahan_model->get_all_bahan();  
		$x['users']=$this->bahan_model->get_users_list(); 
        $x['data']=$this->penyesuaian_bahan_model->get_all_penyesuaian();
        $data = $x['data'];
		if($data->num_rows() > 0){
		    $q=$data->row_array();
        $id = $q['karyawan_id']; 
        $x['karyawan'] = $this->bahan_model->get_karyawan_id($id)->row_array();
        }
        
        $this->manager->display('manager/stock/stock_all',$x); 
    }

    public function in(){

        $data['stock'] = $this->stock_m->get_stock_in()->result();
        $this->manager->display('manager/stock/stock_in',$data);
    }
 
    public function out(){

        $data['stock'] = $this->stock_m->get_stock_out()->result();
        $this->manager->display('manager/stock/stock_out',$data);
    }

    public function form_in(){
          
        $data['item'] = $this->bahan_model->get()->result();
        $this->manager->display('manager/stock/stock_form_in',$data);
    }
 

    public function form_out(){
          
        $data['item'] = $this->bahan_model->get()->result();
        $this->manager->display('manager/stock/stock_form_out',$data);
    }
 
    
    public function process()
    {
        if (isset($_POST['in_add'])) {
            $post = $this->input->post(null, true);
            $this->stock_m->add_stock_in($post);
            $this->bahan_model->update_stock_in($post);
    
            if ($this->db->affected_rows() > 0) {
                // $options = array(
                //     'cluster' => 'ap1',
                //     'useTLS' => true
                // );
                
                // $pusher = new Pusher\Pusher(
                //     'd4392a044ecee1cce52a',
                //     '2ee60baddf74f9ad2925',
                //     '1041444',
                //     $options
                // );

                $data['message'] = 'Stock Berhasil ditambahkan';
                // $pusher->trigger('my-channel', 'my-event', $data);
                $this->session->set_flashdata('success', 'Data Stock-In berhasil ditambah');
                redirect('manager/stock/in');
            }
        } else { 
            $post = $this->input->post(null, true);
            $this->stock_m->add_stock_out($post);
            $this->bahan_model->update_stock_out($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Stock-Out berhasil ditambah');
                redirect('manager/stock/out');
            }
        }
    }

}
