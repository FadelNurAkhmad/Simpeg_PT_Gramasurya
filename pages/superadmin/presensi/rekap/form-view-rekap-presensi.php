<?php
$filename	= "Daftar Pegawai";

include "../../config/koneksi.php";
// require '../../assets/plugins/phpspreadsheet/vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// $spreadsheet = new Spreadsheet();

// $sheet = $spreadsheet->getActiveSheet();
// $sheet->setTitle('Daftar Pegawai');
// $sheet->setCellValue("A1", "DAFTAR PEGAWAI");
// $sheet->setCellValue("A3", "No. Urut");
// $sheet->setCellValue("B3", "ID");
// $sheet->setCellValue("C3", "NIP");
// $sheet->setCellValue("D3", "Nama");
// $sheet->setCellValue("E3", "Tempat Lahir");
// $sheet->setCellValue("F3", "Tgl. Lahir");
// $sheet->setCellValue("G3", "Agama");
// $sheet->setCellValue("H3", "Jenis Kelamin");
// $sheet->setCellValue("I3", "Gol Darah");
// $sheet->setCellValue("J3", "Status Nikah");
// $sheet->setCellValue("K3", "Status");
// $sheet->setCellValue("L3", "Alamat");
// $sheet->setCellValue("M3", "Telp");
// $sheet->setCellValue("N3", "Email");
// $sheet->setCellValue("O3", "Gol/Ruang");
// $sheet->setCellValue("P3", "Pangkat");
// $sheet->setCellValue("Q3", "Jabatan");
// $sheet->setCellValue("R3", "Pendidikan");
// $sheet->setCellValue("S3", "Unit Kerja");
// $sheet->setCellValue("T3", "Tgl. Pensiun");

// $expPeg	= mysqli_query($koneksi, "SELECT * FROM tb_pegawai ORDER BY id_peg");
// $i	= 4; //Dimulai dengan baris ke dua
// $no	= 1;
// while ($peg	= mysqli_fetch_array($expPeg)) {
// 	$expUni	= mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
// 	$uni	= mysqli_fetch_array($expUni);
// 	$sheet->setCellValue("A" . $i, $no);
// 	$sheet->setCellValue("B" . $i, $peg['id_peg']);
// 	$sheet->setCellValue("C" . $i, $peg['nip']);
// 	$sheet->setCellValue("D" . $i, $peg['nama']);
// 	$sheet->setCellValue("E" . $i, $peg['tempat_lhr']);
// 	$sheet->setCellValue("F" . $i, $peg['tgl_lhr']);
// 	$sheet->setCellValue("G" . $i, $peg['agama']);
// 	$sheet->setCellValue("H" . $i, $peg['jk']);
// 	$sheet->setCellValue("I" . $i, $peg['gol_darah']);
// 	$sheet->setCellValue("J" . $i, $peg['status_nikah']);
// 	$sheet->setCellValue("K" . $i, $peg['status_kepeg']);
// 	$sheet->setCellValue("L" . $i, $peg['alamat']);
// 	$sheet->setCellValue("M" . $i, $peg['telp']);
// 	$sheet->setCellValue("N" . $i, $peg['email']);
// 	$sheet->setCellValue("O" . $i, $peg['urut_pangkat']);
// 	$sheet->setCellValue("P" . $i, $peg['pangkat']);
// 	$sheet->setCellValue("Q" . $i, $peg['jabatan']);
// 	$sheet->setCellValue("R" . $i, $peg['sekolah']);
// 	$sheet->setCellValue("S" . $i, $uni['nama']);
// 	$sheet->setCellValue("T" . $i, $peg['tgl_pensiun']);
// 	$no++;
// 	$i++;
// }

// $writer = new Xlsx($spreadsheet);
// $file	= "../../assets/excel/$filename.xlsx";
// $writer->save("$file");
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
    <li>
        <div class="row ">
            <div class="col-12 col-md-4">
                <h1 class="page-header">Rekap <small>Presensi&nbsp;</small></h1>
            </div>
            <div class="col-6 col-md-8">
                <label class="col-md-1 control-label">Periode</label>
                <form action="index.php?page=form-view-rekap-presensi" method="POST" enctype="multipart/form-data">
                    <div class="form-group col-md-3">
                        <div class="input-group date" id= "datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="periode_awal" placeholder="Dari" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="periode_akhir" placeholder="Sampai" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group col-sm-4 m-b-10">
                        <button type="submit" name="cari" value="cari" class="btn btn-primary"><i class="ion-ios-search-strong"></i> &nbsp;Cari</button>&nbsp;
                        <a href="#" class="btn btn-sm btn-success" title="Export To Excel"><i class="fa fa-file-excel-o"></i> &nbsp;Export</a>
                    </div>
                </form>
            </div>
        </div>
    </li>
</ol>


<!-- end breadcrumb -->
<!-- begin page-header -->
<!-- end page-header -->

<!-- begin row -->
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs">
			<li class=""><a href="#presensi" data-toggle="tab"><span class="visible-xs">Presensi</span><span class="hidden-xs"><i class="fa fa-calendar-check-o text-danger"></i> Presensi</span></a></li>
		</ul>
		<div class="tab-content">
			
			
			<!-- tab presensi -->
			<div class="tab-pane fade" id="presensi">
				<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-info fa-2x pull-left"></i> Folder ini dapat digunakan untuk melihat rekap presensi ...
				</div>
				<div class="row ">
					<div class="col-6 col-md-8">
						<label class="col-md-1 control-label">Periode</label>
						<form action="index.php?page=detail-data-pegawai&pegawai_id=<?= $id_peg ?>" method="POST" enctype="multipart/form-data">
							<div class="form-group col-md-3">
								<div class="input-group date" id= "datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" name="periode_awal" placeholder="Dari" class="form-control" />
								</div>
							</div>
							<div class="form-group col-md-3">
								<div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" name="periode_akhir" placeholder="Sampai" class="form-control" />
								</div>
							</div>
							<div class="form-group col-sm-4 m-b-10">
								<button type="submit" name="cari" value="cari" class="btn btn-primary"><i class="ion-ios-search-strong"></i> &nbsp;Cari</button>&nbsp;
								<a href="#" class="btn btn-sm btn-success" title="Export To Excel"><i class="fa fa-file-excel-o"></i> &nbsp;Export</a>
							</div>
						</form>
					</div>
					<div class="col-6 col-md-8">
						<label class="col-md-1 control-label">Hadir</label>
							<div class="col-md-2 m-b-10">
								<input type="text" name="periode_awal" value="" class="form-control" readonly />
							</div>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Jam</th>
								<th>NIP</th>
								<th>Nama</th>
								<th>PIN</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
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