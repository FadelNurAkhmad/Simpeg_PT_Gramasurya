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
<h1 class="page-header">Presensi <small><i class="fa fa-angle-right"></i> Konfigurasi Jadwal Kerja <i class="fa fa-angle-right"></i> Insert&nbsp;</small></h1>
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
$jdw_kerja_m_id    = kdauto("jdw_kerja_m", "");
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
                <h4 class="panel-title">Form master hari/jam kerja</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=master-hari-jam-kerja&jdw_kerja_m_id=<?= $jdw_kerja_m_id ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama Jadwal Kerja<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="jdw_kerja_m_name" />
                        </div>
                        <label class="col-md-1 control-label">Kode<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-2">
                            <input class="form-control" type="text" name="jdw_kerja_m_kode" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Keterangan</label>
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="jdw_kerja_m_keterangan" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mulai Tanggal<span aria-required="true" class="text-warning"> * </span></label>
                        <div class="col-md-3">
                            <div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
                                <input type="text" name="jdw_kerja_m_mulai" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Senin</label>
                        <div class="col-md-3">
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id1" class="default-select2 form-control" id="disabled1">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                                echo '<option value="' . $row['jk_id'] . '">' . $row['jk_name'] .  '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur1" type="checkbox" id="check1" onclick="checkedOn(1)" value="-1">
                            <label class="form-check-label" for="check">Libur</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Selasa</label>
                        <div class="col-md-3">
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id2" class="default-select2 form-control" id="disabled2">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                                echo '<option value="' . $row['jk_id'] . '">' . $row['jk_name'] .  '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur2" type="checkbox" id="check2" onclick="checkedOn(2)" value="-1">
                            <label class="form-check-label" for="check">Libur</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Rabu</label>
                        <div class="col-md-3">
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id3" class="default-select2 form-control" id="disabled3">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                                echo '<option value="' . $row['jk_id'] . '">' . $row['jk_name'] .  '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur3" type="checkbox" id="check3" onclick="checkedOn(3)" value="-1">
                            <label class="form-check-label" for="check">Libur</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kamis</label>
                        <div class="col-md-3">
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id4" class="default-select2 form-control" id="disabled4">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                                echo '<option value="' . $row['jk_id'] . '">' . $row['jk_name'] .  '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur4" type="checkbox" id="check4" onclick="checkedOn(4)" value="-1">
                            <label class="form-check-label" for="check">Libur</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jumat</label>
                        <div class="col-md-3">
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id5" class="default-select2 form-control" id="disabled5">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                                echo '<option value="' . $row['jk_id'] . '">' . $row['jk_name'] .  '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur5" type="checkbox" id="check5" onclick="checkedOn(5)" value="-1">
                            <label class="form-check-label" for="check">Libur</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Sabtu</label>
                        <div class="col-md-3">
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id6" class="default-select2 form-control" id="disabled6">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                                echo '<option value="' . $row['jk_id'] . '">' . $row['jk_name'] .  '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur6" type="checkbox" id="check6" onclick="checkedOn(6)" value="-1">
                            <label class="form-check-label" for="check">Libur</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Minggu</label>
                        <div class="col-md-3">
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id7" class="default-select2 form-control" id="disabled7">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                                echo '<option value="' . $row['jk_id'] . '">' . $row['jk_name'] .  '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur7" type="checkbox" id="check7" onclick="checkedOn(7)" value="-1">
                            <label class="form-check-label" for="check">Libur</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Libur Umum</label>
                        <div class="col-md-3">
                            <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id8" class="default-select2 form-control" id="disabled8">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                                echo '<option value="' . $row['jk_id'] . '">' . $row['jk_name'] .  '</option>';
                            }
                            echo '</select>';
                            ?>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur8" type="checkbox" id="check8" onclick="checkedOn(8)" value="-1">
                            <label class="form-check-label" for="check">Libur</label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Simpan</button>&nbsp;
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

    function checkedOn(x) {

        var checkBox = document.getElementById("check" + x.toString());
        var disabled = document.getElementById("disabled" + x.toString());
        if (checkBox.checked == true) {
            disabled.disabled = true;
            console.log(disabled);
        } else {
            disabled.disabled = false;
            console.log(disabled);
        }

    }
</script>