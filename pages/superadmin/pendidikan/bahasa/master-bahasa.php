<div class="row">
    <?php
    if (isset($_GET['pegawai_id'])) {
        $id_peg = $_GET['pegawai_id'];
    } else {
        die("Error. No ID Selected! ");
    }

    if ($_POST['save'] == "save") {
        $jns_bhs    = $_POST['jns_bhs'];
        $bahasa        = $_POST['bahasa'];
        $kemampuan    = $_POST['kemampuan'];

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
        $id_bhs        = kdauto("tb_bahasa", "");

        include "../../config/koneksi.php";

        if (empty($id_peg) || empty($_POST['jns_bhs']) || empty($_POST['bahasa']) || empty($_POST['kemampuan'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
        } else {
            $insert = "INSERT INTO tb_bahasa (id_bhs, id_peg, jns_bhs, bahasa, kemampuan) VALUES ('$id_bhs', '$id_peg', '$jns_bhs', '$bahasa', '$kemampuan')";
            $query = mysqli_query($koneksi, $insert);
            if ($query) {
                $_SESSION['pesan'] = "Good! Insert data bahasa success ...";
                header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>