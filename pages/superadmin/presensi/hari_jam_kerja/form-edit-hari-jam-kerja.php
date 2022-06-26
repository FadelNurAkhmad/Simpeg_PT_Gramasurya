<?php
if (isset($_GET['jdw_kerja_m_id'])) {
    $jdw_kerja_m_id = $_GET['jdw_kerja_m_id'];

    include "../../config/koneksi.php";
    $query   = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_m WHERE jdw_kerja_m_id='$jdw_kerja_m_id'");
    $data    = mysqli_fetch_array($query, MYSQLI_ASSOC);

    $query2 = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_d WHERE jdw_kerja_m_id='$jdw_kerja_m_id' AND jdw_kerja_d_idx=1");
    $data2 = mysqli_fetch_array($query2, MYSQLI_ASSOC);
    $query3 = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_d WHERE jdw_kerja_m_id='$jdw_kerja_m_id' AND jdw_kerja_d_idx=2");
    $data3 = mysqli_fetch_array($query3, MYSQLI_ASSOC);
    $query4 = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_d WHERE jdw_kerja_m_id='$jdw_kerja_m_id' AND jdw_kerja_d_idx=3");
    $data4 = mysqli_fetch_array($query4, MYSQLI_ASSOC);
    $query5 = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_d WHERE jdw_kerja_m_id='$jdw_kerja_m_id' AND jdw_kerja_d_idx=4");
    $data5 = mysqli_fetch_array($query5, MYSQLI_ASSOC);
    $query6 = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_d WHERE jdw_kerja_m_id='$jdw_kerja_m_id' AND jdw_kerja_d_idx=5");
    $data6 = mysqli_fetch_array($query6, MYSQLI_ASSOC);
    $query7 = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_d WHERE jdw_kerja_m_id='$jdw_kerja_m_id' AND jdw_kerja_d_idx=6");
    $data7 = mysqli_fetch_array($query7, MYSQLI_ASSOC);
    $query8 = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_d WHERE jdw_kerja_m_id='$jdw_kerja_m_id' AND jdw_kerja_d_idx=7");
    $data8 = mysqli_fetch_array($query8, MYSQLI_ASSOC);
    $query9 = mysqli_query($koneksi, "SELECT * FROM jdw_kerja_d WHERE jdw_kerja_m_id='$jdw_kerja_m_id' AND jdw_kerja_d_idx=999");
    $data9 = mysqli_fetch_array($query9, MYSQLI_ASSOC);
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
<h1 class="page-header">Jadwal Kerja Normal <small><i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i></small></h1>
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
                <h4 class="panel-title">Form edit jadwal kerja normal</h4>
            </div>
            <div class="panel-body">
                <form action="index.php?page=edit-hari-jam-kerja&jdw_kerja_m_id=<?= $jdw_kerja_m_id ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama Jadwal Kerja*</label>
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="jdw_kerja_m_name" value="<?= $data['jdw_kerja_m_name'] ?>" />
                        </div>
                        <label class="col-md-1 control-label">Kode*</label>
                        <div class="col-md-2">
                            <input class="form-control" type="text" name="jdw_kerja_m_kode" value="<?= $data['jdw_kerja_m_kode'] ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Keterangan</label>
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="jdw_kerja_m_keterangan" value="<?= $data['jdw_kerja_m_keterangan'] ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mulai Tanggal*</label>
                        <div class="col-md-3">
                            <div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
                                <input type="text" name="jdw_kerja_m_mulai" class="form-control" value="<?= $data['jdw_kerja_m_mulai'] ?>" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Senin</label>
                        <div class="col-md-3">
                            <?php
                            $shift = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id1" class="default-select2 form-control" id="disabled1">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($shift, MYSQLI_ASSOC)) {
                            ?>
                                <option value="<?= $row['jk_id'] ?>" <?php echo ($data2['jk_id'] == $row['jk_id']) ? "selected" : ""; ?>> <?= $row['jk_name'] ?> </option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur1" type="checkbox" id="check1" onclick="checkedOn(1)" value="-1" <?php echo ($data2['jdw_kerja_d_libur'] == '-1') ? "checked" : ""; ?>>
                            <label class="form-check-label" for="check">Libur</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Selasa</label>
                        <div class="col-md-3">
                            <?php
                            $shift = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id2" class="default-select2 form-control" id="disabled2">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($shift, MYSQLI_ASSOC)) {
                            ?>
                                <option value="<?= $row['jk_id'] ?>" <?php echo ($data3['jk_id'] == $row['jk_id']) ? "selected" : ""; ?>> <?= $row['jk_name'] ?> </option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur2" type="checkbox" id="check2" onclick="checkedOn(2)" value="-1" <?php echo ($data3['jdw_kerja_d_libur'] == '-1') ? "checked" : ""; ?>>
                            <label class="form-check-label" for="check">Libur</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Rabu</label>
                        <div class="col-md-3">
                            <?php
                            $shift = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id3" class="default-select2 form-control" id="disabled3">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($shift, MYSQLI_ASSOC)) {
                            ?>
                                <option value="<?= $row['jk_id'] ?>" <?php echo ($data4['jk_id'] == $row['jk_id']) ? "selected" : ""; ?>> <?= $row['jk_name'] ?> </option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur3" type="checkbox" id="check3" onclick="checkedOn(3)" value="-1" <?php echo ($data4['jdw_kerja_d_libur'] == '-1') ? "checked" : ""; ?>>
                            <label class="form-check-label" for="check">Libur</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Kamis</label>
                        <div class="col-md-3">
                            <?php
                            $shift = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id4" class="default-select2 form-control" id="disabled4">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($shift, MYSQLI_ASSOC)) {
                            ?>
                                <option value="<?= $row['jk_id'] ?>" <?php echo ($data5['jk_id'] == $row['jk_id']) ? "selected" : ""; ?>> <?= $row['jk_name'] ?> </option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur4" type="checkbox" id="check4" onclick="checkedOn(4)" value="-1" <?php echo ($data5['jdw_kerja_d_libur'] == '-1') ? "checked" : ""; ?>>
                            <label class="form-check-label" for="check">Libur</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jumat</label>
                        <div class="col-md-3">
                            <?php
                            $shift = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id5" class="default-select2 form-control" id="disabled5">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($shift, MYSQLI_ASSOC)) {
                            ?>
                                <option value="<?= $row['jk_id'] ?>" <?php echo ($data6['jk_id'] == $row['jk_id']) ? "selected" : ""; ?>> <?= $row['jk_name'] ?> </option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur5" type="checkbox" id="check5" onclick="checkedOn(5)" value="-1" <?php echo ($data6['jdw_kerja_d_libur'] == '-1') ? "checked" : ""; ?>>
                            <label class="form-check-label" for="check">Libur</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Sabtu</label>
                        <div class="col-md-3">
                            <?php
                            $shift = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id6" class="default-select2 form-control" id="disabled6">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($shift, MYSQLI_ASSOC)) {
                            ?>
                                <option value="<?= $row['jk_id'] ?>" <?php echo ($data7['jk_id'] == $row['jk_id']) ? "selected" : ""; ?>> <?= $row['jk_name'] ?> </option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur6" type="checkbox" id="check6" onclick="checkedOn(6)" value="-1" <?php echo ($data7['jdw_kerja_d_libur'] == '-1') ? "checked" : ""; ?>>
                            <label class="form-check-label" for="check">Libur</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Minggu</label>
                        <div class="col-md-3">
                            <?php
                            $shift = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id7" class="default-select2 form-control" id="disabled7">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($shift, MYSQLI_ASSOC)) {
                            ?>
                                <option value="<?= $row['jk_id'] ?>" <?php echo ($data8['jk_id'] == $row['jk_id']) ? "selected" : ""; ?>> <?= $row['jk_name'] ?> </option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur7" type="checkbox" id="check7" onclick="checkedOn(7)" value="-1" <?php echo ($data8['jdw_kerja_d_libur'] == '-1') ? "checked" : ""; ?>>
                            <label class="form-check-label" for="check">Libur</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Libur Umum</label>
                        <div class="col-md-3">
                            <?php
                            $shift = mysqli_query($koneksi, "SELECT * FROM jam_kerja ORDER BY jk_id ASC");
                            echo '<select name="jk_id8" class="default-select2 form-control" id="disabled8">';
                            echo '<option value="">...</option>';
                            while ($row = mysqli_fetch_array($shift, MYSQLI_ASSOC)) {
                            ?>
                                <option value="<?= $row['jk_id'] ?>" <?php echo ($data9['jk_id'] == $row['jk_id']) ? "selected" : ""; ?>> <?= $row['jk_name'] ?> </option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-1 form-check">
                            <input class="form-check-input" name="libur8" type="checkbox" id="check8" onclick="checkedOn(8)" value="-1" <?php echo ($data9['jdw_kerja_d_libur'] == '-1') ? "checked" : ""; ?>>
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
        console.log(x);
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