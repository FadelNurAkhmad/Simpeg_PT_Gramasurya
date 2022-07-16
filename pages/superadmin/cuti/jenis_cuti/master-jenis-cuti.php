<div class="row">
    <?php
    if (isset($_GET['id_jenis'])) {
        $id_jenis = $_GET['id_jenis'];
    } else {
        die("Error. No ID Selected! ");
    }

    if ($_POST['save'] == "save") {
        $jenis    = $_POST['jenis'];

        include "../../config/koneksi.php";
        $ceknm    = mysqli_num_rows(mysqli_query($koneksi, "SELECT jenis FROM tb_jenis_cuti WHERE jenis='$_POST[jenis]'"));

        if (empty($_POST['jenis'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-master-jenis-cuti");
        } else if ($ceknm > 0) {
            $_SESSION['pesan'] = "Oops! Duplikat data ...";
            header("location:index.php?page=form-master-jenis-cuti");
        } else {
            $insert = "INSERT INTO tb_jenis_cuti (id_jenis, jenis) VALUES ('$id_jenis', '$jenis')";
            $query = mysqli_query($koneksi, $insert);

            if ($query) {
                $_SESSION['pesan'] = "Good! Insert Jenis Izin success ...";
                header("location:index.php?page=form-view-jenis-cuti");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>