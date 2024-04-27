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

		<div class="row">
			<div class="col-md-7">
				<div class="card">
					<div class="card-header">
						<h3>Update Data User</h3>

					</div>
					<div class="card-body">
						<form action="<?= base_url('Admin/cUser/update/' . $user->id_user) ?>" method="POST">
							<div class="form-group">
								<label for="input-1">Nama User</label>
								<input type="text" value="<?= $user->nama ?>" name="nama" class="form-control" id="input-1" placeholder="Masukkan Nama User">

								<?= form_error('nama', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group">
								<label for="input-2">Alamat</label>
								<input type="text" value="<?= $user->alamat ?>" name="alamat" class="form-control" id="input-2" placeholder="Masukkan Alamat">
								<?= form_error('alamat', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group">
								<label for="input-3">No Telepon</label>
								<input type="text" name="no_hp" value="<?= $user->no_hp ?>" class="form-control" id="input-3" placeholder="Masukkan No Telepon">
								<?= form_error('no_hp', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group">
								<label for="input-4">Username</label>
								<input type="text" name="username" value="<?= $user->username ?>" class="form-control" id="input-4" placeholder="Masukkan Username">
								<?= form_error('username', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group">
								<label for="input-5">Password</label>
								<input type="text" name="password" value="<?= $user->password ?>" class="form-control" id="input-5" placeholder="Masukkan Password">
								<?= form_error('password', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group">
								<label for="input-5">Level User</label>
								<select name="level" class="form-control">
									<option value="">---Pilih Level User---</option>
									<option value="1" <?php if ($user->level_user == '1') {
															echo 'selected';
														} ?>>Admin</option>
									<option value="2" <?php if ($user->level_user == '2') {
															echo 'selected';
														} ?>>Supplier</option>
									<option value="3" <?php if ($user->level_user == '3') {
															echo 'selected';
														} ?>>Owner</option>
									<option value="4" <?php if ($user->level_user == '4') {
															echo 'selected';
														} ?>>Gudang</option>
								</select>
								<?= form_error('level', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success px-5"><i class="ik ik-save"></i> Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>


	</div>
</div>
