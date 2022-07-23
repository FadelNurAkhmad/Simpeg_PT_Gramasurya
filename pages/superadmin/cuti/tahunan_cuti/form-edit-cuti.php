<?php
if (isset($_GET['id_cuti'])) {
    $id_cuti = $_GET['id_cuti'];

    include "../../config/koneksi.php";
    $query   = mysqli_query($koneksi, "SELECT * FROM tb_cuti_tahunan WHERE id_cuti='$id_cuti'");
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
<h1 class="page-header">Cuti / Izin <small><i class="fa fa-angle-right"></i> Cuti Tahunan <i class="fa fa-angle-right"></i> Edit Cuti Tahunan <i class="fa fa-key"></i> Pegawai: <?= $peg['pegawai_nama'] ?> &nbsp;&nbsp;<i class="fa fa-lock"></i> NIP : <?= $peg == 0 ? '-' : $peg['pegawai_nip']; ?></small></h1>
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
                <h4 class="panel-title">Form edit cuti tahunan</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=edit-cuti&id_cuti=<?= $id_cuti ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jenis Cuti<span aria-required="true" class="text-danger"> * </span></label>
                        <div class="col-md-6">
                            <input type="text" name="jenis_cuti" value="<?= $data['jenis_cuti'] ?>" class="form-control" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Keperluan<span aria-required="true" class="text-danger"> * </span></label>
                        <div class="col-md-6">
                            <textarea type="text" name="keperluan" maxlength="255" class="form-control"><?= $data['keperluan'] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal Pengajuan<span aria-required="true" class="text-danger"> * </span></label>
                        <div class="col-md-6">
                            <div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
                                <input type="text" name="tanggal_cuti" value="<?= $data['tanggal_cuti'] ?>" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal Pelaksanaan<span aria-required="true" class="text-danger"> * </span></label>
                        <div class="col-md-3">
                            <div class="input-group date" id="datepicker-disabled-past3" data-date-format="yyyy-mm-dd">
                                <input type="text" id="tanggal_mulai" name="tanggal_mulai" value="<?= $data['tanggal_mulai'] ?>" placeholder="Dari" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group date" id="datepicker-disabled-past4" data-date-format="yyyy-mm-dd">
                                <input type="text" id="tanggal_selesai" name="tanggal_selesai" value="<?= $data['tanggal_selesai'] ?>" placeholder="Sampai" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <label class="col-md-3">
                            <a type="button" value="hitung" id="hitung" class="btn btn-danger"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Hitung Hari</a>&nbsp;
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Lama Cuti<span aria-required="true" class="text-danger"> * </span></label>
                        <div class="col-md-6">
                            <input type="text" id="lama_cuti" name="lama_cuti" value="<?= $data['lama_cuti'] ?>" class="form-control" />
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
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-cuti"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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

<script>
    function getHitungHari(tanggal_mulai, tanggal_selesai) {
        var elapsed, daysBeforeFirstSaturday, daysAfterLastSunday;
        var ifThen = function(a, b, c) {
            return a == b ? c : a;
        };

        elapsed = tanggal_selesai - tanggal_mulai;
        elapsed /= 86400000;

        daysBeforeFirstSunday = (7 - tanggal_mulai.getDay()) % 7;
        daysAfterLastSunday = tanggal_selesai.getDay();

        elapsed -= (daysBeforeFirstSunday + daysAfterLastSunday);
        elapsed = (elapsed / 7) * 6;
        elapsed += ifThen(daysBeforeFirstSunday, 0, 0) + ifThen(daysAfterLastSunday, 6, 6);

        return Math.ceil(elapsed);
    }

    $("#hitung").on("click", function() {
        let mulai = document.querySelector('#tanggal_mulai').value,
            selesai = document.querySelector('#tanggal_selesai').value,
            hasil = getHitungHari(new Date(mulai), new Date(selesai));
        document.querySelector('#lama_cuti').value = hasil;
    })
</script>