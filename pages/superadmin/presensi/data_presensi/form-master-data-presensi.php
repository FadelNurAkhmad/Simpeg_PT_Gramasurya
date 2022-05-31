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
<h1 class="page-header">Riwayat <small>Presensi <i class="fa fa-angle-right"></i> Insert&nbsp;</small></h1>
<!-- end page-header -->
<?php
include "../../config/koneksi.php";
function kdauto($tabel, $inisial){
    include "../../config/koneksi.php";
    
    $struktur   = mysqli_query($koneksi, "SELECT * FROM $tabel");
    $fieldInfo = mysqli_fetch_field_direct($struktur, 0);
    $field      = $fieldInfo->name;
    $panjang    = $fieldInfo->length;
    $qry  = mysqli_query($koneksi, "SELECT max(".$field.") FROM ".$tabel);
    $row  = mysqli_fetch_array($qry);
    if ($row[0]=="") {
    $angka=0;
    }
    else {
    $angka= substr($row[0], strlen($inisial));
    }
    $angka++;
    $angka =strval($angka);
    $tmp  ="";
    for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
    $tmp=$tmp."0";
    }
    return $inisial.$tmp.$angka;
    }
$id_presensi    = kdauto("tb_presensi", "");
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
                <h4 class="panel-title">Form master data presensi</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=master-data-presensi&id_presensi=<?= $id_presensi ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pegawai</label>
                        <div class="col-md-6">
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM tb_pegawai ORDER BY nama ASC");
                            echo '<select name="id_peg" class="default-select2 form-control">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                                echo '<option value="' . $row['id_peg'] . '">' . $row['nama'] . '_' . $row['nip'] . '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanggal</label>
                        <div class="col-md-6">
                            <div class="input-group date" id="datepicker-disabled-past1" data-date-format="yyyy-mm-dd">
                                <input type="text" name="tanggal" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Bulan dan Tahun</label>
                        <div class="col-md-3">
                            <select class="form-control" name="bulan">
                                <?php
                                $arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                foreach ($arr as $key) {
                                    echo "<option value='$key'>$key";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="tahun" class="form-control">
                                <?php
                                for ($i = 2018; $i < 2024; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Hadir</label>
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="hadir" value="0" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Sakit</label>
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="sakit" value="0" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Ijin</label>
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="ijin" value="0" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tanpa Keterangan</label>
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="tanpa_keterangan" value="0" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>&nbsp;
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-data-presensi"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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