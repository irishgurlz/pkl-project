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

// Check if 'employe_nik' is set
if (isset($_GET['employe_nik'])) {
    $nik = $_GET['employe_nik'];

    // Prepare and execute query
    $sql = "SELECT master_employee.employe_name, organisasi.c_org 
            FROM master_employee 
            INNER JOIN organisasi ON master_employee.c_org = organisasi.c_org 
            WHERE master_employee.employe_nik = ?";
    
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $nik);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch data
        if ($row = $result->fetch_assoc()) {
            $data = array(
                'employe_name' => $row['employe_name'],
                'c_org' => $row['c_org']
            );
        } else {
            // Return null values if no data found
            $data = array(
                'employe_name' => null,
                'c_org' => null
            );
        }
    } else {
        // Handle query preparation error
        $data = array(
            'employe_name' => null,
            'c_org' => null
        );
    }
} else {
    // Return null values if 'employe_nik' is not set
    $data = array(
        'employe_name' => null,
        'c_org' => null
    );
}

// Output as JSON
header('Content-Type: application/json');
echo json_encode($data);

// Close statement and connection
$stmt->close();
$conn->close();
?>
