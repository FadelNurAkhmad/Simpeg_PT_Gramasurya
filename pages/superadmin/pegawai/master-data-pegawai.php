<div class="row">
	<?php
	if (isset($_GET['pegawai_id'])) {
		$id_peg = $_GET['pegawai_id'];
	}

	if ($_POST['save'] == "save") {
		$pin			= $_POST['pin'];
		$nip			= $_POST['nip'];
		$nama			= $_POST['nama'];
		$tempat_lahir	= $_POST['tempat_lahir'];
		$tgl_lahir		= $_POST['tgl_lahir'];
		$tgl_mulai_kerja		= $_POST['tgl_mulai_kerja'];
		$tgl_masuk_pertama		= $_POST['tgl_masuk_pertama'];
		$agama			= $_POST['agama'];
		$gender			= $_POST['gender'];
		$gol_darah		= $_POST['gol_darah'];
		$status_nikah	= $_POST['status_nikah'];
		$alamat			= $_POST['alamat'];
		$telp			= $_POST['telp'];
		$email			= $_POST['email'];
		// $sisa_cuti		= $_POST['sisa_cuti'];
		$foto			= $_FILES['foto']['name'];

		$password	= password_hash("123", PASSWORD_DEFAULT);
		$date_reg	= date("Ymd");

		// $pensiun = new DateTime($tgl_lhr);
		// $pensiun->modify('+58 year');
		// $pensiun->format('Y-m-d');
		// $tgl_pensiun=$pensiun->format('Y-m-d');

		include "../../config/koneksi.php";
		$cekpin	= mysqli_num_rows(mysqli_query($koneksi, "SELECT pegawai_pin FROM pegawai WHERE pegawai_pin='$_POST[pin]'"));
		$ceknip	= mysqli_num_rows(mysqli_query($koneksi, "SELECT pegawai_nip FROM pegawai WHERE pegawai_nip='$_POST[nip]'"));

		if (
			empty($_POST['pin']) || empty($_POST['nip']) || empty($_POST['nama']) || empty($_POST['tempat_lahir']) || empty($_POST['tgl_lahir']) || empty($_POST['tgl_mulai_kerja'])
			|| empty($_POST['tgl_masuk_pertama']) || empty($_POST['agama']) || empty($_POST['gender']) || empty($_POST['gol_darah'])
			|| empty($_POST['status_nikah'])
		) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-pegawai");
		} else if ($ceknip > 0 || $cekpin > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-master-data-pegawai");
		}
		// else if ($_POST['sisa_cuti'] > 12) {
		// 	$_SESSION['pesan'] = "Oops! Kuota Cuti Hanya 12 Per tahun ...";
		// 	header("location:index.php?page=form-master-data-pegawai");
		// } 
		else {
			$pegawai = "INSERT INTO pegawai (pegawai_id, pegawai_pin, pegawai_nip, pegawai_nama, pegawai_alias, pegawai_telp, 
											tempat_lahir, tgl_lahir, tgl_mulai_kerja, gender, tgl_masuk_pertama) 
											VALUES ('$id_peg', '$pin', '$nip', '$nama', '$nama', '$telp', '$tempat_lahir', '$tgl_lahir', '$tgl_mulai_kerja', '$gender', '$tgl_masuk_pertama')";
			$query = mysqli_query($koneksi, $pegawai);

			$pegawai_d = mysqli_query($koneksi, "INSERT INTO pegawai_d (pegawai_id, gol_darah, stat_nikah, alamat, agama) VALUES ('$id_peg', '$gol_darah', '$status_nikah', '$alamat', '$agama')");

			$tb_pegawai = mysqli_query($koneksi, "INSERT INTO tb_pegawai (pegawai_id, email, foto, sisa_cuti) VALUES ('$id_peg', '$email', '$foto', '$sisa_cuti')");

			$insertusr = mysqli_query($koneksi, "INSERT INTO tb_user (id_user, nama_user, password, hak_akses, id_peg) VALUES ('$nip', '$nama', '$password', 'Pegawai', '$id_peg')");

			if ($query) {
				$_SESSION['pesan'] = "Good! Insert master pegawai success ...";
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
	?>
</div>