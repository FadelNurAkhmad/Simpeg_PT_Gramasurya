<?php

$filename	= "Report Bezetting";

include "../../config/koneksi.php";
require '../../assets/plugins/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Report Bezetting');
$sheet->setCellValue("A1", "REPORT BEZETTING");
$sheet->setCellValue("A3", "No");
$sheet->setCellValue("B3", "Nama / TTL");
$sheet->setCellValue("C3", "NIP");
$sheet->setCellValue("D3", "Pangkat GOL/Ruang");
$sheet->setCellValue("E3", "Jabatan");
$sheet->setCellValue("F3", "Pendidikan Terakhir");
$sheet->setCellValue("G3", "UMUR");
$sheet->setCellValue("H3", "Ket.");
// $sheet->setCellValue("F3", "TMT");
// $sheet->setCellValue("J3", "Eselon");
// $sheet->setCellValue("G3", "Pendidikan / Jurusan / T.Lulus");
// $sheet->setCellValue("H3", "Alamat & Telp");
// $sheet->setCellValue("M3", "Ket");


$expPeg	= mysqli_query($koneksi, "SELECT * FROM pegawai JOIN tb_pegawai  ON pegawai.pegawai_id= tb_pegawai.pegawai_id 
									JOIN tb_pangkat ON tb_pegawai.pegawai_id=tb_pangkat.id_peg
									JOIN pembagian1 ON tb_pangkat.id_peg=pembagian1.pembagian1_id
									JOIN tb_sekolah ON pembagian1.pembagian1_id=tb_sekolah.id_peg WHERE  tb_sekolah.status='Akhir' ");
$i	= 4; //Dimulai dengan baris ke dua
$no	= 1;






while ($peg	= mysqli_fetch_array($expPeg)) {
	$lhr	= new DateTime($peg['tgl_lahir']);
	$today	= new DateTime();
	$selisih	= $today->diff($lhr);
	$expUni	= mysqli_query($koneksi, "SELECT * FROM pegawai JOIN tb_pegawai  ON pegawai.pegawai_id= tb_pegawai.pegawai_id 
									JOIN tb_pangkat ON tb_pegawai.pegawai_id=tb_pangkat.id_peg 
									JOIN pembagian1 ON tb_pangkat.id_peg=pembagian1.pembagian1_id
									JOIN tb_sekolah ON pembagian1.pembagian1_id=tb_sekolah.id_peg WHERE tb_sekolah.status='Akhir'");
	$uni	= mysqli_fetch_array($expUni);

	$sheet->setCellValue("A" . $i, $no);
	$sheet->setCellValue("B" . $i, $peg['pegawai_nama'] . '/' . $peg['tempat_lahir'] . '/' . $peg['tgl_lahir']);
	$sheet->setCellValue("C" . $i, $peg['pegawai_nip']);
	$sheet->setCellValue("D" . $i, $peg['pangkat'] . '/' . $peg['gol']);
	$sheet->setCellValue("E" . $i, $peg['pembagian1_nama']);
	$sheet->setCellValue("F" . $i, $peg['tingkat']);
	$sheet->setCellValue("G" . $i, $selisih->y);
	$sheet->setCellValue("H" . $i, $peg['pegawai_status']);
	// $sheet->setCellValue("F" . $i, $peg1['tmt_jabatan']);
	// $sheet->setCellValue("J" . $i, $peg['eselon']);
	// $sheet->setCellValue("G" . $i, $peg1['tingkat'] . '/' . $peg1['jurusan'] . '/' . $peg1['tgl_ijazah']);
	// $sheet->setCellValue("H" . $i, $peg1['alamat'] . '/' . $peg['pegawai_telp']);
	// $sheet->setCellValue("M" . $i, $peg['status_kepeg']);


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
	
</ol>
<?php
if (isset($_GET['pegawai_id'])) {
	$id_peg = $_GET['pegawai_id'];
}
include "../../config/koneksi.php";
$kepala	= mysqli_query($koneksi, "SELECT * FROM tb_setup_bkd WHERE id_setup_peru='1'");
$kep	= mysqli_fetch_array($kepala, MYSQLI_ASSOC);
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li><a href="../../pages/superadmin/report/print-bezetting.php" target="_blank" title="print" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Report <small>Bezetting</small></h1>
<!-- end page-header -->
<div class="profile-container">
	<!-- begin profile-section -->
	<div class="profile-section">
		<div class="table-responsive">
			<h5 align="center">DAFTAR BEZETTING PEGAWAI</h5>
			<h6 align="center" style="text-transform:uppercase"><?= $kep['nama_peru'] ?> PERIODE BULAN <?php echo date("m"); ?> TAHUN <?php echo date("Y"); ?></h6>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>NAMA<br />TEMPAT TANGGAL LAHIR</th>
						<th>NIP</th>
						<th>PANGKAT<br />GOL/RUANG</th>
						<th>JABATAN</th>
						<th>PENDIDIKAN<br />TERAKHIR</th>
						<th>UMUR (THN)</th>
						<th>KET</th>
					</tr>
					<tr>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
						<th>7</th>
						<th>8</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					$idPeg = mysqli_query($koneksi, "SELECT * FROM pegawai JOIN pegawai_d ON pegawai.pegawai_id=pegawai_d.pegawai_id JOIN tb_pegawai ON pegawai_d.pegawai_id=tb_pegawai.pegawai_id ORDER BY urut_pangkat DESC");
					while ($peg = mysqli_fetch_array($idPeg, MYSQLI_ASSOC)) {
						$no++
					?>
						<td><?= $no; ?></td>
						<td><?php echo $peg['pegawai_nama']; ?><br /><?php echo $peg['tempat_lahir']; ?> <?php echo $peg['tgl_lahir']; ?></td>
						<td><?php echo $peg['pegawai_nip']; ?></td>
						<td><?php
							$idPan = mysqli_query($koneksi, "SELECT * FROM tb_pangkat WHERE id_peg='$peg[pegawai_id]' AND status_pan='Aktif'");
							$hpan = mysqli_fetch_array($idPan, MYSQLI_ASSOC);
							$hpan1 = isset($hpan['pangkat']) ? $hpan['pangkat'] : '';
							$hpan2 = isset($hpan['gol']) ? $hpan['gol'] : '';
							?>
							<?php echo $hpan1; ?><br /><?php echo $hpan2; ?></td>
						<td><?php
							$idJab = mysqli_query($koneksi, "SELECT * FROM pembagian1 WHERE pembagian1_id='$peg[pembagian1_id]'");
							$hjab = mysqli_fetch_array($idJab, MYSQLI_ASSOC);
							$hjab1 = isset($hjab['pembagian1_nama']) ? $hjab['pembagian1_nama'] : '';
							?>
							<?php echo $hjab1; ?></td>
						<td><?php
							$idSek = mysqli_query($koneksi, " SELECT * FROM tb_sekolah WHERE id_peg='$peg[pegawai_id]' AND status='Akhir'");
							$hsek = mysqli_fetch_array($idSek, MYSQLI_ASSOC);
							$hsek1 = isset($hsek['tingkat']) ? $hsek['tingkat'] : '';
							?>
							<?php echo $hsek1; ?>
						</td>
						<td><?php
							$lhr	= new DateTime($peg['tgl_lahir']);
							$today	= new DateTime();
							$selisih	= $today->diff($lhr);
							echo $selisih->y;
							?>
						</td>
						<!-- <td><?php echo $peg['status_kepeg']; ?></td> -->
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- end profile-section -->
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