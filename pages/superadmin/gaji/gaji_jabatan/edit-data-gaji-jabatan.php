<div class="row">
    <?php
    if (isset($_GET['id_jabatan'])) {
        $id_jabatan = $_GET['id_jabatan'];
    } else {
        die("Error. No Kode Selected! ");
    }
    include "../../config/koneksi.php";
    $tampilGajiJab   = mysqli_query($koneksi, "SELECT * FROM tb_gaji_jabatan WHERE id_jabatan='$id_jabatan'");
    $hasil    = mysqli_fetch_array($tampilGajiJab);

    if ($_POST['edit'] == "edit") {
        $nama_jabatan     = $_POST['nama_jabatan'];
        $gapok            = $_POST['gapok'];
        $tunjangan        = $_POST['tunjangan'];

        if (empty($_POST['nama_jabatan']) || empty($_POST['gapok']) || empty($_POST['tunjangan'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-edit-data-gaji-jabatan&id_jabatan=$id_jabatan");
        } else {
            $update = mysqli_query($koneksi, "UPDATE tb_gaji_jabatan SET nama_jabatan='$nama_jabatan', gapok='$gapok', tunjangan='$tunjangan' WHERE id_jabatan='$id_jabatan'");
            if ($update) {
                $_SESSION['pesan'] = "Good! edit data gaji jabatan success ...";
                header("location:index.php?page=form-view-data-gaji-jabatan");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>