<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cLogin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mLogin');
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('level', 'Hak Akses', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('vLogin');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$data = $this->mLogin->login($username, $password);

			if ($data) {
				$id = $data->id_user;
				$this->session->set_userdata('id', $id);

				if ($data->level_user == '1') {
					$this->session->set_flashdata('success', 'Selamat Datang Admin!');
					redirect('Admin/cDashboard');
				} else if ($data->level_user == '2') {
					$this->session->set_flashdata('success', 'Selamat Datang Supplier!');
					redirect('Supplier/cDashboard');
				} else if ($data->level_user == '3') {
					$this->session->set_flashdata('success', 'Selamat Datang Owner!');
					redirect('Owner/cDashboard');
				} else if ($data->level_user == '4') {
					$this->session->set_flashdata('success', 'Selamat Datang Gudang!');
					redirect('Gudang/cDashboard');
				}
			} else {
				$this->session->set_flashdata('error', 'Username dan Password Salah!');
				redirect('cLogin');
			}
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->set_flashdata('success', 'Anda Berhasil Logout!');
		redirect('cLogin');
	}
}

/* End of file cLogin.php */
