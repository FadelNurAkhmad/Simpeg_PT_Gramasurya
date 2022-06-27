<div class="row">
    <?php
    if (isset($_GET['id_cuti'])) {
        $id_cuti = $_GET['id_cuti'];
    } else {
        die("Error. No Kode Selected! ");
    }
    include "../../config/koneksi.php";
    $tampilCut    = mysqli_query($koneksi, "SELECT * FROM tb_data_cuti WHERE id_cuti='$id_cuti'");
    $hasil    = mysqli_fetch_array($tampilCut);
    $id_peg    = $hasil['id_peg'];

    if ($_POST['edit'] == "edit") {
        $tanggal_cuti  = $_POST['tanggal_cuti'];
        $tanggal_mulai = $_POST['tanggal_mulai'];
        $tanggal_selesai = $_POST['tanggal_selesai'];
        $lama_cuti   = $_POST['lama_cuti'];
        $jumlah_cuti   = $_POST['jumlah_cuti'];
        $jenis_cuti    = $_POST['jenis_cuti'];
        $keperluan     = $_POST['keperluan'];
        $status        = $_POST['status'];

        if (empty($_POST['tanggal_cuti']) || empty($_POST['tanggal_mulai']) || empty($_POST['tanggal_selesai']) || empty($_POST['lama_cuti']) || empty($_POST['jumlah_cuti']) || empty($_POST['jenis_cuti']) || empty($_POST['keperluan']) || empty($_POST['status'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-edit-cuti&id_cuti=$id_cuti");
        } else {
            $update = mysqli_query($koneksi, "UPDATE tb_data_cuti SET tanggal_cuti='$tanggal_cuti', tanggal_mulai='$tanggal_mulai', lama_cuti='$lama_cuti', jumlah_cuti='$jumlah_cuti', jenis_cuti='$jenis_cuti', keperluan='$keperluan', status='$status' WHERE id_cuti='$id_cuti'");
            if ($update) {
                $_SESSION['pesan'] = "Good! edit cuti success ...";
                header("location:index.php?page=form-view-cuti");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>