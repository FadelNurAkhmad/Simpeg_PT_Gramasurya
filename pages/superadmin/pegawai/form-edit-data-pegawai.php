<?php
if (isset($_GET['pegawai_id'])) {
	$id_peg = $_GET['pegawai_id'];

	include "../../config/koneksi.php";
	// mengambil data pegawai dari gabungan tabel pegawai, tb_pegawai, pegawai_d
	$query = "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id = tb_pegawai.pegawai_id INNER JOIN pegawai_d ON pegawai.pegawai_id = pegawai_d.pegawai_id WHERE pegawai.pegawai_id=$id_peg";
	$sql   = mysqli_query($koneksi, $query);
	$data    = mysqli_fetch_array($sql);
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
<h1 class="page-header">Data <small>Pegawai <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> NIP_<?= $data['pegawai_nip'] ?></small></h1>
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
				<h4 class="panel-title">Form edit data pegawai</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=edit-data-pegawai&pegawai_id=<?= $id_peg ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label">PIN*</label>
						<div class="col-md-6">
							<input type="text" value="<?= $data['pegawai_pin'] ?>" name="pegawai_pin" maxlength="24" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">NIP*</label>
						<div class="col-md-6">
							<input type="text" name="pegawai_nip" maxlength="24" value="<?= $data['pegawai_nip'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Status Pegawai*</label>
						<div class="col-md-6">
							<select name="pegawai_status" class="default-select2 form-control" id="option" onchange="selectOption()">
								<option value="0" <?php echo ($data['pegawai_status'] == '0') ? "selected" : ""; ?>>Non Aktif
								<option value="1" <?php echo ($data['pegawai_status'] == '1') ? "selected" : ""; ?>>Aktif
								<option value="2" <?php echo ($data['pegawai_status'] == '2') ? "selected" : ""; ?>>Berhenti
							</select>
						</div>
					</div>
					<div class="form-group" id="resign" style="display:none">
						<label class="col-md-3 control-label">Tanggal Berhenti</label>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past4" data-date-format="yyyy-mm-dd">
								<input type="text" id="tglResign" value="<?= $data['tgl_resign'] ?>" name="tgl_resign" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tempat, Tanggal Lahir*</label>
						<div class="col-md-3">
							<input type="text" name="tempat_lahir" maxlength="64" value="<?= $data['tempat_lahir'] ?>" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Pegawai*</label>
						<div class="col-md-6">
							<input type="text" name="pegawai_nama" maxlength="64" value="<?= $data['pegawai_nama'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tanggal Mulai Kerja*</label>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
								<input type="text" value="<?= $data['tgl_mulai_kerja'] ?>" name="tgl_mulai_kerja" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tanggal Masuk Kerja*</label>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past3" data-date-format="yyyy-mm-dd">
								<input type="text" value="<?= $data['tgl_masuk_pertama'] ?>" name="tgl_masuk_pertama" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Agama*</label>
						<div class="col-md-6">
							<select name="agama" class="default-select2 form-control">
								<option value="1" <?php echo ($data['agama'] == '1') ? "selected" : ""; ?>>Islam
								<option value="2" <?php echo ($data['agama'] == '2') ? "selected" : ""; ?>>Katolik
								<option value="3" <?php echo ($data['agama'] == '3') ? "selected" : ""; ?>>Protestan
								<option value="4" <?php echo ($data['agama'] == '4') ? "selected" : ""; ?>>Hindu
								<option value="5" <?php echo ($data['agama'] == '5') ? "selected" : ""; ?>>Budha
								<option value="6" <?php echo ($data['agama'] == '6') ? "selected" : ""; ?>>Lainnya
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Jenis Kelamin*</label>
						<div class="col-md-6">
							<select name="gender" class="default-select2 form-control">
								<option value="1" <?php echo ($data['gender'] == '1') ? "selected" : ""; ?>>Laki-laki
								<option value="2" <?php echo ($data['gender'] == '2') ? "selected" : ""; ?>>Perempuan
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Golongan Darah*</label>
						<div class="col-md-6">
							<select name="gol_darah" class="default-select2 form-control">
								<option value="1" <?php echo ($data['gol_darah'] == '1') ? "selected" : ""; ?>>A+
								<option value="2" <?php echo ($data['gol_darah'] == '2') ? "selected" : ""; ?>>B+
								<option value="3" <?php echo ($data['gol_darah'] == '3') ? "selected" : ""; ?>>O+
								<option value="4" <?php echo ($data['gol_darah'] == '4') ? "selected" : ""; ?>>AB+
								<option value="5" <?php echo ($data['gol_darah'] == '5') ? "selected" : ""; ?>>A-
								<option value="6" <?php echo ($data['gol_darah'] == '6') ? "selected" : ""; ?>>B-
								<option value="7" <?php echo ($data['gol_darah'] == '7') ? "selected" : ""; ?>>O-
								<option value="8" <?php echo ($data['gol_darah'] == '8') ? "selected" : ""; ?>>AB-
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Status Pernikahan*</label>
						<div class="col-md-6">
							<select name="stat_nikah" class="default-select2 form-control">
								<option value="1" <?php echo ($data['stat_nikah'] == '1') ? "selected" : ""; ?>>Sudah Menikah
								<option value="2" <?php echo ($data['stat_nikah'] == '2') ? "selected" : ""; ?>>Belum Menikah
								<option value="3" <?php echo ($data['stat_nikah'] == '3') ? "selected" : ""; ?>>Duda/Janda Meninggal
								<option value="4" <?php echo ($data['stat_nikah'] == '4') ? "selected" : ""; ?>>Duda/Janda Cerai
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Alamat</label>
						<div class="col-md-6">
							<textarea name="alamat" maxlength="255" class="form-control"><?= $data['alamat'] ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">No. Telp</label>
						<div class="col-md-6">
							<input type="text" name="pegawai_telp" maxlength="12" value="<?= $data['pegawai_telp'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Email</label>
						<div class="col-md-6">
							<input type="text" name="email" maxlength="64" value="<?= $data['email'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="edit" value="edit" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp;Edit</button>&nbsp;
							<a type="button" class="btn btn-default active" href="index.php?page=form-view-data-pegawai"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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

	function selectOption() {
		var select = document.getElementById("option");
		var resign = document.getElementById("resign");
		var tgl = document.getElementById("tglResign");

		if (select.value == "2") {
			resign.style.display = "block";

		} else {
			resign.style.display = "none";
			tgl.value = null;
		}
	}

	selectOption();
</script>