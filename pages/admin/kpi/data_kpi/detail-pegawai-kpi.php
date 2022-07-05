<?php
if (isset($_GET['id_kategori'])) {
    $id_kategori = $_GET['id_kategori'];
} else {
    die("Error. No ID Selected! ");
}
include "../../config/koneksi.php";
$query    = mysqli_query($koneksi, "SELECT * FROM tb_kpi WHERE id_kategori='$id_kategori'");
$data    = mysqli_fetch_array($query);

$tampilBobot    = mysqli_query($koneksi, "SELECT SUM(bobot) AS total_bobot FROM tb_kpi WHERE id_kategori='$id_kategori'");
$total_bobot    = mysqli_fetch_assoc($tampilBobot);

$tampilNilai    = mysqli_query($koneksi, "SELECT SUM(nilai) AS total_nilai FROM tb_kpi WHERE id_kategori='$id_kategori'");
$total_nilai    = mysqli_fetch_assoc($tampilNilai);

// $hasilNilai    = mysqli_query($koneksi, "SELECT (score / target_kpi * bobot) AS hasil_nilai FROM tb_kpi WHERE id_data_kpi=$data[id_data_kpi]");
// $hasil_nilai    = mysqli_fetch_assoc($hasilNilai);

$tampilPeg   = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$data[id_peg]'");
$peg    = mysqli_fetch_array($tampilPeg);

$tampilJab   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$data[id_peg]'");
$jab    = mysqli_fetch_array($tampilJab);
?>
<!-- begin page-header -->
<h1 class="page-header">Detail <small>KPI</small></h1>
<!-- end page-header -->
<div class="invoice">
    <div class="invoice-company">
        <span class="pull-right hidden-print">
            <a href="index.php?page=detail-data-pegawai&pegawai_id=<?= $data['id_peg'] ?>" title="back" class="btn btn-sm btn-white m-b-10"><i class="fa fa-step-backward"></i> &nbsp;Back</a>
            <a href="index.php?page=form-edit-kpi&id_kategori=<?= $id_kategori ?>" title="edit" class="btn btn-sm btn-success m-b-10"><i class="fa fa-edit fa-lg m-r-5"></i> Edit</a>
        </span>
        Key Performance Indicator
    </div>
    <div class="invoice-header">
        <div class="invoice-from">
            <strong><?= $peg['pegawai_nama'] ?></strong><br />
            NIP: <?= $peg == 0 ? '-' : $peg['pegawai_nip']; ?>
        </div>
        <div class="invoice-to">
            <strong>Divisi</strong>
            <address class="m-t-5 m-b-5">
                Divisi : <?= $data['divisi'] ?>
            </address>
        </div>
        <div class="invoice-date">
            <strong>Periode</strong>
            <div class="invoice-detail">
                <?= $data['bulan'] ?> &nbsp; <b>-</b> &nbsp; <?= $data['tahun'] ?>
            </div>
        </div>
    </div>
    <div class="invoice-content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="1%">No.</th>
                        <th width="25%">Sasaran Kerja</th>
                        <th width="15%">Satuan KPI</th>
                        <th>Target KPI</th>
                        <th>Bobot</th>
                        <th>Score</th>
                        <th>Nilai</th>
                        <th width="15%">Dokumen</th>
                        <th width="15%">Kendala</th </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    $query2   = mysqli_query($koneksi, "SELECT * FROM tb_kpi WHERE id_kategori='$id_kategori'");
                    while ($kpi2 = mysqli_fetch_array($query2)) {
                        $no++
                    ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $kpi2['sasaran_kerja']; ?></td>
                            <td><?php echo $kpi2['satuan_kpi']; ?></td>
                            <td><?php echo $kpi2['target_kpi']; ?></td>
                            <td><?php echo $kpi2['bobot']; ?></td>
                            <td><?php echo $kpi2['score']; ?></td>
                            <td><?php echo $kpi2['nilai']; ?></td>
                            <td><?php echo $kpi2['dokumen']; ?></td>
                            <td><?php echo $kpi2['kendala']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Total Bobot</th>
                        <th><?= $total_bobot['total_bobot'] ?></th>
                        <th>Total Nilai</th>
                        <th><?= $total_nilai['total_nilai'] ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
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