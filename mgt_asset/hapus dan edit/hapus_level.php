<?php
include '../koneksi.php';

$id_level = $_GET['id'];
$sql = "DELETE FROM level WHERE id_level =$id_level";
$hapus = mysqli_query($conn, $sql);

if ($hapus->connect_error){
    echo "
    <script>
    </script>
    ";
    header('Location:../level/data_level.php');
}else {
    echo
    "
    <script>
       alert('data gagal dihapus');
    </script>
    ";
   header('Location:../level/data_level.php');
}
?>