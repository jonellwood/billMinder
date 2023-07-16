<?php
include_once "config.php";
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script type="text/javascript" src="./functions.js"></script>
  <script type="text/javascript" src="./calcPaydates.js"></script>

  <link rel="stylesheet" type="text/css" href="./main.css" >
  <title>Ellwood Family Bill Minder</title>
<script>
  getThisWeeksBills();
  getThisWeeksIncome();

</script>
</head>
<body>
  <?php include 'header.php' ?>
<?php include 'nav.php' ?>
<!-- Start Due this week Section -->
<div class="tables-holder" id="tables-holder">
<div>
  <h3>Income and bills this week</h3>
  <div id="week-income"></div>
  <hr>
  <div id="week-bills"></div>
</div>
<!-- End Due this week Section -->


    <!-- Start Calendar Section -->
    <div class="calendar">
      <div class="calendar-header">
        <button id="prevMonth">Previous</button>
        <h2 id="currentMonth"></h2>
        <button id="nextMonth">Next</button>
      </div>
      <div class="calendar-body" id="calendarBody"></div>
    </div>
    <div id="paydayInfoHolderJon"></div>
    <div id="paydayInfoHolderChristina"></div>
    <!-- End Calendar Section -->
  </div>
   <script>

    // Variables for current year and month
    var currentYear;
    var currentMonth;

    // Function to generate calendar
    function generateCalendar(year, month) {
      var calendarBody = document.getElementById('calendarBody');
      var currentMonthElement = document.getElementById('currentMonth');

      // Clear the previous calendar
      calendarBody.innerHTML = '';

      // Set the current month and year
      currentYear = year;
      currentMonth = month;
      currentMonthElement.textContent = (new Date(currentYear, currentMonth)).toLocaleString('en-US', { month: 'long', year: 'numeric' });

      // Get the first day of the month
      var firstDay = new Date(year, month, 1);
      var startingDay = firstDay.getDay(); // 0 (Sunday) to 6 (Saturday)

      // Get the number of days in the month
      var lastDay = new Date(year, month + 1, 0).getDate();

      // Create calendar days
      for (var i = 0; i < startingDay; i++) {
        var day = document.createElement('div');
        day.className = 'calendar-day';
        calendarBody.appendChild(day);
      }

      for (var dayNumber = 1; dayNumber <= lastDay; dayNumber++) {
        var day = document.createElement('div');
        day.className = 'calendar-day';
        day.textContent = dayNumber;
        calendarBody.appendChild(day);
      }
    }

    // Event listeners for previous and next month buttons
    document.getElementById('prevMonth').addEventListener('click', function() {
      var previousMonth = currentMonth - 1;
      if (previousMonth < 0) {
        currentYear--;
        previousMonth = 11; // December
      }
      generateCalendar(currentYear, previousMonth);
    });

    document.getElementById('nextMonth').addEventListener('click', function() {
      var nextMonth = currentMonth + 1;
      if (nextMonth > 11) {
        currentYear++;
        nextMonth = 0; // January
      }
      generateCalendar(currentYear, nextMonth);
    });

    // Generate calendar for the current month
    var currentDate = new Date();
    currentYear = currentDate.getFullYear();
    currentMonth = currentDate.getMonth();
    generateCalendar(currentYear, currentMonth);

  </script>
  <script>
function disableAllButtons(){
  // document.addEventListener("DOMContentLoaded", function() {
    // Select the buttons inside the div with the ID "week-bills"
    var buttons = document.querySelectorAll('.pDBtn');
    console.log(buttons);
    // Loop through each button and evaluate the preceding <p> element's classList
    buttons.forEach(function(button) {
    var isPaidP = button.parentElement.previousElementSibling.querySelector("p");

    // Check for class we want
    if (isPaidP.classList.contains("paid-value-1")) {
      button.disabled = true;
    }
  });
// });
}

calcPaydates('2023-07-13', 'bi-weekly', 'Jon');
calcPaydates('2023-07-06', 'weekly', 'Christina');

</script>
</body>
</html>
<style>
body{
    /* width: 100%;
    font-family: math;
    margin: 0;
    padding: 0;
  }
  .main-holder{
    display: grid;
    grid-template-columns: 1fr 1fr;
    margin-left: 20px;
    margin-right: 20px;
  } */
    /* Styles for the hero header */
    /* .hero-header {
      position: relative;
      height: 400px;
      background-image: url('images/cash-and-card.jpg');
      background-size: cover;
      background-position: center;
      color: #ffffff;
      text-align: center;
      padding-top: 100px;
    } */

    /* .hero-header h1 {
      font-size: 36px;
      margin-bottom: 20px;
    }

    .hero-header p {
      font-size: 18px;
      margin-bottom: 40px;
    } */

    /* Styles for the overlay */
    /* .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
    }
    .hero-h1{
      background-color: #00000050;
      padding: 50px;
    }
    .calendar {
      max-width: 400px;
      margin: 0 auto;
    }

    .calendar-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .calendar-header button {
      background-color: #ffffff;
      border: none;
      cursor: pointer;
      font-size: 16px;
    }

    .calendar-body {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      grid-gap: 5px;
    }

    .calendar-day {
      background-color: #f0f0f0;
      padding: 10px;
      text-align: center;
    }
    .calendar button {
      border: 1px solid black;
      border-radius: 5%;
    }
    table {
    width: 100%;
    border-collapse: collapse;

    }
th {
  background-color: #f0f0f0;
  padding: 10px;
  text-align: left;
}
th, td {
  border: 1px solid #ccc;
  padding: 10px;
}
tr:nth-child(even) {
  background-color: #f9f9f9;
}
tr:hover {
  background-color: #e9e9e9;
}
.false-value {
  color: red;
}

.true-value {
  color: green;
}
.big-hr{
  margin-top: 25px;
  margin-bottom: 25px;
}
.paid-value-0::after {
  content: "False" !important;
  color: #FF0000;
}
.paid-value-1::after {
  content: "True" !important;
  color: #008000;
}
.auto-value-0::after {
  content: "False" !important;
}
.auto-value-1::after {
  content: "True" !important;
  color: #FFA500;
}
#monthly-total-holder{
  text-align: right;
}
.navbar {
      background-color: #f1f1f1;
      display: flex;
      justify-content: center;
      padding: 10px;
    }

    .navbar-item {
      margin: 0 10px;
    }

    .navbar-item a {
      color: #333;
      text-decoration: none;
      display: flex;
      align-items: center;
    }

    .navbar-item i {
      margin-right: 5px;
    }
    .tables-holder{
      margin: 20px;
      display: grid;
      grid-template-columns: 1fr 1fr;
    }
    @media only screen and (max-width: 900px){
      body{
        font-family: math;
       padding: 0;
       margin: 0;
       font-size: .75em;
      }
      .small-screen-header{
        display: block;
        text-align: center;
      }
      .hero-header {
        display: none;
      }
    }
    @media only screen and (max-width: 600px) {
      body{
       padding: 0;
       margin: 0;
      }
      .hero-header{
        display: none;
      }
      .navbar{
        margin-top: 15px;
        font-size: smaller;
      }
      .tables-holder{
        grid-template-columns: 1fr;
      }
}
  </style>
