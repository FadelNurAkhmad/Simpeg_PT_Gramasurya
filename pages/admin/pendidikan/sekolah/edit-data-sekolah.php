<div class="row">
	<?php
	if (isset($_GET['id_sekolah'])) {
		$id_sekolah = $_GET['id_sekolah'];
	} else {
		die("Error. No Kode Selected! ");
	}
	include "../../config/koneksi.php";
	$tampilSek	= mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE id_sekolah='$id_sekolah'");
	$hasil	= mysqli_fetch_array($tampilSek);
	$notnik	= $hasil['nik'];
	$id_peg	= $hasil['id_peg'];

	if ($_POST['edit'] == "edit") {
		$tingkat		= $_POST['tingkat'];
		$nama_sekolah	= $_POST['nama_sekolah'];
		$lokasi			= $_POST['lokasi'];
		$jurusan		= $_POST['jurusan'];
		$no_ijazah		= $_POST['no_ijazah'];
		$tgl_ijazah		= $_POST['tgl_ijazah'];
		$kepala			= $_POST['kepala'];

		if (empty($_POST['tingkat']) || empty($_POST['nama_sekolah']) || empty($_POST['lokasi']) || empty($_POST['no_ijazah']) || empty($_POST['tgl_ijazah']) || empty($_POST['kepala'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-sekolah&id_sekolah=$id_sekolah");
		} else {
			$update = mysqli_query($koneksi, "UPDATE tb_sekolah SET tingkat='$tingkat', nama_sekolah='$nama_sekolah', lokasi='$lokasi', jurusan='$jurusan', no_ijazah='$no_ijazah', tgl_ijazah='$tgl_ijazah', kepala='$kepala' WHERE id_sekolah='$id_sekolah'");
			if ($update) {
				$_SESSION['pesan'] = "Good! edit data sekolah success ...";
				header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>