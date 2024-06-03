<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('logged_in') & $this->session->userdata('level') == 'Admin') {
			redirect('manager/dashboard');
		} elseif ($this->session->userdata('logged_in') & $this->session->userdata('level') == 'Kasir') {
			redirect('cashier/dashboard');
		} else {
			$this->load->view('auth');
		}
	}

	public function verify()
	{
		$username = $this->security->xss_clean(trim($this->input->post('username')));
		$password = trim($this->input->post('password'));
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if ($user) {
			//cek aktif atau tidak
			if ($user['status'] == 'Aktif') {
				//cek password
				if (password_verify($password, $user['password'])) {
					$data = [
						'logged_in' => TRUE,
						'id' => $user['id'],
						'username' => $user['username'],
						'nama' => $user['nama'],
						'photo' => $user['photo'],
						'level' => $user['level'],
						'created_at' => $user['created_at'],
						'updated_at' => $user['updated_at'],
						'costumer_type' => 1,
					];
					$this->session->set_userdata($data);

					if ($user['level'] == 'Admin') {
						$this->session->set_flashdata('success', 'Berhasil Login Sebagai Admin!');
						redirect('manager/dashboard');
					} elseif ($user['level'] == 'Kasir') {

						$this->session->set_flashdata('success', 'Berhasil Login Sebagai User!');
						redirect('app');
					} elseif ($user['level'] == 'Owner') {

						$this->session->set_flashdata('success', 'Berhasil Login Sebagai Owner!');
						redirect('owner/dashboard');
					} elseif ($user['status'] == 'Tidak Aktif') {

						$this->session->set_flashdata('message', '<div class="alert
							alert-primary" role="alert"><div class="alert-body">Akun tidak aktif atau tersuspend!</div></div>');
						redirect('auth');
					} else {
						echo 'You have no Role';
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert
                        alert-primary" role="alert"><div class="alert-body">Password salah mohon ulangi!</div></div>');
					redirect('auth');
				}
			} else {

				$this->session->set_flashdata('message', '<div class="alert
				alert-primary" role="alert"><div class="alert-body">Akun Belum aktif atau disuspend!</div></div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert
                alert-primary" role="alert"><div class="alert-body">Username tidak terdaftar!</div></div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('photo');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('created_at');
		$this->session->unset_userdata('updated_at');
		$this->session->sess_destroy();
		$this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert">Telah Logout</div>');
		redirect('auth');
	}
}
