<div class="row">
    <?php
    if (isset($_GET['id_lokasi'])) {
        $id_lokasi = $_GET['id_lokasi'];
    } else {
        die("Error. No ID Selected! ");
    }

    if ($_POST['save'] == "save") {
        $id_peg         = $_POST['id_peg'];
        $nama_lokasi    = $_POST['nama_lokasi'];
        $link_lokasi    = $_POST['link_lokasi'];
        $alamat         = $_POST['alamat'];

        include "../../config/koneksi.php";

        $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_tempat WHERE id_peg='$_POST[id_peg]'"));

        if (empty($_POST['id_peg']) || empty($_POST['nama_lokasi']) || empty($_POST['link_lokasi']) || empty($_POST['alamat'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-master-tempat");
        } else if ($cek > 0) {
            $_SESSION['pesan'] = "Oops! Duplikat data ...";
            header("location:index.php?page=form-master-tempat");
        } else {
            $insert = "INSERT INTO tb_tempat (id_lokasi, id_peg, nama_lokasi, link_lokasi, alamat) 
            VALUES ('$id_lokasi', '$id_peg', '$nama_lokasi', '$link_lokasi', '$alamat')";
            $query = mysqli_query($koneksi, $insert) or die(mysqli_error($koneksi));

            if ($query) {
                $_SESSION['pesan'] = "Good! Insert data lokasi success ...";
                header("location:index.php?page=form-view-tempat");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>