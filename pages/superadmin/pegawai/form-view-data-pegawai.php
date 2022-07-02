<?php
$filename	= "Daftar Pegawai";

include "../../config/koneksi.php";
require '../../assets/plugins/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Daftar Pegawai');
$sheet->setCellValue("A1", "DAFTAR PEGAWAI");
$sheet->setCellValue("A3", "No. Urut");
$sheet->setCellValue("B3", "ID");
$sheet->setCellValue("C3", "NIP");
$sheet->setCellValue("D3", "Nama");
$sheet->setCellValue("E3", "Tempat Lahir");
$sheet->setCellValue("F3", "Tgl. Lahir");
$sheet->setCellValue("G3", "Agama");
$sheet->setCellValue("H3", "Jenis Kelamin");
$sheet->setCellValue("I3", "Gol Darah");
$sheet->setCellValue("J3", "Status Nikah");
$sheet->setCellValue("K3", "Status");
$sheet->setCellValue("L3", "Alamat");
$sheet->setCellValue("M3", "Telp");
$sheet->setCellValue("N3", "Email");
// $sheet->setCellValue("O3", "Gol/Ruang");
// $sheet->setCellValue("P3", "Pangkat");
$sheet->setCellValue("O3", "Jabatan");
$sheet->setCellValue("P3", "Pendidikan");
$sheet->setCellValue("Q3", "Unit Kerja");
$sheet->setCellValue("R3", "Tgl. Pensiun");

$expPeg	= mysqli_query($koneksi, "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id= tb_pegawai.pegawai_id INNER JOIN pegawai_d ON pegawai.pegawai_id=pegawai_d.pegawai_id ");
$i	= 4; //Dimulai dengan baris ke dua
$no	= 1;
while ($peg	= mysqli_fetch_array($expPeg)) {
	if ($peg['agama'] == '1') {
		$agama = 'Islam';
	} else if ($peg['agama'] == '2') {
		$agama = 'Katolik';
	} else if ($peg['agama'] == '3') {
		$agama = 'Protestan';
	} else if ($peg['agama'] == '4') {
		$agama = 'Hindu';
	}

	if ($peg['gender'] == '1') {
		$gender = 'Laki-laki';
	} else {
		$gender = 'Perempuan';
	}

	if ($peg['gol_darah'] == '1') {
		$goldar = 'A+';
	} else if ($peg['gol_darah'] == '2') {
		$goldar = 'B+';
	} else if ($peg['gol_darah'] == '3') {
		$goldar = 'O+';
	} else if ($peg['gol_darah'] == '4') {
		$goldar = 'A-';
	} else if ($peg['gol_darah'] == '5') {
		$goldar = 'AB+';
	} else if ($peg['gol_darah'] == '6') {
		$goldar = 'B-';
	} else if ($peg['gol_darah'] == '7') {
		$goldar = 'O-';
	} else if ($peg['gol_darah'] == '8') {
		$goldar = 'AB-';
	}

	if ($peg['stat_nikah'] == '1') {
		$stat = 'Sudah Menikah';
	} else if ($peg['stat_nikah'] == '2') {
		$stat = 'Belum Menikah';
	} else if ($peg['stat_nikah'] == '3') {
		$stat = 'Janda / Duda';
	}

	if ($peg['pegawai_status'] == '1') {
		$pgw = 'Aktif';
	}

	$expUni	= mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
	$uni	= mysqli_fetch_array($expUni);

	$se = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peg[pegawai_id]'");
	$see = isset($peg['jabatan']) ? $peg['jabatan'] : '';

	$uni1 = isset($uni1['nama']) ? $uni['nama'] : '';
	$peg1 = isset($peg['sekolah']) ? $peg['sekolah'] : '';

	$sheet->setCellValue("A" . $i, $no);
	$sheet->setCellValue("B" . $i, $peg['pegawai_id']);
	$sheet->setCellValue("C" . $i, $peg['pegawai_nip']);
	$sheet->setCellValue("D" . $i, $peg['pegawai_nama']);
	$sheet->setCellValue("E" . $i, $peg['tempat_lahir']);
	$sheet->setCellValue("F" . $i, $peg['tgl_lahir']);
	$sheet->setCellValue("G" . $i, $agama);
	$sheet->setCellValue("H" . $i, $gender);
	$sheet->setCellValue("I" . $i, $goldar);
	$sheet->setCellValue("J" . $i, $stat);
	$sheet->setCellValue("K" . $i, $pgw);
	$sheet->setCellValue("L" . $i, $peg['alamat']);
	$sheet->setCellValue("M" . $i, $peg['pegawai_telp']);
	$sheet->setCellValue("N" . $i, $peg['email']);
	// $sheet->setCellValue("O" . $i, $peg['urut_pangkat']);
	// $sheet->setCellValue("P" . $i, $peg['pangkat']);
	$sheet->setCellValue("O" . $i, $see);
	$sheet->setCellValue("P" . $i, $peg1);
	$sheet->setCellValue("Q" . $i, $uni1);
	$sheet->setCellValue("R" . $i, $peg['tgl_pensiun']);
	$no++;
	$i++;
}

