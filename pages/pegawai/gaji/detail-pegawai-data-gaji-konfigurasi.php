<?php

if (isset($_GET['id_gaji_konfig'])) {
    $id_gaji_konfig = $_GET['id_gaji_konfig'];

    include "../../config/koneksi.php";
    $query   = mysqli_query($koneksi, "SELECT * FROM tb_gaji_konfigurasi WHERE id_gaji_konfig='$id_gaji_konfig'");
    $gaji    = mysqli_fetch_array($query);

    $tampilPeg   = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE pegawai_id='$gaji[id_peg]'");
    $peg    = mysqli_fetch_array($tampilPeg);

    $tampilJab   = mysqli_query($koneksi, "SELECT * FROM tb_jabatan WHERE id_peg='$gaji[id_peg]'");
    $jab    = mysqli_fetch_array($tampilJab);
} else {
    die("Error. No ID Selected!");
}

?>
<!-- begin page-header -->
<h1 class="page-header">Gaji <small>Slip Gaji</small></h1>
<!-- end page-header -->
<div class="invoice">
    <div class="invoice-company">
        <span class="pull-right hidden-print">
            <a href="index.php?page=detail-data-pegawai&id_peg=<?= $gaji['id_peg'] ?>" title="back" class="btn btn-sm btn-white m-b-10"><i class="fa fa-step-backward"></i> &nbsp;Back</a>
            <a href="../../pages/superadmin/gaji/konfigurasi_gaji/print-detail-konfigurasi-slip-gaji.php" target="_blank" title="print" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print"></i> &nbsp;Print</a>
        </span>
        PT Gramasurya
    </div>
    <div class="invoice-header">
        <div class="invoice-from">
            <strong><?php echo $peg['pegawai_nama'] ?></strong><br />
            NIP: <?= $peg == 0 ? '-' : $peg['pegawai_nip']; ?>
        </div>
        <div class="invoice-to">
            <strong>Jabatan</strong>
            <address class="m-t-5 m-b-5">
                <?= $jab == 0 ? '-' : $jab['jabatan']; ?><br />
            </address>
        </div>
        <div class="invoice-date">
            <strong>Periode</strong>
            <div class="invoice-detail">
                <?php echo $gaji['bulan'] ?><b> - </b><?php echo $gaji['tahun'] ?>
            </div>
        </div>
    </div>
    <div class="invoice-content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tfoot>
                    <tr>
                        <th width="70%">Gaji Pokok</th>
                        <th width="30%"><?php echo 'Rp. ' . number_format($gaji['gaji_pokok']); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10%">No #</th>
                        <th width="60%">Tunjangan Tetap</th>
                        <th width="30%">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Struktural</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['struktural']); ?></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Pendidikan</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['pendidikan']); ?></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Keahlian</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['keahlian']); ?></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Penyesuaian</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['penyesuaian']); ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Nilai Total Tunjangan Tetap</th>
                        <th><?php echo 'Rp. ' . number_format($gaji['tunjangan_tetap']); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10%">No #</th>
                        <th width="60%">Tunjangan Variabel</th>
                        <th width="30%">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Presensi</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['presensi']); ?></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Uang Makan</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['uang_makan']); ?></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Kehadiran</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['kehadiran']); ?></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Kedisiplinan</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['kedisiplinan']); ?></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Keluarga Istri/Suami</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['istri_suami']); ?></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Anak</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['anak']); ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Nilai Total Tunjangan Variabel</th>
                        <th><?php echo 'Rp. ' . number_format($gaji['tunjangan_variabel']); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10%">No #</th>
                        <th width="60%">Potongan Variabel</th>
                        <th width="30%">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Presensi</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['presensi_pot']); ?></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Uang Makan</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['uang_makan_pot']); ?></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Kehadiran</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['kehadiran_pot']); ?></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Kedisiplinan</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['kedisiplinan_pot']); ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Nilai Total Potongan Variabel</th>
                        <th><?php echo 'Rp. ' . number_format($gaji['jumlah_pot_var']); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10%">No #</th>
                        <th width="60%">Potongan Wajib</th>
                        <th width="30%">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>BPJS</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['bpjs']); ?></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Koperasi</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['koperasi']); ?></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Dapen Muh</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['dapen_muh']); ?></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Lainya</td>
                        <td><?php echo 'Rp. ' . number_format($gaji['lainya']); ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Nilai Total Potongan Wajib</th>
                        <th><?php echo 'Rp. ' . number_format($gaji['jumlah_pot_wajib']); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="invoice-price">
            <div class="invoice-price-left">
                <div class="invoice-price-row">
                    <div class="sub-price">
                        <small>GAJI POKOK</small>
                        <?php echo 'Rp. ' . number_format($gaji['gaji_pokok']); ?>
                    </div>
                    <div class="sub-price">
                        <i class="fa fa-plus"></i>
                    </div>
                    <div class="sub-price">
                        <small>TUNJANGAN TETAP</small>
                        <?php echo 'Rp. ' . number_format($gaji['tunjangan_tetap']); ?>
                    </div>
                    <div class="sub-price">
                        <i class="fa fa-plus"></i>
                    </div>
                    <div class="sub-price">
                        <small>TUNJANGAN VARIABEL</small>
                        <?php echo 'Rp. ' . number_format($gaji['tunjangan_variabel']); ?>
                    </div>
                    <div class="sub-price">
                        <i class="fa fa-minus"></i>
                    </div>
                    <div class="sub-price">
                        <small>POTONGAN VARIABEL</small>
                        <?php echo 'Rp. ' . number_format($gaji['jumlah_pot_var']); ?>
                    </div>
                    <div class="sub-price">
                        <i class="fa fa-plus"></i>
                    </div>
                    <div class="sub-price">
                        <small>POTONGAN WAJIB</small>
                        <?php echo 'Rp. ' . number_format($gaji['jumlah_pot_wajib']); ?>
                    </div>
                </div>
            </div>
            <div class="invoice-price-right">
                <small>TOTAL</small> <?php echo 'Rp. ' . number_format($gaji['gaji_diterima']); ?>
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