<div class="row">
    <?php
    if ($_POST['save'] == "save") {
        $pembagian2_nama    = $_POST['pembagian2_nama'];

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
        $pembagian2_id        = kdauto("pembagian2", "");

        $cekname    = mysqli_num_rows(mysqli_query($koneksi, "SELECT pembagian2_nama FROM pembagian2 WHERE pembagian2_nama='$_POST[pembagian2_nama]'"));

        if (empty($_POST['pembagian2_nama'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-master-data-jabatan");
        } else if ($cekname > 0) {
            $_SESSION['pesan'] = "Oops! Duplikat data ...";
            header("location:index.php?page=form-master-data-jabatan");
        } else {
            $insert = "INSERT INTO pembagian2 (pembagian2_id, pembagian2_nama) VALUES ('$pembagian2_id', '$pembagian2_nama')";
            $query = mysqli_query($koneksi, $insert);

            if ($query) {
                $_SESSION['pesan'] = "Good! Insert master nama unit success ...";
                header("location:index.php?page=form-master-data-jabatan");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>