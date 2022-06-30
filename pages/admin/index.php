<?php
ob_start();
session_start();
if (!isset($_SESSION['id_user'])) {
	die("<b>Oops!</b> Access Failed.
		<p>Sistem Logout. Anda harus melakukan Login kembali.</p>
		<button type='button' onclick=location.href='../../'>Back</button>");
}
if ($_SESSION['hak_akses'] != "Admin") {
	die("<b>Oops!</b> Access Failed.
		<p>Anda Bukan Admin.</p>
		<button type='button' onclick=location.href='../../'>Back</button>");
}
include "../../config/koneksi.php";
$tampilUsr	= mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user='$_SESSION[id_user]'");
$usr		= mysqli_fetch_array($tampilUsr);

$tampilPeg	= mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE status_mut=''");
$jmlpeg		= mysqli_num_rows($tampilPeg);

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<title>Aplikasi Sistem Informasi Manajemen Kepegawaian | Gramasurya</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="Aplikasi Sistem Informasi Manajemen Kepegawaian SIMPEG Berbasis Web" name="description" />
	<meta content="aplikasi simpeg berbasis web, aplikasi simpeg, simpeg berbasis web" name="keywords" />
	<meta content="TIM SPI UAD" name="author" />
	<link rel="shortcut icon" href="../../logo-grama.png" type="image/x-icon" />
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="../../assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="../../assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
	<link href="../../assets/css/animate.min.css" rel="stylesheet" />
	<link href="../../assets/css/style.min.css" rel="stylesheet" />
	<link href="../../assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="../../assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="../../assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
	<link href="../../assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<link href="../../assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="../../assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="../../assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />

	<link href="../../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="../../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="../../assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="../../assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="../../assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="../../assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="../../assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="../../assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="../../assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="../../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="../../assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="../../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="../../assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="../../assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="../../assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="../../assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="../../assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="../../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
	<script src="../../assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>

<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="./" class="navbar-brand"><span><img alt="simpeg" src="../../assets/img/logo-grama.png" width="35" height="35"></span> &nbsp;<b>GRAMASURYA</b></a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				<!-- begin navbar-collapse -->
				<div class="collapse navbar-collapse pull-left" id="top-navbar">
					<ul class="nav navbar-nav">
						<li><a href="javascript:;" data-click="sidebar-minify"><i class="ion-navicon-round m-r-5 f-s-20 pull-left text-inverse"></i></a></li>
					</ul>
				</div>
				<!-- end navbar-collapse -->
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li>
						<form action="index.php?page=direct-search" method="POST" enctype="multipart/form-data" class="navbar-form full-width">
							<div class="form-group">
								<input type="text" name="nama" class="form-control" placeholder="Masukan Nama Pegawai" required />
								<button type="submit" name="search" value="search" class="btn btn-search"><i class="ion-ios-search-strong"></i></button>
							</div>
						</form>
					</li>
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<span class="user-image online">
								<?php
								if (empty($usr['avatar']))
									echo "<img src='../../assets/img/no-avatar.jpg' alt='simpeg' />";
								else
									echo "<img src='../../assets/img/$usr[avatar]' alt='simpeg' />";
								?>
							</span>
							<span class="hidden-xs"><span class="text-warning">Welcome , </span><?= $usr['nama_user'] ?></span> <span class="text-warning"><i class="fa fa-caret-down"></i></span>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="index.php?page=form-ganti-password&id_user=<?= $_SESSION['id_user'] ?>"><i class="ion-ios-locked"></i> &nbsp;Change Password</a></li>
							<li class="divider"></li>
							<li><a href="../../restric/logout.php"><i class="ion-power"></i> &nbsp;Log Out</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<div class="image">
							<a href="javascript:;">
								<?php
								if (empty($usr['avatar']))
									echo "<img src='../../assets/img/no-avatar.jpg' alt='simpeg' />";
								else
									echo "<img src='../../assets/img/$usr[avatar]' alt='simpeg' />";
								?>
							</a>
						</div>
						<div class="info">
							<?= $usr['nama_user'] ?>
							<small><?= $usr['hak_akses'] ?></small>
						</div>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Navigation <i class="fa fa-paper-plane m-l-5"></i></li>
					<li><a href="./"><i class="ion-ios-pulse-strong bg-blue"></i><span>Dashboard</span> <span class="badge bg-primary pull-right">HOME</span></a></li>
					<li><a href="index.php?page=form-view-data-pegawai"><i class="ion-ios-personadd bg-pink"></i><span>Data Pegawai</span></a></li>
					<li class="has-sub">
						<a href="javascript:;"><b class="caret pull-right"></b><i class="ion-ios-people bg-purple"></i><span>Riwayat Keluarga</span></a>
						<ul class="sub-menu">
							<li><a href="index.php?page=form-master-data-si"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Suami / Istri</a></li>
							<li><a href="index.php?page=form-master-data-anak"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Anak</a></li>
							<li><a href="index.php?page=form-master-data-ortu"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Orang Tua</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;"><b class="caret pull-right"></b><i class="ion-university bg-success"></i><span>Riwayat Pendidikan</span></a>
						<ul class="sub-menu">
							<li><a href="index.php?page=form-master-data-sekolah"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Sekolah</a></li>
							<li><a href="index.php?page=form-master-data-bahasa"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Bahasa</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;"><b class="caret pull-right"></b><i class="ion-filing bg-info"></i><span>Kepegawaian &nbsp; <span class="label label-warning m-l-5">7</span></span></a>
						<ul class="sub-menu">
							<li><a href="index.php?page=form-master-data-jabatan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Jabatan</a></li>
							<!-- <li><a href="index.php?page=form-master-data-pangkat"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Pangkat</a></li> -->
							<li><a href="index.php?page=form-master-data-hukuman"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Hukuman</a></li>
							<li><a href="index.php?page=form-master-data-dokumen"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Dokumen Pegawai</a></li>
							<!-- <li><a href="index.php?page=form-master-data-diklat"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Diklat</a></li> -->
							<li><a href="index.php?page=form-master-data-penghargaan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Penghargaan</a></li>
							<li><a href="index.php?page=form-master-data-penugasan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Penugasan</a></li>
							<!-- <li><a href="index.php?page=form-master-data-seminar"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Seminar</a></li> -->
							<!-- <li><a href="index.php?page=form-master-data-cuti"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Cuti</a></li> -->
							<!-- <li><a href="index.php?page=form-master-data-lat-jabatan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Latihan Jabatan</a></li> -->
							<li><a href="index.php?page=form-master-data-tunjangan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Tunjangan</a></li>
							<li><a href="index.php?page=form-master-data-kawin"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Izin Kawin</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-calendar bg-purple"></i><span>Cuti</span></a>
						<ul class="sub-menu">
							<li><a href="index.php?page=form-view-cuti"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Data Cuti</a></li>
							<li><a href="index.php?page=form-view-jatah-cuti"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Jatah Cuti Pegawai</a></li>
							<li><a href="index.php?page=form-view-jenis-cuti"><i class="menu-icon fa fa-caret-right"></i> &nbsp;List Jenis Cuti</a></li>
						</ul>
					</li>
					<!-- <li><a href="index.php?page=form-master-data-mutasi"><i class="ion-arrow-swap bg-grey"></i><span>Mutasi</span></a></li> -->
					<li><a href="index.php?page=form-master-data-skp"><i class="ion-social-buffer bg-warning"></i><span>SKP</span></a></li>
					<li class="has-sub">
						<a href="javascript:;"><b class="caret pull-right"></b><i class="ion-compose bg-primary"></i><span>Presensi</span></a>
						<ul class="sub-menu">
							<li><a href="index.php?page=form-view-rekap-presensi"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Rekap Presensi</a></li>
							<li><a href="index.php?page=form-view-data-presensi"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Jadwal Kerja Pegawai</a></li>
							<li><a href="index.php?page=form-view-shift-kerja"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Konfigurasi Shift</a></li>
							<li><a href="index.php?page=form-view-hari-jam-kerja"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Konfigurasi Jadwal Kerja</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;"><i class="ion-arrow-shrink bg-info"></i><span>Rekapitulasi</span> <span class="badge bg-danger pull-right"><span class="ion-stats-bars"></span></span></a>
						<ul class="sub-menu">
							<!-- <li><a href="index.php?page=rekap-golongan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Golongan</a></li> -->
							<li><a href="index.php?page=rekap-jabatan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Jabatan</a></li>
							<li><a href="index.php?page=rekap-pendidikan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Pendidikan</a></li>
							<!-- <li><a href="index.php?page=rekap-skpd"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Unit Kerja</a></li> -->
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;"><b class="caret pull-right"></b><i class="ion-printer"></i><span>Report</span></a>
						<ul class="sub-menu">
							<li><a href="index.php?page=nominatif"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Nominatif</a></li>
							<!-- <li><a href="index.php?page=daftar-urut-kepangkatan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;DUK</a></li> -->
							<li><a href="index.php?page=bezetting"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Bezetting</a></li>
							<li><a href="index.php?page=keadaan-pegawai"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Keadaan Pegawai</a></li>
							<!-- <li><a href="index.php?page=pre-pensiun"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Pensiun</a></li> -->
						</ul>
					</li>
					<!-- <li><a href="index.php?page=pre-report-kgb"><i class="fa fa-file-excel-o bg-success"></i><span>Report KGB</span></a></li> -->
					<li><a href="index.php?page=backup-data"><i class="ion-ios-cloud bg-blue"></i><span>Backup Database</span></a></li>
					<!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn grey" data-click="sidebar-minify"><i class="ion-ios-arrow-left"></i> <span>Collapse</span></a></li>
					<!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		<!-- begin #content -->
		<div id="content" class="content">
			<?php
			$page = (isset($_GET['page'])) ? $_GET['page'] : "main";
			switch ($page) {
				case 'form-view-data-pegawai':
					include "../../pages/admin/pegawai/form-view-data-pegawai.php";
					break;
				case 'form-master-data-pegawai':
					include "../../pages/admin/pegawai/form-master-data-pegawai.php";
					break;
				case 'master-data-pegawai':
					include "../../pages/admin/pegawai/master-data-pegawai.php";
					break;
				case 'form-edit-data-pegawai':
					include "../../pages/admin/pegawai/form-edit-data-pegawai.php";
					break;
				case 'edit-data-pegawai':
					include "../../pages/admin/pegawai/edit-data-pegawai.php";
					break;
				case 'delete-data-pegawai':
					include "../../pages/admin/pegawai/delete-data-pegawai.php";
					break;
				case 'detail-data-pegawai':
					include "../../pages/admin/pegawai/detail-data-pegawai.php";
					break;
				case 'form-ganti-foto':
					include "../../pages/admin/pegawai/form-ganti-foto.php";
					break;
				case 'ganti-foto':
					include "../../pages/admin/pegawai/ganti-foto.php";
					break;

				case 'form-master-data-si':
					include "../../pages/admin/keluarga/si/form-master-data-si.php";
					break;
				case 'master-data-si':
					include "../../pages/admin/keluarga/si/master-data-si.php";
					break;
				case 'form-edit-data-si':
					include "../../pages/admin/keluarga/si/form-edit-data-si.php";
					break;
				case 'edit-data-si':
					include "../../pages/admin/keluarga/si/edit-data-si.php";
					break;
				case 'delete-data-si':
					include "../../pages/admin/keluarga/si/delete-data-si.php";
					break;

				case 'form-master-data-anak':
					include "../../pages/admin/keluarga/anak/form-master-data-anak.php";
					break;
				case 'master-data-anak':
					include "../../pages/admin/keluarga/anak/master-data-anak.php";
					break;
				case 'form-edit-data-anak':
					include "../../pages/admin/keluarga/anak/form-edit-data-anak.php";
					break;
				case 'edit-data-anak':
					include "../../pages/admin/keluarga/anak/edit-data-anak.php";
					break;
				case 'delete-data-anak':
					include "../../pages/admin/keluarga/anak/delete-data-anak.php";
					break;

				case 'form-master-data-ortu':
					include "../../pages/admin/keluarga/ortu/form-master-data-ortu.php";
					break;
				case 'master-data-ortu':
					include "../../pages/admin/keluarga/ortu/master-data-ortu.php";
					break;
				case 'form-edit-data-ortu':
					include "../../pages/admin/keluarga/ortu/form-edit-data-ortu.php";
					break;
				case 'edit-data-ortu':
					include "../../pages/admin/keluarga/ortu/edit-data-ortu.php";
					break;
				case 'delete-data-ortu':
					include "../../pages/admin/keluarga/ortu/delete-data-ortu.php";
					break;

				case 'form-master-data-sekolah':
					include "../../pages/admin/pendidikan/sekolah/form-master-data-sekolah.php";
					break;
				case 'master-data-sekolah':
					include "../../pages/admin/pendidikan/sekolah/master-data-sekolah.php";
					break;
				case 'form-edit-data-sekolah':
					include "../../pages/admin/pendidikan/sekolah/form-edit-data-sekolah.php";
					break;
				case 'edit-data-sekolah':
					include "../../pages/admin/pendidikan/sekolah/edit-data-sekolah.php";
					break;
				case 'delete-data-sekolah':
					include "../../pages/admin/pendidikan/sekolah/delete-data-sekolah.php";
					break;
				case 'set-pendidikan-akhir':
					include "../../pages/admin/pendidikan/sekolah/set-pendidikan-akhir.php";
					break;

				case 'form-master-data-bahasa':
					include "../../pages/admin/pendidikan/bahasa/form-master-data-bahasa.php";
					break;
				case 'master-data-bahasa':
					include "../../pages/admin/pendidikan/bahasa/master-data-bahasa.php";
					break;
				case 'form-edit-data-bahasa':
					include "../../pages/admin/pendidikan/bahasa/form-edit-data-bahasa.php";
					break;
				case 'edit-data-bahasa':
					include "../../pages/admin/pendidikan/bahasa/edit-data-bahasa.php";
					break;
				case 'delete-data-bahasa':
					include "../../pages/admin/pendidikan/bahasa/delete-data-bahasa.php";
					break;

				case 'form-master-data-jabatan':
					include "../../pages/admin/kepeg/jabatan/form-master-data-jabatan.php";
					break;
				case 'master-data-jabatan':
					include "../../pages/admin/kepeg/jabatan/master-data-jabatan.php";
					break;
				case 'form-edit-data-jabatan':
					include "../../pages/admin/kepeg/jabatan/form-edit-data-jabatan.php";
					break;
				case 'edit-data-jabatan':
					include "../../pages/admin/kepeg/jabatan/edit-data-jabatan.php";
					break;
				case 'delete-data-jabatan':
					include "../../pages/admin/kepeg/jabatan/delete-data-jabatan.php";
					break;
				case 'set-jabatan-sekarang':
					include "../../pages/admin/kepeg/jabatan/set-jabatan-sekarang.php";
					break;

				case 'masterjab':
					include "../../pages/admin/kepeg/jabatan/masterjab.php";
					break;
				case 'form-edit-masterjab':
					include "../../pages/admin/kepeg/jabatan/form-edit-masterjab.php";
					break;
				case 'edit-masterjab':
					include "../../pages/admin/kepeg/jabatan/edit-masterjab.php";
					break;
				case 'delete-masterjab':
					include "../../pages/admin/kepeg/jabatan/delete-masterjab.php";
					break;

				case 'masteresl':
					include "../../pages/admin/kepeg/jabatan/masteresl.php";
					break;
				case 'form-edit-masteresl':
					include "../../pages/admin/kepeg/jabatan/form-edit-masteresl.php";
					break;
				case 'edit-masteresl':
					include "../../pages/admin/kepeg/jabatan/edit-masteresl.php";
					break;
				case 'delete-masteresl':
					include "../../pages/admin/kepeg/jabatan/delete-masteresl.php";
					break;

				case 'form-master-data-pangkat':
					include "../../pages/admin/kepeg/pangkat/form-master-data-pangkat.php";
					break;
				case 'master-data-pangkat':
					include "../../pages/admin/kepeg/pangkat/master-data-pangkat.php";
					break;
				case 'form-edit-data-pangkat':
					include "../../pages/admin/kepeg/pangkat/form-edit-data-pangkat.php";
					break;
				case 'edit-data-pangkat':
					include "../../pages/admin/kepeg/pangkat/edit-data-pangkat.php";
					break;
				case 'delete-data-pangkat':
					include "../../pages/admin/kepeg/pangkat/delete-data-pangkat.php";
					break;
				case 'set-pangkat-sekarang':
					include "../../pages/admin/kepeg/pangkat/set-pangkat-sekarang.php";
					break;

				case 'mastergol':
					include "../../pages/admin/kepeg/pangkat/mastergol.php";
					break;
				case 'form-edit-mastergol':
					include "../../pages/admin/kepeg/pangkat/form-edit-mastergol.php";
					break;
				case 'edit-mastergol':
					include "../../pages/admin/kepeg/pangkat/edit-mastergol.php";
					break;
				case 'delete-mastergol':
					include "../../pages/admin/kepeg/pangkat/delete-mastergol.php";
					break;

				case 'form-master-data-hukuman':
					include "../../pages/admin/kepeg/hukum/form-master-data-hukuman.php";
					break;
				case 'master-data-hukuman':
					include "../../pages/admin/kepeg/hukum/master-data-hukuman.php";
					break;
				case 'form-edit-data-hukuman':
					include "../../pages/admin/kepeg/hukum/form-edit-data-hukuman.php";
					break;
				case 'edit-data-hukuman':
					include "../../pages/admin/kepeg/hukum/edit-data-hukuman.php";
					break;
				case 'delete-data-hukuman':
					include "../../pages/admin/kepeg/hukum/delete-data-hukuman.php";
					break;

				case 'form-master-data-dokumen':
					include "../../pages/admin/kepeg/dokumen/form-master-data-dokumen.php";
					break;
				case 'master-data-dokumen':
					include "../../pages/admin/kepeg/dokumen/master-data-dokumen.php";
					break;
				case 'form-edit-data-dokumen':
					include "../../pages/admin/kepeg/dokumen/form-edit-data-dokumen.php";
					break;
				case 'edit-data-dokumen':
					include "../../pages/admin/kepeg/dokumen/edit-data-dokumen.php";
					break;
				case 'delete-data-dokumen':
					include "../../pages/admin/kepeg/dokumen/delete-data-dokumen.php";
					break;
				case 'masterdok':
					include "../../pages/admin/kepeg/masterdok.php";
					break;

				case 'form-master-data-diklat':
					include "../../pages/admin/kepeg/diklat/form-master-data-diklat.php";
					break;
				case 'master-data-diklat':
					include "../../pages/admin/kepeg/diklat/master-data-diklat.php";
					break;
				case 'form-edit-data-diklat':
					include "../../pages/admin/kepeg/diklat/form-edit-data-diklat.php";
					break;
				case 'edit-data-diklat':
					include "../../pages/admin/kepeg/diklat/edit-data-diklat.php";
					break;
				case 'delete-data-diklat':
					include "../../pages/admin/kepeg/diklat/delete-data-diklat.php";
					break;

				case 'form-master-data-penghargaan':
					include "../../pages/admin/kepeg/harga/form-master-data-penghargaan.php";
					break;
				case 'master-data-penghargaan':
					include "../../pages/admin/kepeg/harga/master-data-penghargaan.php";
					break;
				case 'form-edit-data-penghargaan':
					include "../../pages/admin/kepeg/harga/form-edit-data-penghargaan.php";
					break;
				case 'edit-data-penghargaan':
					include "../../pages/admin/kepeg/harga/edit-data-penghargaan.php";
					break;
				case 'delete-data-penghargaan':
					include "../../pages/admin/kepeg/harga/delete-data-penghargaan.php";
					break;

				case 'form-master-data-penugasan':
					include "../../pages/admin/kepeg/tugas/form-master-data-penugasan.php";
					break;
				case 'master-data-penugasan':
					include "../../pages/admin/kepeg/tugas/master-data-penugasan.php";
					break;
				case 'form-edit-data-penugasan':
					include "../../pages/admin/kepeg/tugas/form-edit-data-penugasan.php";
					break;
				case 'edit-data-penugasan':
					include "../../pages/admin/kepeg/tugas/edit-data-penugasan.php";
					break;
				case 'delete-data-penugasan':
					include "../../pages/admin/kepeg/tugas/delete-data-penugasan.php";
					break;

				case 'form-master-data-seminar':
					include "../../pages/admin/kepeg/seminar/form-master-data-seminar.php";
					break;
				case 'master-data-seminar':
					include "../../pages/admin/kepeg/seminar/master-data-seminar.php";
					break;
				case 'form-edit-data-seminar':
					include "../../pages/admin/kepeg/seminar/form-edit-data-seminar.php";
					break;
				case 'edit-data-seminar':
					include "../../pages/admin/kepeg/seminar/edit-data-seminar.php";
					break;
				case 'delete-data-seminar':
					include "../../pages/admin/kepeg/seminar/delete-data-seminar.php";
					break;

				case 'form-master-data-cuti':
					include "../../pages/admin/kepeg/cuti/form-master-data-cuti.php";
					break;
				case 'master-data-cuti':
					include "../../pages/admin/kepeg/cuti/master-data-cuti.php";
					break;
				case 'form-edit-data-cuti':
					include "../../pages/admin/kepeg/cuti/form-edit-data-cuti.php";
					break;
				case 'edit-data-cuti':
					include "../../pages/admin/kepeg/cuti/edit-data-cuti.php";
					break;
				case 'delete-data-cuti':
					include "../../pages/admin/kepeg/cuti/delete-data-cuti.php";
					break;
				case 'detail-data-cuti':
					include "../../pages/admin/kepeg/cuti/detail-data-cuti.php";
					break;

				case 'form-master-data-lat-jabatan':
					include "../../pages/admin/kepeg/latjab/form-master-data-lat-jabatan.php";
					break;
				case 'master-data-lat-jabatan':
					include "../../pages/admin/kepeg/latjab/master-data-lat-jabatan.php";
					break;
				case 'form-edit-data-lat-jabatan':
					include "../../pages/admin/kepeg/latjab/form-edit-data-lat-jabatan.php";
					break;
				case 'edit-data-lat-jabatan':
					include "../../pages/admin/kepeg/latjab/edit-data-lat-jabatan.php";
					break;
				case 'delete-data-lat-jabatan':
					include "../../pages/admin/kepeg/latjab/delete-data-lat-jabatan.php";
					break;

				case 'form-master-data-tunjangan':
					include "../../pages/admin/kepeg/tunjangan/form-master-data-tunjangan.php";
					break;
				case 'master-data-tunjangan':
					include "../../pages/admin/kepeg/tunjangan/master-data-tunjangan.php";
					break;
				case 'form-edit-data-tunjangan':
					include "../../pages/admin/kepeg/tunjangan/form-edit-data-tunjangan.php";
					break;
				case 'edit-data-tunjangan':
					include "../../pages/admin/kepeg/tunjangan/edit-data-tunjangan.php";
					break;
				case 'delete-data-tunjangan':
					include "../../pages/admin/kepeg/tunjangan/delete-data-tunjangan.php";
					break;
				case 'detail-data-tunjangan':
					include "../../pages/admin/kepeg/tunjangan/detail-data-tunjangan.php";
					break;

				case 'form-master-data-kawin':
					include "../../pages/admin/kepeg/kawin/form-master-data-kawin.php";
					break;
				case 'master-data-kawin':
					include "../../pages/admin/kepeg/kawin/master-data-kawin.php";
					break;
				case 'form-edit-data-kawin':
					include "../../pages/admin/kepeg/kawin/form-edit-data-kawin.php";
					break;
				case 'edit-data-kawin':
					include "../../pages/admin/kepeg/kawin/edit-data-kawin.php";
					break;
				case 'delete-data-kawin':
					include "../../pages/admin/kepeg/kawin/delete-data-kawin.php";
					break;
				case 'detail-data-kawin':
					include "../../pages/admin/kepeg/kawin/detail-data-kawin.php";
					break;

				case 'form-master-data-mutasi':
					include "../../pages/admin/kepeg/mutasi/form-master-data-mutasi.php";
					break;
				case 'master-data-mutasi':
					include "../../pages/admin/kepeg/mutasi/master-data-mutasi.php";
					break;
				case 'form-edit-data-mutasi':
					include "../../pages/admin/kepeg/mutasi/form-edit-data-mutasi.php";
					break;
				case 'edit-data-mutasi':
					include "../../pages/admin/kepeg/mutasi/edit-data-mutasi.php";
					break;
				case 'delete-data-mutasi':
					include "../../pages/admin/kepeg/mutasi/delete-data-mutasi.php";
					break;

				case 'form-view-cuti':
					include "../../pages/admin/cuti/data_cuti/form-view-cuti.php";
					break;
				case 'form-master-cuti':
					include "../../pages/admin/cuti/data_cuti/form-master-cuti.php";
					break;
				case 'form-edit-cuti':
					include "../../pages/admin/cuti/data_cuti/form-edit-cuti.php";
					break;
				case 'master-cuti':
					include "../../pages/admin/cuti/data_cuti/master-cuti.php";
					break;
				case 'delete-cuti':
					include "../../pages/admin/cuti/data_cuti/delete-cuti.php";
					break;
				case 'edit-cuti':
					include "../../pages/admin/cuti/data_cuti/edit-cuti.php";
					break;
				case 'status-cuti':
					include "../../pages/admin/cuti/data_cuti/status-cuti.php";
					break;
				case 'detail-cuti':
					include "../../pages/admin/cuti/data_cuti/detail-cuti.php";
					break;

				case 'form-view-jenis-cuti':
					include "../../pages/admin/cuti/jenis_cuti/form-view-jenis-cuti.php";
					break;
				case 'form-edit-jenis-cuti':
					include "../../pages/admin/cuti/jenis_cuti/form-edit-jenis-cuti.php";
					break;
				case 'form-master-jenis-cuti':
					include "../../pages/admin/cuti/jenis_cuti/form-master-jenis-cuti.php";
					break;
				case 'master-jenis-cuti':
					include "../../pages/admin/cuti/jenis_cuti/master-jenis-cuti.php";
					break;
				case 'edit-jenis-cuti':
					include "../../pages/admin/cuti/jenis_cuti/edit-jenis-cuti.php";
					break;
				case 'delete-jenis-cuti':
					include "../../pages/admin/cuti/jenis_cuti/delete-jenis-cuti.php";
					break;

				case 'form-view-jatah-cuti':
					include "../../pages/admin/cuti/jatah_cuti/form-view-jatah-cuti.php";
					break;
				case 'form-master-jatah-cuti':
					include "../../pages/admin/cuti/jatah_cuti/form-master-jatah-cuti.php";
					break;
				case 'form-edit-jatah-cuti':
					include "../../pages/admin/cuti/jatah_cuti/form-edit-jatah-cuti.php";
					break;
				case 'master-jatah-cuti':
					include "../../pages/admin/cuti/jatah_cuti/master-jatah-cuti.php";
					break;
				case 'edit-jatah-cuti':
					include "../../pages/admin/cuti/jatah_cuti/edit-jatah-cuti.php";
					break;
				case 'delete-jatah-cuti':
					include "../../pages/admin/cuti/jatah_cuti/delete-jatah-cuti.php";
					break;

				case 'form-master-data-skp':
					include "../../pages/admin/skp/form-master-data-skp.php";
					break;
				case 'master-data-skp':
					include "../../pages/admin/skp/master-data-skp.php";
					break;
				case 'form-edit-data-skp':
					include "../../pages/admin/skp/form-edit-data-skp.php";
					break;
				case 'edit-data-skp':
					include "../../pages/admin/skp/edit-data-skp.php";
					break;
				case 'delete-data-skp':
					include "../../pages/admin/skp/delete-data-skp.php";
					break;
				case 'detail-data-skp':
					include "../../pages/admin/skp/detail-data-skp.php";
					break;

				case 'form-view-data-presensi':
					include "../../pages/admin/presensi/data_presensi/form-view-data-presensi.php";
					break;
				case 'form-edit-data-presensi':
					include "../../pages/admin/presensi/data_presensi/form-edit-data-presensi.php";
					break;
				case 'edit-data-presensi':
					include "../../pages/admin/presensi/data_presensi/edit-data-presensi.php";
					break;
				case 'form-master-data-presensi':
					include "../../pages/admin/presensi/data_presensi/form-master-data-presensi.php";
					break;
				case 'master-data-presensi':
					include "../../pages/admin/presensi/data_presensi/master-data-presensi.php";
					break;
				case 'delete-data-presensi':
					include "../../pages/admin/presensi/data_presensi/delete-data-presensi.php";
					break;

				case 'form-view-pengaturan-mesin':
					include "../../pages/admin/presensi/mesin/form-view-pengaturan-mesin.php";
					break;
				case 'form-master-pengaturan-mesin':
					include "../../pages/admin/presensi/mesin/form-master-pengaturan-mesin.php";
					break;
				case 'form-edit-pengaturan-mesin':
					include "../../pages/admin/presensi/mesin/form-edit-pengaturan-mesin.php";
					break;

				case 'form-view-shift-kerja':
					include "../../pages/admin/presensi/shift/form-view-shift-kerja.php";
					break;
				case 'form-master-shift-kerja':
					include "../../pages/admin/presensi/shift/form-master-shift-kerja.php";
					break;
				case 'master-shift-kerja':
					include "../../pages/admin/presensi/shift/master-shift-kerja.php";
					break;
				case 'form-edit-shift-kerja':
					include "../../pages/admin/presensi/shift/form-edit-shift-kerja.php";
					break;
				case 'edit-shift-kerja':
					include "../../pages/admin/presensi/shift/edit-shift-kerja.php";
					break;
				case 'delete-shift-kerja':
					include "../../pages/admin/presensi/shift/delete-shift-kerja.php";
					break;

				case 'form-view-hari-jam-kerja':
					include "../../pages/admin/presensi/hari_jam_kerja/form-view-hari-jam-kerja.php";
					break;
				case 'form-master-hari-jam-kerja':
					include "../../pages/admin/presensi/hari_jam_kerja/form-master-hari-jam-kerja.php";
					break;
				case 'master-hari-jam-kerja':
					include "../../pages/admin/presensi/hari_jam_kerja/master-hari-jam-kerja.php";
					break;
				case 'form-edit-hari-jam-kerja':
					include "../../pages/admin/presensi/hari_jam_kerja/form-edit-hari-jam-kerja.php";
					break;
				case 'edit-hari-jam-kerja':
					include "../../pages/admin/presensi/hari_jam_kerja/edit-hari-jam-kerja.php";
					break;
				case 'delete-hari-jam-kerja':
					include "../../pages/admin/presensi/hari_jam_kerja/delete-hari-jam-kerja.php";
					break;

				case 'form-view-rekap-presensi':
					include "../../pages/admin/presensi/rekap/form-view-rekap-presensi.php";
					break;

				case 'form-view-data-attlog':
					include "../../pages/admin/presensi/attlog/form-view-data-attlog.php";
					break;

				case 'rekap-golongan':
					include "../../pages/admin/rekap/rekap-golongan.php";
					break;
				case 'rekap-jabatan':
					include "../../pages/admin/rekap/rekap-jabatan.php";
					break;
				case 'rekap-pendidikan':
					include "../../pages/admin/rekap/rekap-pendidikan.php";
					break;
				case 'rekap-skpd':
					include "../../pages/admin/rekap/rekap-skpd.php";
					break;

				case 'daftar-urut-kepangkatan':
					include "../../pages/admin/report/daftar-urut-kepangkatan.php";
					break;
				case 'bezetting':
					include "../../pages/admin/report/bezetting.php";
					break;
				case 'keadaan-pegawai':
					include "../../pages/admin/report/keadaan-pegawai.php";
					break;
				case 'nominatif':
					include "../../pages/admin/report/nominatif.php";
					break;
				case 'pre-pensiun':
					include "../../pages/admin/report/pre-pensiun.php";
					break;
				case 'pensiun':
					include "../../pages/admin/report/pensiun.php";
					break;

				case 'pre-report-kgb':
					include "../../pages/admin/kgb/pre-report-kgb.php";
					break;
				case 'report-kgb':
					include "../../pages/admin/kgb/report-kgb.php";
					break;
				case 'form-master-data-kgb':
					include "../../pages/admin/kgb/form-master-data-kgb.php";
					break;
				case 'master-data-kgb':
					include "../../pages/admin/kgb/master-data-kgb.php";
					break;
				case 'form-edit-data-kgb':
					include "../../pages/admin/kgb/form-edit-data-kgb.php";
					break;
				case 'edit-data-kgb':
					include "../../pages/admin/kgb/edit-data-kgb.php";
					break;
				case 'delete-data-kgb':
					include "../../pages/admin/kgb/delete-data-kgb.php";
					break;
				case 'detail-data-kgb':
					include "../../pages/admin/kgb/detail-data-kgb.php";
					break;

				case 'backup-data':
					include "../../pages/admin/backup/backup-data.php";
					break;

				case 'form-ganti-password':
					include "../../pages/admin/form-ganti-password.php";
					break;
				case 'ganti-password':
					include "../../pages/admin/ganti-password.php";
					break;

				case 'direct-search':
					include "../../pages/admin/direct-search.php";
					break;

				default:
					include '../../pages/admin/dashboard.php';
			}
			?>
		</div>
		<!-- end #content -->
		<!-- begin #footer -->
		<div id="footer" class="footer">
			&copy; 2022. <a href="https://gramasurya.com/">GRAMASURYA</a> - All Rights Reserved
		</div>
		<!-- end #footer -->
		<!-- begin theme-panel -->
		<div class="theme-panel">
			<a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="ion-ios-cog"></i></a>
			<div class="theme-panel-content">
				<h5 class="m-t-0">Color Theme</h5>
				<ul class="theme-list clearfix">
					<li class="active"><a href="javascript:;" class="bg-blue" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-green" data-theme="green" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Green">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-black" data-theme="black" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
				</ul>
				<div class="divider"></div>
				<div class="row m-t-10">
					<div class="col-md-5 control-label double-line">Header Styling</div>
					<div class="col-md-7">
						<select name="header-styling" class="form-control input-sm">
							<option value="1">default</option>
							<option value="2">inverse</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-5 control-label">Header</div>
					<div class="col-md-7">
						<select name="header-fixed" class="form-control input-sm">
							<option value="1">fixed</option>
							<option value="2">default</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-5 control-label double-line">Sidebar Styling</div>
					<div class="col-md-7">
						<select name="sidebar-styling" class="form-control input-sm">
							<option value="1">default</option>
							<option value="2">grid</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-5 control-label">Sidebar</div>
					<div class="col-md-7">
						<select name="sidebar-fixed" class="form-control input-sm">
							<option value="1">fixed</option>
							<option value="2">default</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-5 control-label double-line">Sidebar Gradient</div>
					<div class="col-md-7">
						<select name="content-gradient" class="form-control input-sm">
							<option value="1">disabled</option>
							<option value="2">enabled</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-12">
						<hr />
					</div>
				</div>
			</div>
		</div>
		<!-- end theme-panel -->
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-primary btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="../../assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="../../assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="../../assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="../../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../../assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="../../assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="../../assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="../../assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="../../assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="../../assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="../../assets/plugins/sparkline/jquery.sparkline.js"></script>
	<script src="../../assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
	<script src="../../assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="../../assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
	<script src="../../assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="../../assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="../../assets/js/table-manage-responsive.demo.min.js"></script>

	<script src="../../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="../../assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
	<script src="../../assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="../../assets/plugins/masked-input/masked-input.min.js"></script>
	<script src="../../assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="../../assets/plugins/password-indicator/js/password-indicator.js"></script>
	<script src="../../assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="../../assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="../../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<script src="../../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
	<script src="../../assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
	<script src="../../assets/plugins/bootstrap-daterangepicker/moment.js"></script>
	<script src="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="../../assets/plugins/select2/dist/js/select2.min.js"></script>
	<script src="../../assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="../../assets/plugins/bootstrap-show-password/bootstrap-show-password.js"></script>
	<script src="../../assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
	<script src="../../assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
	<script src="../../assets/plugins/clipboard/clipboard.min.js"></script>
	<script src="../../assets/js/form-plugins.demo.min.js"></script>
	<script src="../../assets/js/dashboard.min.js"></script>
	<script src="../../assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
			TableManageResponsive.init();
			FormPlugins.init();
		});
	</script>
</body>

</html>