<div class="main-content">
	<div class="container-fluid">
		<div class="page-header">
			<div class="row align-items-end">
				<div class="col-lg-8">
					<div class="page-header-title">
						<i class="ik ik-user-plus bg-blue"></i>
						<div class="d-inline">
							<h5>Data User</h5>
							<span>Akun login user</span>
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
							<li class="breadcrumb-item active" aria-current="page">User</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		<a href="<?= base_url('Admin/cUser/create') ?>" class="btn btn-success mb-3"><i class="ik ik-user-plus"></i>Tambah Data User</a>
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
						<h3>Informasi User</h3>

					</div>
					<div class="card-body">
						<table id="data_table" class="table">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Nama User</th>
									<th scope="col">Alamat</th>
									<th scope="col">No Telepon</th>
									<th scope="col">Username</th>
									<th scope="col">Password</th>
									<th scope="col">Level User</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($user as $key => $value) {
								?>
									<tr>
										<th scope="row"><?= $no++ ?></th>
										<td><?= $value->nama ?></td>
										<td><?= $value->alamat ?></td>
										<td><?= $value->no_hp ?></td>
										<td><?= $value->username ?></td>
										<td><?= $value->password ?></td>
										<td><?php if ($value->level_user == '1') {
											?>
												<span class="badge badge-success">Admin</span>
											<?php
											} else if ($value->level_user == '2') {
											?>
												<span class="badge badge-warning">Supplier</span>
											<?php
											} else if ($value->level_user == '3') {
											?>
												<span class="badge badge-info">Owner</span>
											<?php
											} else if ($value->level_user == '4') {
											?>
												<span class="badge badge-danger">Gudang</span>
											<?php
											}
											?>
										</td>
										<td class="text-center">
											<div class="table-actions">
												<a href="<?= base_url('Admin/cUser/update/' . $value->id_user) ?>"><i class="ik ik-edit-2"></i></a>
												<a href="<?= base_url('Admin/cUser/delete/' . $value->id_user) ?>"><i class="ik ik-trash-2"></i></a>
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
