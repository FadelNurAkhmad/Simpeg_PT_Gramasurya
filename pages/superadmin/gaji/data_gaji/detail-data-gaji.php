<?php
// if (isset($_GET['id_skp'])) {
//     $id_skp = $_GET['id_skp'];
// } else {
//     die("Error. No ID Selected! ");
// }
// include "../../config/koneksi.php";
// $query    = mysql_query("SELECT * FROM tb_skp WHERE id_skp='$id_skp'");
// $data    = mysql_fetch_array($query);
// $orientasi        = $data['nilai_orientasi'];
// $integritas        = $data['nilai_integritas'];
// $komitmen        = $data['nilai_komitmen'];
// $disiplin        = $data['nilai_disiplin'];
// $kerjasama        = $data['nilai_kerjasama'];
// $kepemimpinan    = $data['nilai_kepemimpinan'];
// $jml_nilai    = $orientasi + $integritas + $komitmen + $disiplin + $kerjasama + $kepemimpinan;
// $rata        = $jml_nilai / 6;

// $tampilPeg   = mysql_query("SELECT * FROM tb_pegawai WHERE id_peg='$data[id_peg]'");
// $peg    = mysql_fetch_array($tampilPeg);
?>
<!-- begin page-header -->
<h1 class="page-header">Gaji <small>Slip Gaji</small></h1>
<!-- end page-header -->
<div class="invoice">
    <div class="invoice-company">
        <span class="pull-right hidden-print">
            <a href="index.php?page=form-view-data-gaji" title="back" class="btn btn-sm btn-white m-b-10"><i class="fa fa-step-backward"></i> &nbsp;Back</a>
            <!-- <a href="../../pages/superadmin/report/print-data-slip-gaji.php" target="_blank" title="print" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a> -->
            <a href="../../pages/superadmin/gaji/data_gaji/print-detail-data-slip-gaji.php" target="_blank" title="print" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a>
        </span>
        PT Gramasurya
    </div>
    <div class="invoice-header">
        <div class="invoice-from">
            <strong>Parjo Raharjo</strong><br />
            NIP: 1900018237
        </div>
        <div class="invoice-to">
            <strong>No. Slip</strong>
            <address class="m-t-5 m-b-5">
                202201021900018237<br />
            </address>
        </div>
        <div class="invoice-date">
            <strong>Periode</strong>
            <div class="invoice-detail">
                2022-01-02 &nbsp; <b>s/d</b> &nbsp; 2022-12-03
            </div>
        </div>
    </div>
    <div class="invoice-content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10%">No #</th>
                        <th width="70%">Deskripsi</th>
                        <th width="20%">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Gaji Pokok</td>
                        <td>Rp. 4,000,000</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Tunjangan</td>
                        <td>Rp. 2,000,000</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Bonus</td>
                        <td>Rp. 0</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Potongan</td>
                        <td>Rp. 550,000</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Nilai Total</th>
                        <th>Rp. 6,500,000</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="invoice-price">
            <div class="invoice-price-left">
                <div class="invoice-price-row">
                    <div class="sub-price">
                        <small>GAJI POKOK</small>
                        Rp. 4,000,000
                    </div>
                    <div class="sub-price">
                        <i class="fa fa-plus"></i>
                    </div>
                    <div class="sub-price">
                        <small>TUNJANGAN</small>
                        Rp. 2,000,000
                    </div>
                    <div class="sub-price">
                        <i class="fa fa-plus"></i>
                    </div>
                    <div class="sub-price">
                        <small>BONUS</small>
                        Rp. 0
                    </div>
                    <div class="sub-price">
                        <i class="fa fa-minus"></i>
                    </div>
                    <div class="sub-price">
                        <small>POTONGAN</small>
                        Rp. 550,000
                    </div>
                </div>
            </div>
            <div class="invoice-price-right">
                <small>TOTAL</small> Rp. 6,500,000
            </div>
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