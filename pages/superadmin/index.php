<?php
ob_start();
session_start();
if (!isset($_SESSION['id_user'])) {
    die("<b>Oops!</b> Access Failed.
		<p>Sistem Logout. Anda harus melakukan Login kembali.</p>
		<button type='button' onclick=location.href='../../'>Back</button>");
}
if ($_SESSION['hak_akses'] != "Superadmin") {
    die("<b>Oops!</b> Access Failed.
		<p>Anda Bukan Superadmin.</p>
		<button type='button' onclick=location.href='../../'>Back</button>");
}
include "../../config/koneksi.php";
$tampilUsr    = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user='$_SESSION[id_user]'");
$usr        = mysqli_fetch_array($tampilUsr);

$query = mysqli_query($koneksi, "SELECT * FROM pegawai");
while ($row = mysqli_fetch_array($query)) {
    $cekPeg = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE pegawai_id=$row[pegawai_id]"));

    if ($cekPeg <= 0) {
        $insert = mysqli_query($koneksi, "INSERT INTO tb_pegawai (pegawai_id) VALUES ('$row[pegawai_id]')");
    }

    if ($row['pegawai_status'] == 1) {
        $cekUsr = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_peg=$row[pegawai_id]"));
        if ($cekUsr <= 0) {
            $password    = password_hash("123", PASSWORD_DEFAULT);
            $insertusr = mysqli_query($koneksi, "INSERT INTO tb_user (id_user, nama_user, password, hak_akses, id_peg) VALUES ('$row[pegawai_nip]', '$row[pegawai_nama]', '$password', 'Pegawai', '$row[pegawai_id]')");
        }
    }
}

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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKH2F9gZMQyATwBodQsEr-uM0fokVCvZw&callback=initMap"></script>

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
                                <input type="text" name="pegawai_nama" class="form-control" placeholder="Masukan Nama Pegawai" required />
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
                    <li class="has-sub">
                        <a href="javascript:;"><b class="caret pull-right"></b><i class="ion-ios-gear bg-pink"></i><span>Master Setup</span></a>
                        <ul class="sub-menu">
                            <li><a href="index.php?page=form-view-setup-perusahaan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Perusahaan</a></li>
                            <li><a href="index.php?page=form-view-data-user"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Admin</a></li>
                            <li><a href="index.php?page=form-view-data-userpeg"><i class="menu-icon fa fa-caret-right"></i> &nbsp;User Pegawai</a></li>
                            <li><a href="index.php?page=form-view-pengaturan-mesin"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Mesin</a></li>
                        </ul>
                    </li>
                    <li><a href="index.php?page=form-view-data-pegawai"><i class="ion-ios-personadd bg-purple"></i><span>Data Pegawai</span></a></li>
                    <li class="has-sub">
                        <a href="javascript:;"><b class="caret pull-right"></b><i class="ion-ios-people bg-success"></i><span>Riwayat Keluarga</span></a>
                        <ul class="sub-menu">
                            <li><a href="index.php?page=form-master-data-si"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Suami / Istri</a></li>
                            <li><a href="index.php?page=form-master-data-anak"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Anak</a></li>
                            <li><a href="index.php?page=form-master-data-ortu"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Orang Tua</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;"><b class="caret pull-right"></b><i class="ion-university bg-info"></i><span>Riwayat Pendidikan</span></a>
                        <ul class="sub-menu">
                            <li><a href="index.php?page=form-master-data-sekolah"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Sekolah</a></li>
                            <li><a href="index.php?page=form-master-data-bahasa"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Bahasa</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;"><b class="caret pull-right"></b><i class="ion-filing bg-grey"></i><span>Kepegawaian &nbsp; <span class="label label-warning m-l-5">7</span></span></a>
                        <ul class="sub-menu">
                            <li><a href="index.php?page=form-master-data-jabatan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Jabatan</a></li>
                            <li><a href="index.php?page=form-master-data-pembinaan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Pembinaan</a></li>
                            <li><a href="index.php?page=form-master-data-dokumen"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Dokumen Pegawai</a></li>
                            <li><a href="index.php?page=form-master-data-penghargaan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Penghargaan</a></li>
                            <li><a href="index.php?page=form-master-data-penugasan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Penugasan</a></li>
                            <li><a href="index.php?page=form-master-data-tunjangan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Tunjangan</a></li>
                            <li><a href="index.php?page=form-master-data-kawin"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Izin Kawin</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-calendar bg-purple"></i><span>Cuti / Izin</span></a>
                        <ul class="sub-menu">
                            <li><a href="index.php?page=form-view-cuti"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Cuti Tahunan</a></li>
                            <li><a href="index.php?page=form-view-jatah-cuti"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Jatah Cuti Tahunan</a></li>
                            <li><a href="index.php?page=form-view-cuti-umum"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Izin</a></li>
                            <li><a href="index.php?page=form-view-jenis-cuti"><i class="menu-icon fa fa-caret-right"></i> &nbsp;List Jenis Izin</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;"><i class="fa fa-calendar bg-success"></i><span>Approval Cuti/Izin</span> <span class="badge bg-warning pull-right"><span class="fa fa-check"></span></span></a>
                        <ul class="sub-menu">
                            <li><a href="index.php?page=form-view-approval-tahap1"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Approval Tahap 1</a></li>
                            <li><a href="index.php?page=form-view-approval-tahap2"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Approval Tahap 2</a></li>
                        </ul>
                    </li>
                    <li><a href="index.php?page=form-master-data-mutasi"><i class="ion-arrow-swap bg-warning"></i><span>Mutasi</span></a></li>
                    <li class="has-sub">
                        <a href="javascript:;"><b class="caret pull-right"></b><i class="ion-social-buffer bg-pink"></i><span>KPI</span></a>
                        <ul class="sub-menu">
                            <li><a href="index.php?page=form-view-kpi"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Data KPI</a></li>
                            <li><a href="index.php?page=form-view-divisi-kpi"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Divisi Perusahaan</a></li>
                        </ul>
                    </li>
                    <!-- gaji -->
                    <li><a href="index.php?page=form-view-data-gaji-konfigurasi"><i class="ion-social-usd bg-success"></i><span>Gaji Pegawai</span></a></li>
                    <!-- end gaji -->
                    <li class="has-sub">
                        <a href="javascript:;"><b class="caret pull-right"></b><i class="ion-compose bg-primary"></i><span>Presensi</span></a>
                        <ul class="sub-menu">
                            <li><a href="index.php?page=form-view-rekap-presensi"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Rekap Presensi</a></li>
                            <li><a href="index.php?page=form-view-data-jadwal-kerja-pegawai"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Jadwal Kerja Pegawai</a></li>
                            <li><a href="index.php?page=form-view-shift-kerja"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Konfigurasi Shift</a></li>
                            <li><a href="index.php?page=form-view-hari-jam-kerja"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Konfigurasi Jadwal Kerja</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-map-marker bg-warning"></i><span>Lokasi</span></a>
                        <ul class="sub-menu">
                            <li><a href="index.php?page=form-view-lokasi"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Lokasi Tipe 1</a></li>
                            <li><a href="index.php?page=form-view-tempat"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Lokasi Tipe 2</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;"><i class="ion-arrow-shrink bg-info"></i><span>Rekapitulasi</span> <span class="badge bg-danger pull-right"><span class="ion-stats-bars"></span></span></a>
                        <ul class="sub-menu">
                            <li><a href="index.php?page=rekap-unit-kerja"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Unit Kerja</a></li>
                            <li><a href="index.php?page=rekap-pendidikan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Pendidikan</a></li>

                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;"><b class="caret pull-right"></b><i class="ion-printer"></i><span>Report</span></a>
                        <ul class="sub-menu">
                            <li><a href="index.php?page=nominatif"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Nominatif</a></li>
                            <li><a href="index.php?page=daftar-urut-kepangkatan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;DUK</a></li>
                            <li><a href="index.php?page=bezetting"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Bezetting</a></li>
                        </ul>
                    </li>
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

                case 'form-view-setup-perusahaan':
                    include "../../pages/superadmin/setup/perusahaan/form-view-setup-perusahaan.php";
                    break;
                case 'form-setup-perusahaan':
                    include "../../pages/superadmin/setup/perusahaan/form-setup-perusahaan.php";
                    break;
                case 'setup-perusahaan':
                    include "../../pages/superadmin/setup/perusahaan/setup-perusahaan.php";
                    break;


                case 'form-view-data-unit':
                    include "../../pages/superadmin/unit/form-view-data-unit.php";
                    break;
                case 'form-master-data-unit':
                    include "../../pages/superadmin/unit/form-master-data-unit.php";
                    break;
                case 'master-unit':
                    include "../../pages/superadmin/unit/master-unit.php";
                    break;
                case 'form-edit-data-unit':
                    include "../../pages/superadmin/unit/form-edit-data-unit.php";
                    break;
                case 'edit-unit':
                    include "../../pages/superadmin/unit/edit-unit.php";
                    break;
                case 'delete-unit':
                    include "../../pages/superadmin/unit/delete-unit.php";
                    break;

                case 'form-view-data-user':
                    include "../../pages/superadmin/user/form-view-data-user.php";
                    break;
                case 'form-master-data-user':
                    include "../../pages/superadmin/user/form-master-data-user.php";
                    break;
                case 'master-data-user':
                    include "../../pages/superadmin/user/master-data-user.php";
                    break;
                case 'form-edit-data-user':
                    include "../../pages/superadmin/user/form-edit-data-user.php";
                    break;
                case 'edit-data-user':
                    include "../../pages/superadmin/user/edit-data-user.php";
                    break;
                case 'delete-data-user':
                    include "../../pages/superadmin/user/delete-data-user.php";
                    break;
                case 'reset-password':
                    include "../../pages/superadmin/user/reset-password.php";
                    break;

                case 'form-view-data-userpeg':
                    include "../../pages/superadmin/userpeg/form-view-data-userpeg.php";
                    break;
                case 'reset-passwordpeg':
                    include "../../pages/superadmin/userpeg/reset-passwordpeg.php";
                    break;

                case 'form-view-data-pegawai':
                    include "../../pages/superadmin/pegawai/form-view-data-pegawai.php";
                    break;
                case 'form-master-data-pegawai':
                    include "../../pages/superadmin/pegawai/form-master-data-pegawai.php";
                    break;
                case 'master-data-pegawai':
                    include "../../pages/superadmin/pegawai/master-data-pegawai.php";
                    break;
                case 'form-edit-data-pegawai':
                    include "../../pages/superadmin/pegawai/form-edit-data-pegawai.php";
                    break;
                case 'edit-data-pegawai':
                    include "../../pages/superadmin/pegawai/edit-data-pegawai.php";
                    break;
                case 'delete-data-pegawai':
                    include "../../pages/superadmin/pegawai/delete-data-pegawai.php";
                    break;
                case 'detail-data-pegawai':
                    include "../../pages/superadmin/pegawai/detail-data-pegawai.php";
                    break;
                case 'form-ganti-foto':
                    include "../../pages/superadmin/pegawai/form-ganti-foto.php";
                    break;
                case 'ganti-foto':
                    include "../../pages/superadmin/pegawai/ganti-foto.php";
                    break;
                case 'import-pegawai':
                    include "../../pages/superadmin/pegawai/import-pegawai.php";
                    break;
                case 'export-pegawai':
                    include "../../pages/superadmin/pegawai/export-pegawai.php";
                    break;

                case 'form-master-data-si':
                    include "../../pages/superadmin/keluarga/si/form-master-data-si.php";
                    break;
                case 'master-data-si':
                    include "../../pages/superadmin/keluarga/si/master-data-si.php";
                    break;
                case 'form-edit-data-si':
                    include "../../pages/superadmin/keluarga/si/form-edit-data-si.php";
                    break;
                case 'edit-data-si':
                    include "../../pages/superadmin/keluarga/si/edit-data-si.php";
                    break;
                case 'delete-data-si':
                    include "../../pages/superadmin/keluarga/si/delete-data-si.php";
                    break;
                case 'master-si':
                    include "../../pages/superadmin/keluarga/si/master-si.php";
                    break;

                case 'form-master-data-anak':
                    include "../../pages/superadmin/keluarga/anak/form-master-data-anak.php";
                    break;
                case 'master-data-anak':
                    include "../../pages/superadmin/keluarga/anak/master-data-anak.php";
                    break;
                case 'form-edit-data-anak':
                    include "../../pages/superadmin/keluarga/anak/form-edit-data-anak.php";
                    break;
                case 'edit-data-anak':
                    include "../../pages/superadmin/keluarga/anak/edit-data-anak.php";
                    break;
                case 'delete-data-anak':
                    include "../../pages/superadmin/keluarga/anak/delete-data-anak.php";
                    break;
                case 'master-anak':
                    include "../../pages/superadmin/keluarga/anak/master-anak.php";
                    break;

                case 'form-master-data-ortu':
                    include "../../pages/superadmin/keluarga/ortu/form-master-data-ortu.php";
                    break;
                case 'master-data-ortu':
                    include "../../pages/superadmin/keluarga/ortu/master-data-ortu.php";
                    break;
                case 'form-edit-data-ortu':
                    include "../../pages/superadmin/keluarga/ortu/form-edit-data-ortu.php";
                    break;
                case 'edit-data-ortu':
                    include "../../pages/superadmin/keluarga/ortu/edit-data-ortu.php";
                    break;
                case 'delete-data-ortu':
                    include "../../pages/superadmin/keluarga/ortu/delete-data-ortu.php";
                    break;
                case 'master-ortu':
                    include "../../pages/superadmin/keluarga/ortu/master-ortu.php";
                    break;

                case 'form-master-data-sekolah':
                    include "../../pages/superadmin/pendidikan/sekolah/form-master-data-sekolah.php";
                    break;
                case 'master-data-sekolah':
                    include "../../pages/superadmin/pendidikan/sekolah/master-data-sekolah.php";
                    break;
                case 'form-edit-data-sekolah':
                    include "../../pages/superadmin/pendidikan/sekolah/form-edit-data-sekolah.php";
                    break;
                case 'edit-data-sekolah':
                    include "../../pages/superadmin/pendidikan/sekolah/edit-data-sekolah.php";
                    break;
                case 'delete-data-sekolah':
                    include "../../pages/superadmin/pendidikan/sekolah/delete-data-sekolah.php";
                    break;
                case 'set-pendidikan-akhir':
                    include "../../pages/superadmin/pendidikan/sekolah/set-pendidikan-akhir.php";
                    break;
                case 'master-sekolah':
                    include "../../pages/superadmin/pendidikan/sekolah/master-sekolah.php";
                    break;

                case 'form-master-data-bahasa':
                    include "../../pages/superadmin/pendidikan/bahasa/form-master-data-bahasa.php";
                    break;
                case 'master-data-bahasa':
                    include "../../pages/superadmin/pendidikan/bahasa/master-data-bahasa.php";
                    break;
                case 'form-edit-data-bahasa':
                    include "../../pages/superadmin/pendidikan/bahasa/form-edit-data-bahasa.php";
                    break;
                case 'edit-data-bahasa':
                    include "../../pages/superadmin/pendidikan/bahasa/edit-data-bahasa.php";
                    break;
                case 'delete-data-bahasa':
                    include "../../pages/superadmin/pendidikan/bahasa/delete-data-bahasa.php";
                    break;
                case 'master-bahasa':
                    include "../../pages/superadmin/pendidikan/bahasa/master-bahasa.php";
                    break;

                case 'form-master-data-jabatan':
                    include "../../pages/superadmin/kepeg/jabatan/form-master-data-jabatan.php";
                    break;
                case 'master-data-jabatan':
                    include "../../pages/superadmin/kepeg/jabatan/master-data-jabatan.php";
                    break;
                case 'form-edit-data-jabatan':
                    include "../../pages/superadmin/kepeg/jabatan/form-edit-data-jabatan.php";
                    break;
                case 'edit-data-jabatan':
                    include "../../pages/superadmin/kepeg/jabatan/edit-data-jabatan.php";
                    break;
                case 'delete-data-jabatan':
                    include "../../pages/superadmin/kepeg/jabatan/delete-data-jabatan.php";
                    break;
                case 'set-jabatan-sekarang':
                    include "../../pages/superadmin/kepeg/jabatan/set-jabatan-sekarang.php";
                    break;
                case 'unset-jabatan-sekarang':
                    include "../../pages/superadmin/kepeg/jabatan/unset-jabatan-sekarang.php";
                    break;

                case 'masterjab':
                    include "../../pages/superadmin/kepeg/jabatan/masterjab.php";
                    break;
                case 'form-edit-masterjab':
                    include "../../pages/superadmin/kepeg/jabatan/form-edit-masterjab.php";
                    break;
                case 'edit-masterjab':
                    include "../../pages/superadmin/kepeg/jabatan/edit-masterjab.php";
                    break;
                case 'delete-masterjab':
                    include "../../pages/superadmin/kepeg/jabatan/delete-masterjab.php";
                    break;

                case 'masterunit':
                    include "../../pages/superadmin/kepeg/jabatan/masterunit.php";
                    break;
                case 'form-edit-masterunit':
                    include "../../pages/superadmin/kepeg/jabatan/form-edit-masterunit.php";
                    break;
                case 'edit-masterunit':
                    include "../../pages/superadmin/kepeg/jabatan/edit-masterunit.php";
                    break;
                case 'delete-masterunit':
                    include "../../pages/superadmin/kepeg/jabatan/delete-masterunit.php";
                    break;

                case 'form-master-data-pembinaan':
                    include "../../pages/superadmin/kepeg/pembinaan/form-master-data-pembinaan.php";
                    break;
                case 'master-data-pembinaan':
                    include "../../pages/superadmin/kepeg/pembinaan/master-data-pembinaan.php";
                    break;
                case 'form-edit-data-pembinaan':
                    include "../../pages/superadmin/kepeg/pembinaan/form-edit-data-pembinaan.php";
                    break;
                case 'edit-data-pembinaan':
                    include "../../pages/superadmin/kepeg/pembinaan/edit-data-pembinaan.php";
                    break;
                case 'delete-data-pembinaan':
                    include "../../pages/superadmin/kepeg/pembinaan/delete-data-pembinaan.php";
                    break;

                case 'form-master-data-dokumen':
                    include "../../pages/superadmin/kepeg/dokumen/form-master-data-dokumen.php";
                    break;
                case 'master-data-dokumen':
                    include "../../pages/superadmin/kepeg/dokumen/master-data-dokumen.php";
                    break;
                case 'form-edit-data-dokumen':
                    include "../../pages/superadmin/kepeg/dokumen/form-edit-data-dokumen.php";
                    break;
                case 'edit-data-dokumen':
                    include "../../pages/superadmin/kepeg/dokumen/edit-data-dokumen.php";
                    break;
                case 'delete-data-dokumen':
                    include "../../pages/superadmin/kepeg/dokumen/delete-data-dokumen.php";
                    break;
                case 'masterdok':
                    include "../../pages/superadmin/kepeg/dokumen/masterdok.php";
                    break;


                case 'form-master-data-penghargaan':
                    include "../../pages/superadmin/kepeg/harga/form-master-data-penghargaan.php";
                    break;
                case 'master-data-penghargaan':
                    include "../../pages/superadmin/kepeg/harga/master-data-penghargaan.php";
                    break;
                case 'form-edit-data-penghargaan':
                    include "../../pages/superadmin/kepeg/harga/form-edit-data-penghargaan.php";
                    break;
                case 'edit-data-penghargaan':
                    include "../../pages/superadmin/kepeg/harga/edit-data-penghargaan.php";
                    break;
                case 'delete-data-penghargaan':
                    include "../../pages/superadmin/kepeg/harga/delete-data-penghargaan.php";
                    break;

                case 'form-master-data-penugasan':
                    include "../../pages/superadmin/kepeg/tugas/form-master-data-penugasan.php";
                    break;
                case 'master-data-penugasan':
                    include "../../pages/superadmin/kepeg/tugas/master-data-penugasan.php";
                    break;
                case 'form-edit-data-penugasan':
                    include "../../pages/superadmin/kepeg/tugas/form-edit-data-penugasan.php";
                    break;
                case 'edit-data-penugasan':
                    include "../../pages/superadmin/kepeg/tugas/edit-data-penugasan.php";
                    break;
                case 'delete-data-penugasan':
                    include "../../pages/superadmin/kepeg/tugas/delete-data-penugasan.php";
                    break;

                case 'form-master-data-tunjangan':
                    include "../../pages/superadmin/kepeg/tunjangan/form-master-data-tunjangan.php";
                    break;
                case 'master-data-tunjangan':
                    include "../../pages/superadmin/kepeg/tunjangan/master-data-tunjangan.php";
                    break;
                case 'form-edit-data-tunjangan':
                    include "../../pages/superadmin/kepeg/tunjangan/form-edit-data-tunjangan.php";
                    break;
                case 'edit-data-tunjangan':
                    include "../../pages/superadmin/kepeg/tunjangan/edit-data-tunjangan.php";
                    break;
                case 'delete-data-tunjangan':
                    include "../../pages/superadmin/kepeg/tunjangan/delete-data-tunjangan.php";
                    break;
                case 'detail-data-tunjangan':
                    include "../../pages/superadmin/kepeg/tunjangan/detail-data-tunjangan.php";
                    break;

                case 'form-master-data-kawin':
                    include "../../pages/superadmin/kepeg/kawin/form-master-data-kawin.php";
                    break;
                case 'master-data-kawin':
                    include "../../pages/superadmin/kepeg/kawin/master-data-kawin.php";
                    break;
                case 'form-edit-data-kawin':
                    include "../../pages/superadmin/kepeg/kawin/form-edit-data-kawin.php";
                    break;
                case 'edit-data-kawin':
                    include "../../pages/superadmin/kepeg/kawin/edit-data-kawin.php";
                    break;
                case 'delete-data-kawin':
                    include "../../pages/superadmin/kepeg/kawin/delete-data-kawin.php";
                    break;
                case 'detail-data-kawin':
                    include "../../pages/superadmin/kepeg/kawin/detail-data-kawin.php";
                    break;

                case 'form-view-cuti':
                    include "../../pages/superadmin/cuti/tahunan_cuti/form-view-cuti.php";
                    break;
                case 'form-master-cuti':
                    include "../../pages/superadmin/cuti/tahunan_cuti/form-master-cuti.php";
                    break;
                case 'form-edit-cuti':
                    include "../../pages/superadmin/cuti/tahunan_cuti/form-edit-cuti.php";
                    break;
                case 'master-cuti':
                    include "../../pages/superadmin/cuti/tahunan_cuti/master-cuti.php";
                    break;
                case 'delete-cuti':
                    include "../../pages/superadmin/cuti/tahunan_cuti/delete-cuti.php";
                    break;
                case 'edit-cuti':
                    include "../../pages/superadmin/cuti/tahunan_cuti/edit-cuti.php";
                    break;
                case 'detail-cuti':
                    include "../../pages/superadmin/cuti/tahunan_cuti/detail-cuti.php";
                    break;
                case 'print-cuti':
                    include "../../pages/superadmin/cuti/tahunan_cuti/print-cuti.php";
                    break;

                case 'form-view-cuti-umum':
                    include "../../pages/superadmin/cuti/umum_cuti/form-view-cuti-umum.php";
                    break;
                case 'form-master-cuti-umum':
                    include "../../pages/superadmin/cuti/umum_cuti/form-master-cuti-umum.php";
                    break;
                case 'form-edit-cuti-umum':
                    include "../../pages/superadmin/cuti/umum_cuti/form-edit-cuti-umum.php";
                    break;
                case 'master-cuti-umum':
                    include "../../pages/superadmin/cuti/umum_cuti/master-cuti-umum.php";
                    break;
                case 'delete-cuti-umum':
                    include "../../pages/superadmin/cuti/umum_cuti/delete-cuti-umum.php";
                    break;
                case 'edit-cuti-umum':
                    include "../../pages/superadmin/cuti/umum_cuti/edit-cuti-umum.php";
                    break;
                case 'detail-cuti-umum':
                    include "../../pages/superadmin/cuti/umum_cuti/detail-cuti-umum.php";
                    break;
                case 'print-cuti-umum':
                    include "../../pages/superadmin/cuti/umum_cuti/print-cuti-umum.php";
                    break;

                case 'form-view-jenis-cuti':
                    include "../../pages/superadmin/cuti/jenis_cuti/form-view-jenis-cuti.php";
                    break;
                case 'form-edit-jenis-cuti':
                    include "../../pages/superadmin/cuti/jenis_cuti/form-edit-jenis-cuti.php";
                    break;
                case 'form-master-jenis-cuti':
                    include "../../pages/superadmin/cuti/jenis_cuti/form-master-jenis-cuti.php";
                    break;
                case 'master-jenis-cuti':
                    include "../../pages/superadmin/cuti/jenis_cuti/master-jenis-cuti.php";
                    break;
                case 'edit-jenis-cuti':
                    include "../../pages/superadmin/cuti/jenis_cuti/edit-jenis-cuti.php";
                    break;
                case 'delete-jenis-cuti':
                    include "../../pages/superadmin/cuti/jenis_cuti/delete-jenis-cuti.php";
                    break;

                case 'form-view-jatah-cuti':
                    include "../../pages/superadmin/cuti/jatah_cuti/form-view-jatah-cuti.php";
                    break;
                case 'form-master-jatah-cuti':
                    include "../../pages/superadmin/cuti/jatah_cuti/form-master-jatah-cuti.php";
                    break;
                case 'form-edit-jatah-cuti':
                    include "../../pages/superadmin/cuti/jatah_cuti/form-edit-jatah-cuti.php";
                    break;
                case 'master-jatah-cuti':
                    include "../../pages/superadmin/cuti/jatah_cuti/master-jatah-cuti.php";
                    break;
                case 'edit-jatah-cuti':
                    include "../../pages/superadmin/cuti/jatah_cuti/edit-jatah-cuti.php";
                    break;
                case 'delete-jatah-cuti':
                    include "../../pages/superadmin/cuti/jatah_cuti/delete-jatah-cuti.php";
                    break;

                case 'form-view-approval-tahap1':
                    include "../../pages/superadmin/cuti/approval_tahap_1/form-view-approval-tahap1.php";
                    break;
                case 'status-cuti-umum':
                    include "../../pages/superadmin/cuti/approval_tahap_1/status-cuti-umum.php";
                    break;
                case 'status-cuti-tahunan':
                    include "../../pages/superadmin/cuti/approval_tahap_1/status-cuti-tahunan.php";
                    break;
                case 'delete-approval-tahunan':
                    include "../../pages/superadmin/cuti/approval_tahap_1/delete-approval-tahunan.php";
                    break;
                case 'delete-approval-izin':
                    include "../../pages/superadmin/cuti/approval_tahap_1/delete-approval-izin.php";
                    break;

                case 'form-view-approval-tahap2':
                    include "../../pages/superadmin/cuti/approval_tahap_2/form-view-approval-tahap2.php";
                    break;
                case 'status-cuti-tahunan-2':
                    include "../../pages/superadmin/cuti/approval_tahap_2/status-cuti-tahunan-2.php";
                    break;
                case 'status-cuti-umum-2':
                    include "../../pages/superadmin/cuti/approval_tahap_2/status-cuti-umum-2.php";
                    break;
                case 'delete-approval-izin-2':
                    include "../../pages/superadmin/cuti/approval_tahap_2/delete-approval-izin-2.php";
                    break;
                case 'delete-approval-tahunan-2':
                    include "../../pages/superadmin/cuti/approval_tahap_2/delete-approval-tahunan-2.php";
                    break;

                case 'form-master-data-mutasi':
                    include "../../pages/superadmin/kepeg/mutasi/form-master-data-mutasi.php";
                    break;
                case 'master-data-mutasi':
                    include "../../pages/superadmin/kepeg/mutasi/master-data-mutasi.php";
                    break;
                case 'form-edit-data-mutasi':
                    include "../../pages/superadmin/kepeg/mutasi/form-edit-data-mutasi.php";
                    break;
                case 'edit-data-mutasi':
                    include "../../pages/superadmin/kepeg/mutasi/edit-data-mutasi.php";
                    break;
                case 'delete-data-mutasi':
                    include "../../pages/superadmin/kepeg/mutasi/delete-data-mutasi.php";
                    break;


                case 'form-view-kpi':
                    include "../../pages/superadmin/kpi/data_kpi/form-view-kpi.php";
                    break;
                case 'form-master-kpi':
                    include "../../pages/superadmin/kpi/data_kpi/form-master-kpi.php";
                    break;
                case 'form-edit-kpi':
                    include "../../pages/superadmin/kpi/data_kpi/form-edit-kpi.php";
                    break;
                case 'edit-kpi':
                    include "../../pages/superadmin/kpi/data_kpi/edit-kpi.php";
                    break;
                case 'master-kpi':
                    include "../../pages/superadmin/kpi/data_kpi/master-kpi.php";
                    break;
                case 'delete-edit-kpi':
                    include "../../pages/superadmin/kpi/data_kpi/delete-edit-kpi.php";
                    break;
                case 'delete-kpi':
                    include "../../pages/superadmin/kpi/data_kpi/delete-kpi.php";
                    break;
                case 'detail-kpi':
                    include "../../pages/superadmin/kpi/data_kpi/detail-kpi.php";
                    break;
                case 'detail-pegawai-kpi':
                    include "../../pages/superadmin/kpi/data_kpi/detail-pegawai-kpi.php";
                    break;
                case 'masterkpi':
                    include "../../pages/superadmin/kpi/data_kpi/masterkpi.php";
                    break;

                case 'form-view-divisi-kpi':
                    include "../../pages/superadmin/kpi/divisi/form-view-divisi-kpi.php";
                    break;
                case 'form-master-divisi-kpi':
                    include "../../pages/superadmin/kpi/divisi/form-master-divisi-kpi.php";
                    break;
                case 'form-edit-divisi-kpi':
                    include "../../pages/superadmin/kpi/divisi/form-edit-divisi-kpi.php";
                    break;
                case 'master-divisi-kpi':
                    include "../../pages/superadmin/kpi/divisi/master-divisi-kpi.php";
                    break;
                case 'edit-divisi-kpi':
                    include "../../pages/superadmin/kpi/divisi/edit-divisi-kpi.php";
                    break;
                case 'delete-divisi-kpi':
                    include "../../pages/superadmin/kpi/divisi/delete-divisi-kpi.php";
                    break;

                case 'form-view-data-gaji-jabatan':
                    include "../../pages/superadmin/gaji/gaji_jabatan/form-view-data-gaji-jabatan.php";
                    break;
                case 'form-master-data-gaji-jabatan':
                    include "../../pages/superadmin/gaji/gaji_jabatan/form-master-data-gaji-jabatan.php";
                    break;
                case 'master-data-gaji-jabatan':
                    include "../../pages/superadmin/gaji/gaji_jabatan/master-data-gaji-jabatan.php";
                    break;
                case 'form-edit-data-gaji-jabatan':
                    include "../../pages/superadmin/gaji/gaji_jabatan/form-edit-data-gaji-jabatan.php";
                    break;
                case 'edit-data-gaji-jabatan':
                    include "../../pages/superadmin/gaji/gaji_jabatan/edit-data-gaji-jabatan.php";
                    break;
                case 'delete-data-gaji-jabatan':
                    include "../../pages/superadmin/gaji/gaji_jabatan/delete-data-gaji-jabatan.php";
                    break;

                case 'form-view-data-gaji':
                    include "../../pages/superadmin/gaji/data_gaji/form-view-data-gaji.php";
                    break;
                case 'form-master-data-gaji':
                    include "../../pages/superadmin/gaji/data_gaji/form-master-data-gaji.php";
                    break;
                case 'form-edit-data-gaji':
                    include "../../pages/superadmin/gaji/data_gaji/form-edit-data-gaji.php";
                    break;
                case 'detail-data-gaji':
                    include "../../pages/superadmin/gaji/data_gaji/detail-data-gaji.php";
                    break;

                case 'form-view-data-gaji-konfigurasi':
                    include "../../pages/superadmin/gaji/konfigurasi_gaji/form-view-data-gaji-konfigurasi.php";
                    break;
                case 'form-master-data-gaji-konfigurasi':
                    include "../../pages/superadmin/gaji/konfigurasi_gaji/form-master-data-gaji-konfigurasi.php";
                    break;
                case 'form-edit-data-gaji-konfigurasi':
                    include "../../pages/superadmin/gaji/konfigurasi_gaji/form-edit-data-gaji-konfigurasi.php";
                    break;
                case 'edit-data-gaji-konfigurasi':
                    include "../../pages/superadmin/gaji/konfigurasi_gaji/edit-data-gaji-konfigurasi.php";
                    break;
                case 'master-data-gaji-konfigurasi':
                    include "../../pages/superadmin/gaji/konfigurasi_gaji/master-data-gaji-konfigurasi.php";
                    break;
                case 'detail-data-gaji-konfigurasi':
                    include "../../pages/superadmin/gaji/konfigurasi_gaji/detail-data-gaji-konfigurasi.php";
                    break;
                case 'detail-pegawai-data-gaji-konfigurasi':
                    include "../../pages/superadmin/gaji/konfigurasi_gaji/detail-pegawai-data-gaji-konfigurasi.php";
                    break;
                case 'delete-data-gaji-konfigurasi':
                    include "../../pages/superadmin/gaji/konfigurasi_gaji/delete-data-gaji-konfigurasi.php";
                    break;
                case 'print-detail-konfigurasi-slip-gaji':
                    include "../../pages/superadmin/gaji/konfigurasi_gaji/print-detail-konfigurasi-slip-gaji.php";
                    break;

                case 'form-view-data-jadwal-kerja-pegawai':
                    include "../../pages/superadmin/presensi/jadwal_kerja_pegawai/form-view-data-jadwal-kerja-pegawai.php";
                    break;
                case 'form-edit-data-jadwal-kerja-pegawai':
                    include "../../pages/superadmin/presensi/jadwal_kerja_pegawai/form-edit-data-jadwal-kerja-pegawai.php";
                    break;
                case 'edit-data-jadwal-kerja-pegawai':
                    include "../../pages/superadmin/presensi/jadwal_kerja_pegawai/edit-data-jadwal-kerja-pegawai.php";
                    break;
                case 'form-master-data-jadwal-kerja-pegawai':
                    include "../../pages/superadmin/presensi/jadwal_kerja_pegawai/form-master-data-jadwal-kerja-pegawai.php";
                    break;
                case 'master-data-jadwal-kerja-pegawai':
                    include "../../pages/superadmin/presensi/jadwal_kerja_pegawai/master-data-jadwal-kerja-pegawai.php";
                    break;
                case 'delete-data-jadwal-kerja-pegawai':
                    include "../../pages/superadmin/presensi/jadwal_kerja_pegawai/delete-data-jadwal-kerja-pegawai.php";
                    break;

                case 'form-view-pengaturan-mesin':
                    include "../../pages/superadmin/presensi/mesin/form-view-pengaturan-mesin.php";
                    break;
                case 'form-master-pengaturan-mesin':
                    include "../../pages/superadmin/presensi/mesin/form-master-pengaturan-mesin.php";
                    break;
                case 'form-edit-pengaturan-mesin':
                    include "../../pages/superadmin/presensi/mesin/form-edit-pengaturan-mesin.php";
                    break;

                case 'form-view-shift-kerja':
                    include "../../pages/superadmin/presensi/shift/form-view-shift-kerja.php";
                    break;
                case 'form-master-shift-kerja':
                    include "../../pages/superadmin/presensi/shift/form-master-shift-kerja.php";
                    break;
                case 'master-shift-kerja':
                    include "../../pages/superadmin/presensi/shift/master-shift-kerja.php";
                    break;
                case 'form-edit-shift-kerja':
                    include "../../pages/superadmin/presensi/shift/form-edit-shift-kerja.php";
                    break;
                case 'edit-shift-kerja':
                    include "../../pages/superadmin/presensi/shift/edit-shift-kerja.php";
                    break;
                case 'delete-shift-kerja':
                    include "../../pages/superadmin/presensi/shift/delete-shift-kerja.php";
                    break;


                case 'form-view-hari-jam-kerja':
                    include "../../pages/superadmin/presensi/hari_jam_kerja/form-view-hari-jam-kerja.php";
                    break;
                case 'form-master-hari-jam-kerja':
                    include "../../pages/superadmin/presensi/hari_jam_kerja/form-master-hari-jam-kerja.php";
                    break;
                case 'master-hari-jam-kerja':
                    include "../../pages/superadmin/presensi/hari_jam_kerja/master-hari-jam-kerja.php";
                    break;
                case 'form-edit-hari-jam-kerja':
                    include "../../pages/superadmin/presensi/hari_jam_kerja/form-edit-hari-jam-kerja.php";
                    break;
                case 'edit-hari-jam-kerja':
                    include "../../pages/superadmin/presensi/hari_jam_kerja/edit-hari-jam-kerja.php";
                    break;
                case 'delete-hari-jam-kerja':
                    include "../../pages/superadmin/presensi/hari_jam_kerja/delete-hari-jam-kerja.php";
                    break;


                case 'form-view-rekap-presensi':
                    include "../../pages/superadmin/presensi/rekap/form-view-rekap-presensi.php";
                    break;
                case 'export-scanlog':
                    include "../../pages/superadmin/presensi/rekap/export-scanlog.php";
                    break;
                case 'export-harian':
                    include "../../pages/superadmin/presensi/rekap/export-harian.php";
                    break;
                case 'export-periode':
                    include "../../pages/superadmin/presensi/rekap/export-periode.php";
                    break;


                case 'form-view-lokasi':
                    include "../../pages/superadmin/lokasi/form-view-lokasi.php";
                    break;
                case 'form-master-lokasi':
                    include "../../pages/superadmin/lokasi/form-master-lokasi.php";
                    break;
                case 'form-edit-lokasi':
                    include "../../pages/superadmin/lokasi/form-edit-lokasi.php";
                    break;
                case 'edit-lokasi':
                    include "../../pages/superadmin/lokasi/edit-lokasi.php";
                    break;
                case 'master-lokasi':
                    include "../../pages/superadmin/lokasi/master-lokasi.php";
                    break;
                case 'delete-lokasi':
                    include "../../pages/superadmin/lokasi/delete-lokasi.php";
                    break;
                case 'view-lokasi':
                    include "../../pages/superadmin/lokasi/view-lokasi.php";
                    break;
                case 'function-lokasi':
                    include "../../pages/superadmin/lokasi/function-lokasi.php";
                    break;

                case 'form-view-tempat':
                    include "../../pages/superadmin/tempat/form-view-tempat.php";
                    break;
                case 'form-master-tempat':
                    include "../../pages/superadmin/tempat/form-master-tempat.php";
                    break;
                case 'master-tempat':
                    include "../../pages/superadmin/tempat/master-tempat.php";
                    break;
                case 'edit-tempat':
                    include "../../pages/superadmin/tempat/edit-tempat.php";
                    break;
                case 'delete-tempat':
                    include "../../pages/superadmin/tempat/delete-tempat.php";
                    break;
                case 'form-edit-tempat':
                    include "../../pages/superadmin/tempat/form-edit-tempat.php";
                    break;

                case 'rekap-golongan':
                    include "../../pages/superadmin/rekap/rekap-golongan.php";
                    break;
                case 'rekap-jabatan':
                    include "../../pages/superadmin/rekap/rekap-jabatan.php";
                    break;
                case 'rekap-unit-kerja':
                    include "../../pages/superadmin/rekap/rekap-unit-kerja.php";
                    break;
                case 'rekap-pendidikan':
                    include "../../pages/superadmin/rekap/rekap-pendidikan.php";
                    break;
                case 'rekap-skpd':
                    include "../../pages/superadmin/rekap/rekap-skpd.php";
                    break;

                case 'daftar-urut-kepangkatan':
                    include "../../pages/superadmin/report/daftar-urut-kepangkatan.php";
                    break;
                case 'bezetting':
                    include "../../pages/superadmin/report/bezetting.php";
                    break;
                case 'keadaan-pegawai':
                    include "../../pages/superadmin/report/keadaan-pegawai.php";
                    break;
                case 'nominatif':
                    include "../../pages/superadmin/report/nominatif.php";
                    break;
                case 'export-bezetting':
                    include "../../pages/superadmin/report/export-bezetting.php";
                    break;
                case 'pre-pensiun':
                    include "../../pages/superadmin/report/pre-pensiun.php";
                    break;
                case 'pensiun':
                    include "../../pages/superadmin/report/pensiun.php";
                    break;

                case 'pre-report-kgb':
                    include "../../pages/superadmin/kgb/pre-report-kgb.php";
                    break;
                case 'report-kgb':
                    include "../../pages/superadmin/kgb/report-kgb.php";
                    break;
                case 'form-master-data-kgb':
                    include "../../pages/superadmin/kgb/form-master-data-kgb.php";
                    break;
                case 'master-data-kgb':
                    include "../../pages/superadmin/kgb/master-data-kgb.php";
                    break;
                case 'form-edit-data-kgb':
                    include "../../pages/superadmin/kgb/form-edit-data-kgb.php";
                    break;
                case 'edit-data-kgb':
                    include "../../pages/superadmin/kgb/edit-data-kgb.php";
                    break;
                case 'delete-data-kgb':
                    include "../../pages/superadmin/kgb/delete-data-kgb.php";
                    break;
                case 'detail-data-kgb':
                    include "../../pages/superadmin/kgb/detail-data-kgb.php";
                    break;

                case 'backup-data':
                    include "../../pages/superadmin/backup/backup-data.php";
                    break;

                case 'form-ganti-password':
                    include "../../pages/superadmin/form-ganti-password.php";
                    break;
                case 'ganti-password':
                    include "../../pages/superadmin/ganti-password.php";
                    break;

                case 'direct-search':
                    include "../../pages/superadmin/direct-search.php";
                    break;



                default:
                    include '../../pages/superadmin/dashboard.php';
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
    <!-- <script src="../../assets/plugins/jquery-map/jquery-3.6.0.min.js"></script> -->
    <script src="../../assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
    <script src="../../assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
    <script src="../../assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../assets/js/table-manage-responsive.demo.min.js"></script>
    <script src="../../assets/plugins/number-format/easy-number-separator.js"></script>

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
    <script src="../../assets/js/autoNumeric.min.js"></script>


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