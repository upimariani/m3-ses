<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cTransaksi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mTransaksi');
		$this->load->model('mUser');
		$this->load->model('mBarang');
	}

	public function index()
	{
		$data = array(
			'transaksi' => $this->mTransaksi->transaksi_admin(),
			'supplier' => $this->mUser->supplier()
		);
		$this->load->view('Gudang/Layout/head');
		$this->load->view('Gudang/Layout/sidebar');
		$this->load->view('Gudang/TransaksiSupplier/vTransaksi', $data);
		$this->load->view('Gudang/Layout/footer');
	}
	public function detail_transaksi($id)
	{
		$data = array(
			'transaksi' => $this->mTransaksi->detail_transaksi($id)
		);
		$this->load->view('Gudang/Layout/head');
		$this->load->view('Gudang/Layout/sidebar');
		$this->load->view('Gudang/TransaksiSupplier/vDetailTransaksi', $data);
		$this->load->view('Gudang/Layout/footer');
	}
	public function pesan_supplier($id_supplier = NULL)
	{
		$id_supplier = $this->input->post('supplier');
		$data = array(
			'bb' => $this->mBarang->barang($id_supplier),
			'id_supplier' => $id_supplier
		);
		$this->load->view('Gudang/Layout/head');
		$this->load->view('Gudang/Layout/sidebar');
		$this->load->view('Gudang/TransaksiSupplier/vCreateTransaksi', $data);
		$this->load->view('Gudang/Layout/footer');
	}
	public function addtocart()
	{
		$data = array(
			'id' => $this->input->post('bahanbaku'),
			'name' => $this->input->post('nama'),
			'price' => $this->input->post('harga'),
			'qty' => $this->input->post('qty'),
			'stok' => $this->input->post('stok')
		);
		$this->cart->insert($data);
		$this->session->set_flashdata('success', 'Bahan Baku Berhasil Masuk Keranjang!');


		$id_supplier = $this->input->post('id_supplier');
		$data = array(
			'bb' => $this->mBarang->barang($id_supplier),
			'id_supplier' => $id_supplier
		);
		$this->load->view('Gudang/Layout/head');
		$this->load->view('Gudang/Layout/sidebar');
		$this->load->view('Gudang/TransaksiSupplier/vCreateTransaksi', $data);
		$this->load->view('Gudang/Layout/footer');
	}
	public function hapus($id, $id_supplier)
	{
		$this->cart->remove($id);
		$data = array(
			'bb' => $this->mBarang->barang($id_supplier),
			'id_supplier' => $id_supplier
		);
		$this->load->view('Gudang/Layout/head');
		$this->load->view('Gudang/Layout/sidebar');
		$this->load->view('Gudang/TransaksiSupplier/vCreateTransaksi', $data);
		$this->load->view('Gudang/Layout/footer');
	}
	public function selesai()
	{
		//insert pengajuan
		$data = array(
			'id_user' => $this->input->post('id_supplier'),
			'tanggal' => date('Y-m-d'),
			'total' => $this->cart->total(),
			'pembayaran' => '0',
			'status' => '9'
		);
		$this->mTransaksi->insert_pengajuan($data);

		//insert detail pengajuan
		$id = $this->db->query("SELECT MAX(id_transaksi) as id_transaksi FROM `transaksi`")->row();

		foreach ($this->cart->contents() as $key => $value) {
			$pesanan = array(
				'id_transaksi' => $id->id_transaksi,
				'id_bb' => $value['id'],
				'qty' => $value['qty'],
				'sisa' => $value['qty']
			);
			$this->mTransaksi->insert_pesanan($pesanan);
		}
		$this->cart->destroy();
		$this->session->set_flashdata('success', 'Transaksi berhasil Dikirim!');
		redirect('Gudang/cTransaksi');
	}
	public function bayar($id)
	{
		$config['upload_path']          = './asset/pembayaran';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = 50000;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('bayar')) {
			$data = array(
				'transaksi' => $this->mTransaksi->detail_transaksi($id)
			);
			$this->load->view('Gudang/Layout/head');
			$this->load->view('Gudang/Layout/sidebar');
			$this->load->view('Gudang/TransaksiSupplier/vDetailTransaksi', $data);
			$this->load->view('Gudang/Layout/footer');
		} else {

			$upload_data =  $this->upload->data();
			$data = array(
				'pembayaran' => $upload_data['file_name'],
				'status' => '1'
			);
			$this->mTransaksi->bayar($id, $data);
			$this->session->set_flashdata('success', 'Transaksi Berhasil Dikirim!!!');
			redirect('Gudang/cTransaksi', 'refresh');
		}
	}
	public function pesanan_diterima($id)
	{
		$data = array(
			'status' => '4'
		);
		$this->mTransaksi->update_status($id, $data);
		$this->session->set_flashdata('success', 'Pesanan Berhasil Diterima!');
		redirect('Gudang/cTransaksi');
	}
}

/* End of file cTransaksi.php */
