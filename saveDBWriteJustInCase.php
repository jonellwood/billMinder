<?php
include_once "config.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve form data
  $dueDate = $_POST["dueDate"];
  $payee = $_POST["payee"];
  $amount = $_POST["amount"];
  $isPaid = isset($_POST["isPaid"]) ? 1 : 0;
  $isAuto = isset($_POST["isAuto"]) ? 1 : 0;

  // Create a new database connection
  $conn = new mysqli($host, $username, $password, $database);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and execute the SQL statement
  $stmt = $conn->prepare("INSERT INTO bills (dueDate, payee, amount, isPaid, isAuto) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("ssdii", $dueDate, $payee, $amount, $isPaid, $isAuto);
  $stmt->execute();

  // Check if the insertion was successful
  if ($stmt->affected_rows > 0) {
     header("Location: 'index.php'");
  } else {
    echo "Failed to add the bill.";
  }

  // Close the statement and database connection
  $stmt->close();
  $conn->close();
}
?>
