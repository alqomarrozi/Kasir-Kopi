<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bahan_kategori extends CI_Controller {
 
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
        $x['data'] = $this->bahan_model->get_all_kategori();
        $this->manager->display('manager/bahan/kategori_bahan',$x); 
    }

    public function buat_kategori(){
        $nama_kategori=strip_tags($this->input->post('nama_kategori'));
        $divider = '-';
        $cleanslug = $nama_kategori;
        $cleanslug = preg_replace('~[^\pL\d]+~u', $divider, $cleanslug);
        // transliterate
        $cleanslug = iconv('utf-8', 'us-ascii//TRANSLIT', $cleanslug);
        // remove unwanted characters
        $cleanslug = preg_replace('~[^-\w]+~', '', $cleanslug);
        // trim
        $cleanslug = trim($cleanslug, $divider);
        // remove duplicate divider
        $cleanslug = preg_replace('~-+~', $divider, $cleanslug);
        // lowercase
        $cleanslug = strtolower($cleanslug);
        $slug=strtolower(str_replace(" ", "-", $cleanslug));
        $data=array(
          'nama_kategori'     => $this->input->post('nama_kategori'),
          'deskripsi' => $this->input->post('deskripsi'),
          'bahan_slug'    => $slug,
          'added_by' => $this->session->userdata('id'),
        );
        $this->db->insert('bahan_kategori', $data);
        $this->session->set_flashdata('success', 'Success Membuat Kategori!'); 
        redirect('manager/bahan_kategori'); 
    } 

    public function edit_kategori(){
        $id		  = $this->input->post('kode',TRUE);
        $nama_kategori=strip_tags($this->input->post('nama_kategori'));
        $divider = '-';
        $cleanslug = $nama_kategori;
        $cleanslug = preg_replace('~[^\pL\d]+~u', $divider, $cleanslug);
        // transliterate
        $cleanslug = iconv('utf-8', 'us-ascii//TRANSLIT', $cleanslug);
        // remove unwanted characters
        $cleanslug = preg_replace('~[^-\w]+~', '', $cleanslug);
        // trim
        $cleanslug = trim($cleanslug, $divider);
        // remove duplicate divider
        $cleanslug = preg_replace('~-+~', $divider, $cleanslug);
        // lowercase
        $cleanslug = strtolower($cleanslug);
        $bahan_slug=strtolower(str_replace(" ", "-", $cleanslug));
        $deskripsi = ($this->input->post('deskripsi'));
		$this->bahan_model->edit_bahan_kategori($id,$nama_kategori,$deskripsi,$bahan_slug);
        $this->session->set_flashdata('success', 'Kategori Berhasil di Edit!'); 
        redirect('manager/bahan_kategori'); 
    } 

    function get_bahan(){
		$bahan_id=$this->input->post('bahan_id'); 
    	$data=$this->bahan_model->get_bahan($bahan_id)->result();
    	foreach ($data as $result) { 
    		$value[] = (float) $result->bahan_id;
    	}
    	echo json_encode($value); 
	}

	function delete_kategori(){ 
		$id = $this->input->post('kode',TRUE);
		$this->bahan_model->delete_kategori($id);
		$this->bahan_model->hapusBahanSaatKategoriDihapus($id);
        $this->session->set_flashdata('success', 'Kategori Berhasil Dihapus!'); 
		redirect('manager/bahan_kategori');
	}
    // FUNCTION BAHAN LIST
    public function list($slug) 
    {	 
        
		$x['kode_bahan'] = $this->bahan_model->kode_bahan();
		$where = array('bahan_slug' => $slug);
		$x['cat'] = $this->db->get_where('bahan_kategori', $where)->row_array();
		$x['data']=$this->bahan_model->get_bahan_by_slug($slug);
        $this->manager->display('manager/bahan/list_bahan',$x); 
    } 
    
    public function buat_bahan(){
        
        $data=array(
          'kode_bahan'     => $this->input->post('kode_bahan'),
          'nama_bahan' => $this->input->post('nama_bahan'),
          'bahan_kat_id' => $this->input->post('bahan_kat_id'),
          'minimum_stock' => $this->input->post('minimum_stock'),
          'harga_bahan' => $this->input->post('harga_bahan'),
        );
        $this->db->insert('bahan', $data);
        $this->session->set_flashdata('success', 'Berhasil Membuat Bahan'); 
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_bahan(){ 
        $id		  = $this->input->post('kode',TRUE);
        $nama_kategori=strip_tags($this->input->post('nama_kategori'));
        $divider = '-';
        $cleanslug = $nama_kategori;
        $cleanslug = preg_replace('~[^\pL\d]+~u', $divider, $cleanslug);
        // transliterate
        $cleanslug = iconv('utf-8', 'us-ascii//TRANSLIT', $cleanslug);
        // remove unwanted characters
        $cleanslug = preg_replace('~[^-\w]+~', '', $cleanslug);
        // trim
        $cleanslug = trim($cleanslug, $divider);
        // remove duplicate divider
        $cleanslug = preg_replace('~-+~', $divider, $cleanslug);
        // lowercase
        $cleanslug = strtolower($cleanslug);
        $bahan_slug=strtolower(str_replace(" ", "-", $cleanslug));
        $kode_bahan = ($this->input->post('kode_bahan'));
        $nama_bahan = ($this->input->post('nama_bahan'));
        $bahan_kat_id = ($this->input->post('bahan_kat_id'));
        $minimum_stock = ($this->input->post('minimum_stock')); 
        $harga_bahan = ($this->input->post('harga_bahan')); 
		$this->bahan_model->edit_bahan($id,$kode_bahan,$nama_bahan,$bahan_kat_id,$minimum_stock,$harga_bahan);
        $this->session->set_flashdata('success', 'Bahan Berhasil di Edit!'); 
        redirect($_SERVER['HTTP_REFERER']);
    }
 
    public function delete_bahan(){
		$id = $this->input->post('kode',TRUE);
		$this->bahan_model->delete_bahan($id);
        $this->session->set_flashdata('success', 'Bahan Berhasil Dihapus!'); 
        redirect($_SERVER['HTTP_REFERER']);
    }
    // List Stock 

    public function stock(){
         
		$x['data']=$this->bahan_model->get_all_bahan(); 
        $this->manager->display('manager/bahan/all_bahan',$x); 
    }
    
}