<div class="row">
    <?php
    if (isset($_GET['id_jabatan'])) {
        $id_jabatan = $_GET['id_jabatan'];
    } else {
        die("Error. No ID Selected! ");
    }

    if ($_POST['save'] == "save") {
        $nama_jabatan        = $_POST['nama_jabatan'];
        $gapok        = $_POST['gapok'];
        $tunjangan        = $_POST['tunjangan'];

        include "../../config/koneksi.php";

        if (empty($_POST['nama_jabatan']) || empty($_POST['gapok']) || empty($_POST['tunjangan'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-master-data-gaji-jabatan");
        } else {
            $insert = "INSERT INTO tb_gaji_jabatan (id_jabatan, nama_jabatan, gapok, tunjangan) VALUES ('$id_jabatan','$nama_jabatan', '$gapok', '$tunjangan')";
            $query = mysql_query($insert);

            if ($query) {
                $_SESSION['pesan'] = "Good! Insert data gaji jabatan success ...";
                header("location:index.php?page=form-master-data-gaji-jabatan");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>