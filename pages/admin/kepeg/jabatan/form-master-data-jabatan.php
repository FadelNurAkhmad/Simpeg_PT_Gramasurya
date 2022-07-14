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
<h1 class="page-header">Kepegawaian <small><i class="fa fa-angle-right"></i> Jabatan <i class="fa fa-angle-right"></i> Insert&nbsp;</small></h1>
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
	$row  = mysqli_fetch_array($qry);
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
$id_jab	= kdauto("tb_jabatan", "");
?>
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
				<h4 class="panel-title">Form master data jabatan</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=master-data-jabatan&id_jab=<?= $id_jab ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label">Pegawai</label>
						<div class="col-md-6">
							<?php
							$data = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_nama ASC");
							echo '<select name="pegawai_id" class="default-select2 form-control">';
							echo '<option value="">...</option>';
							while ($row = mysqli_fetch_array($data)) {
								echo '<option value="' . $row['pegawai_id'] . '">' . $row['pegawai_nama'] . '_' . $row['pegawai_nip'] . '</option>';
							}
							echo '</select>';
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Jabatan</label>
						<div class="col-md-4">
							<?php
							$dataJ = mysqli_query($koneksi, "SELECT * FROM pembagian1 ORDER BY pembagian1_nama");
							echo '<select name="jabatan" class="default-select2 form-control">';
							echo '<option value="">...</option>';
							while ($rowj = mysqli_fetch_array($dataJ)) {
								echo '<option value="' . $rowj['pembagian1_nama'] . '">' . $rowj['pembagian1_nama'] . '</option>';
							}
							echo '</select>';
							?>
						</div>
						<div class="col-sm-2">
							<a type="button" class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#jab"><i class="fa fa-plus-circle"></i> Add Jabatan&nbsp;</a>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Nomor dan Tanggal SK</label>
						<div class="col-md-3">
							<input type="text" name="no_sk" maxlength="255" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
								<input type="text" value="" name="tgl_sk" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">TMT Jabatan</label>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past3" data-date-format="yyyy-mm-dd">
								<input type="text" value="" name="tmt_jabatan" placeholder="Dari" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past4" data-date-format="yyyy-mm-dd">
								<input type="text" value="" name="sampai_tgl" placeholder="Sampai" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">File SK Jabatan</label>
						<div class="col-md-6">
							<input type="file" name="file" maxlength="255" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>&nbsp;
							<a type="button" class="btn btn-default active" href="./"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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
<div id="jab" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Master Data Jabatan</h4>
			</div>
			<div class="col-sm-12">
				<div class="modal-body">
					<form action="index.php?page=masterjab" class="form-horizontal" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Jabatan</label>
							<div class="col-md-4">
								<input type="text" name="pembagian1_nama" maxlength="32" class="form-control" />
							</div>
							<div class="col-md-4">
								<p>* Ex: Kepala Dinas</p>
							</div>
							<div class="col-md-2">
								<button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>
							</div>
						</div>
					</form>
					<div class="widget-body">
						<div class="widget-main">
							<table class="table table-bordered table-striped">
								<thead class="thin-border-bottom">
									<tr>
										<th width="10%"><i class="fa fa-caret-right"></i> No</th>
										<th width="70%"><i class="fa fa-caret-right"></i> Nama Jabatan</th>
										<th width="20%">
											<center><i class="fa fa-code fa-lg"></i></center>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 0;
									$tampilJ	= mysqli_query($koneksi, "SELECT * FROM pembagian1 ORDER BY pembagian1_nama ASC");
									while ($jab = mysqli_fetch_array($tampilJ, MYSQLI_ASSOC)) {
										$no++;
									?>
										<tr>
											<td><?= $no ?></td>
											<td><?php echo $jab['pembagian1_nama']; ?></td>
											<td class="tools" align="center">
												<a href="index.php?page=form-edit-masterjab&pembagian1_id=<?= $jab['pembagian1_id']; ?>" title="edit" type="button" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit fa-lg"></i></a>&nbsp;&nbsp;
												<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Delmasjab<?php echo $jab['pembagian1_id'] ?>" title="delete"><i class="fa-lg fa fa-trash-o"></i></a>
											</td>
										</tr>
										<!-- #modal-dialog -->
										<div id="Delmasjab<?php echo $jab['pembagian1_id'] ?>" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete Master Jabatan <?php echo $jab['pembagian1_nama'] ?> from Database?</h5>
													</div>
													<div class="modal-body" align="center">
														<a href="index.php?page=delete-masterjab&pembagian1_id=<?= $jab['pembagian1_id'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
													</div>
													<div class="modal-footer">
														<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
													</div>
												</div>
											</div>
										</div>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer no-margin-top">
			</div>
		</div>
	</div>
</div>

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