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
									<select class="form-control" name="periode">
										<option value="">---Pilih Periode---</option>
										<option value="1">Januari 2023</option>
										<option value="2">Februari 2023</option>
										<option value="3">Maret 2023</option>
										<option value="4">April 2023</option>
										<option value="5">Mei 2023</option>
										<option value="6">Juni 2023</option>
										<option value="7">Juli 2023</option>
										<option value="8">Agustus 2023</option>
										<option value="9">September 2023</option>
										<option value="10">Oktober 2023</option>
										<option value="11">November 2023</option>
										<option value="12">Desember 2023</option>
										<option value="13">Januari 2024</option>
										<option value="14">Februari 2024</option>
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
											if ($value->stat_pengajuan == '4') {

										?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $value->nama_supp ?></td>
													<td><?= $value->tgl_pengajuan ?></td>
													<td>Rp. <?= number_format($value->total_pengajuan)  ?></td>

													<td><?php
														if ($value->stat_pengajuan == '0') {
														?>
															<span class="badge badge-danger">Belum Bayar</span>
														<?php
														} else if ($value->stat_pengajuan == '1') {
														?>
															<span class="badge badge-warning">Menunggu Konfirmasi</span>
														<?php
														} else if ($value->stat_pengajuan == '2') {
														?>
															<span class="badge badge-info">Pesanan Diproses</span>
														<?php
														} else if ($value->stat_pengajuan == '3') {
														?>
															<span class="badge badge-primary">Pesanan Dikirim</span>
														<?php
														} else if ($value->stat_pengajuan == '4') {
														?>
															<span class="badge badge-success">Selesai</span>
														<?php
														}
														?>
													</td>

													<td class="text-center"> <a href="<?= base_url('Owner/cLaporan/detail_transaksi/' . $value->id_pengajuan) ?>" class="btn btn-warning">
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
