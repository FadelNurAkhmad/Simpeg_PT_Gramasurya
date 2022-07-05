<div class="row">
    <?php
    // if (isset($_GET['id_data_kpi'])) {
    //     $id_data_kpi = $_GET['id_data_kpi'];
    // } else {
    //     die("Error. No ID Selected! ");
    // }

    include "../../config/koneksi.php";

    if ($_POST['save'] == "save") {
        $id_peg         = $_POST['id_peg'];
        $divisi         = $_POST['divisi'];
        $tanggal_kpi    = $_POST['tanggal_kpi'];
        $bulan          = $_POST['bulan'];
        $tahun          = $_POST['tahun'];
        $sasaran_kerja  = $_POST['sasaran_kerja'];
        $satuan_kpi     = $_POST['satuan_kpi'];
        $target_kpi     = $_POST['target_kpi'];
        $bobot          = $_POST['bobot'];
        $score          = $_POST['score'];
        $nilai          = $_POST['nilai'];
        $dokumen        = $_POST['dokumen'];
        $kendala        = $_POST['kendala'];
        $rand           = rand(1, 7000);

        // $hasilNilai = ($score / $target_kpi) * $bobot;

        $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_kpi WHERE tanggal_kpi='$_POST[tanggal_kpi]' AND id_peg='$_POST[id_peg]'"));

        if (empty($_POST['sasaran_kerja']) || empty($_POST['id_peg']) || empty($_POST['divisi']) || empty($_POST['tanggal_kpi']) || empty($_POST['bulan']) || empty($_POST['tahun'])) {
            $_SESSION['pesan'] = "Oops! Kolom ada yang belum diisi ...";
            header("location:index.php?page=form-master-kpi");
        } else if ($cek > 0) {
            $_SESSION['pesan'] = "Oops! Duplikat KPI Pegawai ...";
            header("location:index.php?page=form-master-kpi");
        } else {
            for ($i = 0; $i < sizeof($sasaran_kerja); $i++) {
                $query = mysqli_query($koneksi, "INSERT INTO tb_kpi (id_peg, id_kategori, divisi, tanggal_kpi, bulan, tahun, sasaran_kerja, satuan_kpi, target_kpi, bobot, score, nilai, dokumen, kendala)
                                        VALUES ('$id_peg', '$rand', '$divisi', '$tanggal_kpi', 
                                                '$bulan', '$tahun', '$sasaran_kerja[$i]', 
                                                '$satuan_kpi[$i]', '$target_kpi[$i]', 
                                                '$bobot[$i]', '$score[$i]', '$nilai[$i]', 
                                                '$dokumen[$i]', '$kendala[$i]' )");
            }
            if ($query) {
                $_SESSION['pesan'] = "Good! Insert data success ...";
                header("location:index.php?page=form-view-kpi");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>