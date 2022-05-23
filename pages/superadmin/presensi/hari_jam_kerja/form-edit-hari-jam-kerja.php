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
<h1 class="page-header">Hari/Jam Kerja <small><i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i></small></h1>
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
                <h4 class="panel-title">Form edit hari/jam kerja</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=edit-data-presensi&id_presensi=<?= $id_presensi ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Shift*</label>
                        <div class="col-md-6">
                            <select name="lokasi_mesin" class="default-select2 form-control">
                                <option value="">...</option>
                                <option value="">Pagi</option>
                                <option value="">Malam</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Hari*</label>
                        <div class="col-md-6">
                            <select name="lokasi_mesin" class="default-select2 form-control">
                                <option value="">...</option>
                                <option value="">Senin</option>
                                <option value="">Selasa</option>
                                <option value="">Rabu</option>
                                <option value="">Kamis</option>
                                <option value="">Juma'at</option>
                                <option value="">Sabtu</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jam Mulai Absen Masuk*</label>
                        <div class="col-md-6">
                            <div class="input-group date" id="datetimepicker2">
                                <input type="text" name="jam1" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jam Mulai Absen Pulang*</label>
                        <div class="col-md-6">
                            <div class="input-group date" id="datetimepicker3">
                                <input type="text" name="jam1" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jam Masuk Kerja*</label>
                        <div class="col-md-6">
                            <div class="input-group date" id="datetimepicker4">
                                <input type="text" name="jam3" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Batas Absen Masuk*</label>
                        <div class="col-md-6">
                            <div class="input-group date" id="datetimepicker5">
                                <input type="text" name="jam4" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jam Pulang Kerja*</label>
                        <div class="col-md-6">
                            <div class="input-group date" id="datetimepicker6">
                                <input type="text" name="jam5" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Batas Absen Pulang*</label>
                        <div class="col-md-6">
                            <div class="input-group date" id="datetimepicker7">
                                <input type="text" name="jam6" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Edit</button>&nbsp;
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-hari-jam-kerja"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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

<script type="text/javascript">
    $(function() {
        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });
    });
    $(function() {
        $('#datetimepicker4').datetimepicker({
            format: 'LT'
        });
    });
    $(function() {
        $('#datetimepicker5').datetimepicker({
            format: 'LT'
        });
    });
    $(function() {
        $('#datetimepicker6').datetimepicker({
            format: 'LT'
        });
    });
    $(function() {
        $('#datetimepicker7').datetimepicker({
            format: 'LT'
        });
    });
</script>