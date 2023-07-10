<?php
include_once "config.php";
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * from bills";
$result = $conn->query($sql);

$data = array(); // Array to store the fetched data

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Append each row as an associative array to the $data array
    }
}

$conn->close();

echo json_encode($data);

?>
