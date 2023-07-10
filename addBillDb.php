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
  $isRecurring = isset($_POST["isRecurring"]) ? 1 : 0;
  $recurrenceFrequency = $_POST["recurrenceFrequency"];
  $recurrenceDay = $_POST["recurrenceDay"];

  // Create a new database connection
  $conn = new mysqli($host, $username, $password, $database);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and execute the SQL statement for regular bill entry
  $stmt = $conn->prepare("INSERT INTO bills (dueDate, payee, amount, isPaid, isAuto, isRecurring) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssdiii", $dueDate, $payee, $amount, $isPaid, $isAuto, $isRecurring);
  $stmt->execute();

  // Get the ID of the inserted regular bill
  $billId = $stmt->insert_id;

  // Close the statement for regular bill entry
  $stmt->close();

  // Check if the bill is recurring
  if ($isRecurring) {
    // Prepare and execute the SQL statement for recurring bill entry
    $stmt = $conn->prepare("INSERT INTO brecurrences (billId, startDate, dayOfMonth, frequency) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $billId, $dueDate, $recurrenceDay, $recurrenceFrequency);
    $stmt->execute();

    // Close the statement for recurring bill entry
    $stmt->close();
  }

  // Close the database connection
  $conn->close();

  header("Location: monthsBills.php");
}
?>
