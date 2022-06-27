<div class="row">
    <?php
    if (isset($_GET['id_jatah'])) {
        $id_jatah = $_GET['id_jatah'];
    } else {
        die("Error. No ID Selected! ");
    }

    if ($_POST['save'] == "save") {
        $id_peg         = $_POST['id_peg'];
        $jatah_c_mulai  = $_POST['jatah_c_mulai'];
        $jatah_c_akhir  = $_POST['jatah_c_akhir'];
        $jatah_c_jml    = $_POST['jatah_c_jml'];
        $jatah_c_sisa   = $_POST['jatah_c_sisa'];

        include "../../config/koneksi.php";

        $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_jatah_cuti WHERE id_peg='$_POST[id_peg]'"));

        if (empty($_POST['id_peg']) || empty($_POST['jatah_c_mulai']) || empty($_POST['jatah_c_akhir'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-master-jatah-cuti");
        } else if ($cek > 0) {
            $_SESSION['pesan'] = "Oops! Duplikat data ...";
            header("location:index.php?page=form-master-jatah-cuti");
        } else {
            $insert = "INSERT INTO tb_jatah_cuti (id_jatah, id_peg, jatah_c_mulai, jatah_c_akhir, jatah_c_jml, jatah_c_sisa) 
            VALUES ('$id_jatah', '$id_peg', '$jatah_c_mulai', '$jatah_c_akhir', '$jatah_c_jml', '$jatah_c_sisa')";
            $query = mysqli_query($koneksi, $insert) or die(mysqli_error($koneksi));

            if ($query) {
                $_SESSION['pesan'] = "Good! Insert data jatah cuti success ...";
                header("location:index.php?page=form-view-jatah-cuti");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>