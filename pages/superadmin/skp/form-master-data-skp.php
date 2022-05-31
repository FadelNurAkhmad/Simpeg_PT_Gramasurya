<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
			if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
				echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; ".$_SESSION['pesan']." &nbsp; &nbsp; &nbsp;</div></span>";
			}
			$_SESSION['pesan'] ="";
		?>
	</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Riwayat <small>SKP <i class="fa fa-angle-right"></i> Insert&nbsp;</small></h1>
<!-- end page-header -->
<?php
	include "../../config/koneksi.php";
	function kdauto($tabel, $inisial){
		$struktur   = mysqli_query($koneksi, "SELECT * FROM $tabel");
		$field      = mysqli_field_name($struktur,0);
		$panjang    = mysqli_field_len($struktur,0);
		$qry  = mysqli_query($koneksi, "SELECT max(".$field.") FROM ".$tabel);
		$row  = mysqli_fetch_array($qry, MYSQLI_ASSOC);
		if ($row[0]=="") {
		$angka=0;
		}
		else {
		$angka= substr($row[0], strlen($inisial));
		}
		$angka++;
		$angka      =strval($angka);
		$tmp  ="";
		for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";
		}
		return $inisial.$tmp.$angka;
		}
	$id_skp	=kdauto("tb_skp","");
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
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Form master data SKP</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=master-data-skp&id_skp=<?=$id_skp?>" class="form-horizontal" method="POST" enctype="multipart/form-data" >
					<div class="form-group">
						<label class="col-md-3 control-label">Periode Penilaian</label>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
								<input type="text" name="periode_awal" placeholder="Dari" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
								<input type="text" name="periode_akhir" placeholder="Sampai" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Pegawai Yang Dinilai</label>
						<div class="col-md-6">
							<?php
								$data = mysqli_query($koneksi, "SELECT * FROM tb_pegawai ORDER BY nama ASC");        
								echo '<select name="id_peg" class="default-select2 form-control">';    
								echo '<option value="">...</option>';    
									while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {    
									echo '<option value="'.$row['id_peg'].'">'.$row['nama'].'_'.$row['nip'].'</option>';    
									}    
								echo '</select>';
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Pejabat Penilai</label>
						<div class="col-md-6">
							<input type="text" name="penilai" maxlength="64" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Atasan Pejabat Penilai</label>
						<div class="col-md-6">
							<input type="text" name="atasan_penilai" maxlength="64" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nilai Orientasi Pelayanan</label>
						<div class="col-md-4">
							<input type="text" name="nilai_orientasi" maxlength="11" class="form-control" />
						</div>
						<div class="col-md-2">
							<p>* Angka</p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nilai Integritas</label>
						<div class="col-md-4">
							<input type="text" name="nilai_integritas" maxlength="11" class="form-control" />
						</div>
						<div class="col-md-2">
							<p>* Angka</p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nilai Komitmen</label>
						<div class="col-md-4">
							<input type="text" name="nilai_komitmen" maxlength="11" class="form-control" />
						</div>
						<div class="col-md-2">
							<p>* Angka</p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nilai Disiplin</label>
						<div class="col-md-4">
							<input type="text" name="nilai_disiplin" maxlength="11" class="form-control" />
						</div>
						<div class="col-md-2">
							<p>* Angka</p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nilai Kerjasama</label>
						<div class="col-md-4">
							<input type="text" name="nilai_kerjasama" maxlength="11" class="form-control" />
						</div>
						<div class="col-md-2">
							<p>* Angka</p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nilai Kepemimpinan</label>
						<div class="col-md-4">
							<input type="text" name="nilai_kepemimpinan" maxlength="11" class="form-control" />
						</div>
						<div class="col-md-2">
							<p>* Angka</p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Hasil Penilaian</label>
						<div class="col-md-6">
							<select name="hasil_penilaian" class="default-select2 form-control">
								<option value="">...</option>    
								<option value="Sangat Baik">Sangat Baik</option>
								<option value="Baik">Baik</option>
								<option value="Cukup Baik">Cukup Baik</option>
								<option value="Kurang Baik">Kurang Baik</option>
							</select>
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
<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);
</script>