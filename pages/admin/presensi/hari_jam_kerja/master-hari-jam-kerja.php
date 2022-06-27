<div class="row">
<?php



	if (isset($_GET['jdw_kerja_m_id'])) {
	    $jdw_kerja_m_id = $_GET['jdw_kerja_m_id']; 
	}
	else {
		die ("Error. No Kode Selected! ");	
	}	
				
	if ($_POST['save'] == "save") {
	$jdw_kerja_m_name           =$_POST['jdw_kerja_m_name'];
	$jdw_kerja_m_kode			=$_POST['jdw_kerja_m_kode'];
	$jdw_kerja_m_keterangan		=$_POST['jdw_kerja_m_keterangan'];
	$jdw_kerja_m_mulai          =$_POST['jdw_kerja_m_mulai'];
	
    $date = new DateTime($jdw_kerja_m_mulai);
    $day = $date->format('D');
	
   

    include "../../config/koneksi.php";
	$cekkode	=mysqli_num_rows (mysqli_query($koneksi, "SELECT jdw_kerja_m_kode FROM jdw_kerja_m WHERE jdw_kerja_m_kode='$_POST[jdw_kerja_m_kode]'"));
	
		if (empty($_POST['jdw_kerja_m_name']) || empty($_POST['jdw_kerja_m_kode']) || empty($_POST['jdw_kerja_m_mulai'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-hari-jam-kerja");
		}		
		else if($cekkode > 0) {
			$_SESSION['pesan'] = "Oops! Duplikat data ...";
			header("location:index.php?page=form-master-hari-jam-kerja");
		} 
		else if($day != "Mon") {
			$_SESSION['pesan'] = "Oops! Tanggal Mulai harus di hari Senin ...";
			header("location:index.php?page=form-master-hari-jam-kerja");
		}
		else {
		    $insert = mysqli_query ($koneksi, "INSERT INTO jdw_kerja_m (jdw_kerja_m_id, jdw_kerja_m_kode, jdw_kerja_m_name, jdw_kerja_m_keterangan, jdw_kerja_m_periode, jdw_kerja_m_mulai, jdw_kerja_m_type, use_sama)
                                VALUES ('$jdw_kerja_m_id', '$jdw_kerja_m_kode', '$jdw_kerja_m_name', '$jdw_kerja_m_keterangan', '7', '$jdw_kerja_m_mulai', '0', '-1')");
            
            for($i=1; $i<=8; $i++) {
                $hari = "";
                switch($i){
                    case 1 :
                        $hari = "Senin";
                        $jk_id	                =$_POST['jk_id1'];
                    	$libur	                =$_POST['libur1']; 
                        break;
                    case 2 :
                        $hari = "Selasa";
                        $jk_id	                =$_POST['jk_id2'];
                    	$libur	                =$_POST['libur2'];
                        break;
                    case 3 :
                        $hari = "Rabu";
                        $jk_id	                =$_POST['jk_id3'];
                    	$libur	                =$_POST['libur3'];
                        break;
                    case 4 :
                        $hari = "Kamis";
                        $jk_id	                =$_POST['jk_id4'];
                    	$libur	                =$_POST['libur4'];
                        break;
                    case 5 :
                        $hari = "Jumat";
                        $jk_id	                =$_POST['jk_id5'];
                    	$libur	                =$_POST['libur5'];
                        break;
                    case 6 :
                        $hari = "Sabtu";
                        $jk_id	                =$_POST['jk_id6'];
                    	$libur	                =$_POST['libur6'];
                        break;
                    case 7 :
                        $hari = "Minggu";
                        $jk_id	                =$_POST['jk_id7'];
                    	$libur	                =$_POST['libur7'];
                        break;
                    default :
                        $i = 999;
                        $hari = "Libur Umum";
                        $jk_id	                =$_POST['jk_id8'];
                    	$libur	                =$_POST['libur8'];
                        break;
                }
                $insertJdw = mysqli_query($koneksi, "INSERT INTO jdw_kerja_d (jdw_kerja_m_id, jdw_kerja_d_idx, jk_id, jdw_kerja_d_hari, jdw_kerja_d_libur)
                                            VALUES ('$jdw_kerja_m_id', '$i', '$jk_id', '$hari', '$libur')");
            }
            
		
		
            if($insert){
                $_SESSION['pesan'] = "Good! Insert Jadwal Kerja Normal success ...";
                header("location:index.php?page=form-view-hari-jam-kerja");
            }
            else {
                 echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
		}
	}
?>
</div>