<?php
if (isset($_GET['pegawai_id'])) {
    $pegawai_id = $_GET['pegawai_id'];

    include "../../config/koneksi.php";
    $query   = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_pegawai WHERE pegawai_id='$pegawai_id'");
    $data    = mysqli_fetch_array($query, MYSQLI_ASSOC);
    $cek = mysqli_num_rows($query);

    if ($cek <= 0) {
        $datapegawai = "";
    }

    $tampilPeg  = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$pegawai_id'");
    $peg    = mysqli_fetch_array($tampilPeg, MYSQLI_ASSOC);
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
<h1 class="page-header">Presensi <small><i class="fa fa-angle-right"></i> Jadwal Kerja Pegawai <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> Pegawai: <?= $peg['pegawai_nama'] ?></small></h1>
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
                </div>
                <h4 class="panel-title">Form edit jadwal kerja pegawai</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=edit-data-jadwal-kerja-pegawai&pegawai_id=<?= $pegawai_id ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama Pegawai<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-6">
                            <input type="text" name="pegawai_nama" maxlength="64" value="<?= $peg['pegawai_nama'] ?>" class="form-control" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jadwal Kerja<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-6">
                            <?php
                            $jdw = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_m WHERE jdw_kerja_m_type='0' ORDER BY jdw_kerja_m_name ASC");
                            echo '<select name="jdw_kerja_m_id" class="default-select2 form-control">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($jdw, MYSQLI_ASSOC)) {

                            ?>

                                <option value="<?= $row['jdw_kerja_m_id'] ?>" <?php echo ($data == $row['jdw_kerja_m_id']) ? "selected" : "" ?>><?= $row['jdw_kerja_m_name'] ?></option>

                            <?php
                            }
                            ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Edit</button>&nbsp;
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-data-jadwal-kerja-pegawai"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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