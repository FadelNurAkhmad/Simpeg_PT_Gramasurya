<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
		if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
			echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; " . $_SESSION['pesan'] . " &nbsp; &nbsp; &nbsp;</div></span>";
		}
		$_SESSION['pesan'] = "";
		?>
	</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Dashboard <small>Overview &amp; statistic</small></h1>
<!-- end page-header -->
<?php
include "../../config/koneksi.php";

$jmlpeg	= mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE status_mut='' ORDER BY id_peg DESC");
$jpeg	= mysqli_num_rows($jmlpeg);

$jmlhar	= mysqli_query($koneksi, "SELECT * FROM tb_penghargaan");
$jhar	= mysqli_num_rows($jmlhar);

$jmltug	= mysqli_query($koneksi, "SELECT * FROM tb_penugasan");
$jtug	= mysqli_num_rows($jmltug);

$jmldik	= mysqli_query($koneksi, "SELECT * FROM tb_diklat");
$jdik	= mysqli_num_rows($jmldik);
?>
<!-- begin row -->
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-success fade in m-b-15">
			<strong></span> <i class="fa-lg fa fa-check text-success"></i> &nbsp;Welcome To SIMPEG GRAMASURYA</strong>. Sistem Informasi Manajemen Kepegawaian Gramasurya. Dikembangkan oleh | TIM SPI UAD <span class="close" data-dismiss="alert">&times;</span>
		</div>
	</div>
</div>
<!-- begin row -->
<div class="row">
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-white text-inverse">
			<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-blue"><i class="ion-ios-personadd"></i></div>
			<div class="stats-title">PEGAWAI</div>
			<div class="stats-number"><?= $jpeg ?></div>
			<div class="stats-progress progress">
				<div class="progress-bar" style="width: 90%;"></div>
			</div>
			<div class="stats-desc">Total Data Pegawai</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-white text-inverse">
			<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-red"><i class="ion-ios-star"></i></div>
			<div class="stats-title">PENGHARGAAN</div>
			<div class="stats-number"><?= $jhar ?></div>
			<div class="stats-progress progress">
				<div class="progress-bar" style="width: 90%;"></div>
			</div>
			<div class="stats-desc">Total Data Penghargaan</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-white text-inverse">
			<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-yellow"><i class="ion-ios-world"></i></div>
			<div class="stats-title">PENUGASAN</div>
			<div class="stats-number"><?= $jtug ?></div>
			<div class="stats-progress progress">
				<div class="progress-bar" style="width: 90%;"></div>
			</div>
			<div class="stats-desc">Total Data Penugasan LN</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-white text-inverse">
			<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-green"><i class="ion-ios-flag"></i></div>
			<div class="stats-title">CUTI</div>
			<div class="stats-number"><?= $jdik ?></div>
			<div class="stats-progress progress">
				<div class="progress-bar" style="width: 90%;"></div>
			</div>
			<div class="stats-desc">Total Data Cuti</div>
		</div>
	</div>
	<!-- end col-3 -->
