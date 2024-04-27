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
	public function view_analisis($id_barang)
	{
		// echo 'Bismillah perhitungan<br>';
		$dt_aktual = $this->mPeramalan->dt_aktual($id_barang);
		foreach ($dt_aktual as $key => $value) {
			$cek_data_peramalan = $this->db->query("SELECT * FROM `peramalan` WHERE id_barang='" . $id_barang . "' AND bulan_periode='" . $value->periode . "';")->row();
			if (!$cek_data_peramalan) {
				// echo $value->jumlah;
				// echo ' | ';
				$dt_cek = $this->db->query("SELECT * FROM `peramalan` WHERE id_barang='" . $id_barang . "'")->row();

				if (!$dt_cek) {
					$dt_peramalan = '0';
					// echo $value->jumlah;

					$data = array(
						'id_barang' => $id_barang,
						'tgl_peramalan' => date('Y-m-d'),
						'bulan_periode' => $value->periode,
						'dt_aktual' => $value->jumlah,
						'dt_peramalan' => $value->jumlah
					);
					$this->db->insert('peramalan', $data);
				} else {
					$per = $value->periode - 1;
					$dt_peramalan_sebelumnya = $this->db->query("SELECT * FROM `peramalan` WHERE id_barang='" . $id_barang . "' AND bulan_periode='" . $per . "';")->row();
					$ft = round((0.1 * $value->jumlah) + ((1 - 0.1) * $dt_peramalan_sebelumnya->dt_peramalan));
					echo $ft;

					$data = array(
						'id_barang' => $id_barang,
						'tgl_peramalan' => date('Y-m-d'),
						'bulan_periode' => $value->periode,
						'dt_aktual' => $value->jumlah,
						'dt_peramalan' => $ft
					);
					$this->db->insert('peramalan', $data);
				}
				// echo '<br>';
			}
		}

		$data = array(
			'view_analisis' => $this->mPeramalan->view_peramalan($id_barang),
			'periode' => $this->mPeramalan->periode(),
			'id_barang' => $id_barang
		);
		$this->load->view('Admin/Layout/head');
		$this->load->view('Admin/Layout/sidebar');
		$this->load->view('Owner/vViewPeramalan', $data);
		$this->load->view('Admin/Layout/footer');
	}
	public function hitung($id_barang)
	{
		//Perhitungan analisis metode SES

		//cek data peramalan
		$cek_dt_peramalan = $this->mPeramalan->cek_data_peramalan($id_barang);
		if ($cek_dt_peramalan) {
			//menggunakan rumus metode ses
			//ft+1 = a.xt + (1-lamda)ft-1

			$periode = $this->input->post('periode');
			$dt_aktual = $this->mPeramalan->dt_aktual($id_barang);
			foreach ($dt_aktual as $key => $value) {
				if ($value->periode == $periode - 1) {
					$jml_permintaan = $value->jumlah;
				}
			}

			//data peramalan sebelumnya
			$dt_peramalan_sebelumnya = $this->mPeramalan->dt_peramalan_sebelumnya($id_barang, $periode - 1);
			// echo $jml_permintaan;

			$ft = round((0.1 * $jml_permintaan) + ((1 - 0.1) * $dt_peramalan_sebelumnya->dt_peramalan));

			//dt_aktseb = update data aktual sebelumnya
			$dt_aktseb = array(
				'dt_aktual' => $jml_permintaan
			);
			$this->mPeramalan->update_dt_aktual($id_barang, $periode - 1, $dt_aktseb);

			//dt_persel = data peramalan periode in
			$dt_persel = array(
				'id_barang' => $id_barang,
				'tgl_peramalan' => date('Y-m-d'),
				'bulan_periode' => $periode,
				'dt_aktual' => '0',
				'dt_peramalan' => $ft
			);
			$this->mPeramalan->insert_peramalan($dt_persel);
			$this->session->set_flashdata('success', 'Data Analisis Periode ' . $periode . ' Berhasil disimpan!');
			redirect('Owner/cPeramalan/view_analisis/' . $id_barang);
		} else {
			$dt_aktual = $this->mPeramalan->dt_aktual($id_barang);
			foreach ($dt_aktual as $key => $value) {

				if ($value->periode == '1') {
					$jml_permintaan = $value->jumlah;
				}
			}
			$data = array(
				'id_barang' => $id_barang,
				'tgl_peramalan' => date('Y-m-d'),
				'bulan_periode' => $this->input->post('periode'),
				'dt_aktual' => $jml_permintaan,
				'dt_peramalan' => $jml_permintaan
			);
			$this->mPeramalan->insert_peramalan($data);

			$forecasting = array(
				'id_barang' => $id_barang,
				'tgl_peramalan' => date('Y-m-d'),
				'bulan_periode' => $this->input->post('periode') + 1,
				'dt_aktual' => '0',
				'dt_peramalan' => $jml_permintaan
			);
			$this->mPeramalan->insert_peramalan($forecasting);
			$this->session->set_flashdata('success', 'Data Analisis Periode Pertama Berhasil disimpan!');
			redirect('Owner/cPeramalan/view_analisis/' . $id_barang);
		}
	}
	public function hapus($id_peramalan, $id_barang, $bulan)
	{
		$bulan = $bulan - 1;
		//memperbaharui data sebelumnya
		$data = array(
			'dt_aktual' => '0'
		);
		$this->db->where('id_barang', $id_barang);
		$this->db->where('bulan_periode', $bulan);
		$this->db->update('peramalan', $data);

		//menghapus data
		$this->db->where('id_peramalan', $id_peramalan);
		$this->db->delete('peramalan');
		$this->session->set_flashdata('success', 'Peramalan Berhasil Dihapus!');
		redirect('Owner/cPeramalan/view_analisis/' . $id_barang);
	}
}

/* End of file cPeramalan.php */
