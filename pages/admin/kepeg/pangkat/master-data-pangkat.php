<div class="row">
<?php
	if (isset($_GET['id_pangkat'])) {
	$id_pangkat = $_GET['id_pangkat'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
	$id_peg			=$_POST['id_peg'];
	$pangkat		=$_POST['pangkat'];
	$gol			=$_POST['gol'];
	$jns_pangkat	=$_POST['jns_pangkat'];
	$tmt_pangkat	=$_POST['tmt_pangkat'];
	$pejabat_sk		=$_POST['pejabat_sk'];
	$no_sk			=$_POST['no_sk'];
	$tgl_sk			=$_POST['tgl_sk'];
	$file			=$_FILES['file']['name'];
	
	include "../../config/koneksi.php";
	
		if (empty($_POST['id_peg']) || empty($_POST['pangkat']) || empty($_POST['gol']) || empty($_POST['jns_pangkat']) || empty($_POST['pejabat_sk']) || empty($_POST['no_sk']) || empty($_POST['tgl_sk'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-pangkat");
		}
		
		else{
		$insert = "INSERT INTO tb_pangkat (id_pangkat, id_peg, pangkat, gol, jns_pangkat, tmt_pangkat, pejabat_sk, no_sk, tgl_sk, file) VALUES ('$id_pangkat', '$id_peg', '$pangkat', '$gol', '$jns_pangkat', '$tmt_pangkat', '$pejabat_sk', '$no_sk', '$tgl_sk', '$file')";
		$query = mysqli_query ($koneksi, $insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert data pangkat success ...";
			header("location:index.php?page=form-master-data-pangkat");
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