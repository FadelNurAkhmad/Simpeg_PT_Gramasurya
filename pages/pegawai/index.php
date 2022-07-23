<?php
ob_start();
session_start();
if (!isset($_SESSION['id_user'])) {
	die("<b>Oops!</b> Access Failed.
		<p>Sistem Logout. Anda harus melakukan Login kembali.</p>
		<button type='button' onclick=location.href='../../'>Back</button>");
}
if ($_SESSION['hak_akses'] != "Pegawai") {
	die("<b>Oops!</b> Access Failed.
		<p>Anda Bukan Pegawai.</p>
		<button type='button' onclick=location.href='../../'>Back</button>");
}
include "../../config/koneksi.php";
$tampilUsr	= mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user='$_SESSION[id_user]'");
$usr		= mysqli_fetch_array($tampilUsr);

$tampilPeg	= mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id ='$usr[id_peg]'");
$peg		= mysqli_fetch_array($tampilPeg);
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
							<li><a href="index.php?page=form-ganti-password&id_user=<?= $_SESSION['id_peg'] ?>"><i class="ion-ios-locked"></i> &nbsp;Change Password</a></li>
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
							<small><?= $usr['hak_akses'] ?> | <?= $usr['id_peg'] ?></small>
						</div>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Navigation <i class="fa fa-paper-plane m-l-5"></i></li>
					<li><a href="./"><i class="ion-ios-pulse-strong bg-blue"></i><span>Profile Saya</span> <span class="badge bg-blue pull-right">HOME</span></a></li>
					<!-- <li><a href="index.php?page=form-master-cuti&id_user=<?= $_SESSION['id_user'] ?>"><i class="fa fa-calendar bg-pink"></i><span>Form Pengajuan Cuti</span></a></li> -->
					<li class="has-sub">
						<a href="index.php?page=form-view-rekap-presensi"><i class="ion-compose bg-warning"></i><span>Rekap Presensi</span></a>
					</li>
					<li class="has-sub">
						<a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-calendar bg-pink"></i><span>Form Pengajuan Cuti</span></a>
						<ul class="sub-menu">
							<li><a href="index.php?page=form-master-cuti&pegawai_id=<?= $peg['pegawai_id'] ?>"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Pengajuan Cuti Tahunan</a></li>
							<li><a href="index.php?page=form-master-cuti-umum&pegawai_id=<?= $peg['pegawai_id'] ?>"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Pengajuan Izin</a></li>
							<li><a href="index.php?page=form-view-cuti&pegawai_id=<?= $peg['pegawai_id'] ?>"><i class="menu-icon fa fa-caret-right"></i> &nbsp;List Data Cuti Tahunan</a></li>
							<li><a href="index.php?page=form-view-cuti-umum&pegawai_id=<?= $peg['pegawai_id'] ?>"><i class="menu-icon fa fa-caret-right"></i> &nbsp;List Data Izin</a></li>
						</ul>
					</li>
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
				case 'detail-data-skp':
					include "../../pages/pegawai/skp/detail-data-skp.php";
					break;
				case 'detail-pegawai-kpi':
					include "../../pages/pegawai/kpi/detail-pegawai-kpi.php";
					break;
				case 'detail-data-kgb':
					include "../../pages/pegawai/kgb/detail-data-kgb.php";
					break;
				case 'detail-data-cuti':
					include "../../pages/pegawai/kepeg/cuti/detail-data-cuti.php";
					break;

				case 'detail-pegawai-data-gaji-konfigurasi':
					include "../../pages/pegawai/gaji/detail-pegawai-data-gaji-konfigurasi.php";
					break;
				case 'print-detail-konfigurasi-slip-gaji':
					include "../../pages/pegawai/gaji/print-detail-konfigurasi-slip-gaji.php";
					break;

				case 'detail-data-tunjangan':
					include "../../pages/pegawai/kepeg/tunjangan/detail-data-tunjangan.php";
					break;
				case 'detail-data-kawin':
					include "../../pages/pegawai/kepeg/kawin/detail-data-kawin.php";
					break;

				case 'form-view-cuti':
					include "../../pages/pegawai/cuti/tahunan_cuti/form-view-cuti.php";
					break;
				case 'form-master-cuti':
					include "../../pages/pegawai/cuti/tahunan_cuti/form-master-cuti.php";
					break;
				case 'form-edit-cuti':
					include "../../pages/pegawai/cuti/tahunan_cuti/form-edit-cuti.php";
					break;
				case 'edit-cuti':
					include "../../pages/pegawai/cuti/tahunan_cuti/edit-cuti.php";
					break;
				case 'master-cuti':
					include "../../pages/pegawai/cuti/tahunan_cuti/master-cuti.php";
					break;
				case 'detail-cuti':
					include "../../pages/pegawai/cuti/tahunan_cuti/detail-cuti.php";
					break;
				case 'delete-cuti':
					include "../../pages/pegawai/cuti/tahunan_cuti/delete-cuti.php";
					break;
				case 'print-cuti':
					include "../../pages/pegawai/cuti/tahunan_cuti/print-cuti.php";
					break;

				case 'form-view-cuti-umum':
					include "../../pages/pegawai/cuti/umum_cuti/form-view-cuti-umum.php";
					break;
				case 'form-master-cuti-umum':
					include "../../pages/pegawai/cuti/umum_cuti/form-master-cuti-umum.php";
					break;
				case 'master-cuti-umum':
					include "../../pages/pegawai/cuti/umum_cuti/master-cuti-umum.php";
					break;
				case 'detail-cuti-umum':
					include "../../pages/pegawai/cuti/umum_cuti/detail-cuti-umum.php";
					break;
				case 'delete-cuti-umum':
					include "../../pages/pegawai/cuti/umum_cuti/delete-cuti-umum.php";
					break;
				case 'print-cuti-umum':
					include "../../pages/pegawai/cuti/umum_cuti/print-cuti-umum.php";
					break;

				case 'form-view-rekap-presensi':
					include "../../pages/pegawai/presensi/rekap/form-view-rekap-presensi.php";
					break;

				case 'form-ganti-password':
					include "../../pages/pegawai/form-ganti-password.php";
					break;
				case 'ganti-password':
					include "../../pages/pegawai/ganti-password.php";
					break;
				case 'print-biodata-pegawai':
					include "../../pages/pegawai/report/print-biodata-pegawai.php";
					break;

				default:
					include '../../pages/pegawai/my-profile.php';
			}
			?>
		</div>
		<!-- end #content -->
		<!-- begin #footer -->
		<div id="footer" class="footer">
			&copy; 2022. <a href="https://gramasurya.com/">GRAMASURYA</a> - All Rights Reserved
		</div>
		<!-- end #footer -->

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