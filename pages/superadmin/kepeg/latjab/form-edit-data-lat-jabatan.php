<?php
	if (isset($_GET['id_lat_jabatan'])) {
	$id_lat_jabatan = $_GET['id_lat_jabatan'];
	
	include "../../config/koneksi.php";
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_lat_jabatan WHERE id_lat_jabatan='$id_lat_jabatan'");
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
<h1 class="page-header">Riwayat <small>Latihan Jabatan <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> Pegawai: <?=$peg['nama']?></small></h1>
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
				<h4 class="panel-title">Form edit data latihan jabatan</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=edit-data-lat-jabatan&id_lat_jabatan=<?=$id_lat_jabatan?>" class="form-horizontal" method="POST" enctype="multipart/form-data" >
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Pelatih</label>
						<div class="col-md-6">
							<input type="text" name="nama_pelatih" maxlength="64" value="<?=$data['nama_pelatih']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tahun</label>
						<div class="col-md-6">
							<input type="text" name="tahun_lat" maxlength="4" value="<?=$data['tahun_lat']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Jumlah Jam</label>
						<div class="col-md-6">
							<input type="text" name="jml_jam" maxlength="3" value="<?=$data['jml_jam']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Sertifikat</label>
						<div class="col-md-6">
							<input type="file" name="file" maxlength="255" class="form-control" />
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