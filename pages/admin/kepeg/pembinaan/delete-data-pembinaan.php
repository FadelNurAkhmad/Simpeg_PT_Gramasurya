<div class="row">
	<?php
	include "../../config/koneksi.php";
	if (isset($_GET['id_pembinaan'])) {
		$id_pembinaan = $_GET['id_pembinaan'];

		$query   = mysqli_query($koneksi, "SELECT * FROM tb_pembinaan WHERE id_pembinaan='$id_pembinaan'");
		$data    = mysqli_fetch_array($query, MYSQLI_ASSOC);
		$id_peg	= $data['id_peg'];
	} else {
		die("Error. No ID Selected! ");
	}

	if (!empty($id_pembinaan) && $id_pembinaan != "") {
		$delete	= mysqli_query($koneksi, "DELETE FROM tb_pembinaan WHERE id_pembinaan='$id_pembinaan'");
		if ($delete) {
			$_SESSION['pesan'] = "Good! delete pembinaan success ...";
			header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
		} else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($koneksi);
	?>
</div>