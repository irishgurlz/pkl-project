<?php

require '../koneksi.php';

if(isset($_POST['tambah'])){
    $kategori = $_POST['kategori'];

    $query = "INSERT INTO kategori ( kategori ) VALUES ('$kategori')";
    $proses = mysqli_query($conn, $query);

    if($proses){
      echo
      "
        <script>
           window.location.href='../kategori/data_kategori.php';
        </script>
      ";

      
  } else {
      echo
      "
      <script>
         alert('Data Gagal Ditambahkan');
         window.location.href='../kategori/tambah_kategori.php';
      </script>
    ";
  }
}
?>