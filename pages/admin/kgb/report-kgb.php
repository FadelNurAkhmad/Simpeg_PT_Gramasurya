<?php
	if ($_POST['report'] == "report") {
		$kgb_reminder	=$_POST['kgb_reminder'];
	}
	if ($kgb_reminder =="one"){
		$tahun=date("Y");
	}
	else{
		$tahun=date("Y") + 1;
	}
	
	$filename	="Report KGB";
	
	include "../../config/koneksi.php";
	include "../../assets/plugins/PHPExcel-1.8.1/Classes/PHPExcel.php";
	include "../../assets/plugins/PHPExcel-1.8.1/Classes/PHPExcel/Writer/Excel2007.php";
	 
	$excel	=new PHPExcel;
	 
	$excel->getProperties()->setCreator("Raja Putra Media");
	$excel->getProperties()->setLastModifiedBy("Raja Putra Media");
	$excel->getProperties()->setTitle("Raja Putra Media Report");
	$excel->removeSheetByIndex(0);
	 
	$sheet =$excel->createSheet();
	$sheet->setTitle('Report Periode KGB');
	$sheet->setCellValue("A1", "REPORT PERIODE KGB");
	$sheet->setCellValue("A3", "No. Urut");
	$sheet->setCellValue("B3", "NIP");
	$sheet->setCellValue("C3", "Nama");
	$sheet->setCellValue("D3", "Tempat Lahir");
	$sheet->setCellValue("E3", "Tgl. Lahir");
	$sheet->setCellValue("F3", "Jenis Kelamin");
	$sheet->setCellValue("G3", "Telp");
	$sheet->setCellValue("H3", "Periode KGB");
	
	$expKgb	=mysqli_query($koneksi, "SELECT * FROM tb_kgb WHERE tgl_kgb LIKE '$tahun%' ORDER BY tgl_kgb");
	$i	=4; //Dimulai dengan baris ke dua
	$no	=1;
	while($ekgb	=mysqli_fetch_array($expKgb, MYSQLI_ASSOC)){
	$expPeg	=mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$ekgb[id_peg]'");
	while($epeg	=mysqli_fetch_array($expPeg, MYSQLI_ASSOC)){
	   $sheet->setCellValue( "A" . $i, $no);
	   $sheet->setCellValue( "B" . $i, $epeg['nip'] );
	   $sheet->setCellValue( "C" . $i, $epeg['nama'] );
	   $sheet->setCellValue( "D" . $i, $epeg['tempat_lhr'] );
	   $sheet->setCellValue( "E" . $i, $epeg['tgl_lhr'] );
	   $sheet->setCellValue( "F" . $i, $epeg['jk'] );
	   $sheet->setCellValue( "G" . $i, $epeg['telp'] );
	   $sheet->setCellValue( "H" . $i, $ekgb['tgl_kgb'] );
	   $no++;
	   $i++;
	}
	}
	 
	$writer	=new PHPExcel_Writer_Excel2007($excel);
	$file	="../../assets/excel/$filename.xlsx";
	$writer->save("$file");
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li><a href="<?php echo $file;?>" class="btn btn-sm btn-success m-b-10" title="Export To Excel"><i class="fa fa-file-excel-o"></i> &nbsp;Export</a></li>
</ol>
<!-- begin page-header -->
<h1 class="page-header">Report <small>KGB <i class="fa fa-angle-right"></i> Tahun <?=$tahun?></small></h1>
<!-- end page-header -->
<div class="profile-container">
	<!-- begin profile-section -->
	<div class="profile-section">
		<div class="panel-body">
			<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
				<thead>
					<tr>
						<th>No #</th>
						<th><i class="ace-icon fa fa-key bigger-110 hidden-480"></i> NIP</th>
						<th> Nama</th>
						<th> TTL</th>
						<th> JK</th>
						<th> No. Telp</th>
						<th> Periode</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						include "../../config/koneksi.php";
						$no=0;
						$tampilKgb	=mysqli_query($koneksi, "SELECT * FROM tb_kgb WHERE tgl_kgb LIKE '$tahun%' ORDER BY tgl_kgb");
						while($kgb	=mysqli_fetch_array($tampilKgb, MYSQLI_ASSOC)){
							$tampilPeg	=mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$kgb[id_peg]'");
							while($peg	=mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC)){						
						$no++
					?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $peg['nip'];?></td>
						<td><?php echo $peg['nama'];?></td>
						<td><?php echo $peg['tempat_lhr']?>, <?php echo $peg['tgl_lhr']?></td>
						<td><?php echo $peg['jk']?></td>
						<td><?php echo $peg['telp']?></td>
						<td><?php echo $kgb['tgl_kgb'];?></td>
						<td><a href="index.php?page=form-master-data-kgb&id_peg=<?=$peg['id_peg'];?>&tgl_kgb=<?=$kgb['tgl_kgb']?>" title="Create KGB" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> &nbsp;Create KGB</a></td>
					</tr>
					<?php
						}
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- end profile-section -->
</div>