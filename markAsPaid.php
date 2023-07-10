<?php
include_once "config.php";
  $conn = new mysqli($host, $username, $password, $database);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$billId = $_GET['id'];
$sql = "UPDATE bills set isPaid = 1 where id = $billId";
$result = $conn->query($sql);
Header(Location: 'index.php');
?>
