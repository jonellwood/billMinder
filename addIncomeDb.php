<?php
include_once "config.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve form data
  $date = $_POST["date"];
  $source = $_POST["source"];
  $amount = $_POST["amount"];
  $isRecurring = isset($_POST["isRecurring"]) ? 1 : 0;
  $recurrenceFrequency = $_POST["recurrenceFrequency"];
  $recurrenceDay = $_POST["recurrenceDay"];

  // Create a new database connection
  $conn = new mysqli($host, $username, $password, $database);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and execute the SQL statement for regular bill entry
  $stmt = $conn->prepare("INSERT INTO income (date, source, amount, isRecurring) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("sssi", $date, $source, $amount, $isRecurring);
  $stmt->execute();

  // Get the ID of the inserted regular bill
  $incid = $stmt->insert_id;

  // Close the statement for regular bill entry
  $stmt->close();

  // Check if the bill is recurring
  if ($isRecurring) {
    // Prepare and execute the SQL statement for recurring bill entry

    $stmt = $conn->prepare("INSERT INTO irecurrences (incid, startDate, dayOfMonth, frequency) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $incid, $date, $recurrenceDay, $recurrenceFrequency);
    $stmt->execute();

    // Close the statement for recurring bill entry
    $stmt->close();
  }

  // Close the database connection
  $conn->close();

  header("Location: monthsBills.php");
}
?>
