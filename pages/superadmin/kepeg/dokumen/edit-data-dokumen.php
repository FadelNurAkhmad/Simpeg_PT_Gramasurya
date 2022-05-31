<div class="row">
    <?php
    if (isset($_GET['id_dokumen'])) {
        $id_dokumen = $_GET['id_dokumen'];
    } else {
        die("Error. No Kode Selected! ");
    }
    include "../../config/koneksi.php";
    $tampilSem    = mysqli_query($koneksi, "SELECT * FROM tb_dokumen WHERE id_dokumen='$id_dokumen'");
    $hasil    = mysqli_fetch_array($tampilSem, MYSQLI_ASSOC);
    $id_peg    = $hasil['id_peg'];

    if ($_POST['edit'] == "edit") {
        $dokumen       = $_POST['dokumen'];
        $file            = $_FILES['file']['name'];

        if (empty($_POST['dokumen'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-edit-data-dokumen&id_dokumen=$id_dokumen");
        } else {
            $update = mysqli_query($koneksi, "UPDATE tb_dokumen SET dokumen='$dokumen', file='$file' WHERE id_dokumen='$id_dokumen'");
            if ($update) {
                $_SESSION['pesan'] = "Good! edit data seminar success ...";
                header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
            if (strlen($file) > 0) {
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    move_uploaded_file($_FILES['file']['tmp_name'], "../../assets/file/" . $file);
                }
            }
        }
    }
    ?>
</div>