<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('level') != 'Admin') {
            $this->session->set_flashdata('message', '<div class="alert	alert-primary" role="alert"><div class="alert-body">Login terlebih dahulu!</div></div>');
            $url=base_url('auth');
            redirect($url);
        };
        $this->load->model('Menu_model','menu_model');
        $this->load->model('Bahan_model','bahan_model');
        $this->load->helper('url');
        $this->load->helper('form'); 
        $this->load->library('datatables'); //load library ignited-dataTable
    } 
  
    public function index() 
    {	
        $x['data'] = $this->menu_model->get_all_menu();
        $x['kategori'] = $this->menu_model->get_all_kategori();
        $this->manager->display('manager/menu/menu_list',$x); 
    }

  function get_menu_json() { //data data produk by JSON object
    header('Content-Type: application/json');
    echo $this->menu_model->get_all_produk();
  }
  
  function get_bahan(){
    $bahan_id = $this->input->post('id',TRUE);
    $data = $this->bahan_model->get_bahan($bahan_id)->result();
    echo json_encode($data);
  }
  
  function add(){
    $x['bahan']=$this->bahan_model->get_all_bahan(); 
    $x['kategori'] = $this->menu_model->get_all_kategori();
    $x['kodeproduk'] = $this->menu_model->kodeproduk();
    $this->manager->display('manager/menu/menu_create',$x);
  }
   
  function create(){
        if(!empty($_POST['bahan_id'])) {
        //  Bahan Detail  
        // $where = array('no_referensi' => $noref);
        // $x['data']=$this->db->get_where('penyesuaian_stok', $where)->row_array();
         
         $kode_produk = $this->menu_model->kodeproduk(); 
        // var_dump($kode_produk);die;
            // $kode_produk = $this->input->post('kode_produk'); 
            $bahan_id = $_POST['bahan_id'];
            $jumlah = $_POST['jumlah']; 
        
            $data = array();
        $index = 0; // Set index array awal dengan 0
        foreach($_POST['bahan_id'] as $databahan_id){ // Kita buat perulangan berdasarkan nis sampai data terakhir
        array_push($data, array(
        'bahan_id'=> $databahan_id,
        'kode_produk' => $kode_produk,
        'jumlah'=> $jumlah[$index],  // Ambil dan set data nama sesuai index array dari $index
        ));
    
        $index++;
        }
        if(!empty($_POST['bahan_id'])) {
        // var_dump($data);die;
        $config['upload_path'] = './images/produk/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['maintain_ratio'] = FALSE;
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        $this->upload->initialize($config);
        if(!empty($_FILES['filefoto']['name']))
        {
            if ($this->upload->do_upload('filefoto'))
                {
                    $gbr = $this->upload->data();
                    $gambar=$gbr['file_name']; //Mengambil file name dari gambar yang diupload
            
                    $config['image_library']='gd2';
                    $config['source_image']='./images/produk/'.$gambar;
                    $config['create_thumb']= FALSE;
                    $config['maintain_ratio']= FALSE;
                    $config['quality']= '50%';
                    $config['width']= 600;
                    $config['height']= 400;
                    $config['new_image']= './images/produk/'.$gambar;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    
                    $kode_produk = $this->menu_model->kodeproduk(); 
                    $data2 = array(
                        'kode_produk' => $kode_produk, 
                        'nama_produk' => $this->input->post('nama_produk'), 
                        'harga_produk' => $this->input->post('harga_produk'), 
                        'modal_produk' => $this->input->post('modal_produk'), 
                        'kategori_id' => $this->input->post('kategori_id'), 
                        'gambar_produk' => $gambar, 
                        'pajak_produk' => $this->input->post('pajak_produk'), 
                        'detail_produk' => $this->input->post('detail_produk'), 
                    );
                    // var_dump($data2);die;
                    $this->db->insert('produk', $data2);
                    $this->db->insert_batch('produk_bahan', $data);
                 
                    $this->session->set_flashdata('success', 'Success'); 
                    redirect('manager/menu/');
                    
                }else{ 
                    $this->session->set_flashdata('failed', 'Gambar Gagal Upload. Gambar harus bertipe gif|jpg|png|jpeg|bmp'); 
                    redirect('manager/menu/');
                } 
                    
        
        }
    }
           
    }else {

    $config['upload_path'] = './images/produk/'; //path folder
    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

    // $kode_produk = $this->input->post('kode_produk');
    $this->upload->initialize($config);
    if(!empty($_FILES['filefoto']['name']))
    {
        if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                $gambar=$gbr['file_name']; //Mengambil file name dari gambar yang diupload
                 $kode_produk = $this->menu_model->kodeproduk(); 
                $data2 = array(
                    'kode_produk' => $kode_produk, 
                    'nama_produk' => $this->input->post('nama_produk'), 
                    'harga_produk' => $this->input->post('harga_produk'), 
                    'modal_produk' => $this->input->post('modal_produk'), 
                    'kategori_id' => $this->input->post('kategori_id'), 
                    'gambar_produk' => $gambar, 
                    'pajak_produk' => $this->input->post('pajak_produk'), 
                    'detail_produk' => $this->input->post('detail_produk'), 
                );
                
                $this->db->insert('produk', $data2);
                $this->db->insert_batch('produk_bahan', $data2);
                
                $this->session->set_flashdata('success', 'Success'); 
                redirect('manager/menu/');
                
            }else{
                
                $this->session->set_flashdata('failed', 'Gambar Gagal Upload. Gambar harus bertipe gif|jpg|png|jpeg|bmp'); 
                redirect('manager/menu/');
            } 
                    
        }
    }
    }
        
    function edit(){
        if (isset($_POST['submit'])) {
            $config['upload_path']          = './images/produk/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['overwrite'] = TRUE;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                $id =   $this->input->post('id');
                $nama       =   $this->input->post('nama_produk');
                $kategori   =   $this->input->post('kategori_id');
                $harga      =   $this->input->post('harga_produk');
                $modal      =   $this->input->post('modal_produk');
                $pajak      =   $this->input->post('pajak_produk');
                $kode_produk     =   $this->input->post('kode_produk');
                $foto = $this->upload->data('file_name');
                
                $data       = array(
                    'nama_produk' => $nama,
                    'kategori_id' => $kategori,
                    'kode_produk' => $kode_produk,
                    'harga_produk' => $harga,
                    'modal_produk' => $modal,
                    'pajak_produk' => $pajak,
                );   
                $this->menu_model->edit($data, $id);
                $this->session->set_flashdata('success', 'Data Barang berhasil diubah Tanpa Foto!');
                redirect('manager/menu');
                // $this->session->set_flashdata('message', $this->upload->display_errors());
                // redirect($_SERVER['HTTP_REFERER']);
                // return false;
            } else {
                $id =   $this->input->post('id');
                $foto = $this->menu_model->get_one($id)->row_array()['gambar_produk'];
                $path = $this->upload->data('file_path'); 
                $uploads = $path . $foto;
                if (unlink($uploads)) {
                    echo 'deleted successfully';
                } else {
                    echo 'errors occured';
                }
                $nama       =   $this->input->post('nama_produk');
                $kategori   =   $this->input->post('kategori_id');
                $harga      =   $this->input->post('harga_produk');
                $modal      =   $this->input->post('modal_produk');
                $pajak      =   $this->input->post('pajak_produk');
                $kode_produk     =   $this->input->post('kode_produk');
                $foto = $this->upload->data('file_name');
                $config['image_library']='gd2';
                $config['source_image']='./images/produk/'.$foto;
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '50%';
                $config['width']= 600;
                $config['height']= 400;
                $config['new_image']= './images/produk/'.$foto;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $data       = array(
                    'nama_produk' => $nama,
                    'kategori_id' => $kategori,
                    'kode_produk' => $kode_produk,
                    'harga_produk' => $harga,
                    'modal_produk' => $modal,
                    'pajak_produk' => $pajak,
                    'gambar_produk' => $foto,
                );  
                $this->menu_model->edit($data, $id);
                $this->session->set_flashdata('success', 'Data Barang dan foto berhasil dirubah!');
                redirect('manager/menu');
            }
            
        } else {
            $id =  $this->uri->segment(4);
            $this->load->model('Model_kategori'); 
            $data['kategori']   =  $this->Model_kategori->tampilkan_data();
            $data['bahan']=$this->bahan_model->get_all_bahan(); 
            $data['kategori'] = $this->menu_model->get_all_kategori();
            $data['record']     =  $this->menu_model->get_one($id)->row_array();
            $data['bahankode']=$this->menu_model->get_bahanproduk($id)->result(); 
            // var_dump($data['bahankode']);die;
            // $data['ukuran'] = $this->Model_barang->tampilkan_ukuran()->result();
                // $this->session->set_flashdata('success', 'Data Barang berhasil dirubah!');
            $this->manager->display('manager/menu/menu_edit', $data);
        }
    } 


    function add_bahan_edit_menu(){
    $data = array(
            'kode_produk' => $this->input->post('kode_produk'),
            'bahan_id' => $this->input->post('bahan_id_pb'),
            'jumlah' => $this->input->post('jumlah_pb'), 
    );
        //insert all together 
                $this->session->set_flashdata('success', 'Berhasil Menambahkan Bahan Pada Menu!'); 
    $this->db->insert('produk_bahan', $data);
    redirect($_SERVER['HTTP_REFERER']);
    } 

    
    function update_bahan_edit_menu(){
        $ipb = $this->input->post('ipb');
        $data = array(
                'kode_produk' => $this->input->post('kode_produk'),
                'bahan_id' => $this->input->post('bahan_id_pb'),
                'jumlah' => $this->input->post('jumlah_pb'), 
        );
            //insert all together  
		$this->db->where('id_produk_bahan',$ipb);
		$this->db->update('produk_bahan', $data);
        redirect($_SERVER['HTTP_REFERER']);
    } 


    public function delete_bahan_edit_menu()
	{
		//delete file
		$id = $this->input->post('kode',TRUE);
   
        //insert all together  
		$this->db->where('id_produk_bahan',$id);
		$this->db->delete('produk_bahan');
        $this->session->set_flashdata('success', 'Berhasil Menghapus Bahan Pada Menu!'); 
        redirect($_SERVER['HTTP_REFERER']);
	} 
 

    public function delete_produk()
	{
		//delete file
		$id = $this->input->post('id_produk');
		$kd = $this->input->post('kode_produk');
		$row = $this->db->get_where('produk', array('id_produk' => $id))->row();
		if(file_exists('images/produk/'.$row->gambar_produk) && $row->gambar_produk)
			unlink('images/produk/'.$row->gambar_produk);
        $this->db->where('id_produk',$id);
        $this->db->delete('produk'); 
        $this->menu_model->delete_produk_bahan_menu($kd);
        $this->menu_model->delete_produk_extras_menu($id);
		$this->session->set_flashdata('success-create', 'Terhapus'); 
        redirect($_SERVER['HTTP_REFERER']);
	} 

    } 