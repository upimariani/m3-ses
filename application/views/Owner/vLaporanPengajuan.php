<div class="main-content">
	<div class="container-fluid">
		<div class="page-header">
			<div class="row align-items-end">
				<div class="col-lg-8">
					<div class="page-header-title">
						<i class="ik ik-user-plus bg-blue"></i>
						<div class="d-inline">
							<h5>Data Transaksi</h5>
							<span>Transaksi Bahan Baku Supplier</span>
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
							<li class="breadcrumb-item active" aria-current="page">Transaksi</li>
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

		<!-- /.modal -->
		<div class="row">
			<div class="col-12 col-sm-12">
				<div class="card card-info card-tabs">
					<form action="<?= base_url('Owner/cLaporan/cetak_laporan') ?>" method="POST">
						<div class="card-header">
							<div class="row">
								<div class="col-lg-12">
									<h3>Cetak Laporan Pengajuan Barang</h3>
								</div>

								<div class="col-lg-12 mt-3">
									<select class="form-control" name="periode" required>
										<option value="">---Pilih Periode---</option>
										<option value="1">Januari</option>
										<option value="2">Februari</option>
										<option value="3">Maret</option>
										<option value="4">April</option>
										<option value="5">Mei</option>
										<option value="6">Juni</option>
										<option value="7">Juli</option>
										<option value="8">Agustus</option>
										<option value="9">September</option>
										<option value="10">Oktober</option>
										<option value="11">November</option>
										<option value="12">Desember</option>
									</select>
									<select class="form-control mt-3" name="tahun" required>
										<option value="">---Pilih Tahun---</option>
										<option value="2023">2023</option>
										<option value="2024">2024</option>
									</select>
									<button type="submit" class="btn btn-warning mt-3">Cetak Laporan</button>
								</div>

							</div>

						</div>
					</form>
					<div class="card-body">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Informasi Transaksi Selesai</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<table id="data_table" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Supplier</th>
											<th>Tanggal Transaksi</th>
											<th>Total Bayar</th>
											<th>Status Pesanan</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($transaksi as $key => $value) {
											if ($value->status == '4') {

										?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $value->nama ?></td>
													<td><?= $value->tanggal ?></td>
													<td>Rp. <?= number_format($value->total)  ?></td>

													<td><?php
														if ($value->status == '0') {
														?>
															<span class="badge badge-danger">Belum Bayar</span>
														<?php
														} else if ($value->status == '1') {
														?>
															<span class="badge badge-warning">Menunggu Konfirmasi</span>
														<?php
														} else if ($value->status == '2') {
														?>
															<span class="badge badge-info">Pesanan Diproses</span>
														<?php
														} else if ($value->status == '3') {
														?>
															<span class="badge badge-primary">Pesanan Dikirim</span>
														<?php
														} else if ($value->status == '4') {
														?>
															<span class="badge badge-success">Selesai</span>
														<?php
														}
														?>
													</td>

													<td class="text-center"> <a href="<?= base_url('Owner/cLaporan/detail_transaksi/' . $value->id_transaksi) ?>" class="btn btn-warning">
															<i class="fas fa-info"></i> Detail Transaksi
														</a> </td>
												</tr>
										<?php
											}
										}
										?>
									</tbody>
									<tfoot>

										<tr>
											<th>No</th>
											<th>Nama Supplier</th>
											<th>Tanggal Transaksi</th>
											<th>Total Bayar</th>
											<th>Status Pesanan</th>
											<th class="text-center">Action</th>
										</tr>
									</tfoot>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
					</div>
				</div>
			</div>
			<!-- /.card -->
		</div>
	</div>

	<!-- /.col -->
</div>
