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
<h1 class="page-header">Presensi <small><i class="fa fa-angle-right"></i> Konfigurasi Shift <i class="fa fa-angle-right"></i> Insert&nbsp;</small></h1>
<!-- end page-header -->
<?php
function kdauto($tabel, $inisial)
{
    include "../../config/koneksi.php";

    $struktur   = mysqli_query($koneksi, "SELECT * FROM $tabel");
    $fieldInfo = mysqli_fetch_field_direct($struktur, 0);
    $field      = $fieldInfo->name;
    $panjang    = $fieldInfo->length;
    $qry  = mysqli_query($koneksi, "SELECT max(" . $field . ") FROM " . $tabel);
    $row  = mysqli_fetch_array($qry);
    if ($row[0] == "") {
        $angka = 0;
    } else {
        $angka = substr($row[0], strlen($inisial));
    }
    $angka++;
    $angka = strval($angka);
    $tmp  = "";
    for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
        $tmp = $tmp . "0";
    }
    return $inisial . $tmp . $angka;
}
$jk_id    = kdauto("jam_kerja", "");
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
                </div>
                <h4 class="panel-title">Form master tambah shift kerja</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=master-shift-kerja&jk_id=<?= $jk_id ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama Shift<span aria-required="true" class="text-danger"> * </span></label>
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="jk_name" />
                        </div>
                        <label class="col-md-1 control-label">Kode<span aria-required="true" class="text-danger"> * </span></label>
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="jk_kode" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Keterangan</label>
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="jk_ket" />
                        </div>
                        <label class="col-md-1 control-label"></label>
                        <div class="col-md-1 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jk_durasi" id="flexRadioDefault1" value="1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Durasi efektif
                            </label>
                        </div>
                        <label class="col-md-1 control-label"></label>
                        <div class="col-md-1 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jk_durasi" id="flexRadioDefault2" value="2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Durasi aktual
                            </label>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Dihitung</label>
                        <div class="col-md-3">
                            <div class="form-inline">
                                <input class="form-control" type="number" name="jk_countas" value="1" /> hari
                            </div>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="jk_use_ist" type="checkbox" id="check" onclick="checkedOn()" value="-1">
                            <label class="form-check-label" for="check">Istirahat</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <label class="col-md-8 control-label">Masuk<span aria-required="true" class="text-danger"> * </span></label>
                            <input class="form-control" type="time" name="masuk" id="masuk" value="00:00" data-parsley-required="true" />
                        </div>

                        <div class="col-md-2" id="show" style="display:none">
                            <label class="col-md-10 control-label">Istirahat Keluar</label>
                            <input class="form-control" type="time" name="ist_1" id="ist_1" value="00:00" data-parsley-required="true" />
                        </div>

                        <div class="col-md-2" id="show2" style="display:none">
                            <label class="col-md-10 control-label">Istirahat Kembali</label>
                            <input class="form-control" type="time" name="ist_2" id="ist_2" value="00:00" data-parsley-required="true" />
                        </div>

                        <div class="col-md-2">
                            <label class="col-md-8 control-label">Pulang<span aria-required="true" class="text-danger"> * </span></label>
                            <input class="form-control" type="time" name="pulang" id="pulang" value="00:00" data-parsley-required="true" />
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Durasi sebelum jam masuk</label>
                        <div class="col-md-3">
                            <div class="form-inline">
                                <input class="form-control" type="number" name="sebelum_masuk" value="60" /> menit
                            </div>
                        </div>
                        <label class="col-md-2 control-label">Durasi sebelum jam pulang</label>
                        <div class="col-md-3">
                            <div class="form-inline">
                                <input class="form-control" type="number" name="sebelum_pulang" value="0" /> menit
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Durasi setelah jam masuk</label>
                        <div class="col-md-3">
                            <div class="form-inline">
                                <input class="form-control" type="number" name="setelah_masuk" value="60" /> menit
                            </div>
                        </div>
                        <label class="col-md-2 control-label">Durasi setelah jam pulang</label>
                        <div class="col-md-3">
                            <div class="form-inline">
                                <input class="form-control" type="number" name="setelah_pulang" value="0" /> menit
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Toleransi terlambat</label>
                        <div class="col-md-3">
                            <div class="form-inline">
                                <input class="form-control" type="number" name="tol_late" value="0" /> menit
                            </div>
                        </div>
                        <label class="col-md-2 control-label">Toleransi pulang awal</label>
                        <div class="col-md-3">
                            <div class="form-inline">
                                <input class="form-control" type="number" name="tol_early" value="0" /> menit
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- <label class="col-md-3 control-label">Durasi minimal dihitung 1/2 hari kerja</label>
                        <div class="col-md-3">
                            <div class="form-inline">
                                <input class="form-control" type="number" name="setengah_kerja" value="0" /> menit
                            </div>
                        </div> -->
                        <label class="col-md-3 control-label">Durasi minimal dihitung kerja penuh</label>
                        <div class="col-md-3">
                            <div class="form-inline">
                                <input class="form-control" type="number" name="kerja_penuh" value="240" /> menit
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-md-5 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Simpan</button>&nbsp;
                            <a type="button" class="btn btn-default active" href="index.php?page=form-view-shift-kerja"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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

    function checkedOn() {
        var checkBox = document.getElementById("check");
        var show = document.getElementById("show");
        var show2 = document.getElementById("show2");
        if (checkBox.checked == true) {
            show.style.display = "block";
            show2.style.display = "block";
        } else {
            show.style.display = "none";
            show2.style.display = "none";
        }
    }
</script>