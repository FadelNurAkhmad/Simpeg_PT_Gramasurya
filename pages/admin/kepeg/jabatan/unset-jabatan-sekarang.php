<div class="row">
    <?php
    if (isset($_GET['id_jab']) and ($_GET['pegawai_id']) or ($_GET['unit']) or ($_GET['jabatan'])) {
        $id_jab = $_GET['id_jab'];
        $unit = $_GET['unit'];
        $jabatan    = $_GET['jabatan'];
        $id_peg = $_GET['pegawai_id'];
    } else {
        die("Error. No Kode Selected! ");
    }
    include "../../config/koneksi.php";

    $update1 = mysqli_query($koneksi, "UPDATE tb_jabatan SET status_jab='' WHERE id_jab='$id_jab'");
    $update2 = mysqli_query($koneksi, "UPDATE pegawai SET pembagian1_id='0', pembagian2_id='0' WHERE pegawai_id='$id_peg'");
    if ($update1 && $update2) {
        $_SESSION['pesan'] = "Good! unset jabatan sekarang success ...";
        header("location:index.php?page=detail-data-pegawai&pegawai_id=$id_peg");
    } else {
        echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
    }
    ?>
</div>