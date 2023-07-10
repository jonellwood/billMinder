<!DOCTYPE html>
<html>
<head>
  <title>Add Bill Form</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <link rel="stylesheet" type="text/css" href="./main.css">
</head>
<body>
  <?php include "header.php" ?>
  <?php include "nav.php" ?>
<div class="body">
  <div class="form-container">
    <h2>Add Bill</h2>
    <form action="addBillDb.php" method="POST">
      <div class="form-group">
        <label for="dueDate">Due Date:</label>
        <input type="date" id="dueDate" name="dueDate" required>
      </div>
      <div class="form-group">
        <label for="payee">Payee:</label>
        <input type="text" id="payee" name="payee" required>
      </div>
      <div class="form-group">
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" step="0.01" required>
      </div>
      <div class="form-group">
        <input type="checkbox" id="isPaid" name="isPaid">
        <label for="isPaid" class="checkbox-label">Paid</label>
      </div>
      <div class="form-group">
        <input type="checkbox" id="isAuto" name="isAuto">
        <label for="isAuto" class="checkbox-label">Auto</label>
      </div>
      <div class="form-group">
        <input type="checkbox" id="isRecurring" name="isRecurring">
        <label for="isRecurring" class="checkbox-label">Recurring</label>
      </div>
      <div class="form-group">
        <label for="recurrenceFrequency">Frequency</label>
        <select id="recurrenceFrequency" name="recurrenceFrequency">
          <option value="NULL" selected>Not Recurring</option>
          <option value="weekly">Weekly</option>
          <option value="monthly">Monthly</option>
          <option value="monthly">Yearly</option>
        </select>
      </div>
      <div class="form-group">
        <label for="recurrenceDay">Recurrence Day</label>
        <select id="recurrenceDay" name="recurrenceDay">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        </select>
      </div>
      <div class="form-group">
        <input type="submit" value="Submit" class="submit-button">
      </div>
    </form>
  </div>
  </div>
</body>
</html>
