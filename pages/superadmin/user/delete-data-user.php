<div class="row">
<?php
include "../../config/koneksi.php";
if (isset($_GET['id_user'])) {
	$id_user = $_GET['id_user'];
	
	$query   =mysql_query("SELECT * FROM tb_user WHERE id_user='$id_user'");
	$data    =mysql_fetch_array($query);
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_user) && $id_user != "") {
		if ($data['hak_akses'] =="Superadmin") {
			$_SESSION['pesan'] = "Oops! You cant delete this $data[hak_akses] ...";
			header("location:index.php?page=form-view-data-user");
		}
		
		else{
			$delete		=mysql_query("DELETE FROM tb_user WHERE id_user='$id_user'");
			if($delete){
				$_SESSION['pesan'] = "Good! Delete user $data[id_user] success ...";
				header("location:index.php?page=form-view-data-user");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	mysql_close($Open);
?>
</div>