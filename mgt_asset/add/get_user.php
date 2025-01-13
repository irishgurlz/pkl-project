<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dirgantara_indonesia";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nik = $_GET['employe_nik'];

// Prepare and execute query
$sql = "SELECT employe_name,organisasi.c_org FROM master_employee INNER JOIN organisasi ON master_employee.c_org = organisasi.c_org WHERE employe_nik = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nik);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
if ($row = $result->fetch_assoc()) {
    $data = array(
        'employe_name' => $row['employe_name'],
        'c_org' => $row['c_org']
    );
}

// Output as JSON
header('Content-Type: application/json');
echo json_encode($data);

$stmt->close();
$conn->close();
?>
