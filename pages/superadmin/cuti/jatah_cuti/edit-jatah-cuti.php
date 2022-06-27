<div class="row">
    <?php
    if (isset($_GET['id_jatah'])) {
        $id_jatah = $_GET['id_jatah'];
    } else {
        die("Error. No Kode Selected! ");
    }
    include "../../config/koneksi.php";
    $tampilCut    = mysqli_query($koneksi, "SELECT * FROM tb_jatah_cuti WHERE id_jatah='$id_jatah'");
    $hasil    = mysqli_fetch_array($tampilCut);
    $id_peg    = $hasil['id_peg'];

    if ($_POST['edit'] == "edit") {
        $jatah_c_mulai  = $_POST['jatah_c_mulai'];
        $jatah_c_akhir  = $_POST['jatah_c_akhir'];
        $jatah_c_jml    = $_POST['jatah_c_jml'];
        $jatah_c_ambil  = $_POST['jatah_c_ambil'];
        $jatah_c_sisa   = $_POST['jatah_c_sisa'];

        // $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_jatah_cuti WHERE jatah_c_jml='$_POST[jatah_c_jml]' AND jatah_c_sisa='$_POST[jatah_c_sisa]'"));


        if (empty($_POST['jatah_c_mulai']) || empty($_POST['jatah_c_akhir']) || empty($_POST['jatah_c_jml']) || empty($_POST['jatah_c_sisa'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-edit-jatah-cuti&id_jatah=$id_jatah");
        } else if ($_POST['jatah_c_jml'] > 12) {
            $_SESSION['pesan'] = "Oops! Jatah Cuti Hanya 12 Per tahun ...";
            header("location:index.php?page=form-edit-jatah-cuti&id_jatah=$id_jatah");
        } else if ($_POST['jatah_c_sisa'] > 12) {
            $_SESSION['pesan'] = "Oops! Input sisa cuti max 12 ...";
            header("location:index.php?page=form-edit-jatah-cuti&id_jatah=$id_jatah");
        } else {
            $update = mysqli_query($koneksi, "UPDATE tb_jatah_cuti SET jatah_c_mulai='$jatah_c_mulai', jatah_c_akhir='$jatah_c_akhir', jatah_c_jml='$jatah_c_jml', jatah_c_ambil='$jatah_c_ambil', jatah_c_sisa='$jatah_c_sisa' WHERE id_jatah='$id_jatah'");
            if ($update) {
                $_SESSION['pesan'] = "Good! edit cuti success ...";
                header("location:index.php?page=form-view-jatah-cuti");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>