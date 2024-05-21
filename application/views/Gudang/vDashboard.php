<div class="main-content">
	<div class="container-fluid">
		<?php
		$user = $this->db->query("SELECT COUNT(id_user) as user FROM `user`")->row();
		$bb = $this->db->query("SELECT COUNT(id_bb) as bb FROM `bahan_baku`")->row();
		$pendapatan = $this->db->query("SELECT SUM(total) as total FROM `transaksi` WHERE status='4'")->row();
		$supplier = $this->db->query("SELECT COUNT(id_user) as user FROM `user` WHERE level_user='2'")->row();
		?>
		<div class="row clearfix">
			<div class="col-lg-3 col-md-6 col-sm-12">
				<div class="widget">
					<div class="widget-body">
						<div class="d-flex justify-content-between align-items-center">
							<div class="state">
								<h6>User</h6>
								<h2><?= $user->user ?></h2>
							</div>
							<div class="icon">
								<i class="ik ik-award"></i>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12">
				<div class="widget">
					<div class="widget-body">
						<div class="d-flex justify-content-between align-items-center">
							<div class="state">
								<h6>Bahan Baku</h6>
								<h2><?= $bb->bb ?></h2>
							</div>
							<div class="icon">
								<i class="ik ik-thumbs-up"></i>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12">
				<div class="widget">
					<div class="widget-body">
						<div class="d-flex justify-content-between align-items-center">
							<div class="state">
								<h6>Pendapatan</h6>
								<h4>Rp. <?= number_format($pendapatan->total) ?></h4>
							</div>
							<div class="icon">
								<i class="ik ik-calendar"></i>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12">
				<div class="widget">
					<div class="widget-body">
						<div class="d-flex justify-content-between align-items-center">
							<div class="state">
								<h6>Supplier</h6>
								<h2><?= $supplier->user ?></h2>
							</div>
							<div class="icon">
								<i class="ik ik-message-square"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="alert alert-success" role="alert">
			Selamat Datang Gudang!
		</div>
	</div>
</div>
