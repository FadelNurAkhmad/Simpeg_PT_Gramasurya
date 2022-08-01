<div class="row">
    <?php
    ob_start();
    if (isset($_GET['pegawai_id'])) {
        $id_peg = $_GET['pegawai_id'];
    } else {
        die("Error. No ID Selected! ");
    }

    if ($_POST['save'] == "save") {
        $dokumen        = $_POST['dokumen'];
        $file            = $_FILES['file']['name'];
        $ekstensi       = array('pdf');
        $ext            = pathinfo($file, PATHINFO_EXTENSION);
        $ukuran        = $_FILES['file']['size'];

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
        $id_dokumen        = kdauto("tb_dokumen", "");

        if (empty($_POST['dokumen'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
        } else {
            if (!in_array($ext, $ekstensi)) {
                $_SESSION['pesan'] = "Oops! File extensions not available. Only PDF ...";
                header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
            } else {
                if ($ukuran > 5000000 === false) {

                    $insert = "INSERT INTO tb_dokumen (id_dokumen, id_peg, dokumen, file) VALUES ('$id_dokumen', '$id_peg', '$dokumen', '$file')";
                    $query = mysqli_query($koneksi, $insert);

                    if ($query) {
                        $_SESSION['pesan'] = "Good! Insert data dokumen success ...";
                        header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
                    } else {
                        echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
                    }
                    if (strlen($file) > 0) {
                        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                            move_uploaded_file($_FILES['file']['tmp_name'], "../../assets/file/" . $file);
                        }
                    }
                } else {
                    $_SESSION['pesan'] = "Oops! Ukuran File Terlalu Besar ...";
                    header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
                }
            }
        }
    }

    ?>
</div>