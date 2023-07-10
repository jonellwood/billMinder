function formatNumber(number) {
  // Convert the number to a string
  let formattedNumber = number.toString();
  // Check if the number is negative
  const isNegative = formattedNumber < 0;
  // Remove the negative sign if present
  formattedNumber = Math.abs(formattedNumber);
  // Split the number into integer and decimal parts (if any)
  const parts = formattedNumber.toString().split(".");
  let integerPart = parts[0];
  let decimalPart = parts[1] || "";
  // Insert commas as thousands separators
  integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  // Limit the decimal part to two decimal places
  decimalPart = decimalPart.slice(0, 2);
  // Concatenate the integer and decimal parts with a decimal point
  formattedNumber = decimalPart ? integerPart + "." + decimalPart : integerPart;
  // Add the $ sign
  formattedNumber = "$" + formattedNumber;
  // Add the 'negative' class if the number is less than 0
  if (isNegative) {
    formattedNumber = "-" + formattedNumber;
    formattedNumber = '<span class="negative">' + formattedNumber + '</span>';
  }
  return formattedNumber;
}

  // ### GET MONTHS BILLS
  async function getThisMonthsBills(){

    await fetch('getThisMonthsBills.php')
    .then((result) => result.json())
    .then((data) => {
      console.log(data);
      var html = "<table>"
      html += "<thead>"
      html += "<tr>"
      html += "<th>Date</th><th>Payee</th><th>Amount</th><th>Auto Draft</th><th>is Paid</th>"
      html += "</tr>"
      html += "</thead>"
      html += "<tbody>"
      for (var i = 0; i < data.length; i++){
        html += "<tr>"
          html += "<td>"+ data[i].dueDate +"</td>"
          html += "<td>"+ data[i].payee +"</td>"
          html += "<td>"+ formatNumber(data[i].amount) +"</td>"
          html += "<td><p class='auto-value-"+ data[i].isAuto + "'></p></td>"
          html += "<td><p class='paid-value-"+ data[i].isPaid + "'></p></td>"
          html += "</tr>";
        }

      html += "<tr><td><b>TOTAL MONTHLY BILLS:</b></td><td id='monthly-total-holder' colspan='4'></td></tr>"
      html += "</tbody>"
      html += "</table>"

      document.getElementById('month-bills').innerHTML = html;
       var total = getMonthlyBillsTotal();
    })
  }
// ### GET MONTHS INCOME
  async function getThisMonthsIncome(){
    await fetch('getThisMonthsIncome.php')
    .then((result) => result.json())
    .then((data) => {
      console.log(data);
      var html = "<table>"
      html += "<thead>"
      html += "<tr>"
      html += "<th>Date</th><th>Source</th><th>Amount</th>"
      html += "</tr>"
      html += "</thead>"
      html += "<tbody>"
      for (var i = 0; i < data.length; i++){
        html += "<tr><td>"+ data[i].date +"</td><td>"+ data[i].source +"</td><td>"+ formatNumber(data[i].amount) +"</td></tr>";
      }
      html += "</tbody>"
      html += "</table>"
      document.getElementById('month-income').innerHTML = html;
    })
  }
  // ### GET WEEKS BILLS
  async function getThisWeeksBills(){
    await fetch('getThisWeeksBills.php')
    .then((result) => result.json())
    .then((data) => {
      console.log(data);
      var html = "<table>"
      html += "<thead>"
      html += "<tr>"
      html += "<th>Date</th><th>Payee</th><th>Amount</th><th>Auto Draft</th><th>is Paid</th><th>Btn</th>"
      html += "</tr>"
      html += "</thead>"
      html += "<tbody class='bills-table-body' id='bills-table-body'>"
      for (var i = 0; i < data.length; i++){
        html += "<tr>"
        html += "<td>"+ data[i].dueDate +"</td>"
        html += "<td>"+ data[i].payee +"</td>"
        html += "<td>"+ formatNumber(data[i].amount) +"</td>"
        html += "<td><p class='auto-value-"+ data[i].isAuto + "'></p></td>"
        html += "<td><p class='paid-value-"+ data[i].isPaid + "'></p></td>"
        html += "<td><button class='pDBtn' type=button onclick='markAsPaid(this.value)' value='" +  data[i].id + "' id='"+ data[i].id +"'>Paid</button></td>"
        "</tr>";
      }
      html += "</tbody>"
      html += "</table>"
      document.getElementById('week-bills').innerHTML = html;
    })
    disableAllButtons();
  }
  // ### GET WEEKS INCOME
  async function getThisWeeksIncome(){
    await fetch('getThisWeeksIncome.php')
    .then((result) => result.json())
    .then((data) => {
      console.log(data);
      var html = "<table>"
      html += "<thead>"
      html += "<tr>"
      html += "<th>Date</th><th>Source</th><th>Amount</th>"
      html += "</tr>"
      html += "</thead>"
      html += "<tbody>"
      for (var i = 0; i < data.length; i++){
        html += "<tr><td>"+ data[i].date +"</td><td>"+ data[i].source +"</td><td>"+ formatNumber(data[i].amount) +"</td></tr>";
      }
      html += "</tbody>"
      html += "</table>"
      document.getElementById('week-income').innerHTML = html;
    })
  }

    function disableButton(id){
      var button = document.getElementById(id)
      var isPaidP = button.parentElement.previousElementSibling.querySelector("p");

      if (isPaidP.classList.contains("paid-value-1")){
        button.disabled = true;
      }
    }
function markAsPaid(id){
  fetch('markAsPaid.php?id=' + id);
  // disableButton(id);
}
async function getMonthlyBillsTotal(){
    await fetch('getTotalsBillsMonth.php')
    .then((result) => result.json())
    .then((data) => {
      console.log('The monthly total is: ' , data[0].total);
      var html = '<p><b>'+ formatNumber(data[0].total) +'</b></p>'
      document.getElementById('monthly-total-holder').innerHTML = html;
    })
  }
