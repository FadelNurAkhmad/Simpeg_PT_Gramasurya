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

$jmlpeg    = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_status='1' ORDER BY pegawai_id DESC");
$jpeg    = mysqli_num_rows($jmlpeg);

$jmlhar    = mysqli_query($koneksi, "SELECT * FROM tb_penghargaan");
$jhar    = mysqli_num_rows($jmlhar);

$jmltug    = mysqli_query($koneksi, "SELECT * FROM tb_penugasan");
$jtug    = mysqli_num_rows($jmltug);

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
			<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-yellow"><i class="fa fa-calendar"></i></icon>
			</div>
			<div class="stats-title">TANGGAL</div>
			<div class="stats-number">
				<?= date("d M Y"); ?>
			</div>
			<div class="stats-progress progress">
				<div class="progress-bar" style="width: 90%;"></div>
			</div>
			<div class="stats-desc">Tanggal Sekarang</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-white text-inverse">
			<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-green"><i class="ion-ios-time"></i></div>
			<div class="stats-title">WAKTU</div>
			<div class="stats-number">
				<?php
				date_default_timezone_set("Asia/jakarta");
				?>
				<p><span id="jam"></span></p>
			</div>
			<div class="stats-progress progress">
				<div class="progress-bar" style="width: 90%;"></div>
			</div>
			<div class="stats-desc">Waktu Sekarang</div>
		</div>
	</div>
	<!-- end col-3 -->
</div>
<!-- end row -->

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
				<h4 class="panel-title"><i class="ion-ios-calendar fa-lg text-warning"></i> &nbsp;Pengajuan Cuti</h4>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead class="thin-border-bottom">
							<tr>
								<th width="25%"><i class="ace-icon fa fa-lock blue"></i> NIP</th>
								<th width="40%"><i class="ace-icon fa fa-caret-right blue"></i> Nama</th>
								<th width="20%"><i class="ace-icon fa fa-caret-right blue"></i> Tgl Pengajuan</th>
								<th width="15%" class="hidden-480"><i class="ace-icon fa fa-caret-right blue"></i> Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$tampilCuti    = mysqli_query(
								$koneksi,
								"SELECT tb_data_cuti.id_cuti, tb_data_cuti.id_peg, tb_data_cuti.tanggal_cuti, tb_data_cuti.tanggal_mulai, tb_data_cuti.tanggal_selesai, tb_data_cuti.lama_cuti, tb_data_cuti.jumlah_cuti, tb_data_cuti.jenis_cuti, tb_data_cuti.keperluan, tb_data_cuti.status, pegawai.pegawai_nip, pegawai.pegawai_nama
    							FROM tb_data_cuti
    							INNER JOIN pegawai ON tb_data_cuti.id_peg=pegawai.pegawai_id ORDER BY id_cuti DESC LIMIT 7"
							);
							while ($cuti    = mysqli_fetch_array($tampilCuti)) {
							?>
								<tr>
									<td><?php echo $cuti == 0 ? '-' : $cuti['pegawai_nip']; ?></td>
									<td><?php echo $cuti['pegawai_nama'] ?></td>
									<td><?php echo $cuti['tanggal_cuti'] ?></td>
									<td><?php
										if ($cuti['status'] == 'Process') {
											echo '<span class="badge badge-primary">PROCESS</span>';
										} else if ($cuti['status'] == 'Approve') {
											echo '<span class="badge badge-success">APPROVED</span>';
										} else if ($cuti['status'] == 'Reject') {
											echo '<span class="badge badge-danger">REJECTED</span>';
										}
										?>
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
				<h4 class="panel-title"><i class="ion-stats-bars fa-lg text-warning"></i> &nbsp;Statistik Pendidikan</h4>
			</div>
			<div class="panel-body">
				<div id="container1" class="height-sm"></div>
			</div>
		</div>
	</div>
	<!-- end col-6 -->
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
				$sql   = "SELECT * FROM pembagian1 GROUP BY pembagian1_nama ORDER BY pembagian1_nama DESC";
				$query = mysqli_query($koneksi, $sql)  or die(mysqli_error($koneksi));
				while ($ret = mysqli_fetch_array($query)) {
					$jab = $ret['pembagian1_nama'];

					$sql_jumlah   = "SELECT * FROM pegawai WHERE pegawai_status='1' AND pembagian1_id=$ret[pembagian1_id]";
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
				$sql   = "SELECT * FROM tb_sekolah GROUP BY tingkat ORDER BY tingkat DESC";
				$query = mysqli_query($koneksi, $sql)  or die(mysqli_error($koneksi));
				while ($ret = mysqli_fetch_array($query)) {
					$sek	= $ret['tingkat'];

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

<script type="text/javascript">
	window.onload = function() {
		jam();
	}

	function jam() {
		var e = document.getElementById('jam'),
			d = new Date(),
			h, m, s;
		h = d.getHours();
		m = set(d.getMinutes());
		s = set(d.getSeconds());

		e.innerHTML = h + ':' + m + ':' + s;

		setTimeout('jam()', 1000);
	}

	function set(e) {
		e = e < 10 ? '0' + e : e;
		return e;
	}
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