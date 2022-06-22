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

$jmlpeg	= mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_status='1' ORDER BY pegawai_id DESC");
$jpeg	= mysqli_num_rows($jmlpeg);

$jmlhar	= mysqli_query($koneksi, "SELECT * FROM tb_penghargaan");
$jhar	= mysqli_num_rows($jmlhar);

$jmltug	= mysqli_query($koneksi, "SELECT * FROM tb_penugasan");
$jtug	= mysqli_num_rows($jmltug);

$jmldik	= mysqli_query($koneksi, "SELECT * FROM tb_diklat");
$jdik	= mysqli_num_rows($jmldik);
?>