</div>
<!-- end row -->
<div class="row">
	<!-- begin col-6 -->
	<div class="col-md-6">
		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title"><i class="ion-ios-calendar fa-lg text-warning"></i> &nbsp;Berkala Gaji 1 Bulan Kedepan</h4>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead class="thin-border-bottom">
							<tr>
								<th width="25%"><i class="ace-icon fa fa-lock blue"></i> NIP</th>
								<th width="40%"><i class="ace-icon fa fa-caret-right blue"></i> Nama</th>
								<th width="20%"><i class="ace-icon fa fa-caret-right blue"></i> TTL</th>
								<th width="15%" class="hidden-480"><i class="ace-icon fa fa-caret-right blue"></i> Periode</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$nowg	= date('Y-m-d');
							$blng	= date('Y-m-d', strtotime('+1 months', strtotime($nowg)));

							$tampilKgb	= mysqli_query($koneksi, "SELECT * FROM tb_kgb WHERE tgl_kgb BETWEEN '$nowg' AND '$blng'");
							while ($kgb	= mysqli_fetch_array($tampilKgb, MYSQLI_ASSOC)) {
								$idg = $kgb['id_peg'];
								$tampilPegg	= mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$idg'");
								while ($pegg	= mysqli_fetch_array($tampilPegg, MYSQLI_ASSOC)) {
							?>
									<tr>
										<td><?php echo $pegg['nip']; ?></td>
										<td><?php echo $pegg['nama']; ?></td>
										<td><?php echo $pegg['tempat_lhr']; ?>, <?php echo $pegg['tgl_lhr']; ?></td>
										<td><?php echo $kgb['tgl_kgb']; ?></td>
									</tr>
							<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- end col-6 -->
	<!-- begin col-6 -->
	<div class="col-md-6">
		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title"><i class="ion-ios-calendar fa-lg text-warning"></i> &nbsp;Berkala Pangkat 1 Bulan Kedepan</h4>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead class="thin-border-bottom">
							<tr>
								<th width="25%"><i class="ace-icon fa fa-lock blue"></i> NIP</th>
								<th width="40%"><i class="ace-icon fa fa-caret-right blue"></i> Nama</th>
								<th width="20%"><i class="ace-icon fa fa-caret-right blue"></i> TTL</th>
								<th width="15%" class="hidden-480"><i class="ace-icon fa fa-caret-right blue"></i> Periode</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$nowp	= date('Y-m-d');
							$blnp	= date('Y-m-d', strtotime('+1 months', strtotime($nowp)));

							$tampilKpb	= mysqli_query($koneksi, "SELECT * FROM tb_kpb WHERE tgl_kpb BETWEEN '$nowp' AND '$blnp'");
							while ($kpb	= mysqli_fetch_array($tampilKpb, MYSQLI_ASSOC)) {
								$idp = $kpb['id_peg'];
								$tampilPegp	= mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$idp'");
								while ($pegp	= mysqli_fetch_array($tampilPegp, MYSQLI_ASSOC)) {
							?>
									<tr>
										<td><?php echo $pegp['nip']; ?></td>
										<td><?php echo $pegp['nama']; ?></td>
										<td><?php echo $pegp['tempat_lhr']; ?>, <?php echo $pegp['tgl_lhr']; ?></td>
										<td><?php echo $kpb['tgl_kpb']; ?></td>
									</tr>
							<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- end col-6 -->
</div>
<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title"><i class="ion-stats-bars fa-lg text-warning"></i> &nbsp;Statistik Jabatan</h4>
			</div>
			<div class="panel-body">
				<div id="container" class="height-sm"></div>
			</div>
		</div>
	</div>
	<!-- end col-12 -->
</div>
<div class="row">
	<!-- begin col-6 -->
	<div class="col-md-6">
		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title"><i class="ion-ios-calendar fa-lg text-warning"></i> &nbsp;Pensiun Tahun Ini</h4>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead class="thin-border-bottom">
							<tr>
								<th width="25%"><i class="ace-icon fa fa-lock blue"></i> NIP</th>
								<th width="40%"><i class="ace-icon fa fa-caret-right blue"></i> Nama</th>
								<th width="20%"><i class="ace-icon fa fa-caret-right blue"></i> TTL</th>
								<th width="15%" class="hidden-480"><i class="ace-icon fa fa-caret-right blue"></i> Periode</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$datenow = date("Y");
							$nowpen	= mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE tgl_pensiun LIKE '$datenow%' ORDER BY tgl_pensiun");
							while ($now	= mysqli_fetch_array($nowpen, MYSQLI_ASSOC)) {
							?>
								<tr>
									<td><?php echo $now['nip']; ?></td>
									<td><?php echo $now['nama'] ?></td>
									<td><?php echo $now['tempat_lhr'] ?>, <?php echo $now['tgl_lhr'] ?></td>
									<td><?php echo $now['tgl_pensiun'] ?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title"><i class="ion-ios-calendar fa-lg text-warning"></i> &nbsp;Pensiun 1 Tahun Yang Akan Datang</h4>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead class="thin-border-bottom">
							<tr>
								<th width="25%"><i class="ace-icon fa fa-lock blue"></i> NIP</th>
								<th width="40%"><i class="ace-icon fa fa-caret-right blue"></i> Nama</th>
								<th width="20%"><i class="ace-icon fa fa-caret-right blue"></i> TTL</th>
								<th width="15%" class="hidden-480"><i class="ace-icon fa fa-caret-right blue"></i> Periode</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$dateone = date("Y") + 1;
							$onepen	= mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE tgl_pensiun LIKE '$dateone%' ORDER BY tgl_pensiun");
							while ($one	= mysqli_fetch_array($onepen, MYSQLI_ASSOC)) {
							?>
								<tr>
									<td><?php echo $one['nip']; ?></td>
									<td><?php echo $one['nama'] ?></td>
									<td><?php echo $one['tempat_lhr'] ?>, <?php echo $one['tgl_lhr'] ?></td>
									<td><?php echo $one['tgl_pensiun'] ?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title"><i class="ion-ios-calendar fa-lg text-warning"></i> &nbsp;Pensiun 2 Tahun Yang Akan Datang</h4>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead class="thin-border-bottom">
							<tr>
								<th width="25%"><i class="ace-icon fa fa-lock blue"></i> NIP</th>
								<th width="40%"><i class="ace-icon fa fa-caret-right blue"></i> Nama</th>
								<th width="20%"><i class="ace-icon fa fa-caret-right blue"></i> TTL</th>
								<th width="15%" class="hidden-480"><i class="ace-icon fa fa-caret-right blue"></i> Periode</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$datetwo = date("Y") + 2;
							$twopen	= mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE tgl_pensiun LIKE '$datetwo%' ORDER BY tgl_pensiun");
							while ($two	= mysqli_fetch_array($twopen, MYSQLI_ASSOC)) {
							?>
								<tr>
									<td><?php echo $two['nip']; ?></td>
									<td><?php echo $two['nama'] ?></td>
									<td><?php echo $two['tempat_lhr'] ?>, <?php echo $two['tgl_lhr'] ?></td>
									<td><?php echo $two['tgl_pensiun'] ?></td>
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
	<!-- end col-6 -->
	<!-- begin col-6 -->
	<div class="col-md-6">
		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title"><i class="ion-stats-bars fa-lg text-warning"></i> &nbsp;Statistik Golongan</h4>
			</div>
			<div class="panel-body">
				<div id="container1" class="height-sm"></div>
			</div>
		</div>
	</div>
	<!-- end col-6 -->
</div>
<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title"><i class="ion-stats-bars fa-lg text-warning"></i> &nbsp;Statistik Pendidikan</h4>
			</div>
			<div class="panel-body">
				<div id="container2" class="height-sm"></div>
			</div>
		</div>
	</div>
	<!-- end col-12 -->
</div>

<script src="../../assets/js/highcharts.js" type="text/javascript"></script>
<script type="text/javascript">
	var chart1; // globally available
	$(document).ready(function() {
		chart1 = new Highcharts.Chart({
			chart: {
				renderTo: 'container',
				type: 'column'
			},
			title: {
				text: 'Statistik Jabatan'
			},
			xAxis: {
				categories: ['Jabatan']
			},
			yAxis: {
				title: {
					text: 'Jumlah'
				}
			},
			series: [
				<?php
				$sql   = "SELECT * FROM tb_pegawai WHERE status_mut='' GROUP BY jabatan ORDER BY jabatan DESC";
				$query = mysqli_query($koneksi, $sql)  or die(mysqli_error($koneksi));
				while ($ret = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
					$jab	= $ret['jabatan'];

					$sql_jumlah   = "SELECT * FROM tb_pegawai WHERE status_mut='' AND jabatan='$jab'";
					$query_jumlah = mysqli_query($koneksi, $sql_jumlah) or die(mysqli_error($koneksi));
					$data = mysqli_num_rows($query_jumlah);
				?> {
						name: '<?php echo $jab; ?>',
						data: [<?php echo $data; ?>]
					},
				<?php

				}
				?>
			]
		});
	});
</script>
<script type="text/javascript">
	var chart1; // globally available
	$(document).ready(function() {
		chart1 = new Highcharts.Chart({
			chart: {
				renderTo: 'container1',
				type: 'column'
			},
			title: {
				text: 'Statistik Golongan'
			},
			xAxis: {
				categories: ['Golongan']
			},
			yAxis: {
				title: {
					text: 'Jumlah'
				}
			},
			series: [
				<?php
				$sql   = "SELECT * FROM tb_pegawai WHERE status_mut='' GROUP BY urut_pangkat ORDER BY urut_pangkat DESC";
				$query = mysqli_query($koneksi, $sql)  or die(mysqli_error($koneksi));
				while ($ret = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
					$gol	= $ret['urut_pangkat'];

					$sql_jumlah   = "SELECT * FROM tb_pegawai WHERE status_mut='' AND urut_pangkat='$gol'";
					$query_jumlah = mysqli_query($koneksi, $sql_jumlah) or die(mysqli_error($koneksi));
					$data = mysqli_num_rows($query_jumlah);
				?> {
						name: '<?php echo $gol; ?>',
						data: [<?php echo $data; ?>]
					},
				<?php

				}
				?>
			]
		});
	});
</script>
<script type="text/javascript">
	var chart1; // globally available
	$(document).ready(function() {
		chart1 = new Highcharts.Chart({
			chart: {
				renderTo: 'container2',
				type: 'column'
			},
			title: {
				text: 'Statistik Tingkat Pendidikan'
			},
			xAxis: {
				categories: ['Pendidikan']
			},
			yAxis: {
				title: {
					text: 'Jumlah'
				}
			},
			series: [
				<?php
				$sql   = "SELECT * FROM tb_pegawai WHERE status_mut='' GROUP BY sekolah ORDER BY sekolah DESC";
				$query = mysqli_query($koneksi, $sql)  or die(mysqli_error($koneksi));
				while ($ret = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
					$sek	= $ret['sekolah'];

					$sql_jumlah   = "SELECT * FROM tb_pegawai WHERE status_mut='' AND sekolah='$sek'";
					$query_jumlah = mysqli_query($koneksi, $sql_jumlah) or die(mysqli_error($koneksi));
					$data = mysqli_num_rows($query_jumlah);
				?> {
						name: '<?php echo $sek; ?>',
						data: [<?php echo $data; ?>]
					},
				<?php

				}
				?>
			]
		});
	});
</script>
<script>
	// 500 = 0,5 s
	$(document).ready(function() {
		setTimeout(function() {
			$(".pesan").fadeIn('slow');
		}, 500);
	});
	setTimeout(function() {
		$(".pesan").fadeOut('slow');
	}, 7000);
</script>