<?php

require '../koneksi.php';

if(isset($_POST['tambah'])){
    $nik = $_POST['nik'];
    $name = $_POST['name'];
    $c_org = $_POST['c_org'];
    $level = $_POST['id_level'];

    $query = "INSERT INTO master_employee (employe_nik,employe_name,c_org,id_level) VALUES ('$nik','$name','$c_org','$level')";
    $proses = mysqli_query($conn, $query);

    if($proses){
      echo
      "
        <script>
           window.location.href='../employe/data_employe.php';
        </script>
      ";

      
  } else {
      echo
      "
      <script>
         alert('Data Gagal Ditambahkan');
         window.location.href='../employe/tambah_employe.php';
      </script>
    ";
  }
}
?>