<div class="row">
	<?php
	if (isset($_GET['pegawai_id'])) {
		$id_peg = $_GET['pegawai_id'];
	}

	if ($_POST['save'] == "save") {
		$pin			= $_POST['pegawai_pin'];
		$nip			= $_POST['pegawai_nip'];
		$pegawai_status = $_POST['pegawai_status'];
		$tgl_resign		= $_POST['tgl_resign'];
		$tempat_lahir	= $_POST['tempat_lahir'];
		$tgl_lahir		= $_POST['tgl_lahir'];
		$nama			= $_POST['pegawai_nama'];
		$tgl_mulai_kerja		= $_POST['tgl_mulai_kerja'];
		$tgl_masuk_pertama		= $_POST['tgl_masuk_pertama'];
		$agama			= $_POST['agama'];
		$gender			= $_POST['gender'];
		$gol_darah		= $_POST['gol_darah'];
		$status_nikah	= $_POST['stat_nikah'];
		$alamat			= $_POST['alamat'];
		$telp			= $_POST['pegawai_telp'];
		$email			= $_POST['email'];
		$ket			= $_POST['ket'];
		$foto			= $_FILES['foto']['name'];

		$password	= password_hash("123", PASSWORD_DEFAULT);

		include "../../config/koneksi.php";
		$cekpin	= mysqli_num_rows(mysqli_query($koneksi, "SELECT pegawai_pin FROM pegawai WHERE pegawai_pin='$_POST[pegawai_pin]'"));
		$ceknip	= mysqli_num_rows(mysqli_query($koneksi, "SELECT pegawai_nip FROM pegawai WHERE pegawai_nip='$_POST[pegawai_nip]'"));

		if (empty($_POST['pegawai_pin']) || empty($_POST['pegawai_nip']) || empty($_POST['pegawai_nama']) || empty($_POST['tempat_lahir']) || empty($_POST['tgl_lahir']) || empty($_POST['tgl_mulai_kerja']) || empty($_POST['tgl_masuk_pertama']) || empty($_POST['agama']) || empty($_POST['gender']) || empty($_POST['gol_darah']) || empty($_POST['stat_nikah'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-pegawai");
		} else if ($ceknip > 0 || $cekpin > 0) {
			$_SESSION['pesan'] = "Oops! NIP atau PIN telah terpakai ...";
			header("location:index.php?page=form-master-data-pegawai");
		} else {

			$pegawai_d = mysqli_query($koneksi, "INSERT INTO pegawai_d (pegawai_id, gol_darah, stat_nikah, alamat, agama) VALUES ('$id_peg', '$gol_darah', '$status_nikah', '$alamat', '$agama')");
			$tb_pegawai = mysqli_query($koneksi, "INSERT INTO tb_pegawai (pegawai_id, email, foto, ket) VALUES ('$id_peg', '$email', '$foto', '$ket')");

			if ($pegawai_status == 1) {
				$query = "INSERT INTO pegawai (pegawai_id, pegawai_pin, pegawai_nip, pegawai_nama, pegawai_alias, pegawai_telp, pegawai_status, tempat_lahir, tgl_lahir, tgl_mulai_kerja, gender, tgl_masuk_pertama) 
													VALUES ('$id_peg', '$pin', '$nip', '$nama', '$nama', '$telp', '$pegawai_status', '$tempat_lahir', '$tgl_lahir', '$tgl_mulai_kerja', '$gender', '$tgl_masuk_pertama')";
				$pegawai = mysqli_query($koneksi, $query);
				$tb_user = mysqli_query($koneksi, "INSERT INTO tb_user (id_user, nama_user, password, hak_akses, id_peg) VALUES ('$nip', '$nama', '$password', 'Pegawai', '$id_peg')");

				if ($pegawai && $pegawai_d && $tb_pegawai && $tb_user) {
					$_SESSION['pesan'] = "Good! Menambahkan data pegawai berhasil ...";
					header("location:index.php?page=form-view-data-pegawai");
				} else {
					echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
				}
				if (strlen($foto) > 0) {
					if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
						move_uploaded_file($_FILES['foto']['tmp_name'], "../../assets/img/foto/" . $foto);
					}
				}
			} else {
				if ($pegawai_status == 2) {
					$query = "INSERT INTO pegawai (pegawai_id, pegawai_pin, pegawai_nip, pegawai_nama, pegawai_alias, pegawai_telp, pegawai_status, tempat_lahir, tgl_lahir, tgl_mulai_kerja, gender, tgl_masuk_pertama, tgl_resign) 
													VALUES ('$id_peg', '$pin', '$nip', '$nama', '$nama', '$telp', '$pegawai_status', '$tempat_lahir', '$tgl_lahir', '$tgl_mulai_kerja', '$gender', '$tgl_masuk_pertama', '$tgl_resign')";
					$pegawai = mysqli_query($koneksi, $query);
				}
				if ($pegawai && $pegawai_d && $tb_pegawai) {
					$_SESSION['pesan'] = "Good! Menambahkan data pegawai berhasil ...";
					header("location:index.php?page=form-view-data-pegawai");
				} else {
					echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
				}
				if (strlen($foto) > 0) {
					if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
						move_uploaded_file($_FILES['foto']['tmp_name'], "../../assets/img/foto/" . $foto);
					}
				}
			}
		}
	}
	?>
</div>