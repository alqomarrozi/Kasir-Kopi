<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('level') != 'Admin') {
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
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)"  onclick="edit_user('."'".$users->id."'".')" title="Edit"><i class="fa fa-pencil"></i></a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$users->id."'".')"><i class="fa fa-trash"></i></a>';
  
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
    public function ajax_delete($id)
	{
		//delete file
		// $user = $this->users_model->get_by_id($id);
		$this->users_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

    
	public function ajax_edit($id)
	{
		$data = $this->users_model->get_by_id($id);
		echo json_encode($data);
	}

    public function ajax_update()
	{
		$this->_validate();
        if($this->input->post('password') != NULL){

            $data = array(
                'username' => $this->input->post('username'),
                'nama' => $this->input->post('nama'),
                'level' => $this->input->post('level'), 
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'status' => $this->input->post('status'),
                );
                $this->users_model->update(array('id' => $this->input->post('id')), $data);
                echo json_encode(array("status" => TRUE));
        }else{
            $data = array(
                'username' => $this->input->post('username'),
                'nama' => $this->input->post('nama'),
                'level' => $this->input->post('level'), 
                // 'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'status' => $this->input->post('status'),
                );
                $this->users_model->update(array('id' => $this->input->post('id')), $data);
                echo json_encode(array("status" => TRUE));
        }

	}

    
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama Wajib di isi';
			$data['status'] = FALSE;
		}

		if($this->input->post('username') == '')
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'username wajib di isi';
			$data['status'] = FALSE;
		}

		if($this->input->post('status') == '')
		{
			$data['inputerror'][] = 'status';
			$data['error_string'][] = 'Status Wajib di isi';
			$data['status'] = FALSE;
		}

        if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

    public function create(){
	 
				$data = array(
					'username' => $this->input->post('username'),
					'nama' => $this->input->post('nama'),
					'level' => $this->input->post('level'), 
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'photo' => NULL,
					'status' => $this->input->post('status'),
		
				);
				//insert all together
				$this->db->insert('users', $data);
		 
				$this->session->set_flashdata('success', 'Data berhasil dibuat'); 
				redirect('manager/users');	

    }
}