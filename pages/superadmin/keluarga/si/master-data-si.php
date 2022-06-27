<div class="row">
	<?php
	if (isset($_GET['id_si'])) {
		$id_si = $_GET['id_si'];
	} else {
		die("Error. No ID Selected! ");
	}

	if ($_POST['save'] == "save") {
		$id_peg			= $_POST['id_peg'];
		$nik			= $_POST['nik'];
		$nama			= $_POST['nama'];
		$tmp_lhr		= $_POST['tmp_lhr'];
		$tgl_lhr		= $_POST['tgl_lhr'];
		$pendidikan		= $_POST['pendidikan'];
		$pekerjaan		= $_POST['pekerjaan'];
		$status_hub		= $_POST['status_hub'];

		$date_reg	= date("Ymd");

		include "../../config/koneksi.php";
		$ceknik	= mysqli_num_rows(mysqli_query($koneksi, "SELECT nik FROM tb_suamiistri WHERE nik='$_POST[nik]'"));
		$ceksi	= mysqli_num_rows(mysqli_query($koneksi, "SELECT status_hub FROM tb_suamiistri WHERE id_peg='$_POST[id_peg]' AND (status_hub='Suami' OR status_hub='Istri')"));

		if (empty($_POST['id_peg']) || empty($_POST['nik']) || empty($_POST['nama']) || empty($_POST['tmp_lhr']) || empty($_POST['tgl_lhr']) || empty($_POST['pendidikan']) || empty($_POST['pekerjaan']) || empty($_POST['status_hub'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-si");
		} else if ($ceknik > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-master-data-si");
		} else if ($ceksi > 0) {
			$_SESSION['pesan'] = "Oops! Data suami istri telah diinput sebelumnya ...";
			header("location:index.php?page=form-master-data-si");
		} else {
			$insert = "INSERT INTO tb_suamiistri (id_si, id_peg, nik, nama, tmp_lhr, tgl_lhr, pendidikan, pekerjaan, status_hub, date_reg) VALUES ('$id_si', '$id_peg', '$nik', '$nama', '$tmp_lhr', '$tgl_lhr', '$pendidikan', '$pekerjaan', '$status_hub', '$date_reg')";
			$query = mysqli_query($koneksi, $insert);

			if ($query) {
				$_SESSION['pesan'] = "Good! Insert data suami / istri success ...";
				header("location:index.php?page=form-master-data-si");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>