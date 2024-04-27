<div class="main-content">
	<div class="container-fluid">
		<div class="page-header">
			<div class="row align-items-end">
				<div class="col-lg-8">
					<div class="page-header-title">
						<i class="ik ik-pie-chart bg-blue"></i>
						<div class="d-inline">
							<h5>Analisis Data Barang</h5>
							<span>Forecasting Barang</span>
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
		<!-- <button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-success mb-3">
			<i class="fas fa-plus"></i> Tambah Analisis
		</button> -->
		<div class="modal fade" id="modal-default">
			<div class="modal-dialog">
				<form action="<?= base_url('Owner/cPeramalan/hitung/' . $id_barang) ?>" method="POST">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Analisis Peramalan Barang</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="col-lg-12">
								<div class="form-group">
									<label for="exampleInputEmail1">Pilih Periode</label>
									<select class="form-control" name="periode" required>
										<option value="">---Pilih Periode Analisis---</option>
										<?php
										foreach ($periode as $key => $value) {
											$cek_analisis = $this->db->query("SELECT * FROM `peramalan` WHERE id_barang='" . $id_barang . "' AND bulan_periode='" . $value->periode . "'")->row();
										?>
											<option value="<?= $value->periode ?>" <?php if ($cek_analisis) {
																						echo 'disabled';
																					} ?>><?php
																							if ($value->periode == '1') {
																								echo 'Januari';
																							} else if ($value->periode == '2') {
																								echo 'Februari';
																							} else if ($value->periode == '3') {
																								echo 'Maret';
																							} else if ($value->periode == '4') {
																								echo 'April';
																							} else if ($value->periode == '5') {
																								echo 'Mei';
																							} else if ($value->periode == '6') {
																								echo 'Juni';
																							} else if ($value->periode == '7') {
																								echo 'Juli';
																							} else if ($value->periode == '8') {
																								echo 'Agustus';
																							} else if ($value->periode == '9') {
																								echo 'September';
																							} else if ($value->periode == '10') {
																								echo 'Oktober';
																							} else if ($value->periode == '11') {
																								echo 'November';
																							} else if ($value->periode == '12') {
																							}
																							?></option>
										<?php
										}
										?>


									</select>
								</div>
							</div>
						</div>
						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</div>
				</form>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3>Informasi Analisis Peramalan Barang</h3>

					</div>
					<div class="card-body">
						<table id="data_table" class="table">
							<thead>
								<tr>
									<th class="d-none d-md-table-cell">Nama Barang</th>
									<th class="d-none d-md-table-cell">Tanggal Peramalan</th>
									<th class="d-none d-md-table-cell">Periode</th>
									<th class="d-none d-md-table-cell">Data Aktual</th>
									<th class="d-none d-md-table-cell">Data Peramalan</th>
									<th class="d-none d-md-table-cell">Selisih</th>
									<th class="d-none d-md-table-cell">Absolute Persentase Kesalahan</th>
									<!-- <th class="d-none d-md-table-cell">Hapus</th> -->

								</tr>
							</thead>
							<tbody>
								<?php
								$mape = 0;
								foreach ($view_analisis as $key => $value) { ?>
									<tr>
										<td class="d-none d-md-table-cell"><?= $value->nama_barang ?></td>
										<td class="d-none d-md-table-cell"><?= $value->tgl_peramalan ?></td>
										<td class="d-none d-md-table-cell"><?php
																			if ($value->bulan_periode == '1') {
																				echo 'Januari';
																			} else if ($value->bulan_periode == '2') {
																				echo 'Februari';
																			} else if ($value->bulan_periode == '3') {
																				echo 'Maret';
																			} else if ($value->bulan_periode == '4') {
																				echo 'April';
																			} else if ($value->bulan_periode == '5') {
																				echo 'Mei';
																			} else if ($value->bulan_periode == '6') {
																				echo 'Juni';
																			} else if ($value->bulan_periode == '7') {
																				echo 'Juli';
																			} else if ($value->bulan_periode == '8') {
																				echo 'Agustus';
																			} else if ($value->bulan_periode == '9') {
																				echo 'September';
																			} else if ($value->bulan_periode == '10') {
																				echo 'Oktober';
																			} else if ($value->bulan_periode == '11') {
																				echo 'November';
																			} else if ($value->bulan_periode == '12') {
																			}
																			?></td>
										<td class="d-none d-md-table-cell"><?= $value->dt_aktual ?> <?= $value->keterangan ?></td>
										<td class="d-none d-md-table-cell"><span class="badge badge-success"><?= $value->dt_peramalan ?> <?= $value->keterangan ?></span></td>
										<?php
										if ($value->dt_aktual == '0') {
										?>
											<td><a href="<?= base_url('Owner/cPeramalan/hapus/' . $value->id_peramalan . '/' . $value->id_barang . '/' . $value->bulan_periode) ?>" class="btn btn-danger btn-sm">Hapus</a></td>
										<?php
										}
										?>
										<?php
										$selisih =  $value->dt_aktual - $value->dt_peramalan;
										$absolute = ($selisih / $value->dt_aktual) * 100;
										$mape += $absolute;
										?>
										<td><?= $selisih ?></td>
										<td><?= round($absolute, 2) ?></td>
									</tr>
								<?php } ?>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><strong>MAPE</strong></td>
									<td><?= round($mape / 10, 2) ?>%</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>


	</div>
</div>
