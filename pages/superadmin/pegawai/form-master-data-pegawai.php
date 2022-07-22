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
<h1 class="page-header">Data <small>Pegawai <i class="fa fa-angle-right"></i> Insert&nbsp;</small></h1>
<!-- end page-header -->
<?php
function kdauto($tabel, $inisial)
{
	include "../../config/koneksi.php";

	$struktur   = mysqli_query($koneksi, "SELECT * FROM $tabel");
	$fieldInfo = mysqli_fetch_field_direct($struktur, 0);
	$field      = $fieldInfo->name;
	$panjang    = $fieldInfo->length;
	$qry  = mysqli_query($koneksi, "SELECT max(" . $field . ") FROM " . $tabel);
	$row  = mysqli_fetch_array($qry, MYSQLI_NUM);
	if ($row[0] == "") {
		$angka = 0;
	} else {
		$angka = substr($row[0], strlen($inisial));
	}
	$angka++;
	$angka = strval($angka);
	$tmp  = "";
	for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
		$tmp = $tmp . "0";
	}
	return $inisial . $tmp . $angka;
}
$id_peg	= kdauto("tb_pegawai", "");
?>
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
				<h4 class="panel-title">Form master data pegawai</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=master-data-pegawai&pegawai_id=<?= $id_peg ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">

					<div class="form-group" style="display:none">
						<label class="col-md-3 control-label">Record Pegawai<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-6">
							<?php
							$ambilId = mysqli_query($koneksi, "SELECT *FROM pegawai ORDER BY pegawai_id DESC LIMIT 1");
							$id = mysqli_fetch_array($ambilId);

							$id_explode = explode(".", $id['pegawai_nip']);
							$recordId = $id_explode[3];
							?>
							<input type="text" value="<?= $recordId + 1 ?>" name="record_id" id="record_id" maxlength="24" class="form-control" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">PIN<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-6">
							<?php
							$sql = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_id DESC LIMIT 1");
							$pin = mysqli_fetch_array($sql);
							?>
							<input type="text" value="<?= $pin['pegawai_pin'] + 1 ?>" name="pegawai_pin" maxlength="24" class="form-control" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Nama Pegawai<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-6">
							<input type="text" name="pegawai_nama" maxlength="64" class="form-control" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Tanggal Masuk Kerja<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past3" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_masuk_pertama" id="tgl_masuk_pertama" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tanggal Mulai Kerja<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_mulai_kerja" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">NIP<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-4">
							<input type="text" name="pegawai_nip" id="pegawai_nip" maxlength="24" class="form-control" />
						</div>
						<div class="col-sm-2">
							<a type="button" class="btn btn-success btn-sm pull-right" onclick="generateNip()"><i class="fa fa-plus-circle"></i> Generate NIP&nbsp;</a>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Status Pegawai<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-6">
							<select name="pegawai_status" class="default-select2 form-control" id="option" onchange="selectOption()">
								<option value="1">Aktif</option>
								<option value="2">Non Aktif</option>
							</select>
						</div>
					</div>
					<div class="form-group" id="resign" style="display:none">
						<label class="col-md-3 control-label">Tanggal Berhenti</label>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past4" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_resign" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-3 control-label">Tempat, Tanggal Lahir<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-3">
							<input type="text" name="tempat_lahir" id="tempat_lahir" maxlength="64" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>








					<div class="form-group">
						<label class="col-md-3 control-label">Agama<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-6">
							<select name="agama" class="default-select2 form-control">
								<option value="1">Islam</option>
								<option value="2">Katolik</option>
								<option value="3">Protestan</option>
								<option value="4">Hindu</option>
								<option value="5">Budha</option>
								<option value="6">Lainnya</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Jenis Kelamin<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-6">
							<select name="gender" class="default-select2 form-control">
								<option value="1">Laki-laki</option>
								<option value="2">Perempuan</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Golongan Darah<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-6">
							<select name="gol_darah" class="default-select2 form-control">
								<option value="1">A+</option>
								<option value="2">B+</option>
								<option value="3">O+</option>
								<option value="4">AB+</option>
								<option value="5">A-</option>
								<option value="6">B-</option>
								<option value="7">O-</option>
								<option value="8">AB-</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Status Pernikahan<span aria-required="true" class="text-danger"> * </span></label>
						<div class="col-md-6">
							<select name="stat_nikah" class="default-select2 form-control">
								<option value="1">Sudah Menikah</option>
								<option value="2">Belum Menikah</option>
								<option value="3">Duda/Janda Meninggal</option>
								<option value="4">Duda/Janda Cerai</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Alamat</label>
						<div class="col-md-6">
							<textarea name="alamat" maxlength="255" class="form-control"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">No. Telp</label>
						<div class="col-md-6">
							<input type="text" name="pegawai_telp" maxlength="12" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Email</label>
						<div class="col-md-6">
							<input type="text" name="email" maxlength="64" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Keterangan</label>
						<div class="col-md-6">
							<input type="text" name="ket" maxlength="64" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right">Foto</label>
						<div class="col-sm-6">
							<input type="file" name="foto" maxlength="255" class="form-control" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>&nbsp;
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

		if (select.value == "2") {
			resign.style.display = "block";

		} else {
			resign.style.display = "none";
		}
	}

	selectOption();
</script>

<script type="text/javascript">
	// $(document).ready(function() {

	// 	$("#set_nip").keyup(function() {
	// 		var tgl_masuk_pertama = new Date($("#tgl_masuk_pertama").val());
	// 		var tahun = tgl_masuk_pertama.getFullYear();
	// 		var year2digits = tahun.toString().substring(2);

	// 		var pegawai_nip = year2digits;
	// 		$("#pegawai_nip").val(pegawai_nip);
	// 	});

	// });

	function generateNip() {
		var doc = document.getElementById("tgl_masuk_pertama");
		var doc2 = document.getElementById("pegawai_nip");
		var doc3 = document.getElementById("record_id");

		var tgl_masuk_pertama = new Date(doc.value);
		var tahun = tgl_masuk_pertama.getFullYear();
		var bulan = ("0" + (tgl_masuk_pertama.getMonth() + 1)).slice(-2);
		var year2digits = tahun.toString().substring(2);

		doc2.value = "2012." + year2digits + "." + bulan + "." + doc3.value;

	}
</script>