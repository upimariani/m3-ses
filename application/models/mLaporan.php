<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mLaporan extends CI_Model
{
	public function laporan_periode($bulan, $tahun)
	{
		return $this->db->query("SELECT * FROM `transaksi` JOIN detail_transaksi ON transaksi.id_transaksi=detail_transaksi.id_transaksi JOIN bahan_baku ON bahan_baku.id_bb=detail_transaksi.id_bb WHERE MONTH(tanggal)='" . $bulan . "' AND YEAR(tanggal)='" . $tahun . "'")->result();
	}
}

/* End of file mLaporan.php */
