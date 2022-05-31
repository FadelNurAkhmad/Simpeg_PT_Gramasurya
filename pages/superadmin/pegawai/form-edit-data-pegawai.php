<?php
	if (isset($_GET['id_peg'])) {
	$id_peg = $_GET['id_peg'];
	
	include "../../config/koneksi.php";
	$query   =mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE id_peg='$id_peg'");
	$data    =mysqli_fetch_array($query, MYSQLI_ASSOC);
	}
	else {
		die ("Error. No ID Selected!");	
	}
?>
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
<h1 class="page-header">Data <small>Pegawai <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> NIP_<?=$data['nip']?></small></h1>
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
				<h4 class="panel-title">Form edit data pegawai</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=edit-data-pegawai&id_peg=<?=$id_peg?>" class="form-horizontal" method="POST" enctype="multipart/form-data" >
					<div class="form-group">
						<label class="col-md-3 control-label">NIP</label>
						<div class="col-md-6">
							<input type="text" name="nip" maxlength="24" value="<?=$data['nip']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tempat, Tanggal Lahir</label>
						<div class="col-md-3">
							<input type="text" name="tempat_lhr" maxlength="64" value="<?=$data['tempat_lhr']?>" class="form-control" />
						</div>
						<div class="col-md-3">
							<div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_lhr" value="<?=$data['tgl_lhr']?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Pegawai</label>
						<div class="col-md-6">
							<input type="text" name="nama" maxlength="64" value="<?=$data['nama']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Agama</label>
						<div class="col-md-6">
							<select name="agama" class="default-select2 form-control">
								<option value="Islam" <?php echo ($data['agama']=='Islam')?"selected":""; ?>>Islam    
								<option value="Protestan" <?php echo ($data['agama']=='Protestan')?"selected":""; ?>>Protestan    
								<option value="Katolik" <?php echo ($data['agama']=='Katolik')?"selected":""; ?>>Katolik    
								<option value="Hindu" <?php echo ($data['agama']=='Hindu')?"selected":""; ?>>Hindu    
								<option value="Budha" <?php echo ($data['agama']=='Budha')?"selected":""; ?>>Budha    
								<option value="Kong Hu Cu" <?php echo ($data['agama']=='Kong Hu Cu')?"selected":""; ?>>Kong Hu Cu
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Jenis Kelamin</label>
						<div class="col-md-6">
							<select name="jk" class="default-select2 form-control">
								<option value="Laki-laki" <?php echo ($data['jk']=='Laki-laki')?"selected":""; ?>>Laki-laki
								<option value="Perempuan" <?php echo ($data['jk']=='Perempuan')?"selected":""; ?>>Perempuan
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Golongan Darah</label>
						<div class="col-md-6">
							<select name="gol_darah" class="default-select2 form-control">
								<option value="A" <?php echo ($data['gol_darah']=='A')?"selected":""; ?>>A    
								<option value="AB" <?php echo ($data['gol_darah']=='AB')?"selected":""; ?>>AB    
								<option value="B" <?php echo ($data['gol_darah']=='B')?"selected":""; ?>>B    
								<option value="O" <?php echo ($data['gol_darah']=='O')?"selected":""; ?>>O 
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Status Pernikahan</label>
						<div class="col-md-6">
							<select name="status_nikah" class="default-select2 form-control">
								<option value="Nikah" <?php echo ($data['status_nikah']=='Nikah')?"selected":""; ?>>Nikah     
								<option value="Belum Nikah" <?php echo ($data['status_nikah']=='Belum Nikah')?"selected":""; ?>>Belum Nikah     
								<option value="Cerai" <?php echo ($data['status_nikah']=='Cerai')?"selected":""; ?>>Cerai 
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Status Kepegawaian</label>
						<div class="col-md-6">
							<select name="status_kepeg" class="default-select2 form-control">
								<option value="PNS" <?php echo ($data['status_kepeg']=='PNS')?"selected":""; ?>>PNS    
								<option value="PTT" <?php echo ($data['status_kepeg']=='PTT')?"selected":""; ?>>PTT
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tanggal Kenaikan Pangkat</label>
						<div class="col-md-6">
							<div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_naikpangkat" value="<?=$data['tgl_naikpangkat']?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tanggal Kenaikan Gaji</label>
						<div class="col-md-6">
							<div class="input-group date" id="datepicker-disabled-past3" data-date-format="yyyy-mm-dd">
								<input type="text" name="tgl_naikgaji" value="<?=$data['tgl_naikgaji']?>" class="form-control" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Alamat</label>
						<div class="col-md-6">
							<textarea name="alamat" maxlength="255" class="form-control"><?=$data['alamat']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">No. Telp</label>
						<div class="col-md-6">
							<input type="text" name="telp" maxlength="12" value="<?=$data['telp']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Email</label>
						<div class="col-md-6">
							<input type="text" name="email" maxlength="64" value="<?=$data['email']?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Unit Kerja</label>
						<div class="col-md-6">
							<?php
								$unit = mysqli_query($koneksi, "SELECT * FROM tb_unit ORDER BY nama");        
								echo '<select name="id_unit" class="default-select2 form-control">';    
								echo '<option value="'.$data['unit_kerja'].'">...</option>';    
									while ($rowunit = mysqli_fetch_array($unit, MYSQLI_ASSOC)) {    
									echo '<option value="'.$rowunit['id_unit'].'">'.$rowunit['nama'].'</option>';    
									}    
								echo '</select>';
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="edit" value="edit" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp;Edit</button>&nbsp;
							<a type="button" class="btn btn-default active" href="index.php?page=form-view-data-pegawai"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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