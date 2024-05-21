<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cTransaksi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mTransaksi');
	}

	public function index()
	{
		$data = array(
			'transaksi' => $this->mTransaksi->transaksi_admin()
		);
		$this->load->view('Owner/Layout/head');
		$this->load->view('Owner/Layout/sidebar');
		$this->load->view('Owner/vTransaksi', $data);
		$this->load->view('Owner/Layout/footer');
	}
	public function detail_transaksi($id)
	{
		$data = array(
			'transaksi' => $this->mTransaksi->detail_transaksi($id)
		);
		$this->load->view('Owner/Layout/head');
		$this->load->view('Owner/Layout/sidebar');
		$this->load->view('Owner/vDetailTransaksi', $data);
		$this->load->view('Owner/Layout/footer');
	}
	public function approve($id)
	{
		$data = array(
			'status' => '0'
		);
		$this->db->where('id_transaksi', $id);
		$this->db->update('transaksi', $data);
		$this->session->set_flashdata('success', 'Pesanan Approve!');
		redirect('Owner/cTransaksi');
	}
}

/* End of file cTransaksi.php */
