<?php

require '../koneksi.php';

if(isset($_POST['tambah'])){
    $nama_type = $_POST['nama_type'];
    $id_kategori = $_POST['id_kategori'];

    $query = "INSERT INTO type_kategori ( id_kategori,nama_type ) VALUES ('$id_kategori','$nama_type')";
    $proses = mysqli_query($conn, $query);

    if($proses){
      echo
      "
        <script>
           window.location.href='../kategori/data_type_kategori.php';
        </script>
      ";

      
  } else {
      echo
      "
      <script>
         alert('Data Gagal Ditambahkan');
         window.location.href='../kategori/data_type_kategori.php';
      </script>
    ";
  }
}
?>