$writer = new Xlsx($spreadsheet);
$file	= "../../assets/excel/$filename.xlsx";
$writer->save("$file");

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
	<li><a href="<?php echo $file; ?>" class="btn btn-sm btn-success m-b-10" title="Export To Excel"><i class="fa fa-file-excel-o"></i> &nbsp;Export</a></li>
	<li><a href="index.php?page=form-master-data-pegawai" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-plus-circle"></i> &nbsp;Add Pegawai</a></li>
</ol>
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
			<li class="active"><a href="#aktif" data-toggle="tab"><span class="visible-xs">Aktif</span><span class="hidden-xs"><i class="fa fa-calendar-check-o text-danger"></i> Aktif</span></a></li>
			<li class=""><a href="#nonaktif" data-toggle="tab"><span class="visible-xs">Non Aktif</span><span class="hidden-xs"><i class="fa fa-calendar-check-o text-danger"></i> Non Aktif</span></a></li>
			<li class=""><a href="#berhenti" data-toggle="tab"><span class="visible-xs">Berhenti</span><span class="hidden-xs"><i class="fa fa-calendar-check-o text-danger"></i> Berhenti</span></a></li>
		</ul>
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
									<td><?php echo (is_null($peg['tempat_lahir'])) ? $peg['tempat_lahir'] . "," : "" ?> <?php echo $peg['tgl_lahir'] ?></td>
									<td><?php
										$tampilJab   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peg[pegawai_id]'");
										$jab    = mysqli_fetch_array($tampilJab);

										if (isset($jab)) {
											echo $jab['jabatan'];
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
					<i class="fa fa-info fa-2x pull-left"></i> Folder ini dapat digunakan untuk melihat data pegawai non aktif ...
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
								<th>Jabatan</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							while ($non	= mysqli_fetch_array($tampilNon)) {
								$no++
							?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $non['pegawai_nama'] ?></td>
									<td><a href="index.php?page=detail-data-pegawai&pegawai_id=<?= $non['pegawai_id'] ?>" title="detail"><?php echo $non['pegawai_nip']; ?></a></td>
									<td>
										<?php
										if ($non['gender'] == "1") {
											echo "Laki-laki";
										} else {
											echo "Perempuan";
										}
										?>
									</td>
									<td><?php echo (is_null($non['tempat_lahir'])) ? $non['tempat_lahir'] . "," : "" ?> <?php echo $non['tgl_lahir'] ?></td>
									<td><?php
										$tampilJab   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$non[pegawai_id]'");
										$jab    = mysqli_fetch_array($tampilJab);

										if (isset($jab)) {
											echo $jab['jabatan'];
										} else {
											echo "";
										}
										?>
									</td>
									<td class="text-center">
										<a type="button" class="btn btn-success btn-icon btn-sm" href="index.php?page=detail-data-pegawai&pegawai_id=<?= $non['pegawai_id'] ?>" title="detail"><i class="fa fa-folder-open-o fa-lg"></i></a>
										<a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-data-pegawai&pegawai_id=<?= $non['pegawai_id'] ?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
										<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $non['pegawai_id'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
									</td>
								</tr>
								<!-- #modal-dialog -->
								<div id="Del<?php echo $non['pegawai_id'] ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Are you sure you want to delete <u><?php echo $non['pegawai_nama'] ?></u> from Database?</h5>
											</div>
											<div class="modal-body" align="center">
												<a href="index.php?page=delete-data-pegawai&pegawai_id=<?= $non['pegawai_id'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
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
			<!-- end tab pegawai non aktif -->
			<!-- tab pegawai berhenti -->
			<div class="tab-pane fade" id="berhenti">
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
								<th>Jabatan</th>
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
									<td><?php echo (is_null($resign['tempat_lahir'])) ? $resign['tempat_lahir'] . "," : "" ?> <?php echo $resign['tgl_lahir'] ?></td>
									<td><?php
										$tampilJab   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$resign[pegawai_id]'");
										$jab    = mysqli_fetch_array($tampilJab);

										if (isset($jab)) {
											echo $jab['jabatan'];
										} else {
											echo "";
										}
										?>
									</td>
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