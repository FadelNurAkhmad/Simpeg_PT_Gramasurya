<div class="row">
<?php
	if (isset($_GET['pegawai_id'])) {
	$id_peg = $_GET['pegawai_id'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilPeg	= mysqli_query($koneksi, "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id = tb_pegawai.pegawai_id WHERE pegawai.pegawai_id='$id_peg'");
	$hasil	= mysqli_fetch_array ($tampilPeg, MYSQLI_ASSOC);
				
	if ($_POST['edit'] == "edit") {
		$foto = $_FILES['foto']['name'];
	
	
		if (empty($_FILES['foto']['name'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-ganti-foto&pegawai_id=$id_peg");
		}		
		else {
			$update= mysqli_query ($koneksi, "UPDATE tb_pegawai SET foto='$foto' WHERE pegawai_id='$id_peg'");
			if($update){
				$_SESSION['pesan'] = "Good! ganti foto $hasil[pegawai_nip] success ...";
				header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
			if (strlen($foto)>0) {
				if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
					move_uploaded_file ($_FILES['foto']['tmp_name'], "../../assets/img/foto/".$foto);
				}
			}
		}
	}
?>
</div>