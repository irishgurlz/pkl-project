<?php
include '../koneksi.php';

$id_type_kategori = $_GET['id'];
$sql = "DELETE FROM type_kategori WHERE id_type_kategori =$id_type_kategori";
$hapus = mysqli_query($conn, $sql);

if ($hapus->connect_error){
    echo "
    <script>
    </script>
    ";
    header('Location:../kategori/data_type_kategori.php');
}else {
    echo
    "
    <script>
       alert('data gagal dihapus');
    </script>
    ";
   header('Location:../kategori/data_type_kategori.php');
}
?>