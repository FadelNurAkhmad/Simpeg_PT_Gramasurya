<?php
if (isset($_GET['id_lokasi'])) {
    $id_lokasi = $_GET['id_lokasi'];

    include "../../config/koneksi.php";
    $query   = mysqli_query($koneksi, "SELECT * FROM tb_lokasi WHERE id_lokasi='$id_lokasi'");
    $data    = mysqli_fetch_array($query);

    $tampilPeg   = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$data[id_peg]'");
    $peg    = mysqli_fetch_array($tampilPeg);
} else {
    die("Error. No ID Selected!");
}
?>
<script>
    var defaultCenter = {
        lat: <?= $data['lat']; ?>,
        lng: <?= $data['lng']; ?>
    };

    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: defaultCenter
        });

        var marker = new google.maps.Marker({
            position: defaultCenter,
            map: map,
            title: 'Click to zoom',
            draggable: true
        });


        marker.addListener('drag', handleEvent);
        marker.addListener('dragend', handleEvent);

        var infowindow = new google.maps.InfoWindow({
            content: '<h4>Drag untuk pindah lokasi</h4>'
        });

        infowindow.open(map, marker);
    }

    function handleEvent(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('lng').value = event.latLng.lng();
    }

    $(function() {
        initMap();
    })
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKH2F9gZMQyATwBodQsEr-uM0fokVCvZw&callback=initMap"></script>

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
<h1 class="page-header">View <small>Lokasi <i class="fa fa-angle-right"></i> <i class="fa fa-key"></i> Pegawai: <?= $peg['pegawai_nama'] ?> &nbsp;&nbsp;<i class="fa fa-lock"></i> NIP : <?= $peg == 0 ? '-' : $peg['pegawai_nip']; ?></small></h1>
<!-- end page-header -->
<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-6">
        <div id="map" style="height:500px;"></div>
    </div>
    <!-- end col-6 -->
    <!-- begin col-6 -->
    <div class="col-md-6">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-validation-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Keterangan</h4>
            </div>
            <div class="panel-body">
                <div class="form-group col-sm-12">
                    <label class="col-md-3 control-label">Nama Lokasi</label>
                    <div class="col-md-9">
                        : <?php echo $data['nama_lokasi'] ?>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <label class="col-md-3 control-label">Latitude</label>
                    <div class="col-md-9">
                        : <?php echo $data['lat'] ?>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <label class="col-md-3 control-label">Longitude</label>
                    <div class="col-md-9">
                        : <?php echo $data['lng'] ?>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <label class="col-md-3 control-label">Alamat</label>
                    <div class="col-md-9">
                        : <?php echo $data['alamat'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-9">
                        <a type="button" class="btn btn-md btn-white m-b-10" href="index.php?page=form-view-lokasi"><i class="fa fa-step-backward"></i>&nbsp;Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
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