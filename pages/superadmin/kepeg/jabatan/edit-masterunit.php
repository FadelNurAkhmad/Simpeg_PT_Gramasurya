<div class="row">
    <?php
    if (isset($_GET['pembagian2_id'])) {
        $pembagian2_id = $_GET['pembagian2_id'];
    } else {
        die("Error. No Kode Selected! ");
    }
    include "../../config/koneksi.php";
    $tampilMJ    = mysqli_query($koneksi, "SELECT * FROM pembagian2 WHERE pembagian2_id='$pembagian2_id'");
    $hasil    = mysqli_fetch_array($tampilMJ, MYSQLI_ASSOC);

    if ($_POST['edit'] == "edit") {
        $pembagian2_nama    = $_POST['pembagian2_nama'];

        $cekname    = mysqli_num_rows(mysqli_query($koneksi, "SELECT pembagian2_nama FROM pembagian2 WHERE pembagian2_nama='$_POST[pembagian2_nama]'"));

        if (empty($_POST['pembagian2_nama'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-edit-masterjab&pembagian2_id=$pembagian2_id");
        } else if ($cekname > 0) {
            $_SESSION['pesan'] = "Oops! Duplikat data ...";
            header("location:index.php?page=form-edit-masterjab&pembagian2_id=$pembagian2_id");
        } else {
            $update = mysqli_query($koneksi, "UPDATE pembagian2 SET pembagian2_nama='$pembagian2_nama' WHERE pembagian2_id='$pembagian2_id'");
            if ($update) {
                $_SESSION['pesan'] = "Good! edit nama unit success ...";
                header("location:index.php?page=form-master-data-jabatan");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>