<div class="row">
<?php
	if (isset($_GET['id_pangkat'])) {
	$id_pangkat = $_GET['id_pangkat'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../../config/koneksi.php";
	$tampilPan	= mysqli_query($koneksi, "SELECT * FROM tb_pangkat WHERE id_pangkat='$id_pangkat'");
	$hasil	= mysqli_fetch_array ($tampilPan, MYSQLI_ASSOC);
		$id_peg	=$hasil['id_peg'];
				
	if ($_POST['edit'] == "edit") {
	$pangkat		=$_POST['pangkat'];
	$gol			=$_POST['gol'];
	$jns_pangkat	=$_POST['jns_pangkat'];
	$tmt_pangkat	=$_POST['tmt_pangkat'];
	$pejabat_sk		=$_POST['pejabat_sk'];
	$no_sk			=$_POST['no_sk'];
	$tgl_sk			=$_POST['tgl_sk'];
	$file			=$_FILES['file']['name'];
	
		if (empty($_POST['pangkat']) || empty($_POST['gol']) || empty($_POST['jns_pangkat']) || empty($_POST['pejabat_sk']) || empty($_POST['no_sk']) || empty($_POST['tgl_sk'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-pangkat&id_pangkat=$id_pangkat");
		}		
		else{
		$update= mysqli_query ($koneksi, "UPDATE tb_pangkat SET pangkat='$pangkat', gol='$gol', jns_pangkat='$jns_pangkat', tmt_pangkat='$tmt_pangkat', pejabat_sk='$pejabat_sk', no_sk='$no_sk', tgl_sk='$tgl_sk', file='$file' WHERE id_pangkat='$id_pangkat'");
			if($update){
				$_SESSION['pesan'] = "Good! edit data pangkat success ...";
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