<!-- begin page-header -->
<h1 class="page-header">Backup <small>Database </small></h1>
<!-- end page-header -->
<div class="profile-container">
	<?php
		error_reporting(0);
		$file=date("Ymd").'_BackupDB.sql';
		backup_tables("localhost","root","","db_simpeg7",$file);
	?>
	<!-- begin profile-section -->
	<div class="profile-section">
		<div class="panel-body">
			<div class="form-group">
				<p align="center">Backup Database Berhasil ! Please download file ...</p>
			</div>
			<div class="form-group">
				<br />
			</div>
			<div class="form-group">
				<p align="center">
					<a type="button" href="../../assets/backup/<?=$file?>" title="Download" target="_blank" class="btn btn-success"><i class="fa-lg ion-ios-cloud-download-outline"></i> &nbsp;Download</a>
				</p>
			</div>
		</div>
	</div>
	<!-- end profile-section -->
	<?php
	/*
	untuk memanggil nama fungsi :: jika anda ingin membackup semua tabel yang ada didalam database, biarkan tanda BINTANG (*) pada variabel $tables = '*'
	jika hanya tabel-table tertentu, masukan nama table dipisahkan dengan tanda KOMA (,) 
	*/
	function backup_tables($host,$user,$pass,$name,$nama_file,$tables ='*')	{
		$link = mysqli_connect($host,$user,$pass);
		mysqli_select_db($link, $name);
			
		if($tables == '*'){
			$tables = array();
			$result = mysqli_query($link, 'SHOW TABLES');
			while($row = mysqli_fetch_row($result)){
				$tables[] = $row[0];
			}
		}
		else{ //jika hanya table-table tertentu
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
				
		foreach($tables as $table){
			$result = mysqli_query($link, 'SELECT * FROM '.$table);
			$num_fields = mysqli_num_fields($result);
																
			$return.= 'DROP TABLE '.$table.';'; //menyisipkan query drop table untuk nanti hapus table yang lama
			$row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
					
			for ($i = 0; $i < $num_fields; $i++) {
				while($row = mysqli_fetch_row($result)){	//menyisipkan query Insert. untuk nanti memasukan data yang lama ketable yang baru dibuat
				$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) { //akan menelusuri setiap baris query didalam
						$row[$j] = addslashes($row[$j]);
						$row[$j] = ereg_replace("\n","\\n",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
					$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}							
		//simpan file di folder
		$nama_file;
		$handle = fopen('../../assets/backup/'.$nama_file,'w+');
		fwrite($handle,$return);
		fclose($handle);
	}
	?>
</div>