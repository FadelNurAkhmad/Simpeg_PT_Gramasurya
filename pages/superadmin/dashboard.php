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


<script src="../../assets/js/highcharts.js" type="text/javascript"></script>

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