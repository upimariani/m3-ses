<footer class="footer">
	<div class="w-100 clearfix">
		<span class="text-center text-sm-left d-md-inline-block">TOKO HADI - KUNINGAN</span>
	</div>
</footer>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
	window.jQuery || document.write('<script src="<?= base_url('asset/themekit-master/') ?>src/js/vendor/jquery-3.3.1.min.js"><\/script>')
</script>
<script src="<?= base_url('asset/themekit-master/') ?>node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="<?= base_url('asset/themekit-master/') ?>node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url('asset/themekit-master/') ?>node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script src="<?= base_url('asset/themekit-master/') ?>node_modules/screenfull/dist/screenfull.js"></script>
<script src="<?= base_url('asset/themekit-master/') ?>node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('asset/themekit-master/') ?>node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('asset/themekit-master/') ?>dist/js/theme.min.js"></script>
<script src="<?= base_url('asset/themekit-master/') ?>js/datatables.js"></script>
<script src="<?= base_url('asset/chart/js_chart.js') ?>"></script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
	(function(b, o, i, l, e, r) {
		b.GoogleAnalyticsObject = l;
		b[l] || (b[l] =
			function() {
				(b[l].q = b[l].q || []).push(arguments)
			});
		b[l].l = +new Date;
		e = o.createElement(i);
		r = o.getElementsByTagName(i)[0];
		e.src = 'https://www.google-analytics.com/analytics.js';
		r.parentNode.insertBefore(e, r)
	}(window, document, 'script', 'ga'));
	ga('create', 'UA-XXXXX-X', 'auto');
	ga('send', 'pageview');
</script>
<script>
	$(function() {
		$("#example1").DataTable({
			"responsive": true,
			"autoWidth": false,
		});


		$('.example1').DataTable({
			"responsive": true,
			"autoWidth": true,
		});
	});
</script>
<script>
	<?php
	$jml_data = $this->db->query("SELECT SUM(qty) as jumlah, id_barang, MONTH(tgl_pengajuan) FROM `pengajuan` JOIN detail_pengajuan ON pengajuan.id_pengajuan=detail_pengajuan.id_pengajuan GROUP BY MONTH(tgl_pengajuan), id_barang")->result();
	foreach ($jml_data as $key => $value) {
		if ($value->id_barang == '1') {
			$beras[] = $value->jumlah;
		} else if ($value->id_barang == '2') {
			$gulpas[] = $value->jumlah;
		} else if ($value->id_barang == '3') {
			$minyak[] = $value->jumlah;
		} else if ($value->id_barang == '4') {
			$terigu[] = $value->jumlah;
		} else if ($value->id_barang == '5') {
			$telor[] = $value->jumlah;
		} else if ($value->id_barang == '6') {
			$susu[] = $value->jumlah;
		}
	}
	?>
	Highcharts.chart('container', {
		chart: {
			type: 'spline'
		},
		title: {
			text: 'Grafik Permintaan Barang Supplier'
		},
		subtitle: {
			text: 'Hasil dari Permintaan Barang Kepada Supplier'
		},
		xAxis: {
			categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
				'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
			],
			accessibility: {
				description: 'Months of the year'
			}
		},
		yAxis: {
			title: {
				text: 'Jumlah Permintaan'
			},
			labels: {
				format: '{value}'
			}
		},
		tooltip: {
			crosshairs: true,
			shared: true
		},
		plotOptions: {
			spline: {
				marker: {
					radius: 4,
					lineColor: '#666666',
					lineWidth: 1
				}
			}
		},
		series: [{
				name: 'Beras',
				marker: {
					symbol: 'square'
				},
				data: [<?php for ($brs = 0; $brs < sizeof($beras); $brs++) {
							echo $beras[$brs], ',';
						} ?>]
			}, {
				name: 'Gula Pasir Putih',
				marker: {
					symbol: 'diamond'
				},
				data: [<?php for ($gul = 0; $gul < sizeof($gulpas); $gul++) {
							echo $gulpas[$gul], ',';
						} ?>]
			},
			{
				name: 'Minyak',
				marker: {
					symbol: 'circle'
				},
				data: [<?php for ($min = 0; $min < sizeof($minyak); $min++) {
							echo $minyak[$min], ',';
						} ?>]
			},
			{
				name: 'Terigu Segitiga',
				marker: {
					symbol: 'triangle'
				},
				data: [<?php for ($ter = 0; $ter < sizeof($terigu); $ter++) {
							echo $terigu[$ter], ',';
						} ?>]
			},
			{
				name: 'Telor',
				marker: {
					symbol: 'cross'
				},
				data: [<?php for ($tel = 0; $tel < sizeof($telor); $tel++) {
							echo $telor[$tel], ',';
						} ?>]
			},
			{
				name: 'Susu',
				marker: {
					symbol: 'plus'
				},
				data: [<?php for ($sus = 0; $sus < sizeof($susu); $sus++) {
							echo $susu[$sus], ',';
						} ?>]
			}
		]
	});
</script>
</body>

</html>