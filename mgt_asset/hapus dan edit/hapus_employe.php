<?php
include '../koneksi.php';

$employe_nik = $_GET['id'];

// Kemudian, lakukan penghapusan data
$sql = "DELETE FROM master_employee WHERE employe_nik =$employe_nik";
$hapus = mysqli_query($conn, $sql);

// Periksa apakah penghapusan berhasil
if ($hapus) {
    echo "
    <script>
    </script>
    ";
} else {
    echo "
    <script>
       alert('Data gagal dihapus: " . mysqli_error($conn) . "');
    </script>
    ";
}

// Alihkan kembali ke halaman detail employe
header('Location:../employe/data_employe.php');
?>