<?php
	if (isset($_GET['id_cuti'])) {
	$id_cuti = $_GET['id_cuti'];
	
	include "../../config/koneksi.php";
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_cuti WHERE id_cuti='$id_cuti'");
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
<h1 class="page-header">Riwayat <small>Cuti <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> Pegawai: <?=$peg['nama']?></small></h1>
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
				<h4 class="panel-title">Form edit data cuti</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=edit-data-cuti&id_cuti=<?=$id_cuti?>" class="form-horizontal" method="POST" enctype="multipart/form-data" >
					<div class="form-group">
						<label class="col-md-3 control-label">Nomor dan Tanggal Surat Cuti</label>
						<div class="col-md-3">
							<input type="text" name="no_suratcuti" maxlength="32" value="<?=$data['no_suratcuti']?>" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_suratcuti" value="<?=$data['tgl_suratcuti']?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tanggal Pelaksanaan Cuti</label>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_mulai" value="<?=$data['tgl_mulai']?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past3" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_selesai" value="<?=$data['tgl_selesai']?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Jenis Cuti</label>
						<div class="col-md-6">
							<input type="text" name="jns_cuti" maxlength="32" value="<?=$data['jns_cuti']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Lama Cuti dan Terbilang</label>
						<div class="col-md-2">
							<input type="text" name="lama" maxlength="11" value="<?=$data['lama']?>" class="form-control" />
						</div>
						<div class="col-md-2">
							<input type="text" name="lama_terbilang" maxlength="255" value="<?=$data['lama_terbilang']?>" class="form-control" />
						</div>
						<div class="col-md-2">
							<input type="text" name="lama_satuan" maxlength="255" value="<?=$data['lama_satuan']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Ketentuan A</label>
						<div class="col-md-1">
							<input type="text" name="point1" maxlength="2" value="<?=$data['point1']?>" class="form-control" />
						</div>
						<div class="col-md-5">
							<textarea type="text" name="ket1" maxlength="255" class="form-control"><?=$data['ket1']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Ketentuan B</label>
						<div class="col-md-1">
							<input type="text" name="point2" maxlength="2" value="<?=$data['point2']?>" class="form-control" />
						</div>
						<div class="col-md-5">
							<textarea type="text" name="ket2" maxlength="255" class="form-control"><?=$data['ket2']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Ketentuan C</label>
						<div class="col-md-1">
							<input type="text" name="point3" maxlength="2" value="<?=$data['point3']?>" class="form-control" />
						</div>
						<div class="col-md-5">
							<textarea type="text" name="ket3" maxlength="255" class="form-control"><?=$data['ket3']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tembusan</label>
						<div class="col-md-6">
							<input type="text" name="tembusan1" maxlength="255" value="<?=$data['tembusan1']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="text" name="tembusan2" maxlength="255" value="<?=$data['tembusan2']?>" class="form-control" />
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