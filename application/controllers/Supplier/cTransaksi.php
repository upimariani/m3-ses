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
			'transaksi' => $this->mTransaksi->select_supplier()
		);
		$this->load->view('Supplier/Layout/head');
		$this->load->view('Supplier/Layout/sidebar');
		$this->load->view('Supplier/Transaksi/vTransaksi', $data);
		$this->load->view('Supplier/Layout/footer');
	}
	public function detail_transaksi($id)
	{
		$data = array(
			'transaksi' => $this->mTransaksi->detail_transaksi($id)
		);
		$this->load->view('Supplier/Layout/head');
		$this->load->view('Supplier/Layout/sidebar');
		$this->load->view('Supplier/Transaksi/vDetailTransaksi', $data);
		$this->load->view('Supplier/Layout/footer');
	}
	public function tolak_pesanan($id)
	{
		$data = array(
			'status' => '9'
		);
		$this->db->where('id_transaksi', $id);
		$this->db->update('transaksi', $data);
		$this->session->set_flashdata('success', 'Pesanan Ditolak!');
		redirect('Supplier/cTransaksi');
	}
	public function konfirmasi($id)
	{
		$data = array(
			'status' => '2'
		);
		$this->mTransaksi->update_status($id, $data);
		$this->session->set_flashdata('success', 'Pesanan Berhasil Dikonfirmasi!');
		redirect('Supplier/cTransaksi');
	}
	public function kirim($id)
	{
		$data = array(
			'status' => '3'
		);
		$this->mTransaksi->update_status($id, $data);
		$this->session->set_flashdata('success', 'Pesanan Berhasil Dikirim!');
		redirect('Supplier/cTransaksi');
	}
}

/* End of file cTransaksi.php */
