<?php
include_once "config.php";
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentMonthStart = date('Y-m-01');
$currentMonthEnd = date('Y-m-t');

$sql = "SELECT * FROM income WHERE date >= '$currentMonthStart' AND date <= '$currentMonthEnd' AND isRecurring = 0 order by date ASC";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$sql2 = "SELECT i.*, r.frequency from income AS i
INNER JOIN irecurrences AS r ON i.id = r.incid
WHERE r.startDate <= '$currentMonthEnd'
AND DAYOFMONTH(r.startDate) <= r.dayOfMonth
order by date ASC";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
  while ($row2 = $result2->fetch_assoc()){
    array_push($data, $row2);
  }
}


$conn->close();

echo json_encode($data);

?>
