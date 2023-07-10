<?php
include_once "config.php";
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentMonthStart = date('Y-m-01');
$currentMonthEnd = date('Y-m-t');

$sql = "SELECT SUM(amount) as total from bills WHERE dueDate >= '$currentMonthStart' AND dueDate <= '$currentMonthEnd'";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
$conn->close();

echo json_encode($data);

?>
