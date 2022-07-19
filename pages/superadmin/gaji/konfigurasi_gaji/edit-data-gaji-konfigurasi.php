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
        $gaji_diterima      = str_replace(",", "", $_POST['gaji_diterima']);
        $gaji_pokok         = str_replace(",", "", $_POST['gaji_pokok']);
        $tunjangan_tetap    = str_replace(",", "", $_POST['tunjangan_tetap']);
        $struktural         = str_replace(",", "", $_POST['struktural']);
        $pendidikan         = str_replace(",", "", $_POST['pendidikan']);
        $keahlian           = str_replace(",", "", $_POST['keahlian']);
        $penyesuaian        = str_replace(",", "", $_POST['penyesuaian']);
        $tunjangan_variabel = str_replace(",", "", $_POST['tunjangan_variabel']);
        $presensi           = str_replace(",", "", $_POST['presensi']);
        $uang_makan         = str_replace(",", "", $_POST['uang_makan']);
        $kehadiran          = str_replace(",", "", $_POST['kehadiran']);
        $kedisiplinan       = str_replace(",", "", $_POST['kedisiplinan']);
        $istri_suami        = str_replace(",", "", $_POST['istri_suami']);
        $anak               = str_replace(",", "", $_POST['anak']);
        $presensi_pot       = str_replace(",", "", $_POST['presensi_pot']);
        $uang_makan_pot     = str_replace(",", "", $_POST['uang_makan_pot']);
        $kehadiran_pot      = str_replace(",", "", $_POST['kehadiran_pot']);
        $kedisiplinan_pot   = str_replace(",", "", $_POST['kedisiplinan_pot']);
        $jumlah_pot_var     = str_replace(",", "", $_POST['jumlah_pot_var']);
        $bpjs               = str_replace(",", "", $_POST['bpjs']);
        $koperasi           = str_replace(",", "", $_POST['koperasi']);
        $dapen_muh          = str_replace(",", "", $_POST['dapen_muh']);
        $lainya             = str_replace(",", "", $_POST['lainya']);
        $jumlah_pot_wajib   = str_replace(",", "", $_POST['jumlah_pot_wajib']);

        if (empty($_POST['bulan']) || empty($_POST['tahun']) || empty($_POST['tanggal_gaji_konfig'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-edit-data-gaji-konfigurasi&id_gaji_konfig=$id_gaji_konfig");
        } else if ($_POST['gaji_diterima'] == 0) {
            $_SESSION['pesan'] = "Oops! Jumlah Gaji Diterima belum dihitung ...";
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