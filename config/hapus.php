<?php
require "koneksi.php";

$siswa_id = $_GET["siswa_id"];

if ( hapus($siswa_id) > 0){
    echo "
            <script>
                alert('data berhasil dihapus');
                document.location.href = '../admin/siswa/siswa.php';
            </script>
        ";
} else {
    echo "
            <script>
                alert('data gagal dihapus');
                document.location.href = '../admin/siswa/siswa.php';
            </script>
        ";
}

?>