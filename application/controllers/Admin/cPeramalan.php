<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cPeramalan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mPeramalan');
	}

	public function index()
	{
		$data = array(
			'barang' => $this->mPeramalan->barang()
		);
		$this->load->view('Admin/Layout/head');
		$this->load->view('Admin/Layout/sidebar');
		$this->load->view('Owner/vPeramalan', $data);
		$this->load->view('Admin/Layout/footer');
	}
	public function view_analisis($id_bb)
	{
		// echo 'Bismillah perhitungan<br>';
		$dt_aktual = $this->mPeramalan->dt_aktual($id_bb);
		foreach ($dt_aktual as $key => $value) {
			$cek_data_peramalan = $this->db->query("SELECT * FROM `peramalan` WHERE id_bb='" . $id_bb . "' AND bulan='" . $value->periode . "' AND tahun='" . $value->tahun . "';")->row();
			if (!$cek_data_peramalan) {
				// echo $value->jumlah;
				// echo ' | ';
				$dt_cek = $this->db->query("SELECT * FROM `peramalan` WHERE id_bb='" . $id_bb . "'")->row();

				if (!$dt_cek) {
					$dt_peramalan = '0';
					// echo $value->jumlah;

					$data = array(
						'id_bb' => $id_bb,
						'bulan' => $value->periode,
						'tahun' => $value->tahun,
						'aktual' => $value->jumlah,
						'forecasting' => $value->jumlah
					);
					$this->db->insert('peramalan', $data);
				} else {
					$per = $value->periode - 1;
					$dt_peramalan_sebelumnya = $this->db->query("SELECT * FROM `peramalan` WHERE id_bb='" . $id_bb . "' AND bulan='" . $per . "' AND tahun='" . $value->tahun . "';")->result();
					foreach ($dt_peramalan_sebelumnya as $key => $item) {
						$forecasting = $item->forecasting;
					}
					$ft = round((0.1 * $forecasting) + ((1 - 0.1) * $value->jumlah));
					// echo $ft;

					$data = array(
						'id_bb' => $id_bb,
						'bulan' => $value->periode,
						'tahun' => $value->tahun,
						'aktual' => $value->jumlah,
						'forecasting' => $ft
					);
					$this->db->insert('peramalan', $data);
				}
				// echo '<br>';
			}
		}

		$data = array(
			'view_analisis' => $this->mPeramalan->view_peramalan($id_bb),
			'periode' => $this->mPeramalan->periode(),
			'id_bb' => $id_bb
		);
		$this->load->view('Admin/Layout/head');
		$this->load->view('Admin/Layout/sidebar');
		$this->load->view('Owner/vViewPeramalan', $data);
		$this->load->view('Admin/Layout/footer');
	}
}

/* End of file cPeramalan.php */