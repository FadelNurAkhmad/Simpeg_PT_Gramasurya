<?php
	if (isset($_GET['id_skp'])) {
	$id_skp = $_GET['id_skp'];
	
	include "../../config/koneksi.php";
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_skp WHERE id_skp='$id_skp'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
		
	$tampilPeg   =mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$data[id_peg]'");
	$peg    =mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);
	}
	else {
		die ("Error. No ID Selected!");	
	}
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
			if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
				echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; ".$_SESSION['pesan']." &nbsp; &nbsp; &nbsp;</div></span>";
			}
			$_SESSION['pesan'] ="";
		?>
	</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Riwayat <small>SKP <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> Pegawai: <?=$peg['nama']?></small></h1>
<!-- begin row -->
<div class="row">
	<!-- begin col-12 -->
    <div class="col-md-12">
		<!-- begin panel -->
		<div class="panel panel-inverse" data-sortable-id="form-stuff-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Form edit data SKP</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=edit-data-skp&id_skp=<?=$id_skp?>" class="form-horizontal" method="POST" enctype="multipart/form-data" >
					<div class="form-group">
						<label class="col-md-3 control-label">Periode Penilaian</label>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
								<input type="text" name="periode_awal" value="<?=$data['periode_awal']?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
								<input type="text" name="periode_akhir" value="<?=$data['periode_akhir']?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Pejabat Penilai</label>
						<div class="col-md-6">
							<input type="text" name="penilai" maxlength="64" value="<?=$data['penilai']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Atasan Pejabat Penilai</label>
						<div class="col-md-6">
							<input type="text" name="atasan_penilai" maxlength="64" value="<?=$data['atasan_penilai']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nilai Orientasi Pelayanan</label>
						<div class="col-md-4">
							<input type="text" name="nilai_orientasi" maxlength="11" value="<?=$data['nilai_orientasi']?>" class="form-control" />
						</div>
						<div class="col-md-2">
							<p>* Angka</p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nilai Integritas</label>
						<div class="col-md-4">
							<input type="text" name="nilai_integritas" maxlength="11" value="<?=$data['nilai_integritas']?>" class="form-control" />
						</div>
						<div class="col-md-2">
							<p>* Angka</p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nilai Komitmen</label>
						<div class="col-md-4">
							<input type="text" name="nilai_komitmen" maxlength="11" value="<?=$data['nilai_komitmen']?>" class="form-control" />
						</div>
						<div class="col-md-2">
							<p>* Angka</p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nilai Disiplin</label>
						<div class="col-md-4">
							<input type="text" name="nilai_disiplin" maxlength="11" value="<?=$data['nilai_disiplin']?>" class="form-control" />
						</div>
						<div class="col-md-2">
							<p>* Angka</p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nilai Kerjasama</label>
						<div class="col-md-4">
							<input type="text" name="nilai_kerjasama" maxlength="11" value="<?=$data['nilai_kerjasama']?>" class="form-control" />
						</div>
						<div class="col-md-2">
							<p>* Angka</p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nilai Kepemimpinan</label>
						<div class="col-md-4">
							<input type="text" name="nilai_kepemimpinan" maxlength="11" value="<?=$data['nilai_kepemimpinan']?>" class="form-control" />
						</div>
						<div class="col-md-2">
							<p>* Angka</p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Hasil Penilian</label>
						<div class="col-md-6">
							<select name="hasil_penilaian" class="default-select2 form-control">
								<option value="Sangat Baik" <?php echo ($data['hasil_penilaian']=='Sangat Baik')?"selected":""; ?>>Sangat Baik      
								<option value="Baik" <?php echo ($data['hasil_penilaian']=='Baik')?"selected":""; ?>>Baik      
								<option value="Cukup Baik" <?php echo ($data['hasil_penilaian']=='Cukup Baik')?"selected":""; ?>>Cukup Baik      
								<option value="Kurang Baik" <?php echo ($data['hasil_penilaian']=='Kurang Baik')?"selected":""; ?>>Kurang Baik
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="edit" value="edit" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp;Edit</button>&nbsp;
							<a type="button" class="btn btn-default active" href="index.php?page=detail-data-pegawai&id_peg=<?=$data['id_peg']?>"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- end panel -->
	</div>
	<!-- end col-6 -->
</div>
<!-- end row -->
<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);
</script>