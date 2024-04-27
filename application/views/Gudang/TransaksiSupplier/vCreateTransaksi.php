<div class="main-content">
	<div class="container-fluid">
		<div class="page-header">
			<div class="row align-items-end">
				<div class="col-lg-8">
					<div class="page-header-title">
						<i class="fas fa-shopping-basket bg-blue"></i>
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


		<div class="row">
			<!-- left column -->
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Tambah Data Pesanan Bahan Baku</h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<form action="<?= base_url('Gudang/cTransaksi/addtocart') ?>" method="POST" role="form">
						<div class="card-body">

							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<input type="hidden" name="id_supplier" value="<?= $id_supplier ?>">
										<label for="exampleInputEmail1">Bahan Baku</label>
										<select class="form-control" id="bb" name="bahanbaku" required>
											<option value="">---Pilih Bahan Baku---</option>
											<?php
											foreach ($bb as $key => $value) {
											?>
												<option data-nama="<?= $value->nama_bb ?>" data-harga="<?= $value->harga ?>" value="<?= $value->id_bb ?>"><?= $value->nama_bb ?> <?= $value->keterangan ?></option>
											<?php
											}
											?>

										</select>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group">
										<label for="exampleInputEmail1">Nama Bahan Baku</label>
										<input type="text" name="nama" class="nama form-control" id="exampleInputEmail1" readonly>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="exampleInputPassword1">Harga Bahan Baku</label>
										<input type="number" name="harga" class="harga form-control" id="exampleInputPassword1" readonly>
									</div>
								</div>
							</div>

							<div class="row">

								<div class="col-lg-12">
									<div class="form-group">
										<label for="exampleInputPassword1">Quantity Pesan</label>
										<input type="number" name="qty" class="rekomendasi form-control" id="exampleInputPassword1" required>
									</div>
								</div>
							</div>
						</div>
						<!-- /.card-body -->

						<div class="card-footer">
							<button type="submit" class="btn btn-primary"><i class="fas fa-shopping-basket"></i>Add To Cart</button>
							<a href="<?= base_url('Gudang/cTransaksi') ?>" class="btn btn-danger"><i class="fas fa-step-backward"></i> Kembali</a>
						</div>
					</form>
				</div>
				<!-- /.card -->
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Informasi Keranjang</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body p-0">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama</th>
									<th>Harga</th>
									<th>Quantity</th>
									<th>Subtotal</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($this->cart->contents() as $key => $value) {
								?>
									<tr>
										<td><?= $no++ ?>.</td>
										<td><?= $value['name'] ?></td>
										<td>Rp. <?= number_format($value['price'])  ?></td>
										<td><span class="badge bg-danger"><?= $value['qty'] ?></span></td>
										<td>Rp. <?= number_format($value['price'] * $value['qty'])  ?></td>
										<td><a href="<?= base_url('Gudang/cTransaksi/hapus/' . $value['rowid'] . '/' . $id_supplier) ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a></td>

									</tr>

								<?php
								}
								?>
								<form action="<?= base_url('Gudang/cTransaksi/selesai') ?>" method="POST">
									<input type="hidden" name="id_supplier" value="<?= $id_supplier ?>">

									<tr>
										<td><button type="submit" class="btn btn-success btn-sm"><i class="fas fa-leaf"></i> Selesai</button></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>Total: </td>
										<td><strong>Rp.<?= number_format($this->cart->total())  ?></strong></td>
									</tr>
								</form>
							</tbody>
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


</div>
</div>
