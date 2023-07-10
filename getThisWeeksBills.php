<?php
include_once "config.php";
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentWeekStart = date('Y-m-d', strtotime('monday this week', strtotime('today')));
$currentWeekEnd = date('Y-m-d', strtotime('sunday this week', strtotime('today')));

// $sql = "SELECT * FROM bills WHERE dueDate >= '$currentWeekStart' AND dueDate <= '$currentWeekEnd'";

$sql = "SELECT *
FROM bills
WHERE (dueDate < CURDATE())
   OR (dueDate >= CURDATE() AND dueDate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)) order by dueDate ASC";
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
