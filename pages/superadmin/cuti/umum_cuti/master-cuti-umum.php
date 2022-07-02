<div class="row">
    <?php
    if (isset($_GET['id_cuti_umum'])) {
        $id_cuti_umum = $_GET['id_cuti_umum'];
    } else {
        die("Error. No ID Selected! ");
    }

    if ($_POST['save'] == "save") {
        $id_peg        = $_POST['id_peg'];
        $tanggal_cuti  = $_POST['tanggal_cuti'];
        $tanggal_mulai = $_POST['tanggal_mulai'];
        $tanggal_selesai = $_POST['tanggal_selesai'];
        $lama_cuti   = $_POST['lama_cuti'];
        $jumlah_cuti   = $_POST['jumlah_cuti'];
        $jenis_cuti    = $_POST['jenis_cuti'];
        $keperluan     = $_POST['keperluan'];
        $status        = $_POST['status'];

        include "../../config/koneksi.php";

        $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_cuti_umum WHERE tanggal_cuti='$_POST[tanggal_cuti]' AND id_peg='$_POST[id_peg]'"));

        if (empty($_POST['id_peg']) || empty($_POST['tanggal_cuti']) || empty($_POST['tanggal_mulai']) || empty($_POST['tanggal_selesai']) || empty($_POST['lama_cuti']) || empty($_POST['jumlah_cuti']) || empty($_POST['jenis_cuti']) || empty($_POST['keperluan']) || empty($_POST['status'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-master-cuti-umum");
        } else if ($cek > 0) {
            $_SESSION['pesan'] = "Oops! Duplikat data ...";
            header("location:index.php?page=form-master-cuti-umum");
        } else {
            $insert = "INSERT INTO tb_cuti_umum (id_cuti_umum, id_peg, tanggal_cuti, tanggal_mulai, tanggal_selesai, lama_cuti, jumlah_cuti, jenis_cuti, keperluan, status) 
            VALUES ('$id_cuti_umum', '$id_peg', '$tanggal_cuti', '$tanggal_mulai', '$tanggal_selesai', '$lama_cuti', '$jumlah_cuti', '$jenis_cuti', '$keperluan', '$status')";
            $query = mysqli_query($koneksi, $insert) or die(mysqli_error($koneksi));

            if ($query) {
                $_SESSION['pesan'] = "Good! Insert data cuti success ...";
                header("location:index.php?page=form-view-cuti-umum");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>