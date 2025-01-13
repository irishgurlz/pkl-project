<?php
// $conn = mysql_connect("localhost", "root", "", "web1")
$host = "localhost";
$username = "root";
$password = "";
$database = "dirgantara_indonesia";
$conn = new mysqli($host, $username, $password, $database);
if($conn->connect_error){
    echo 'Gagal koneksi ke database';
} else{
    //echo 'koneksi berhasil';
}
?>