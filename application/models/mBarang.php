<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mBarang extends CI_Model
{
	public function select()
	{
		$this->db->select('*');
		$this->db->from('bahan_baku');
		$this->db->join('user', 'bahan_baku.id_user = user.id_user', 'left');
		return $this->db->get()->result();
	}
	public function insert($data)
	{
		$this->db->insert('bahan_baku', $data);
	}
	public function get_data($id)
	{
		$this->db->select('*');
		$this->db->from('bahan_baku');
		$this->db->where('id_bb', $id);
		return $this->db->get()->row();
	}
	public function update($id, $data)
	{
		$this->db->where('id_bb', $id);
		$this->db->update('bahan_baku', $data);
	}
	public function delete($id)
	{
		$this->db->where('id_bb', $id);
		$this->db->delete('bahan_baku');
	}

	//transaksi admin
	public function barang($id_supplier)
	{
		$this->db->select('*');
		$this->db->from('bahan_baku');
		$this->db->join('user', 'bahan_baku.id_user = user.id_user', 'left');
		$this->db->where('bahan_baku.id_user', $id_supplier);
		return $this->db->get()->result();
	}
}

/* End of file mBarang.php */
