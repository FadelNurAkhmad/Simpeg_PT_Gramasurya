<div class="row">
    <?php
    if (isset($_GET['id_gaji_konfig'])) {
        $id_gaji_konfig = $_GET['id_gaji_konfig'];
    } else {
        die("Error. No Kode Selected! ");
    }
    include "../../config/koneksi.php";
    $tampilGaji   = mysqli_query($koneksi, "SELECT * FROM tb_gaji_konfigurasi WHERE id_gaji_konfig='$id_gaji_konfig'");
    $hasil    = mysqli_fetch_array($tampilGaji);

    if ($_POST['edit'] == "edit") {
        $bulan              = $_POST['bulan'];
        $tahun              = $_POST['tahun'];
        $tanggal_gaji_konfig = $_POST['tanggal_gaji_konfig'];
        $gaji_diterima      = $_POST['gaji_diterima'];
        $gaji_pokok         = $_POST['gaji_pokok'];
        $tunjangan_tetap    = $_POST['tunjangan_tetap'];
        $struktural         = $_POST['struktural'];
        $pendidikan         = $_POST['pendidikan'];
        $keahlian           = $_POST['keahlian'];
        $penyesuaian        = $_POST['penyesuaian'];
        $tunjangan_variabel = $_POST['tunjangan_variabel'];
        $presensi           = $_POST['presensi'];
        $uang_makan         = $_POST['uang_makan'];
        $kehadiran          = $_POST['kehadiran'];
        $kedisiplinan       = $_POST['kedisiplinan'];
        $istri_suami        = $_POST['istri_suami'];
        $anak               = $_POST['anak'];
        $presensi_pot       = $_POST['presensi_pot'];
        $uang_makan_pot     = $_POST['uang_makan_pot'];
        $kehadiran_pot      = $_POST['kehadiran_pot'];
        $kedisiplinan_pot   = $_POST['kedisiplinan_pot'];
        $jumlah_pot_var     = $_POST['jumlah_pot_var'];
        $bpjs               = $_POST['bpjs'];
        $koperasi           = $_POST['koperasi'];
        $dapen_muh          = $_POST['dapen_muh'];
        $lainya             = $_POST['lainya'];
        $jumlah_pot_wajib   = $_POST['jumlah_pot_wajib'];

        if (empty($_POST['bulan']) || empty($_POST['tahun']) || empty($_POST['tanggal_gaji_konfig'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-edit-data-gaji-konfigurasi&id_gaji_konfig=$id_gaji_konfig");
        } else {
            $update = mysqli_query($koneksi, "UPDATE tb_gaji_konfigurasi 
                                            SET bulan='$bulan', 
                                                tahun='$tahun', 
                                                tanggal_gaji_konfig='$tanggal_gaji_konfig', 
                                                gaji_diterima='$gaji_diterima', 
                                                gaji_pokok='$gaji_pokok', 
                                                tunjangan_tetap='$tunjangan_tetap', 
                                                struktural='$struktural', 
                                                pendidikan='$pendidikan', 
                                                keahlian='$keahlian', 
                                                penyesuaian='$penyesuaian', 
                                                tunjangan_variabel='$tunjangan_variabel', 
                                                presensi='$presensi', 
                                                uang_makan='$uang_makan', 
                                                kehadiran='$kehadiran', 
                                                kedisiplinan='$kedisiplinan', 
                                                istri_suami='$istri_suami', 
                                                anak='$anak', 
                                                presensi_pot='$presensi_pot', 
                                                uang_makan_pot='$uang_makan_pot', 
                                                kehadiran_pot='$kehadiran_pot', 
                                                kedisiplinan_pot='$kedisiplinan_pot', 
                                                jumlah_pot_var='$jumlah_pot_var', 
                                                bpjs='$bpjs', 
                                                koperasi='$koperasi', 
                                                dapen_muh='$dapen_muh', 
                                                lainya='$lainya', 
                                                jumlah_pot_wajib='$jumlah_pot_wajib' 
                                            WHERE id_gaji_konfig='$id_gaji_konfig'");
            if ($update) {
                $_SESSION['pesan'] = "Good! edit data gaji konfigurasi success ...";
                header("location:index.php?page=form-view-data-gaji-konfigurasi");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>