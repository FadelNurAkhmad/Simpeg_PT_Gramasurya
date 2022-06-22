<div class="row">
<?php
	if (isset($_GET['id_user'])) {
		$id_user = $_GET['id_user'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	
	$password	=password_hash("123", PASSWORD_DEFAULT);
	
	include "../../config/koneksi.php";
	$query	= mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user='$id_user'");
	$hasil	= mysqli_fetch_array ($query, MYSQLI_ASSOC);
				
	$reset= mysqli_query ($koneksi, "UPDATE tb_user SET password='$password' WHERE id_user='$id_user'");
	if($reset){
		$_SESSION['pesan'] = "Good! Reset password $hasil[id_user] success ...";
		header("location:index.php?page=form-view-data-userpeg");
	}
	else {
		echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
	}	
?>
</div>