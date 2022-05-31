<div class="row">
<?php
	if (isset($_GET['id_jab'])) {
	$id_jab = $_GET['id_jab'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilJab	= mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_jab='$id_jab'");
	$hasil	= mysqli_fetch_array ($tampilJab, MYSQLI_ASSOC);
		$id_peg	=$hasil['id_peg'];
				
	if ($_POST['edit'] == "edit") {
	$jabatan		=$_POST['jabatan'];
	$eselon			=$_POST['eselon'];
	$no_sk			=$_POST['no_sk'];
	$tgl_sk			=$_POST['tgl_sk'];
	$tmt_jabatan	=$_POST['tmt_jabatan'];
	$sampai_tgl		=$_POST['sampai_tgl'];
	$file			=$_FILES['file']['name'];
	
		if (empty($_POST['jabatan']) || empty($_POST['eselon']) || empty($_POST['tmt_jabatan'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-jabatan&id_jab=$id_jab");
		}
		else{
		$update= mysqli_query ($koneksi, "UPDATE tb_jabatan SET jabatan='$jabatan', eselon='$eselon', no_sk='$no_sk', tgl_sk='$tgl_sk', tmt_jabatan='$tmt_jabatan', sampai_tgl='$sampai_tgl', file='$file' WHERE id_jab='$id_jab'");
			if($update){
				$_SESSION['pesan'] = "Good! edit data jabatan success ...";
				header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
			if (strlen($file)>0) {
				if (is_uploaded_file($_FILES['file']['tmp_name'])) {
					move_uploaded_file ($_FILES['file']['tmp_name'], "../../assets/file/".$file);
				}
			}
		}
	}
?>
</div>