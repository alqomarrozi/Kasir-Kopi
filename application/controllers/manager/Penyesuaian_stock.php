<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyesuaian_stock extends CI_Controller {
 
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
        
        $this->manager->display('manager/penyesuaian_stok/penyesuaian_stok',$x); 
    }

    public function create_penyesuaian_stock(){
 
		$x['bahan']=$this->bahan_model->get_all_bahan(); 
		$x['users']=$this->bahan_model->get_users_list(); 
        $this->manager->display('manager/penyesuaian_stok/penyesuaian_stok_add',$x); 
    }
     
    function list($noref){
		$x['bahan']=$this->bahan_model->get_all_bahan(); 
		$x['data']=$this->penyesuaian_bahan_model->get_penyesuaian_by_no_ref($noref);
		$where = array('no_referensi' => $noref);
		$x['get_id']=$this->db->get_where('penyesuaian_stok', $where)->row_array();
        $this->manager->display('manager/penyesuaian_stok/penyesuaian_stok_list',$x); 
    } 

    function add(){
        
		$x['bahan']=$this->bahan_model->get_all_bahan(); 
		
        $x['noref']=$this->penyesuaian_bahan_model->get_no_ref();
		$x['users']=$this->bahan_model->get_users_list(); 
        $where = array('id_penyesuaian');
		$x['data']=$this->db->get_where('penyesuaian_stok', $where)->row_array();
        
			$x['kode'] = $this->penyesuaian_bahan_model->kode();
        // $data = $x['data'];
		// if(count ($data) > 0){
        // $id = $data['karyawan_id'];   
        // $x['karyawan'] = $this->bahan_model->get_karyawan_id($id)->row_array();
        // }
        // if(count ($data) > 0){
        // $user_id = $data['user_id']; 
        
		// $where = array('id' => $user_id);
        // $x['added_by'] = $this->db->get_where('users', $where)->row_array();
        // }
        $this->manager->display('manager/penyesuaian_stok/penyesuaian_stok_add',$x); 
    }
 
    function edit($noref){
		$x['bahan']=$this->bahan_model->get_all_bahan(); 
        $x['noref']=$this->penyesuaian_bahan_model->get_no_ref();
		$x['users']=$this->bahan_model->get_users_list();
        $x['data'] = $this->penyesuaian_bahan_model->get_detail_penyesuaian($noref);
		$x['databynoref']=$this->penyesuaian_bahan_model->get_penyesuaian_by_no_ref($noref);
		$x['kode'] = $this->penyesuaian_bahan_model->kode();
        $data = $x['data'];
		// if($data->num_rows() > 0){
        // $id = $data['karyawan_id'];   
        // $x['karyawan'] = $this->bahan_model->get_karyawan_id($id)->row_array();
        // }
        // if(count ($data) > 0){
        // $user_id = $data['user_id']; 
        
		// $where = array('id' => $user_id);
        // $x['added_by'] = $this->db->get_where('users', $where)->row_array();
        // }
        $this->manager->display('manager/penyesuaian_stok/penyesuaian_stok_edit', $x); 
    }

    function add_on_edit(){

        $data=array(
            'no_ref' => $this->input->post('no_ref'),
            'bahan_id'     => $this->input->post('bahan_id'),
            'qty_penyesuaian'    => $this->input->post('qty_penyesuaian'),
            'status_penyesuaian' => $this->input->post('status_penyesuaian')
          );
          $this->db->insert('penyesuaian_stok_bahan', $data);
          redirect($_SERVER['HTTP_REFERER']);
    }

    function edit_on_edit(){
        $kode=$this->input->post('id_penyesuaian_stok_bahan');
        $data=array(
          'bahan_id'     => $this->input->post('bahan_id'),
          'qty_penyesuaian'    => $this->input->post('qty_penyesuaian'),
          'status_penyesuaian' => $this->input->post('status_penyesuaian')
        );
        $this->db->where('id_penyesuaian_stok_bahan',$kode);
        $this->db->update('penyesuaian_stok_bahan', $data);
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    function delete_on_edit(){

    $kode=$this->input->post('id_penyesuaian_stok_bahan');
    $this->db->where('id_penyesuaian_stok_bahan',$kode);
    $this->db->delete('penyesuaian_stok_bahan');
    redirect($_SERVER['HTTP_REFERER']);
    }
     
    function get_bahan(){
        $bahan_id = $this->input->post('id',TRUE);
        $data = $this->bahan_model->get_bahan($bahan_id)->result();
        echo json_encode($data);
    }
    
    public function add_action(){
            if(!empty($_POST['bahan_id'])) {
            //  Bahan Detail 
            $noref = $this->input->post('get_noref');
            // $where = array('no_referensi' => $noref);
            // $x['data']=$this->db->get_where('penyesuaian_stok', $where)->row_array();
                $bahan_id = $_POST['bahan_id'];
                $qty_penyesuaian = $_POST['qty_penyesuaian']; 
                $no_ref = $this->input->post('no_referensi');
                $status_penyesuaian = $_POST['status_penyesuaian'];
            
                $data = array();
            $index = 0; // Set index array awal dengan 0
            foreach($bahan_id as $databahan_id){ // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($data, array(
            'bahan_id'=>$databahan_id,
            'qty_penyesuaian'=>$qty_penyesuaian[$index],  // Ambil dan set data nama sesuai index array dari $index
            'no_ref'=>$no_ref,  // Ambil dan set data telepon sesuai index array dari $index
            'status_penyesuaian'=>$status_penyesuaian[$index],  // Ambil dan set data alamat sesuai index array dari $index
            ));
        
        $index++;
        }
        //   No ref dan keterangan 
        $data2 = array(
            'id_penyesuaian' => $this->input->post('id_penyesuaian'), 
            'no_referensi' => $this->input->post('no_referensi'), 
            'tanggal_penyesuaian' => $this->input->post('tanggal_penyesuaian'), 
            'catatan_penyesuaian' => $this->input->post('catatan_penyesuaian'), 
            'karyawan_id' => $this->input->post('karyawan_id'), 
            'user_id' => $this->session->userdata('id'), 
        );
          
        $this->db->insert('penyesuaian_stok', $data2);
        $this->db->insert_batch('penyesuaian_stok_bahan', $data);
        $this->penyesuaian_bahan_model->update_stock_in($data2);

        $this->session->set_flashdata('success', 'Success'); 
        redirect('manager/penyesuaian_stock/');
    }else {
        $data2 = array(
            'id_penyesuaian' => $this->input->post('id_penyesuaian'), 
            'no_referensi' => $this->input->post('no_referensi'), 
            'tanggal_penyesuaian' => $this->input->post('tanggal_penyesuaian'), 
            'catatan_penyesuaian' => $this->input->post('catatan_penyesuaian'), 
            'karyawan_id' => $this->input->post('karyawan_id'), 
            'user_id' => $this->session->userdata('id'), 
        );
          
        
        $this->db->insert('penyesuaian_stok', $data2);
        $this->session->set_flashdata('success', 'Success'); 
        redirect('manager/penyesuaian_stock/');
    }
    }

    public function edit_action(){

        $data2 = array(
            // 'id_penyesuaian' => $this->input->post('id_penyesuaian'), 
            // 'no_referensi' => $this->input->post('no_referensi'), 
            'tanggal_penyesuaian' => $this->input->post('tanggal_penyesuaian'), 
            'catatan_penyesuaian' => $this->input->post('catatan_penyesuaian'), 
            'karyawan_id' => $this->input->post('karyawan_id'), 
        );
          
        
        $kode=$this->input->post('id_penyesuaian');
        $this->db->where('id_penyesuaian',$kode);
        $this->db->update('penyesuaian_stok', $data2);
        $this->session->set_flashdata('success', 'Success'); 
        redirect('manager/penyesuaian_stock/');
    }

    public function store_penyesuaian_stock(){
        
        $noref = $this->input->post('get_noref');
        $data = array(
            'id_penyesuaian' => $this->input->post('id_penyesuaian'), 
            'no_referensi' => $this->input->post('no_referensi'), 
            'tanggal_penyesuaian' => $this->input->post('tanggal_penyesuaian'), 
            'catatan_penyesuaian' => $this->input->post('catatan_penyesuaian'), 
            'karyawan_id' => $this->input->post('karyawan_id'), 
            'user_id' => $this->session->userdata('id'), 
        );
        
        
        $this->db->insert('penyesuaian_stok', $data);
        // $this->bahan_model->insert_penyesuaian($id);
        $this->session->set_flashdata('success', 'Success'); 
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function store_stock(){ 
    }

    public function minus_stock(){
        
    }


    // List Stock 

    public function stock(){
        
		$x['bahan']=$this->bahan_model->get_all_bahan(); 
        $this->manager->display('manager/bahan/stok_bahan',$x); 
    }
    
}