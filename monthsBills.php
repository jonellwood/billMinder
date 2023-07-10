<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script type="text/javascript" src="./functions.js"></script>
  <link rel="stylesheet" type="text/css" href="./main.css" >
  <title>Monthly Bills</title>
  <script>

    getThisMonthsBills();
    getThisMonthsIncome();
    getMonthlyBillsTotal();
  </script>
</head>
<body>
  <?php include "header.php" ?>
  <?php include "nav.php" ?>

  <!-- <div class="tables-holder" id="tables-holder"> -->
    <!-- Start Monthly View Section -->
    <hr class="big-hr">
    <div class="holder">
      <h2>Income and bills this month</h2>
      <div class="main-holder">
        <div id="month-income"></div>
        <div id="month-bills"></div>
      </div>
      <!-- End Monthly View Section -->
    <!-- </div> -->
  </div>
</body>
</html>
