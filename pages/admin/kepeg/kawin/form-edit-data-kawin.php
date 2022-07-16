<?php
if (isset($_GET['id_kawin'])) {
	$id_kawin = $_GET['id_kawin'];

	include "../../config/koneksi.php";
	$query   = mysqli_query($koneksi, "SELECT * FROM tb_kawin WHERE id_kawin='$id_kawin'");
	$data    = mysqli_fetch_array($query);

	$tampilPeg   = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_Id='$data[id_peg]'");
	$peg    = mysqli_fetch_array($tampilPeg);
} else {
	die("Error. No ID Selected!");
}
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
		if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
			echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; " . $_SESSION['pesan'] . " &nbsp; &nbsp; &nbsp;</div></span>";
		}
		$_SESSION['pesan'] = "";
		?>
	</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Riwayat <small>Surat Izin Kawin <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> Pegawai: <?= $peg['pegawai_nama'] ?></small></h1>
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
				</div>
				<h4 class="panel-title">Form edit data izin kawin</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=edit-data-kawin&id_kawin=<?= $id_kawin ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label">Nomor dan Tanggal Izin Kawin<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-3">
							<input type="text" name="no_kawin" maxlength="32" value="<?= $data['no_kawin'] ?>" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_izin" value="<?= $data['tgl_izin'] ?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Kebangsaan</label>
						<div class="col-md-6">
							<input type="text" name="bangsa1" maxlength="255" value="<?= $data['bangsa1'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Wali (Bapak)</label>
						<div class="col-md-6">
							<input type="text" name="nama_wali_bapak1" maxlength="255" value="<?= $data['nama_wali_bapak1'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Pekerjaan</label>
						<div class="col-md-6">
							<input type="text" name="kerja_wali_bapak1" maxlength="255" value="<?= $data['kerja_wali_bapak1'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Alamat</label>
						<div class="col-md-6">
							<input type="text" name="alamat_wali_bapak1" maxlength="255" value="<?= $data['alamat_wali_bapak1'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Wali (Ibu)</label>
						<div class="col-md-6">
							<input type="text" name="nama_wali_ibu1" maxlength="255" value="<?= $data['nama_wali_ibu1'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Pekerjaan</label>
						<div class="col-md-6">
							<input type="text" name="kerja_wali_ibu1" maxlength="255" value="<?= $data['kerja_wali_ibu1'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Alamat</label>
						<div class="col-md-6">
							<input type="text" name="alamat_wali_ibu1" maxlength="255" value="<?= $data['alamat_wali_ibu1'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<b>UNTUK KAWIN DENGAN</b>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nama<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-6">
							<input type="text" name="nama" maxlength="255" value="<?= $data['nama'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tempat dan Tanggal Lahir<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-3">
							<input type="text" name="tmp_lahir" maxlength="255" value="<?= $data['tmp_lahir'] ?>" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Pekerjaan</label>
						<div class="col-md-6">
							<input type="text" name="pekerjaan" maxlength="255" value="<?= $data['pekerjaan'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">NIP/NIK</label>
						<div class="col-md-6">
							<input type="text" name="nik" maxlength="255" value="<?= $data['nik'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Pangkat/Golongan</label>
						<div class="col-md-3">
							<input type="text" name="pangkat" maxlength="255" value="<?= $data['pangkat'] ?>" class="form-control" />
						</div>
						<div class="col-md-3">
							<input type="text" name="gol" maxlength="255" value="<?= $data['gol'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Jabatan</label>
						<div class="col-md-6">
							<input type="text" name="jab" maxlength="255" value="<?= $data['jab'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Instansi</label>
						<div class="col-md-6">
							<input type="text" name="instansi" maxlength="255" value="<?= $data['instansi'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Kebangsaan</label>
						<div class="col-md-6">
							<input type="text" name="bangsa2" maxlength="255" value="<?= $data['bangsa2'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Agama</label>
						<div class="col-md-6">
							<input type="text" name="agama" maxlength="255" value="<?= $data['agama'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Alamat</label>
						<div class="col-md-6">
							<input type="text" name="alamat" maxlength="255" value="<?= $data['alamat'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Wali (Bapak)</label>
						<div class="col-md-6">
							<input type="text" name="nama_wali_bapak2" maxlength="255" value="<?= $data['nama_wali_bapak2'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Pekerjaan</label>
						<div class="col-md-6">
							<input type="text" name="kerja_wali_bapak2" maxlength="255" value="<?= $data['kerja_wali_bapak2'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Alamat</label>
						<div class="col-md-6">
							<input type="text" name="alamat_wali_bapak2" maxlength="255" value="<?= $data['alamat_wali_bapak2'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Wali (Ibu)</label>
						<div class="col-md-6">
							<input type="text" name="nama_wali_ibu2" maxlength="255" value="<?= $data['nama_wali_ibu2'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Pekerjaan</label>
						<div class="col-md-6">
							<input type="text" name="kerja_wali_ibu2" maxlength="255" value="<?= $data['kerja_wali_ibu2'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Alamat</label>
						<div class="col-md-6">
							<input type="text" name="alamat_wali_ibu2" maxlength="255" value="<?= $data['alamat_wali_ibu2'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tempat dan Tanggal Kawin</label>
						<div class="col-md-3">
							<input type="text" name="tmp_kawin" maxlength="255" value="<?= $data['tmp_kawin'] ?>" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past3" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_kawin" value="<?= $data['tgl_kawin'] ?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tanggal Ditetapkan<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-6">
							<div class="input-group date" id="datepicker-disabled-past4" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_ditetapkan" value="<?= $data['tgl_ditetapkan'] ?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="edit" value="edit" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp;Edit</button>&nbsp;
							<a type="button" class="btn btn-default active" href="index.php?page=detail-data-pegawai&pegawai_id=<?= $data['id_peg'] ?>"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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
<script>
	// 500 = 0,5 s
	$(document).ready(function() {
		setTimeout(function() {
			$(".pesan").fadeIn('slow');
		}, 500);
	});
	setTimeout(function() {
		$(".pesan").fadeOut('slow');
	}, 7000);
</script>