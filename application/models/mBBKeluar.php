<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mBBKeluar extends CI_Model
{
	public function select()
	{
		$this->db->select('*');
		$this->db->from('bb_keluar');
		$this->db->join('detail_transaksi', 'bb_keluar.id_detail = detail_transaksi.id_detail', 'left');
		$this->db->join('bahan_baku', 'bahan_baku.id_bb = detail_transaksi.id_bb', 'left');
		return $this->db->get()->result();
	}
	public function bb()
	{
		$this->db->select('*');
		$this->db->from('detail_transaksi');
		$this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi', 'left');
		$this->db->join('bahan_baku', 'bahan_baku.id_bb = detail_transaksi.id_bb', 'left');
		$this->db->where('sisa!=0');
		return $this->db->get()->result();
	}
}

/* End of file mBBKeluar.php */
