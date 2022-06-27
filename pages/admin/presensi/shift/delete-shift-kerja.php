<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['jk_id'])) {
	$jk_id = $_GET['jk_id'];
	
	$query   =mysqli_query($koneksi, "SELECT * FROM jam_kerja WHERE jk_id='$jk_id'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
	$nama	= $data['jk_name'];

	$cekshift = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jdw_kerja_d WHERE jk_id='$jk_id'"));
	
	
	}
	else {
		die ("Error. No ID Selected! ");	
	}

	if($cekshift > 0) {
		$_SESSION['pesan'] = "Oops! Shift sedang dipakai di jadwal kerja ...";
		header("location:index.php?page=form-view-shift-kerja");
	} else if (!empty($jk_id) && $jk_id != "") {
		

		$delete	=mysqli_query($koneksi, "DELETE FROM jam_kerja WHERE jk_id='$jk_id'");
		
		
		if($delete){
			$_SESSION['pesan'] = "Good! Delete shift kerja \"$nama\" success ...";
			header("location:index.php?page=form-view-shift-kerja");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	
	
	mysqli_close($koneksi);
?>
</div>