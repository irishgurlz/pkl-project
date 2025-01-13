<?php
include '../koneksi.php';

$id_kategori = $_GET['id'];
$sql = "DELETE FROM kategori WHERE id_kategori =$id_kategori";
$hapus = mysqli_query($conn, $sql);

if ($hapus->connect_error){
    echo "
    <script>
    </script>
    ";
    header('Location:../kategori/data_kategori.php');
}else {
    echo
    "
    <script>
       alert('data gagal dihapus');
    </script>
    ";
   header('Location:../kategori/data_kategori.php');
}
?>