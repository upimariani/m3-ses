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
						<h3>Informasi Analisis Peramalan Barang</h3>

					</div>
					<div class="card-body">
						<table id="data_table" class="table">
							<thead>
								<tr>
									<th class="d-none d-md-table-cell">Nama Barang</th>
									<th class="d-none d-md-table-cell">Bulan</th>
									<th class="d-none d-md-table-cell">Tahun</th>
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
										<td class="d-none d-md-table-cell"><?= $value->aktual ?> <?= $value->keterangan ?></td>
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
