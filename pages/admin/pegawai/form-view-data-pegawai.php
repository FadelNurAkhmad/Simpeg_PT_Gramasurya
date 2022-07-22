<?php

include "../../config/koneksi.php";
require '../../assets/plugins/phpspreadsheet/vendor/autoload.php';

require 'pegawai/export-pegawai.php';



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
	<li><a type="button" data-toggle="modal" data-target="#import" class=" btn btn-sm btn-warning m-b-10" title="Import From Excel"><i class="fa fa-file-excel-o"></i> &nbsp;Import</a></li>
	<li><a href="<?php echo $file; ?>" class="btn btn-sm btn-success m-b-10" title="Export To Excel"><i class="fa fa-file-excel-o"></i> &nbsp;Export</a></li>
	<li><a href="index.php?page=form-master-data-pegawai" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-plus-circle"></i> &nbsp;Add Pegawai</a></li>
</ol>

<!-- Modal Dokumen -->
<div id="import" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">
					<i class="ion-ios-gear text-danger"></i>
					Import Excel
				</h4>
			</div>
			<div class="col-sm-12">
				<div class="modal-body">
					<form action="index.php?page=import-pegawai" class="form-horizontal" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-md-3 control-label">File</label>
							<div class="col-md-6">
								<input type="file" name="filexls" maxlength="255" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"></label>
							<div class="col-md-6">
								<!-- <p>* Max size 5 MB</p> -->
								<p>* Format Excel</p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"></label>
							<div class="col-md-6">
								<button type="submit" name="submit" value="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Import</button>&nbsp;
								<a type="button" class="btn btn-default active" data-dismiss="modal" aria-hidden="true"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer no-margin-top">
			</div>
		</div>
	</div>
</div>
<!-- end tab dokumen -->
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Data Pegawai</h1>
<!-- end page-header -->
<?php
include "../../config/koneksi.php";

// ambil data gabungan tabel pegawai dan tb_pegawai (pegawai non-aktif)
$tampilNon	= mysqli_query($koneksi, "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id = tb_pegawai.pegawai_id WHERE pegawai_status='0'");

// ambil data gabungan tabel pegawai dan tb_pegawai (pegawai aktif)
$tampilPeg	= mysqli_query($koneksi, "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id = tb_pegawai.pegawai_id WHERE pegawai_status='1'");

// ambil data gabungan tabel pegawai dan tb_pegawai (pegawai berhenti)
$tampilResign	= mysqli_query($koneksi, "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id = tb_pegawai.pegawai_id WHERE pegawai_status='2'");

?>

