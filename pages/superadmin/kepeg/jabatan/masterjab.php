<div class="row">
	<?php
	if ($_POST['save'] == "save") {
		$nama_masterjab	= $_POST['nama_masterjab'];

		function kdauto($tabel, $inisial)
		{
			include "../../config/koneksi.php";

			$struktur   = mysqli_query($koneksi, "SELECT * FROM $tabel");
			$fieldInfo = mysqli_fetch_field_direct($struktur, 0);
			$field      = $fieldInfo->name;
			$panjang    = $fieldInfo->length;
			$qry  = mysqli_query($koneksi, "SELECT max(" . $field . ") FROM " . $tabel);
			$row  = mysqli_fetch_array($qry);
			if ($row[0] == "") {
				$angka = 0;
			} else {
				$angka = substr($row[0], strlen($inisial));
			}
			$angka++;
			$angka = strval($angka);
			$tmp  = "";
			for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
				$tmp = $tmp . "0";
			}
			return $inisial . $tmp . $angka;
		}
		$id_masterjab		= kdauto("tb_masterjab", "");

		$cekname	= mysqli_num_rows(mysqli_query($koneksi, "SELECT nama_masterjab FROM tb_masterjab WHERE nama_masterjab='$_POST[nama_masterjab]'"));

		if (empty($_POST['nama_masterjab'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-jabatan");
		} else if ($cekname > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-master-data-jabatan");
		} else {
			$insert = "INSERT INTO tb_masterjab (id_masterjab, nama_masterjab) VALUES ('$id_masterjab', '$nama_masterjab')";
			$query = mysqli_query($koneksi, $insert);

			if ($query) {
				$_SESSION['pesan'] = "Good! Insert master nama jabatan success ...";
				header("location:index.php?page=form-master-data-jabatan");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>