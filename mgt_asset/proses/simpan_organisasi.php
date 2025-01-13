<?php

require '../koneksi.php';

if(isset($_POST['tambah'])){
    $corg = $_POST['corg'];
    $orgparent = $_POST['orgparent'];
    $norg = $_POST['norg'];
    $eorg = $_POST['eorg'];

    $query = "INSERT INTO organisasi (c_org,c_org_parent,n_org,e_org) VALUES ('$corg','$orgparent','$norg','$eorg')";
    $proses = mysqli_query($conn, $query);

    if($proses){
      echo
      "
        <script>
           window.location.href='../organisasi/data_organisasi.php';
        </script>
      ";

      
  } else {
      echo
      "
      <script>
         alert('Data Gagal Ditambahkan');
         window.location.href='../organisasi/tambah_organisasi.php';
      </script>
    ";
  }
}
?>