<!-- begin row -->
<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#aktif" data-toggle="tab"><span class="visible-xs">Aktif</span><span class="hidden-xs"><i class="ion-ios-person fa-lg text-success"></i> Aktif</span></a></li>
			<li class=""><a href="#nonaktif" data-toggle="tab"><span class="visible-xs">Berhenti</span><span class="hidden-xs"><i class="ion-ios-person fa-lg text-danger"></i> Non-Aktif</span></a></li>
		</ul>

		<!-- Modal Dokumen -->
		<div id="dok" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">
							<i class="ion-ios-gear text-danger"></i>
							Upload Dokumen Kepegawaian
						</h4>
					</div>
					<div class="col-sm-12">
						<div class="modal-body">
							<form action="index.php?page=masterdok&pegawai_id=<?= $id_peg ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Dokumen</label>
									<div class="col-md-6">
										<input type="text" name="dokumen" maxlength="128" class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">File</label>
									<div class="col-md-6">
										<input type="file" name="file" maxlength="255" class="form-control" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"></label>
									<div class="col-md-6">
										<p>* Max size 5 MB</p>
										<p>* Format PDF</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"></label>
									<div class="col-md-6">
										<button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>&nbsp;
										<a type="button" class="btn btn-default active" data-dismiss="modal" aria-hidden="true"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="modal-footer no-margin-top">
					</div>
				</div>
			</div>
		</div>
		<!-- end tab dokumen -->

		<!-- begin tab-content -->
		<div class="tab-content">
			<!-- tab pegawai aktif -->
			<div class="tab-pane fade active in" id="aktif">
				<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-info fa-2x pull-left"></i> Folder ini dapat digunakan untuk melihat data pegawai aktif ...
				</div>
				<div class="table-responsive">
					<table id="" class="table table-striped table-bordered nowrap display" width="100%">
						<thead>
							<tr>
								<th width="4%">No</th>
								<th>Nama</th>
								<th>NIP</th>
								<th>Jenis Kelamin</th>
								<th>TTL</th>
								<th>Unit</th>
								<th>Jabatan</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							while ($peg	= mysqli_fetch_array($tampilPeg)) {
								$no++
							?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $peg['pegawai_nama'] ?></td>
									<td><a href="index.php?page=detail-data-pegawai&pegawai_id=<?= $peg['pegawai_id'] ?>" title="detail"><?php echo $peg['pegawai_nip']; ?></a></td>
									<td>
										<?php
										if ($peg['gender'] == "1") {
											echo "Laki-laki";
										} else {
											echo "Perempuan";
										}
										?>
									</td>
									<td><?php echo (empty($peg['tempat_lahir'])) ? "" : $peg['tempat_lahir'] . "," ?> <?php echo $peg['tgl_lahir'] ?></td>
									<td><?php
										// $tampilJab   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peg[pegawai_id]' AND status_jab='Aktif'");
										$tampilUnit = mysqli_query($koneksi, "SELECT * FROM pembagian2 WHERE pembagian2_id = '$peg[pembagian2_id]'");
										$unit    = mysqli_fetch_array($tampilUnit);

										if (isset($unit)) {
											// echo $jab['jabatan'];
											echo $unit['pembagian2_nama'];
										} else {
											echo "";
										}
										?>
									</td>
									<td><?php
										// $tampilJab   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peg[pegawai_id]' AND status_jab='Aktif'");
										$tampilJab = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id = '$peg[pembagian1_id]'");
										$jab    = mysqli_fetch_array($tampilJab);

										if (isset($jab)) {
											// echo $jab['jabatan'];
											echo $jab['pembagian1_nama'];
										} else {
											echo "";
										}
										?>
									</td>

									<td class="text-center">
										<a type="button" class="btn btn-success btn-icon btn-sm" href="index.php?page=detail-data-pegawai&pegawai_id=<?= $peg['pegawai_id'] ?>" title="detail"><i class="fa fa-folder-open-o fa-lg"></i></a>
										<a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-data-pegawai&pegawai_id=<?= $peg['pegawai_id'] ?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
										<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $peg['pegawai_id'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
									</td>
								</tr>
								<!-- #modal-dialog -->
								<div id="Del<?php echo $peg['pegawai_id'] ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete <u><?php echo $peg['pegawai_nama'] ?></u> from Database?</h5>
											</div>
											<div class="modal-body" align="center">
												<a href="index.php?page=delete-data-pegawai&pegawai_id=<?= $peg['pegawai_id'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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
			<!-- end tab pegawai aktif -->

			<!-- tab pegawai non-aktif -->
			<div class="tab-pane fade" id="nonaktif">
				<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-info fa-2x pull-left"></i> Folder ini dapat digunakan untuk melihat data pegawai berhenti ...
				</div>
				<div class="table-responsive">
					<table id="" class="table table-striped table-bordered nowrap display" width="100%">
						<thead>
							<tr>
								<th width="4%">No</th>
								<th>Nama</th>
								<th>NIP</th>
								<th>Jenis Kelamin</th>
								<th>TTL</th>
								<th>Unit</th>
								<th>Jabatan</th>
								<th>Tanggal Berhenti</th>
								<th>Keterangan</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							while ($resign	= mysqli_fetch_array($tampilResign)) {
								$no++
							?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $resign['pegawai_nama'] ?></td>
									<td><a href="index.php?page=detail-data-pegawai&pegawai_id=<?= $resign['pegawai_id'] ?>" title="detail"><?php echo $resign['pegawai_nip']; ?></a></td>
									<td>
										<?php
										if ($resign['gender'] == "1") {
											echo "Laki-laki";
										} else {
											echo "Perempuan";
										}
										?>
									</td>
									<td><?php echo (empty($resign['tempat_lahir'])) ? "" : $resign['tempat_lahir'] . "," ?> <?php echo $resign['tgl_lahir'] ?></td>
									<td><?php
										// $tampilJab   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peg[pegawai_id]' AND status_jab='Aktif'");
										$tampilUnit2 = mysqli_query($koneksi, "SELECT * FROM pembagian2 WHERE pembagian2_id = '$resign[pembagian2_id]'");
										$unit2    = mysqli_fetch_array($tampilUnit2);

										if (isset($unit2)) {
											// echo $jab['jabatan'];
											echo $unit2['pembagian2_nama'];
										} else {
											echo "";
										}
										?>
									</td>
									<td><?php
										$tampilJab2   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$resign[pegawai_id]'");
										$jab2    = mysqli_fetch_array($tampilJab2);

										if (isset($jab2)) {
											echo $jab2['jabatan'];
										} else {
											echo "";
										}
										?>
									</td>
									<td><?php echo $resign['tgl_resign'] ?></td>
									<td><?= $resign['ket'] ?></td>

									<td class="text-center">
										<a type="button" class="btn btn-success btn-icon btn-sm" href="index.php?page=detail-data-pegawai&pegawai_id=<?= $resign['pegawai_id'] ?>" title="detail"><i class="fa fa-folder-open-o fa-lg"></i></a>
										<a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-data-pegawai&pegawai_id=<?= $resign['pegawai_id'] ?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
										<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $resign['pegawai_id'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
									</td>
								</tr>
								<!-- #modal-dialog -->
								<div id="Del<?php echo $resign['pegawai_id'] ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete <u><?php echo $resign['pegawai_nama'] ?></u> from Database?</h5>
											</div>
											<div class="modal-body" align="center">
												<a href="index.php?page=delete-data-pegawai&pegawai_id=<?= $resign['pegawai_id'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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
			<!-- end tab pegawai resign -->
		</div>
		<!-- end tab-content -->
	</div>
	<!-- end col-12 -->
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

	$(document).ready(function() {
		$('table.display').DataTable();
	});
</script>