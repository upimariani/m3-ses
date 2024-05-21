<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cBBKeluar extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mBBKeluar');
	}

	public function index()
	{
		$data = array(
			'bb_keluar' => $this->mBBKeluar->select(),
			'bb' => $this->mBBKeluar->bb()
		);
		$this->load->view('Gudang/Layout/head');
		$this->load->view('Gudang/Layout/sidebar');
		$this->load->view('Gudang/BBKeluar/vBBKeluar', $data);
		$this->load->view('Gudang/Layout/footer');
	}
	public function create()
	{
		$data = array(
			'id_detail' => $this->input->post('bb'),
			'tgl_keluar' => date('Y-m-d'),
			'jumlah' => $this->input->post('qty')
		);
		$this->db->insert('bb_keluar', $data);

		//mengurangi stok sebelumnya
		$id_detail = $this->input->post('bb');
		$dt = $this->db->query("SELECT * FROM `detail_transaksi` WHERE id_detail='" . $id_detail . "'")->row();
		$ss = $dt->sisa;
		$qty = $this->input->post('qty');
		$stok = $ss - $qty;
		$updatedt = array(
			'sisa' => $stok
		);
		$this->db->where('id_detail', $id_detail);
		$this->db->update('detail_transaksi', $updatedt);

		$this->session->set_flashdata('success', 'Data Bahan Baku Keluar berhasil disimpan!');
		redirect('Gudang/cBBKeluar');
	}
	public function delete($id)
	{
		$this->db->where('id_bb_keluar', $id);
		$this->db->delete('bb_keluar');
		$this->session->set_flashdata('success', 'Data Bahan Baku Keluar berhasil dihapus!');
		redirect('Gudang/cBBKeluar');
	}
}

/* End of file cBBKeluar.php */
