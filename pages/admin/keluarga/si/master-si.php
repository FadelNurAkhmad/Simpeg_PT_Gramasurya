<div class="row">
    <?php
    ob_start();
    if (isset($_GET['pegawai_id'])) {
        $id_peg = $_GET['pegawai_id'];
    } else {
        die("Error. No ID Selected! ");
    }


    if ($_POST['save'] == "save") {
        $nik            = $_POST['nik'];
        $nama            = $_POST['nama'];
        $tmp_lhr        = $_POST['tmp_lhr'];
        $tgl_lhr        = $_POST['tgl_lhr'];
        $pendidikan        = $_POST['pendidikan'];
        $pekerjaan        = $_POST['pekerjaan'];
        $status_hub        = $_POST['status_hub'];

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
        $id_suamiistri        = kdauto("tb_suamiistri", "");

        $date_reg    = date("Ymd");

        include "../../config/koneksi.php";
        $ceknik    = mysqli_num_rows(mysqli_query($koneksi, "SELECT nik FROM tb_suamiistri WHERE nik='$_POST[nik]'"));
        $ceksi    = mysqli_num_rows(mysqli_query($koneksi, "SELECT status_hub FROM tb_suamiistri WHERE id_peg='$_POST[id_peg]' AND (status_hub='Suami' OR status_hub='Istri')"));

        if (empty($id_peg) || empty($_POST['nik']) || empty($_POST['nama']) || empty($_POST['tmp_lhr']) || empty($_POST['tgl_lhr']) || empty($_POST['pendidikan']) || empty($_POST['pekerjaan']) || empty($_POST['status_hub'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
        } else if ($ceknik > 0 || $ceksi > 0) {
            $_SESSION['pesan'] = "Oops! Duplikat data ...";
            header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
        } else {
            $insert = "INSERT INTO tb_suamiistri (id_si, id_peg, nik, nama, tmp_lhr, tgl_lhr, pendidikan, pekerjaan, status_hub, date_reg) VALUES ('$id_suamiistri', '$id_peg', '$nik', '$nama', '$tmp_lhr', '$tgl_lhr', '$pendidikan', '$pekerjaan', '$status_hub', '$date_reg')";
            $query = mysqli_query($koneksi, $insert);

            if ($query) {
                $_SESSION['pesan'] = "Good! Insert data suami / istri success ...";
                header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>