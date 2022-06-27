<div class="row">
	<?php
	include "../../config/koneksi.php";
	if (isset($_GET['id_sekolah'])) {
		$id_sekolah = $_GET['id_sekolah'];

		$query   = mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE id_sekolah='$id_sekolah'");
		$data    = mysqli_fetch_array($query);
		$id_peg	= $data['id_peg'];
	} else {
		die("Error. No ID Selected! ");
	}

	if (!empty($id_sekolah) && $id_sekolah != "") {
		$delete	= mysqli_query($koneksi, "DELETE FROM tb_sekolah WHERE id_sekolah='$id_sekolah'");
		$updatesek = mysqli_query($koneksi, "UPDATE tb_pegawai SET sekolah='' WHERE pegawai_id='$id_peg'");

		if ($delete) {
			$_SESSION['pesan'] = "Good! delete sekolah success ...";
			header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
		} else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
	?>
</div>