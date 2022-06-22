<div class="row">
    <?php
    if (isset($_GET['id_lokasi'])) {
        $id_lokasi = $_GET['id_lokasi'];
    } else {
        die("Error. No Kode Selected! ");
    }
    include "../../config/koneksi.php";
    $tampilLokasi    = mysqli_query($koneksi, "SELECT * FROM tb_lokasi WHERE id_lokasi='$id_lokasi'");
    $hasil    = mysqli_fetch_array($tampilLokasi);
    $id_peg    = $hasil['id_peg'];

    if ($_POST['edit'] == "edit") {
        $nama_lokasi    = $_POST['nama_lokasi'];
        $lat            = $_POST['lat'];
        $lng            = $_POST['lng'];
        $alamat         = $_POST['alamat'];

        if (empty($_POST['nama_lokasi']) || empty($_POST['lat']) || empty($_POST['lng']) || empty($_POST['alamat'])) {
            $_SESSION['pesan'] = "Oops! Please fill all column ...";
            header("location:index.php?page=form-edit-lokasi&id_lokasi=$id_lokasi");
        } else {
            $update = mysqli_query($koneksi, "UPDATE tb_lokasi SET nama_lokasi='$nama_lokasi', lat='$lat', lng='$lng', alamat='$alamat' WHERE id_lokasi='$id_lokasi'");
            if ($update) {
                $_SESSION['pesan'] = "Good! edit lokasi success ...";
                header("location:index.php?page=form-view-lokasi");
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>