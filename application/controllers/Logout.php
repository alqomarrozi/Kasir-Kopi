<?php
defined('BASEPATH') or exit('No direct script access allowed');

class logout extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	} 
public function index()
	{

		$this->session->unset_userdata('id');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('status');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('nama_user');
		$this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert">Terima Kasih</div>');
		redirect('Login');
	}
}