<?php	
	if (isset($_GET['id_skp'])) {
	$id_skp = $_GET['id_skp'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	include "../../config/koneksi.php";
	$query	=mysqli_query($koneksi, "SELECT * FROM tb_skp WHERE id_skp='$id_skp'");
	$data	=mysqli_fetch_array($query, MYSQLI_ASSOC);
		$orientasi		=$data['nilai_orientasi'];
		$integritas		=$data['nilai_integritas'];
		$komitmen		=$data['nilai_komitmen'];
		$disiplin		=$data['nilai_disiplin'];
		$kerjasama		=$data['nilai_kerjasama'];
		$kepemimpinan	=$data['nilai_kepemimpinan'];
		$jml_nilai	=$orientasi+$integritas+$komitmen+$disiplin+$kerjasama+$kepemimpinan;
		$rata		=$jml_nilai/6;
	
	$tampilPeg   =mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$data[id_peg]'");
	$peg    =mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);
?>
<!-- begin page-header -->
<h1 class="page-header">Detail <small>SKP</small></h1>
<!-- end page-header -->			
<div class="invoice">
	<div class="invoice-company">
		Sasaran Kerja Pegawai
	</div>
	<div class="invoice-header">
		<div class="invoice-from">
			<strong><?=$peg['nama']?></strong><br />
			NIP: <?=$peg['nip']?>
		</div>
		<div class="invoice-to">
			<strong>Pejabat</strong>
			<address class="m-t-5 m-b-5">
			Penilai: <?=$data['penilai']?><br />
			Atasan Penilai: <?=$data['atasan_penilai']?>
			</address>
		</div>
		<div class="invoice-date">
			<strong>Periode</strong>
            <div class="invoice-detail">
				<?=$data['periode_awal']?> &nbsp; <b>s/d</b> &nbsp; <?=$data['periode_akhir']?>
			</div>
		</div>
	</div>
	<div class="invoice-content">
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th width="10%">No #</th>
						<th width="70%">Aspek Penilaian SKP</th>
						<th width="20%">Nilai Perolehan</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Orientasi Pelayanan</td>
						<td><?php echo $data['nilai_orientasi'];?></td>
					</tr>
					<tr>
						<td>2</td>
						<td>Integritas</td>
						<td><?php echo $data['nilai_integritas'];?></td>
					</tr>
					<tr>
						<td>3</td>
						<td>Komitmen</td>
						<td><?php echo $data['nilai_komitmen'];?></td>
					</tr>
					<tr>
						<td>4</td>
						<td>Disiplin</td>
						<td><?php echo $data['nilai_disiplin'];?></td>
					</tr>
					<tr>
						<td>5</td>
						<td>Kerjasama</td>
						<td><?php echo $data['nilai_kerjasama'];?></td>
					</tr>
					<tr>
						<td>6</td>
						<td>Kepemimpinan</td>
						<td><?php echo $data['nilai_kepemimpinan'];?></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="2">Nilai Total</th>
						<th><?=$jml_nilai?></th>
					</tr>
					<tr>
						<th colspan="2">Rata-rata</th>
						<th><?=number_format($rata,2,",",",")?></th>
					</tr>
					<tr>
						<th colspan="2">Mutu</th>
						<th><?=$data['hasil_penilaian']?></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);
</script>