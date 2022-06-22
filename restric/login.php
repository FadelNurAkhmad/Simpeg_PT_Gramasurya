<div class="row">
<?php
	include "config/koneksi.php";
	$id_user		= $_POST['id_user'];
	$password		= $_POST['password'];
	$op 			= $_GET['op'];

	if($op=="in"){
		$sql = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user='$id_user'");
		if(mysqli_num_rows($sql)==1){
			$qry = mysqli_fetch_array($sql, MYSQLI_ASSOC);
			$checkPassword = password_verify($password, $qry["password"]);

			if($checkPassword === false) {
				$_SESSION['pesan'] = "Login Failed! Password tidak sesuai ...";
				header("location:./");
			} else {
			
				$_SESSION['id_user']	= $qry['id_user'];
				$_SESSION['nama_user']	= $qry['nama_user'];
				$_SESSION['hak_akses']	= $qry['hak_akses'];
				$_SESSION['id_peg']		= $qry['id_peg'];
				
				if($qry['hak_akses']=="Superadmin"){
					$_SESSION['pesan'] = "Login Success!";
					header("location:pages/superadmin/");
				}
				else if($qry['hak_akses']=="Admin"){
					$_SESSION['pesan'] = "Login Success!";
					header("location:pages/admin/");
				}
				else if($qry['hak_akses']=="Pegawai"){
					$_SESSION['pesan'] = "Login Success!";
					header("location:pages/pegawai/");
				}
			}	
		}
		else{
			$_SESSION['pesan'] = "Login Failed! Username & password tidak sesuai ...";
			header("location:./");
		}
	}
	else if($op=="out"){
		unset($_SESSION['id_user']);
		unset($_SESSION['hak_akses']);
		header("location:./");
	}
?>
</div>