<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['id_dokumen'])) {
        $id_dokumen = $_GET['id_dokumen'];

        $query   = mysql_query("SELECT * FROM tb_dokumen WHERE id_dokumen='$id_dokumen'");
        $data    = mysql_fetch_array($query);
        $id_peg    = $data['id_peg'];
    } else {
        die("Error. No ID Selected! ");
    }

    if (!empty($id_dokumen) && $id_dokumen != "") {
        $delete    = mysql_query("DELETE FROM tb_dokumen WHERE id_dokumen='$id_dokumen'");
        if ($delete) {
            $_SESSION['pesan'] = "Good! delete dokumen success ...";
            header("location:index.php?page=detail-data-pegawai&id_peg=$id_peg");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysql_close($Open);
    ?>
</div>