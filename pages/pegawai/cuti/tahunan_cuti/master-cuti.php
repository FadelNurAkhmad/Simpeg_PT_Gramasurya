<div class="row">
    <?php
    ob_start();
    if (isset($_GET['id_peg'])) {
        $id_peg = $_GET['id_peg'];
    } else {
        die("Error. No ID Selected! ");
    }

    if ($_POST['save'] == "save") {
        $tanggal_cuti  = $_POST['tanggal_cuti'];
        $tanggal_mulai = $_POST['tanggal_mulai'];
        $tanggal_selesai = $_POST['tanggal_selesai'];
        $lama_cuti   = $_POST['lama_cuti'];
        $jumlah_cuti   = $_POST['jumlah_cuti'];
        $jenis_cuti    = $_POST['jenis_cuti'];
        $keperluan     = $_POST['keperluan'];
        $status        = $_POST['status'];

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
        $id_cuti       = kdauto("tb_cuti_tahunan", "");

        $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_cuti_tahunan WHERE tanggal_cuti='$_POST[tanggal_cuti]' AND id_peg='$_POST[id_peg]'"));

        if (empty($_POST['tanggal_cuti']) || empty($_POST['tanggal_mulai']) || empty($_POST['tanggal_selesai']) || empty($_POST['lama_cuti']) || empty($_POST['jumlah_cuti']) || empty($_POST['jenis_cuti']) || empty($_POST['keperluan']) || empty($_POST['status'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-master-cuti");
        } else if ($cek > 0) {
            $_SESSION['pesan'] = "Oops! Duplikat data ...";
            header("location:index.php?page=form-master-cuti");
        } else {
            $insert = mysqli_query($koneksi, "INSERT INTO tb_cuti_tahunan (id_cuti, id_peg, tanggal_cuti, tanggal_mulai, tanggal_selesai, lama_cuti, jumlah_cuti, jenis_cuti, keperluan, status) 
            VALUES ('$id_cuti', '$id_peg', '$tanggal_cuti', '$tanggal_mulai', '$tanggal_selesai', '$lama_cuti', '$jumlah_cuti', '$jenis_cuti', '$keperluan', '$status')");

            $approval = mysqli_query($koneksi, "INSERT INTO tb_approval_cuti_tahunan (id_approval_cuti, id_peg, tanggal_cuti, tanggal_mulai, tanggal_selesai, lama_cuti, jumlah_cuti, jenis_cuti, keperluan, status) 
            VALUES ('$id_cuti', '$id_peg', '$tanggal_cuti', '$tanggal_mulai', '$tanggal_selesai', '$lama_cuti', '$jumlah_cuti', '$jenis_cuti', '$keperluan', '$status')");

            if ($query && $approval) {
                $_SESSION['pesan'] = "Good! Insert data cuti success ...";
                header("location:index.php?page=form-master-cuti");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>