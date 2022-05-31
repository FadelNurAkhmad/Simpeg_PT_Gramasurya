<div class="row">
<?php	
	if ($_POST['save'] == "save") {
	$id_user	=$_POST['id_user'];
	$nama_user	=$_POST['nama_user'];
	$password	=md5($_POST['password']);
	$hak_akses	=$_POST['hak_akses'];
	$avatar		=$_FILES['avatar']['name'];
	
	include "../../config/koneksi.php";
	$cekuser	=mysqli_num_rows (mysqli_query($koneksi, "SELECT id_user FROM tb_user WHERE id_user='$_POST[id_user]'"));
	
		if (empty($_POST['id_user']) || empty($_POST['nama_user']) || empty($_POST['password']) || empty($_POST['hak_akses'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-user");
		}
		else if($cekuser > 0) {
		$_SESSION['pesan'] = "Oops! Username not Available ...";
			header("location:index.php?page=form-master-data-user");
		}
		
		else{
		$insert = "INSERT INTO tb_user (id_user, nama_user, password, hak_akses, avatar) VALUES ('$id_user', '$nama_user', '$password', '$hak_akses', '$avatar')";
		$query = mysqli_query ($koneksi, $insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert User success ...";
			header("location:index.php?page=form-view-data-user");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
		if (strlen($avatar)>0) {
			if (is_uploaded_file($_FILES['avatar']['tmp_name'])) {
				move_uploaded_file ($_FILES['avatar']['tmp_name'], "../../assets/img/".$avatar);
			}
		}
	}
?>
</div>