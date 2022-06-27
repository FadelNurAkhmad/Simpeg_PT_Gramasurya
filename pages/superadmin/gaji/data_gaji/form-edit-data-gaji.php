<?php
// if (isset($_GET['id_presensi'])) {
//     $id_presensi = $_GET['id_presensi'];

//     include "../../config/koneksi.php";
//     $query   = mysql_query("SELECT * FROM tb_presensi WHERE id_presensi='$id_presensi'");
//     $data    = mysql_fetch_array($query);
// } else {
//     die("Error. No ID Selected!");
// }
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
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Data Gaji <small><i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> Pegawai : </small></h1>
<!-- begin row -->
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
                <h4 class="panel-title">Form edit data presensi</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=edit-data-presensi&id_presensi=<?= $id_presensi ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pegawai</label>
                        <div class="col-md-6">
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY pegawai_nama ASC");
                            echo '<select name="id_peg" class="default-select2 form-control">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($data)) {
                                echo '<option value="' . $row['pegawai_id'] . '">' . $row['pegawai_nama'] . '_' . $row['pegawai_nip'] . '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal </label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="date" name="tanggal_penggajian" id="tanggal_penggajianx" readonly value="" data-parsley-required="true" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jabatan</label>
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="nama_jabatan" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Gaji Pokok</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp.
                                <input class="form-control" type="text" name="gaji_pokok" id="gaji_pokok" data-parsley-required="true" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tunjangan Jabatan</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp.
                                <input class="form-control" type="text" name="tunjangan_jabatan" id="tunjangan_jabatan" data-parsley-required="true" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Bonus</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="bonus" id="bonus" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Potongan</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp.
                                <input class="form-control" type="text" name="potongan" id="potongan" value="0" data-parsley-required="true" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Gaji Bersih</label>
                        <div class="col-md-6">
                            <div class="form-inline">
                                Rp.
                                <input class="form-control" type="text" name="gaji_bersih" id="gaji_bersih" value="0" data-parsley-required="true" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Edit</button>&nbsp;
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-data-gaji"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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