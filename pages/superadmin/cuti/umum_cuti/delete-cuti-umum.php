<div class="row">
    <?php
    include "../../config/koneksi.php";
    if (isset($_GET['id_cuti_umum'])) {
        $id_cuti_umum = $_GET['id_cuti_umum'];

        $query   = mysqli_query($koneksi, "SELECT * FROM tb_cuti_umum WHERE id_cuti_umum='$id_cuti_umum'");
        $data    = mysqli_fetch_array($query);
    } else {
        die("Error. No ID Selected! ");
    }

    if (!empty($id_cuti_umum) && $id_cuti_umum != "") {
        // mengupdate izin pada tabel shift_result menjadi 0 jika data izin dihapus
        $shift_result = mysqli_query($koneksi, "UPDATE shift_result SET izin_jenis_id = '0' WHERE pegawai_id = $data[id_peg] AND tgl_shift >= '$data[tanggal_mulai]' AND tgl_shift <= '$data[tanggal_selesai]'");
        $delete    = mysqli_query($koneksi, "DELETE FROM tb_cuti_umum WHERE id_cuti_umum='$id_cuti_umum'");
        if ($delete) {
            $_SESSION['pesan'] = "Good! delete cuti success ...";
            header("location:index.php?page=form-view-cuti-umum");
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysqli_close($koneksi);
    ?>
</div>