<?php

$filename	= "Report DUK";

include "../../config/koneksi.php";
require '../../assets/plugins/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Report DUK');
$sheet->setCellValue("A1", "REPORT DUK");
$sheet->setCellValue("A3", "No");
$sheet->setCellValue("B3", "Nama / TTL");
$sheet->setCellValue("C3", "NIP");
$sheet->setCellValue("D3", "Jabatan");
$sheet->setCellValue("E3", "TMT");
$sheet->setCellValue("F3", "Pendidikan Akhir / Asal");
$sheet->setCellValue("G3", "Tahun Lulus");
$sheet->setCellValue("H3", "ket.");;


$expPeg	= mysqli_query($koneksi, "SELECT * FROM pegawai INNER JOIN tb_pegawai ON pegawai.pegawai_id= tb_pegawai.pegawai_id INNER JOIN pegawai_d ON pegawai.pegawai_id=pegawai_d.pegawai_id ");
$i	= 4; //Dimulai dengan baris ke dua
$no	= 1;

while ($peg	= mysqli_fetch_array($expPeg)) {
	if ($peg['pegawai_status'] == '1') {
		$pgw = 'Aktif';
	}
	$expeg2 = mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE id_peg='$peg[pegawai_id]' AND status='Akhir'");
	$peg2 = mysqli_fetch_array($expeg2, MYSQLI_ASSOC);
	$pegg = isset($peg2['tingkat']) ? $peg2['tingkat'] : '';
	$pegg1 = isset($peg2['nama_sekolah']) ? $peg2['nama_sekolah'] : '';
	$peg1 = isset($peg2['tgl_ijazah']) ? $peg2['tgl_ijazah'] : '';

	$expeg3 = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$peg[pegawai_id]'");
	$peg3 = mysqli_fetch_array($expeg3, MYSQLI_ASSOC);
	$pegi = isset($peg3['jabatan']) ? $peg3['jabatan'] : '';
	$pegii = isset($peg3['tmt_jabatan']) ? $peg3['tmt_jabatan'] : '';

	$expUni	= mysqli_query($koneksi, "SELECT * FROM tb_unit WHERE id_unit='$peg[unit_kerja]'");
	$uni	= mysqli_fetch_array($expUni);

	$sheet->setCellValue("A" . $i, $no);
	$sheet->setCellValue("B" . $i, $peg['pegawai_nama'] . '/' . $peg['tempat_lahir'] . '/' . $peg['tgl_lahir']);
	$sheet->setCellValue("C" . $i, $peg['pegawai_nip']);
	$sheet->setCellValue("D" . $i, $pegi);
	$sheet->setCellValue("E" . $i, $pegii);
	$sheet->setCellValue("F" . $i, $pegg . '/' . $pegg1);
	$sheet->setCellValue("G" . $i, $peg1);
	$sheet->setCellValue("H" . $i, $pgw);


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
include "../../config/koneksi.php";
$kepala	= mysqli_query($koneksi, "SELECT * FROM tb_setup_peru WHERE id_setup_peru='1'");
$kep	= mysqli_fetch_array($kepala, MYSQLI_ASSOC);
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li><a href="../../pages/superadmin/report/print-daftar-urut-kepangkatan.php" target="_blank" title="print" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Report <small>DUK</small></h1>
<!-- end page-header -->
<div class="profile-container">
	<!-- begin profile-section -->
	<div class="profile-section">
		<div class="table-responsive">
			<h5 align="center">DAFTAR URUT KEPANGKATAN PEGAWAI</h5>
			<h6 align="center" style="text-transform:uppercase"><?= $kep['nama_peru'] ?> TAHUN <?php echo date("Y"); ?></h6>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th rowspan="2">No</th>
						<th colspan="2">NAMA</th>
						<th rowspan="2">NIP</th>
						<th colspan="2">JABATAN</th>
						<th colspan="2">PEND AKHIR</th>
						<th rowspan="2">KET</th>
					</tr>
					<tr>
						<th colspan="2">TTL</th>
						<th>NAMA</th>
						<th>TMT</th>
						<th>ASAL / TINGKAT</th>
						<th>T.LLS</th>
					</tr>
					<tr>
						<th>1</th>
						<th colspan="2">2</th>
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
						<td><?php echo $peg['pegawai_nama']; ?><br />
						<td><?php echo $peg['tempat_lahir']; ?> <?php echo $peg['tgl_lahir']; ?></td>
						</td>
						<td><?php echo $peg['pegawai_nip']; ?></td>
						
						<td><?php
							$idJab = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE (id_jab='$peg[pegawai_id]' AND status_jab='Aktif')");
							$hjab = mysqli_fetch_array($idJab, MYSQLI_ASSOC);
							$hjab1 = isset($hjab['jabatan']) ? $hjab['jabatan'] : '';
							$hjab2 = isset($hjab['tmt_jabatan']) ? $hjab['tmt_jabatan'] : '';

							?>
							<?php echo $hjab1 ?></td>
						<td><?php echo $hjab2; ?></td>
						<!-- <td><?php echo $hjab['eselon']; ?></td> -->
						<!-- <td><?php
							$tgl_sk	= new DateTime($hpan4);
							$today	= new DateTime();
							$selisih	= $today->diff($tgl_sk);

							echo $selisih->y;
							?>
						</td> -->
						<!-- <td><?php echo $selisih->m; ?></td> -->
						<td><?php
							$idSek = mysqli_query($koneksi, "SELECT * FROM tb_sekolah WHERE id_peg='$peg[pegawai_id]' AND status='Akhir'");
							$hsek = mysqli_fetch_array($idSek, MYSQLI_ASSOC);
							$hsek1 = isset($hsek['nama_sekolah']) ? $hsek['nama_sekolah'] : '';
							$hsek2 = isset($hsek['tingkat']) ? $hsek['tingkat'] : '';
							$hsek3 = isset($hsek['tgl_ijazah']) ? $hsek['tgl_ijazah'] : '';

							?>
							<?php echo $hsek1; ?><br><?php echo $hsek2; ?>
						</td>
						<td><?php echo $hsek3; ?></td>
						<td><?php
							if ($peg['pegawai_status'] == '1') {
								$pgw = 'Aktif';
							}
							echo $pgw; ?></td>
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