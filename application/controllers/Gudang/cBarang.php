<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cBarang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mBarang');
		$this->load->model('mUser');
	}

	public function index()
	{
		$data = array(
			'barang' => $this->mBarang->select()
		);
		$this->load->view('Gudang/Layout/head');
		$this->load->view('Gudang/Layout/sidebar');
		$this->load->view('Gudang/Barang/vBarang', $data);
		$this->load->view('Gudang/Layout/footer');
	}
	public function create()
	{
		$this->form_validation->set_rules('nama', 'Nama Barang', 'required');
		$this->form_validation->set_rules('harga', 'Harga Barang', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan Barang', 'required');
		$this->form_validation->set_rules('supplier', 'Supplier Barang', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'supplier' => $this->mUser->select()
			);
			$this->load->view('Gudang/Layout/head');
			$this->load->view('Gudang/Layout/sidebar');
			$this->load->view('Gudang/Barang/vCreateBarang', $data);
			$this->load->view('Gudang/Layout/footer');
		} else {
			$data = array(
				'id_user' => $this->input->post('supplier'),
				'nama_bb' => $this->input->post('nama'),
				'harga' => $this->input->post('harga'),
				'keterangan' => $this->input->post('keterangan')
			);
			$this->mBarang->insert($data);
			$this->session->set_flashdata('success', 'Data Barang Berhasil Ditambahkan!');
			redirect('Gudang/cBarang');
		}
	}
	public function update($id)
	{
		$this->form_validation->set_rules('nama', 'Nama Barang', 'required');
		$this->form_validation->set_rules('harga', 'Harga Barang', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan Barang', 'required');
		$this->form_validation->set_rules('supplier', 'Supplier Barang', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'supplier' => $this->mUser->select(),
				'bb' => $this->mBarang->get_data($id)
			);
			$this->load->view('Gudang/Layout/head');
			$this->load->view('Gudang/Layout/sidebar');
			$this->load->view('Gudang/Barang/vUpdateBarang', $data);
			$this->load->view('Gudang/Layout/footer');
		} else {
			$data = array(
				'id_user' => $this->input->post('supplier'),
				'nama_bb' => $this->input->post('nama'),
				'harga' => $this->input->post('harga'),
				'keterangan' => $this->input->post('keterangan')
			);
			$this->mBarang->update($id, $data);
			$this->session->set_flashdata('success', 'Data Barang Berhasil Ditambahkan!');
			redirect('Gudang/cBarang');
		}
	}
	public function delete($id)
	{
		$this->mBarang->delete($id);
		$this->session->set_flashdata('success', 'Data Barang Berhasil Dihapus !!!');
		redirect('Gudang/cBarang');
	}
}

/* End of file cBarang.php */