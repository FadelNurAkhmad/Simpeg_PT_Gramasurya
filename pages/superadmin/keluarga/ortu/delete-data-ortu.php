<div class="row">
	<?php
	include "../../config/koneksi.php";
	if (isset($_GET['id_ortu'])) {
		$id_ortu = $_GET['id_ortu'];

		$query   = mysqli_query($koneksi, "SELECT * FROM tb_ortu WHERE id_ortu='$id_ortu'");
		$data    = mysqli_fetch_array($query);
		$id_peg	= $data['id_peg'];
	} else {
		die("Error. No ID Selected! ");
	}

	if (!empty($id_ortu) && $id_ortu != "") {
		$delete	= mysqli_query($koneksi, "DELETE FROM tb_ortu WHERE id_ortu='$id_ortu'");
		if ($delete) {
			$_SESSION['pesan'] = "Good! delete orang tua success ...";
			header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
		} else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
	?>
</div>