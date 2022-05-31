<?php
	if (isset($_GET['id_spkgb'])) {
	$id_spkgb = $_GET['id_spkgb'];
	
	include "../../config/koneksi.php";
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_spkgb WHERE id_spkgb='$id_spkgb'");
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
<h1 class="page-header">Riwayat <small>Kenaikan Gaji Berkala <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> Pegawai: <?=$peg['nama']?></small></h1>
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
				<h4 class="panel-title">Form edit kenaikan gaji berkala</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=edit-data-kgb&id_spkgb=<?=$id_spkgb?>" class="form-horizontal" method="POST" enctype="multipart/form-data" >
					<div class="form-group">
						<label class="col-md-3 control-label">Nomor dan Tanggal KGB</label>
						<div class="col-md-3">
							<input type="text" name="no_kgb" maxlength="32" value="<?=$data['no_kgb']?>" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl" value="<?=$data['tgl']?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<b>Gaji Pokok Lama ( Atas Dasar Surat Keputusan Terakhir Tentang Gaji / Pangkat ) Yang Ditetapkan Oleh :</b>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Pejabat</label>
						<div class="col-md-6">
							<input type="text" name="pejabat_lama" maxlength="255" value="<?=$data['pejabat_lama']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nomor dan Tanggal</label>
						<div class="col-md-3">
							<input type="text" name="no_lama" maxlength="32" value="<?=$data['no_lama']?>" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_lama" value="<?=$data['tgl_lama']?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tanggal Berlakunya Gaji</label>
						<div class="col-md-6">
							<div class="input-group date" id="datepicker-disabled-past3" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_berlaku_lama" value="<?=$data['tgl_berlaku_lama']?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Masa Kerja dan Gaji</label>
						<div class="col-md-3">
							<input type="text" name="mk_lama" maxlength="32" value="<?=$data['mk_lama']?>" class="form-control" />
						</div>
						<div class="col-md-3">
							<input type="text" name="gaji_lama" maxlength="12" value="<?=$data['gaji_lama']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<b>Diberikan  Kenaikan  Gaji  Berkala  Hingga Memperoleh :</b>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Gaji Baru / Terbilang</label>
						<div class="col-md-2">
							<input type="text" name="gaji_baru" maxlength="12" value="<?=$data['gaji_baru']?>" class="form-control" />
						</div>
						<div class="col-md-4">
							<input type="text" name="terbilang_gajibaru" maxlength="255" value="<?=$data['terbilang_gajibaru']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Masa Kerja / Golongan</label>
						<div class="col-md-3">
							<input type="text" name="mk_baru" maxlength="32" value="<?=$data['mk_baru']?>" class="form-control" />
						</div>
						<div class="col-md-3">
							<input type="text" name="gol_baru" maxlength="32" value="<?=$data['gol_baru']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Terhitung  Mulai  Tanggal</label>
						<div class="col-md-6">
							<div class="input-group date" id="datepicker-disabled-past4" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_terhitung" value="<?=$data['tgl_terhitung']?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
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
							<input type="text" name="tembusan3" maxlength="255" value="<?=$data['tembusan3']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="text" name="tembusan4" maxlength="255" value="<?=$data['tembusan4']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="text" name="tembusan5" maxlength="255" value="<?=$data['tembusan5']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="text" name="tembusan6" maxlength="255" value="<?=$data['tembusan6']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="text" name="tembusan7" maxlength="255" value="<?=$data['tembusan7']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="text" name="tembusan8" maxlength="255" value="<?=$data['tembusan8']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="text" name="tembusan9" maxlength="255" value="<?=$data['tembusan9']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="text" name="tembusan10" maxlength="255" value="<?=$data['tembusan10']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="text" name="tembusan11" maxlength="255" value="<?=$data['tembusan11']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="text" name="tembusan12" maxlength="255" value="<?=$data['tembusan12']?>" class="form-control" />
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