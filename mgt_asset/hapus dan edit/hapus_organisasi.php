<?php
include '../koneksi.php';

$id_org = $_GET['id'];
$sql = "DELETE FROM organisasi WHERE id_org =$id_org";
$hapus = mysqli_query($conn, $sql);

if ($hapus->connect_error){
    echo "
    <script>
    </script>
    ";
    header('Location:../organisasi/data_organisasi.php');
}else {
    echo
    "
    <script>
       alert('data gagal dihapus');
    </script>
    ";
   header('Location:../organisasi/data_organisasi.php');
}
?>