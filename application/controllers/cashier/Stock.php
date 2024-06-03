<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert
			alert-primary" role="alert"><div class="alert-body">Login terlebih dahulu!</div></div>');
            $url=base_url('auth');
            redirect($url);
        };
        $this->load->model('Users_model','users_model');
    }
 
    public function index()
    {
        $this->load->helper('url');
        $this->load->helper('form');
         
        $levels = $this->users_model->get_list_levels();
 
        $opt = array('' => 'All Level');
        foreach ($levels as $level) {
            $opt[$level] = $level;
        }
 
        $data['form_level'] = form_dropdown('',$opt,'','id="level" class="form-control"');
        $this->manager->display('manager/users/list', $data);
    }

    public function get_data()
    {
        $list = $this->users_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $users) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $users->nama;
            $row[] = $users->username;
            $row[] = $users->level;
            $row[] = $users->status;
            $row[] = $users->created_at;
            $row[] = $users->updated_at; 
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_users('."'".$users->id."'".')"><i class="fa fa-pencil"></i></a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_users('."'".$users->id."'".')"><i class="fa fa-trash"></i></a>';
  
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->users_model->count_all(),
                        "recordsFiltered" => $this->users_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    public function delete(){
 
    }
}