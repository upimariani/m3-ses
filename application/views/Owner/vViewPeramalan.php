<div class="main-content">
	<div class="container-fluid">
		<div class="page-header">
			<div class="row align-items-end">
				<div class="col-lg-8">
					<div class="page-header-title">
						<i class="ik ik-pie-chart bg-blue"></i>
						<div class="d-inline">
							<h5>Analisis Data Bahan Baku</h5>
							<span>Forecasting Bahan Baku</span>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<nav class="breadcrumb-container" aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="../index.html"><i class="ik ik-home"></i></a>
							</li>
							<li class="breadcrumb-item">
								<a href="#">Tables</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Barang</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		<?php
		if ($this->session->userdata('success') != '') {
		?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<div class="alert-icon">
					<i class="zmdi zmdi-notifications-none"></i>
				</div>
				<div class="alert-message">
					<span><strong>Success!</strong> <?= $this->session->userdata('success') ?></span>
				</div>
			</div>
		<?php
		}
		?>

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h5>Perubahan Nilai Alpha</h5>

					</div>
					<div class="card-body">
						<form action="<?= base_url('Admin/cPeramalan/perbaharui_alpha/' . $id_bb) ?>" method="POST">
							<div class="form-group">
								<label for="input-2">Nilai Alpha</label>
								<small class="text-danger">Masukkan nilai decimal dengan menggunakan (.)</small>
								<input type="text" name="alpha" class="form-control" id="input-2" placeholder="Masukkan Nilai Alpha" required>

							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success">Perbaharui</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<table>
							<tr>
								<td>
									<h3>Informasi Analisis Peramalan Barang</h3>
								</td>
							</tr>
							<tr>
								<td>
									<?php
									$alpha = $this->db->query("SELECT * FROM `peramalan` WHERE id_bb='" . $id_bb . "' LIMIT 1")->row();
									?>
									<p>Nilai Alfa yang digunakan adalah <strong><?= $alpha->alpha ?></strong></p>
								</td>
							</tr>
						</table>




					</div>

					<div class="card-body">
						<table id="data_table" class="table">
							<thead>
								<tr>
									<th class="d-none d-md-table-cell">Nama Barang</th>
									<th class="d-none d-md-table-cell">Bulan</th>
									<th class="d-none d-md-table-cell">Tahun</th>
									<th class="d-none d-md-table-cell">Total Transaksi</th>
									<th class="d-none d-md-table-cell">Data Persediaan</th>
									<th class="d-none d-md-table-cell">Data Peramalan</th>
									<th class="d-none d-md-table-cell">Selisih</th>
									<th class="d-none d-md-table-cell">Absolute Persentase Kesalahan</th>
									<!-- <th class="d-none d-md-table-cell">Hapus</th> -->

								</tr>
							</thead>
							<tbody>
								<?php
								$mape = 0;
								$tpers = 0;
								foreach ($view_analisis as $key => $value) { ?>
									<tr>
										<td class="d-none d-md-table-cell"><?= $value->nama_bb ?></td>
										<td class="d-none d-md-table-cell"><?php
																			if ($value->bulan == '1') {
																				echo 'Januari';
																			} else if ($value->bulan == '2') {
																				echo 'Februari';
																			} else if ($value->bulan == '3') {
																				echo 'Maret';
																			} else if ($value->bulan == '4') {
																				echo 'April';
																			} else if ($value->bulan == '5') {
																				echo 'Mei';
																			} else if ($value->bulan == '6') {
																				echo 'Juni';
																			} else if ($value->bulan == '7') {
																				echo 'Juli';
																			} else if ($value->bulan == '8') {
																				echo 'Agustus';
																			} else if ($value->bulan == '9') {
																				echo 'September';
																			} else if ($value->bulan == '10') {
																				echo 'Oktober';
																			} else if ($value->bulan == '11') {
																				echo 'November';
																			} else if ($value->bulan == '12') {
																				echo 'Desember';
																			}
																			?></td>
										<td class="d-none d-md-table-cell"><?= $value->tahun ?></td>
										<?php
										$t_tranbulan = $this->db->query("SELECT COUNT(transaksi.id_transaksi) as jml_transaksi, tanggal FROM `transaksi` JOIN detail_transaksi ON transaksi.id_transaksi=detail_transaksi.id_transaksi WHERE detail_transaksi.id_bb='1' AND MONTH(tanggal) = '" . $value->bulan . "' AND YEAR(tanggal)='" . $value->tahun . "'")->row();
										?>
										<td><?= $t_tranbulan->jml_transaksi ?></td>
										<td class="d-none d-md-table-cell"><?= $value->aktual ?> <?= $value->keterangan ?></td>
										<?php
										$tpers += $value->aktual;
										?>
										<td class="d-none d-md-table-cell"><span class="badge badge-success"><?= $value->forecasting ?> <?= $value->keterangan ?></span></td>
										<?php
										if ($value->aktual == '0') {
										?>
											<td><a href="<?= base_url('Owner/cPeramalan/hapus/' . $value->id_peramalan . '/' . $value->id_bb . '/' . $value->bulan) ?>" class="btn btn-danger btn-sm">Hapus</a></td>
										<?php
										}
										?>
										<?php
										$selisih =  $value->aktual - $value->forecasting;
										$absolute = ($selisih / $value->aktual) * 100;
										$mape += $absolute;
										?>
										<td><?= abs($selisih) ?></td>
										<?php
										$sel = round($absolute, 2);
										?>
										<td><?= abs($sel)  ?></td>
									</tr>
								<?php } ?>
							<tfoot>
								<?php
								$t_tran = $this->db->query("SELECT COUNT(transaksi.id_transaksi) as jml_transaksi FROM `transaksi` JOIN detail_transaksi ON transaksi.id_transaksi=detail_transaksi.id_transaksi WHERE detail_transaksi.id_bb='" . $id_bb . "'")->row();
								?>
								<tr>
									<td></td>
									<td><strong>Total Transaksi</strong></td>
									<td><?= $t_tran->jml_transaksi ?></td>
									<td><strong>Total Persediaan</strong></td>
									<td><?= $tpers ?></td>
									<td></td>
									<td><strong>MAPE</strong></td>
									<td><?= abs(round($mape / 17, 2)) ?>%</td>
								</tr>
							</tfoot>

							</tbody>
						</table>
					</div>
					<div class="card-footer">
						<?php
						$dt = $this->db->query("SELECT * FROM `peramalan` WHERE id_bb='" . $id_bb . "' GROUP BY id_peramalan DESC LIMIT 1")->row();
						$ft = round((0.1 * $dt->aktual) + ((1 - 0.1) * $dt->forecasting));

						//mengambil data bulan
						$bulan = $this->db->query("SELECT MAX(bulan)+1 as bulan FROM `peramalan` WHERE id_bb='1' AND tahun='2024'")->row();
						if ($bulan->bulan == '1') {
							$next_bulan = 'Januari';
						} else if ($bulan->bulan == '2') {
							$next_bulan = 'Februari';
						} else if ($bulan->bulan == '3') {
							$next_bulan = 'Maret';
						} else if ($bulan->bulan == '4') {
							$next_bulan = 'April';
						} else if ($bulan->bulan == '5') {
							$next_bulan = 'Mei';
						} else if ($bulan->bulan == '6') {
							$next_bulan = 'Juni';
						} else if ($bulan->bulan == '7') {
							$next_bulan = 'Juli';
						} else if ($bulan->bulan == '8') {
							$next_bulan = 'Agustus';
						} else if ($bulan->bulan == '9') {
							$next_bulan = 'September';
						} else if ($bulan->bulan == '10') {
							$next_bulan = 'Oktober';
						} else if ($bulan->bulan == '11') {
							$next_bulan = 'November';
						} else if ($bulan->bulan == '12') {
							$next_bulan = 'Desember';
						}
						?>
						<h5>Peramalan di Bulan <strong><?= $next_bulan ?></strong> adalah <?= $ft ?> pcs</h5>
					</div>
				</div>
			</div>
		</div>


	</div>
</div>
