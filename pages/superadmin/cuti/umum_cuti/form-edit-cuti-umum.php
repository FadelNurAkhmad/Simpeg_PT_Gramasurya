<?php
if (isset($_GET['id_cuti_umum'])) {
    $id_cuti_umum = $_GET['id_cuti_umum'];

    include "../../config/koneksi.php";
    $query   = mysqli_query($koneksi, "SELECT * FROM tb_cuti_umum WHERE id_cuti_umum='$id_cuti_umum'");
    $data    = mysqli_fetch_array($query);

    $tampilPeg   = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$data[id_peg]'");
    $peg    = mysqli_fetch_array($tampilPeg);
} else {
    die("Error. No ID Selected!");
}
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
<h1 class="page-header">Cuti / Izin <small><i class="fa fa-angle-right"></i> Izin <i class="fa fa-angle-right"></i> Edit Izin <i class="fa fa-key"></i> Pegawai: <?= $peg['pegawai_nama'] ?> &nbsp;&nbsp;<i class="fa fa-lock"></i> NIP : <?= $peg == 0 ? '-' : $peg['pegawai_nip']; ?></small></h1>
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
                </div>
                <h4 class="panel-title">Form edit izin</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=edit-cuti-umum&id_cuti_umum=<?= $id_cuti_umum ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jenis Izin<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-6">
                            <?php
                            $dataJ = mysqli_query($koneksi, "SELECT * FROM tb_jenis_cuti ORDER BY jenis");
                            echo '<select name="jenis_cuti" class="default-select2 form-control">';
                            echo '<option value="">...</option>';
                            while ($rowj = mysqli_fetch_array($dataJ)) {
                                echo '<option value="' . $rowj['jenis'] . '">' . $rowj['jenis'] . '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Keperluan<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-6">
                            <textarea type="text" name="keperluan" maxlength="255" class="form-control"><?= $data['keperluan'] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal Pengajuan<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-6">
                            <div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
                                <input type="text" name="tanggal_cuti" value="<?= $data['tanggal_cuti'] ?>" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal Pelaksanaan<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-3">
                            <div class="input-group date" id="datepicker-disabled-past3" data-date-format="yyyy-mm-dd">
                                <input type="text" name="tanggal_mulai" value="<?= $data['tanggal_mulai'] ?>" placeholder="Dari" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group date" id="datepicker-disabled-past4" data-date-format="yyyy-mm-dd">
                                <input type="text" name="tanggal_selesai" value="<?= $data['tanggal_selesai'] ?>" placeholder="Sampai" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Lama Izin<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-6">
                            <input type="text" name="lama_cuti" value="<?= $data['lama_cuti'] ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="hidden" id="jumlah_cuti" name="jumlah_cuti" value="<?= $data['jumlah_cuti'] ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="hidden" id="status" name="status" value="<?= $data['status']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="edit" value="edit" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp;Edit</button>&nbsp;
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-cuti-umum"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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