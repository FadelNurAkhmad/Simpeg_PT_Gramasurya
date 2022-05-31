<!-- begin page-header -->
<h1 class="page-header">Report <small>KGB <i class="fa fa-angle-right"></i> Bulan Ini</small></h1>
<!-- end page-header -->
<div class="profile-container">
	<!-- begin profile-section -->
	<div class="profile-section">
		<div class="panel-body">
			<form action="index.php?page=report-kgb" class="form-horizontal" method="POST" enctype="multipart/form-data" >
				<div class="form-group">
					<label class="col-md-4 control-label">Pilih Periode</label>
					<div class="col-md-3">
						<select name="kgb_reminder" class="default-select2 form-control">
							<option value="one">Tahun Ini</option>
							<option value="two">Tahun Depan</option>
						</select>
					</div>
					<div class="col-md-4">
						<button type="submit" name="report" value="report" class="btn btn-success"><i class="fa fa-search"></i> &nbsp;Get Report</button>&nbsp;
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- end profile-section -->
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
						list($y,$m,$d)	=explode ("-",date('Y-m-d'));
						$now	="$y"."-"."$m";
						$no=0;
						$tampilKgb	=mysqli_query($koneksi, "SELECT * FROM tb_kgb WHERE tgl_kgb LIKE '$now%' ORDER BY tgl_kgb");
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