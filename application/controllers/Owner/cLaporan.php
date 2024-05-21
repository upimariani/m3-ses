<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cLaporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mTransaksi');
		$this->load->model('mLaporan');
	}
	public function index()
	{
		$data = array(
			'transaksi' => $this->mTransaksi->transaksi_admin()
		);
		$this->load->view('Owner/Layout/head');
		$this->load->view('Owner/Layout/sidebar');
		$this->load->view('Owner/vLaporanPengajuan', $data);
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
	public function cetak_laporan()
	{
		$bulan = $this->input->post('periode');
		$tahun = $this->input->post('tahun');

		// memanggil library FPDF
		require('asset/fpdf/fpdf.php');

		// intance object dan memberikan pengaturan halaman PDF
		$pdf = new FPDF('P', 'mm', 'A4');
		$pdf->AddPage();

		$pdf->SetFont('Times', 'B', 14);
		$pdf->Cell(200, 40, 'LAPORAN TRANSAKSI BAHAN BAKU SUPPLIER', 0, 0, 'C');
		$pdf->SetLineWidth(0);
		$pdf->Cell(10, 30, '', 0, 1);
		$pdf->SetFont('Times', 'B', 9);
		$pdf->Cell(30, 7, 'Id Pengajuan', 1, 0, 'C');
		$pdf->Cell(30, 7, 'Tanggal Transaksi', 1, 0, 'C');
		$pdf->Cell(50, 7, 'Nama Barang', 1, 0, 'C');
		$pdf->Cell(30, 7, 'Harga', 1, 0, 'C');
		$pdf->Cell(20, 7, 'Quantity', 1, 0, 'C');
		$pdf->Cell(30, 7, 'Subtotal', 1, 0, 'C');


		$pdf->Cell(10, 7, '', 0, 1);
		$pdf->SetFont('Times', '', 10);
		$no = 1;


		$data = $this->mLaporan->laporan_periode($bulan, $tahun);
		$total = 0;
		foreach ($data as $key => $value) {
			$total += ($value->harga * $value->qty);
			$pdf->Cell(30, 7, $value->id_transaksi, 1, 0, 'C');
			$pdf->Cell(30, 7, $value->tanggal, 1, 0, 'C');
			$pdf->Cell(50, 7, $value->nama_bb, 1, 0, 'C');
			$pdf->Cell(30, 7, 'Rp.' . number_format($value->harga), 1, 0, 'C');
			$pdf->Cell(20, 7, $value->qty, 1, 0, 'C');
			$pdf->Cell(30, 7, 'Rp. ' . number_format($value->harga * $value->qty), 1, 1, 'C');
		}
		$pdf->SetFont('Times', 'B', 12);
		$pdf->Cell(110, 7, '', 0, 0, 'C');
		$pdf->Cell(50, 7, 'Total', 0, 0, 'C');
		$pdf->Cell(30, 7, 'Rp.' . number_format($total), 0, 0, 'C');
		$pdf->Output();
	}
}

/* End of file c.php */
