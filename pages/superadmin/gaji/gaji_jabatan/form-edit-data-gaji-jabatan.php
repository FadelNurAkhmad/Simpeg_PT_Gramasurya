<?php
if (isset($_GET['id_jabatan'])) {
    $id_jabatan = $_GET['id_jabatan'];

    include "../../config/koneksi.php";
    $query   = mysql_query("SELECT * FROM tb_gaji_jabatan WHERE id_jabatan='$id_jabatan'");
    $data    = mysql_fetch_array($query);
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
<h1 class="page-header">Data Gaji <small><i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> Jabatan: <?= $data['nama_jabatan'] ?></small></h1>
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
                <h4 class="panel-title">Form edit data gaji jabatan</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=edit-data-gaji-jabatan&id_jabatan=<?= $id_jabatan ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama Jabatan</label>
                        <div class="col-md-6">
                            <?php
                            $dataJ = mysql_query("SELECT * FROM tb_masterjab ORDER BY nama_masterjab");
                            echo '<select name="nama_jabatan" class="default-select2 form-control">';
                            echo '<option value="' . $data['nama_jabatan'] . '">...</option>';
                            while ($rowj = mysql_fetch_array($dataJ)) {
                                echo '<option value="' . $rowj['nama_masterjab'] . '">' . $rowj['nama_masterjab'] . '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Gaji Pokok</label>
                        <div class="col-md-6">
                            <input type="number" name="gapok" value="<?= $data['gapok'] ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tunjangan</label>
                        <div class="col-md-6">
                            <input type="number" name="tunjangan" value="<?= $data['tunjangan'] ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="edit" value="edit" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp;Edit</button>&nbsp;
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-data-gaji-jabatan"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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