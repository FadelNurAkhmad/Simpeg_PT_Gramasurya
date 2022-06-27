<div class="row">
	<?php
	if (isset($_GET['id_kawin'])) {
		$id_kawin = $_GET['id_kawin'];
	} else {
		die("Error. No ID Selected! ");
	}

	if ($_POST['save'] == "save") {
		$no_kawin			= $_POST['no_kawin'];
		$tgl_izin			= $_POST['tgl_izin'];
		$id_peg				= $_POST['id_peg'];
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

		include "../../config/koneksi.php";

		if (empty($_POST['no_kawin']) || empty($_POST['tgl_izin']) || empty($_POST['id_peg']) || empty($_POST['nama']) || empty($_POST['tmp_lahir']) || empty($_POST['tgl_lahir']) || empty($_POST['tgl_ditetapkan'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-kawin");
		} else {
			$insert = "INSERT INTO tb_kawin (id_kawin, no_kawin, tgl_izin, id_peg, bangsa1, nama_wali_bapak1, kerja_wali_bapak1, alamat_wali_bapak1, nama_wali_ibu1, kerja_wali_ibu1, alamat_wali_ibu1, nama, tmp_lahir, tgl_lahir, pekerjaan, nik, pangkat, gol, jab, instansi, bangsa2, agama, alamat, nama_wali_bapak2, kerja_wali_bapak2, alamat_wali_bapak2, nama_wali_ibu2, kerja_wali_ibu2, alamat_wali_ibu2, tmp_kawin, tgl_kawin, tgl_ditetapkan)
		VALUES ('$id_kawin', '$no_kawin', '$tgl_izin', '$id_peg', '$bangsa1', '$nama_wali_bapak1', '$kerja_wali_bapak1', '$alamat_wali_bapak1', '$nama_wali_ibu1', '$kerja_wali_ibu1', '$alamat_wali_ibu1', '$nama', '$tmp_lahir', '$tgl_lahir', '$pekerjaan', '$nik', '$pangkat', '$gol', '$jab', '$instansi', '$bangsa2', '$agama', '$alamat', '$nama_wali_bapak2', '$kerja_wali_bapak2', '$alamat_wali_bapak2', '$nama_wali_ibu2', '$kerja_wali_ibu2', '$alamat_wali_ibu2', '$tmp_kawin', '$tgl_kawin', '$tgl_ditetapkan')";
			$query = mysqli_query($koneksi, $insert);

			if ($query) {
				$_SESSION['pesan'] = "Good! Insert data izin kawin success ...";
				header("location:index.php?page=form-master-data-kawin");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>