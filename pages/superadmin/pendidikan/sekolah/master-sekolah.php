<div class="row">
    <?php
    if (isset($_GET['pegawai_id'])) {
        $id_peg = $_GET['pegawai_id'];
    } else {
        die("Error. No ID Selected! ");
    }

    if ($_POST['save'] == "save") {
        $tingkat        = $_POST['tingkat'];
        $nama_sekolah    = $_POST['nama_sekolah'];
        $lokasi            = $_POST['lokasi'];
        $jurusan        = $_POST['jurusan'];
        $no_ijazah        = $_POST['no_ijazah'];
        $tgl_ijazah        = $_POST['tgl_ijazah'];
        $kepala            = $_POST['kepala'];

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
        $id_sekolah    = kdauto("tb_sekolah", "");

        include "../../config/koneksi.php";

        if (empty($id_peg) || empty($_POST['tingkat']) || empty($_POST['nama_sekolah']) || empty($_POST['lokasi']) || empty($_POST['no_ijazah']) || empty($_POST['tgl_ijazah']) || empty($_POST['kepala'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
        } else {
            $insert = "INSERT INTO tb_sekolah (id_sekolah, id_peg, tingkat, nama_sekolah, lokasi, jurusan, no_ijazah, tgl_ijazah, kepala) VALUES ('$id_sekolah', '$id_peg', '$tingkat', '$nama_sekolah', '$lokasi', '$jurusan', '$no_ijazah', '$tgl_ijazah', '$kepala')";
            $query = mysqli_query($koneksi, $insert);

            if ($query) {
                $_SESSION['pesan'] = "Good! Insert data sekolah success ...";
                header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>