<div class="row">
<?php
	if (isset($_GET['id_ortu'])) {
	$id_ortu = $_GET['id_ortu'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilOrt	= mysql_query("SELECT * FROM tb_ortu WHERE id_ortu='$id_ortu'");
	$hasil	= mysql_fetch_array ($tampilOrt);
		$notnik	=$hasil['nik'];
		$id_peg	=$hasil['id_peg'];
				
	if ($_POST['edit'] == "edit") {
	$nik			=$_POST['nik'];
	$nama			=$_POST['nama'];
	$tmp_lhr		=$_POST['tmp_lhr'];
	$tgl_lhr		=$_POST['tgl_lhr'];
	$pendidikan		=$_POST['pendidikan'];
	$pekerjaan		=$_POST['pekerjaan'];	
	$status_hub		=$_POST['status_hub'];
	
	$ceknik	=mysql_num_rows (mysql_query("SELECT nik FROM tb_ortu WHERE nik='$_POST[nik]' AND nik!='$notnik'"));
	
		if (empty($_POST['nik']) || empty($_POST['nama']) || empty($_POST['tmp_lhr']) || empty($_POST['tgl_lhr']) || empty($_POST['pendidikan']) || empty($_POST['pekerjaan']) || empty($_POST['status_hub'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-ortu&id_ortu=$id_ortu");
		}		
		else if($ceknik > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-edit-data-ortu&id_ortu=$id_ortu");
		}
		else{
		$update= mysql_query ("UPDATE tb_ortu SET nik='$nik', nama='$nama', tmp_lhr='$tmp_lhr', tgl_lhr='$tgl_lhr', pendidikan='$pendidikan', pekerjaan='$pekerjaan', status_hub='$status_hub' WHERE id_ortu='$id_ortu'");
			if($update){
				$_SESSION['pesan'] = "Good! edit data orang tua success ...";
				header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>