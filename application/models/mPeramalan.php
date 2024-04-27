<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mPeramalan extends CI_Model
{
	public function barang()
	{
		$this->db->select('*');
		$this->db->from('barang');
		return $this->db->get()->result();
	}
	public function view_peramalan($id)
	{
		$this->db->select('*');
		$this->db->from('peramalan');
		$this->db->join('barang', 'barang.id_barang = peramalan.id_barang', 'left');
		$this->db->where('peramalan.id_barang', $id);
		return $this->db->get()->result();
	}

	//mengambil data analisis
	public function periode()
	{
		return $this->db->query("SELECT MONTH(tgl_pengajuan) as periode FROM `pengajuan` GROUP BY MONTH(tgl_pengajuan)")->result();
	}
	public function cek_data_peramalan($id_barang)
	{
		return $this->db->query("SELECT * FROM `peramalan` WHERE id_barang='" . $id_barang . "'")->row();
	}
	public function dt_aktual($id_barang)
	{
		return $this->db->query("SELECT SUM(qty) as jumlah, MONTH(tgl_pengajuan) as periode, id_barang FROM `pengajuan` JOIN detail_pengajuan ON pengajuan.id_pengajuan=detail_pengajuan.id_pengajuan WHERE id_barang='" . $id_barang . "' GROUP BY MONTH(tgl_pengajuan), id_barang")->result();
	}
	public function dt_peramalan_sebelumnya($id_barang, $periode)
	{
		return $this->db->query("SELECT * FROM `peramalan` WHERE id_barang='" . $id_barang . "' AND bulan_periode='" . $periode . "'")->row();
	}

	//action peramalan
	public function insert_peramalan($data)
	{
		$this->db->insert('peramalan', $data);
	}
	public function update_dt_aktual($id_barang, $periode, $data)
	{
		$this->db->where('id_barang', $id_barang);
		$this->db->where('bulan_periode', $periode);
		$this->db->update('peramalan', $data);
	}
}

/* End of file mPeramalan.php */
