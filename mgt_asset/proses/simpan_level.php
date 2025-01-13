<?php

require '../koneksi.php';

if(isset($_POST['tambah'])){
    $level = $_POST['level'];

    $query = "INSERT INTO level ( nama_level ) VALUES ('$level')";
    $proses = mysqli_query($conn, $query);

    if($proses){
      echo
      "
        <script>
           window.location.href='../level/data_level.php';
        </script>
      ";

      
  } else {
      echo
      "
      <script>
         alert('Data Gagal Ditambahkan');
         window.location.href='../level/tambah_level.php';
      </script>
    ";
  }
}
?>