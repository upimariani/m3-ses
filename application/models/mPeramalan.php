<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mPeramalan extends CI_Model
{
	public function barang()
	{
		$this->db->select('*');
		$this->db->from('bahan_baku');
		return $this->db->get()->result();
	}
	public function view_peramalan($id)
	{
		$this->db->select('*');
		$this->db->from('peramalan');
		$this->db->join('bahan_baku', 'bahan_baku.id_bb = peramalan.id_bb', 'left');
		$this->db->where('peramalan.id_bb', $id);
		return $this->db->get()->result();
	}

	//mengambil data analisis
	public function periode()
	{
		return $this->db->query("SELECT MONTH(tanggal) as periode FROM `transaksi` GROUP BY MONTH(tanggal), YEAR(tanggal)")->result();
	}
	public function cek_data_peramalan($id_barang)
	{
		return $this->db->query("SELECT * FROM `peramalan` WHERE id_bb='" . $id_barang . "'")->row();
	}
	public function dt_aktual($id_barang)
	{
		return $this->db->query("SELECT SUM(qty) as jumlah, MONTH(tanggal) as periode, YEAR(tanggal) as tahun, id_bb FROM `transaksi` JOIN detail_transaksi ON transaksi.id_transaksi=detail_transaksi.id_transaksi WHERE id_bb='" . $id_barang . "' GROUP BY MONTH(tanggal), YEAR(tanggal), id_bb ORDER BY tahun, periode ASC")->result();
	}
	public function dt_peramalan_sebelumnya($id_barang, $periode)
	{
		return $this->db->query("SELECT * FROM `peramalan` WHERE id_bb='" . $id_barang . "' AND bulan='" . $periode . "'")->row();
	}

	//action peramalan
	public function insert_peramalan($data)
	{
		$this->db->insert('peramalan', $data);
	}
	public function update_dt_aktual($id_barang, $periode, $data)
	{
		$this->db->where('id_bb', $id_barang);
		$this->db->where('bulan', $periode);
		$this->db->update('peramalan', $data);
	}
}

/* End of file mPeramalan.php */
