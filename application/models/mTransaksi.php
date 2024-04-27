<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mTransaksi extends CI_Model
{
	//admin
	public function transaksi_admin()
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('user', 'transaksi.id_user = user.id_user', 'left');

		return $this->db->get()->result();
	}
	public function bahanbaku($id)
	{
		$this->db->select('*');
		$this->db->from('bahan_baku');
		$this->db->where('id_user', $id);
		return $this->db->get()->result();
	}
	public function insert_pengajuan($data)
	{
		$this->db->insert('transaksi', $data);
	}
	public function insert_pesanan($data)
	{
		$this->db->insert('detail_transaksi', $data);
	}

	public function detail_transaksi($id)
	{
		$data['transaksi'] = $this->db->query("SELECT * FROM `transaksi` WHERE id_transaksi='" . $id . "'")->row();
		$data['detail'] = $this->db->query("SELECT * FROM `transaksi` JOIN detail_transaksi ON transaksi.id_transaksi=detail_transaksi.id_transaksi JOIN bahan_baku ON detail_transaksi.id_bb=bahan_baku.id_bb WHERE transaksi.id_transaksi='" . $id . "'")->result();
		return $data;
	}
	public function bayar($id, $data)
	{
		$this->db->where('id_transaksi', $id);
		$this->db->update('transaksi', $data);
	}

	//supplier
	public function select_supplier()
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('user', 'transaksi.id_user = user.id_user', 'left');
		$this->db->where('transaksi.id_user', $this->session->userdata('id'));
		$this->db->order_by('tanggal', 'desc');

		return $this->db->get()->result();
	}
	public function update_status($id, $data)
	{
		$this->db->where('id_transaksi', $id);
		$this->db->update('transaksi', $data);
	}
}

/* End of file mTransaksi.php */
