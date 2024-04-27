<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mLaporan extends CI_Model
{
	public function laporan_periode($bulan, $tahun)
	{
		return $this->db->query("SELECT * FROM `pengajuan` JOIN detail_pengajuan ON pengajuan.id_pengajuan=detail_pengajuan.id_pengajuan JOIN barang ON barang.id_barang=detail_pengajuan.id_barang WHERE MONTH(tgl_pengajuan)='" . $bulan . "' AND YEAR(tgl_pengajuan)='" . $tahun . "'")->result();
	}
}

/* End of file mLaporan.php */
