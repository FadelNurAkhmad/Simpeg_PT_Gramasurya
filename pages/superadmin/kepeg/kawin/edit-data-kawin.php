<div class="row">
	<?php
	if (isset($_GET['id_kawin'])) {
		$id_kawin = $_GET['id_kawin'];
	} else {
		die("Error. No Kode Selected! ");
	}
	include "../../config/koneksi.php";
	$tampilKaw	= mysqli_query($koneksi, "SELECT * FROM tb_kawin WHERE id_kawin='$id_kawin'");
	$hasil	= mysqli_fetch_array($tampilKaw);
	$id_peg	= $hasil['id_peg'];

	if ($_POST['edit'] == "edit") {
		$no_kawin			= $_POST['no_kawin'];
		$tgl_izin			= $_POST['tgl_izin'];
		$bangsa1			= $_POST['bangsa1'];
		$nama_wali_bapak1	= $_POST['nama_wali_bapak1'];
		$kerja_wali_bapak1	= $_POST['kerja_wali_bapak1'];
		$alamat_wali_bapak1	= $_POST['alamat_wali_bapak1'];
		$nama_wali_ibu1		= $_POST['nama_wali_ibu1'];
		$kerja_wali_ibu1	= $_POST['kerja_wali_ibu1'];
		$alamat_wali_ibu1	= $_POST['alamat_wali_ibu1'];
		$nama				= $_POST['nama'];
		$tmp_lahir			= $_POST['tmp_lahir'];
		$tgl_lahir			= $_POST['tgl_lahir'];
		$pekerjaan			= $_POST['pekerjaan'];
		$nik				= $_POST['nik'];
		$pangkat			= $_POST['pangkat'];
		$gol				= $_POST['gol'];
		$jab				= $_POST['jab'];
		$instansi			= $_POST['instansi'];
		$bangsa2			= $_POST['bangsa2'];
		$agama				= $_POST['agama'];
		$alamat				= $_POST['alamat'];
		$nama_wali_bapak2	= $_POST['nama_wali_bapak2'];
		$kerja_wali_bapak2	= $_POST['kerja_wali_bapak2'];
		$alamat_wali_bapak2	= $_POST['alamat_wali_bapak2'];
		$nama_wali_ibu2		= $_POST['nama_wali_ibu2'];
		$kerja_wali_ibu2	= $_POST['kerja_wali_ibu2'];
		$alamat_wali_ibu2	= $_POST['alamat_wali_ibu2'];
		$tmp_kawin			= $_POST['tmp_kawin'];
		$tgl_kawin			= $_POST['tgl_kawin'];
		$tgl_ditetapkan		= $_POST['tgl_ditetapkan'];

		if (empty($_POST['no_kawin']) || empty($_POST['tgl_izin']) || empty($_POST['nama']) || empty($_POST['tmp_lahir']) || empty($_POST['tgl_lahir']) || empty($_POST['tgl_ditetapkan'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-kawin&id_kawin=$id_kawin");
		} else {
			$update = mysqli_query($koneksi, "UPDATE tb_kawin SET no_kawin='$no_kawin', tgl_izin='$tgl_izin', bangsa1='$bangsa1', nama_wali_bapak1='$nama_wali_bapak1', kerja_wali_bapak1='$kerja_wali_bapak1', alamat_wali_bapak1='$alamat_wali_bapak1', nama_wali_ibu1='$nama_wali_ibu1', kerja_wali_ibu1='$kerja_wali_ibu1', alamat_wali_ibu1='$alamat_wali_ibu1', nama='$nama', tmp_lahir='$tmp_lahir', tgl_lahir='$tgl_lahir', pekerjaan='$pekerjaan', nik='$nik', pangkat='$pangkat', gol='$gol', jab='$jab', instansi='$instansi', bangsa2='$bangsa2', agama='$agama', alamat='$alamat', nama_wali_bapak2='$nama_wali_bapak2', kerja_wali_bapak2='$kerja_wali_bapak2', alamat_wali_bapak2='$alamat_wali_bapak2', nama_wali_ibu2='$nama_wali_ibu2', kerja_wali_ibu2='$kerja_wali_ibu2', alamat_wali_ibu2='$alamat_wali_ibu2', tmp_kawin='$tmp_kawin', tgl_kawin='$tgl_kawin', tgl_ditetapkan='$tgl_ditetapkan' WHERE id_kawin='$id_kawin'");
			if ($update) {
				$_SESSION['pesan'] = "Good! edit data izin kawin success ...";
				header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>