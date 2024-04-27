<body>
	<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

	<div class="wrapper">
		<header class="header-top" header-theme="light">
			<div class="container-fluid">
				<div class="d-flex justify-content-between">
					<div class="top-menu d-flex align-items-center">
						<button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
						<div class="header-search">
							<div class="input-group">
								<span class="input-group-addon search-close"><i class="ik ik-x"></i></span>
							</div>
						</div>
						<button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
					</div>
					<div class="top-menu d-flex align-items-center">



					</div>
				</div>
			</div>
		</header>

		<div class="page-wrap">
			<div class="app-sidebar colored">
				<div class="sidebar-header">
					<a class="header-brand" href="index.html">
						<div class="logo-img">
							<img src="<?= base_url('asset/themekit-master/') ?>src/img/brand-white.svg" class="header-brand-img" alt="lavalite">
						</div>
						<span class="text">M3</span>
					</a>
					<button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
					<button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
				</div>

				<div class="sidebar-content">
					<div class="nav-container">
						<nav id="main-menu-navigation" class="navigation-main">
							<div class="nav-lavel">Navigation</div>
							<div class="nav-item <?php if ($this->uri->segment(1) == 'Gudang' && $this->uri->segment(2) == 'cDashboard') {
														echo 'active';
													}  ?>">
								<a href="<?= base_url('Gudang/cDashboard') ?>"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
							</div>

							<div class="nav-lavel">TRANSAKSI</div>

							<div class="nav-item <?php if ($this->uri->segment(1) == 'Gudang' && $this->uri->segment(2) == 'cTransaksi') {
														echo 'active';
													}  ?>">
								<a href="<?= base_url('Gudang/cTransaksi') ?>"><i class="ik ik-shopping-cart"></i><span>Transaksi</span></a>
							</div>


							<div class="nav-lavel">BAHAN BAKU KELUAR</div>

							<div class="nav-item <?php if ($this->uri->segment(1) == 'Gudang' && $this->uri->segment(2) == 'cBBKeluar') {
														echo 'active';
													}  ?>">

								<a href="<?= base_url('Gudang/cBBKeluar') ?>"><i class="ik ik-tag"></i><span>Bahan Baku Keluar</span></a>
							</div>
							<div class="nav-lavel">ANALISIS</div>

							<div class="nav-item <?php if ($this->uri->segment(1) == 'Gudang' && $this->uri->segment(2) == 'cPeramalan') {
														echo 'active';
													}  ?>">
								<a href="<?= base_url('Gudang/cPeramalan') ?>"><i class="ik ik-pie-chart"></i><span>Forecasting</span></a>
							</div>

							<div class="nav-item">
								<a href="<?= base_url('cLogin/logout') ?>"><i class="ik ik-power"></i><span>LogOut</span></a>
							</div>
						</nav>
					</div>
				</div>
			</div>