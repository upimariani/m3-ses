<div class="main-content">
	<div class="container-fluid">
		<div class="page-header">
			<div class="row align-items-end">
				<div class="col-lg-8">
					<div class="page-header-title">
						<i class="ik ik-tag bg-blue"></i>
						<div class="d-inline">
							<h5>Data Bahan Baku Keluar</h5>
							<span>Bahan Baku Keluar</span>
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
							<li class="breadcrumb-item active" aria-current="page">Bahan Baku</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#demoModal"><i class="ik ik-tag"></i>Tambah Data Bahan Baku Keluar</button>
		<div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form action="<?= base_url('Gudang/cBBKeluar/create') ?>" method="POST">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="demoModalLabel">Masukkan Bahan Baku Keluar</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="input-1">Nama Bahan Baku</label>
								<select class="form-control" name="bb" required>
									<option value="">---Pilih Bahan Baku---</option>
									<?php
									foreach ($bb as $key => $value) {
									?>
										<option value="<?= $value->id_detail ?>"><?= $value->nama_bb ?> | Tgl Masuk. <?= $value->tanggal ?> Stok. <?= $value->sisa ?></option>
									<?php
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="input-2">Quantity</label>
								<input type="text" name="qty" class="form-control" id="input-2" placeholder="Masukkan Quantity" required>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</div>
				</form>
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
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3>Informasi Bahan Baku Keluar</h3>

					</div>
					<div class="card-body">
						<table id="data_table" class="table">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Nama Bahan Baku</th>
									<th scope="col">Tanggal Keluar</th>
									<th scope="col">Jumlah</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($bb_keluar as $key => $value) {
								?>
									<tr>
										<th scope="row"><?= $no++ ?></th>
										<td><?= $value->nama_bb ?></td>
										<td><?= $value->tgl_keluar ?></td>
										<td><?= $value->jumlah ?></td>

										<td class="text-center">
											<div class="table-actions">
												<a href="<?= base_url('Gudang/cBBKeluar/delete/' . $value->id_bb_keluar) ?>"><i class="ik ik-trash-2"></i></a>
											</div>
										</td>
									</tr>
								<?php
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>


	</div>
</div>
