
  // Assuming I can actually get an 'income' object with properties 'startDate' and 'recurrence'
function calcPaydates(startDate, recurrence, person){
// function calcPaydates(){
  // var income = {
  //   startDate: '2023-07-13',
  //   recurrence: 'bi-weekly'
  // };
  var income = {
    startDate: startDate,
    recurrence: recurrence,
    person: person
  };

  // Define the start date and end date of the current month
  var currentDate = new Date();
  var startOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
  var endOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 1);
  // console.log('start - end: ', (endOfMonth - startOfMonth) / (1000 * 60 * 60 *24));
  // console.log('startOfMonth: ', startOfMonth);
  // console.log('endOfMonth: ', endOfMonth);
  // Calculate the number of days between the start date and end date of the current month
var totalDays = (endOfMonth - startOfMonth) / (1000 * 60 * 60 * 24);
console.log('totalDays', totalDays);
// Calculate the number of occurrences based on the recurrence pattern
var recurrenceFactor = 0;
switch (income.recurrence) {
  case 'weekly':
    recurrenceFactor = 7;
    break;
    case 'bi-weekly':
      recurrenceFactor = 14;
      break;
      case 'monthly':
        recurrenceFactor = totalDays;
        break;
        case 'annually':
          recurrenceFactor = totalDays / 365;
          break;
        }
        // Calculate the number of occurrences in the current month
      var html = "<table><thead><tr><th>Date</th><th>Who</th></tr></thead><tbody>";
      var numberOfOccurrences = Math.floor(totalDays / recurrenceFactor);
        // html += "<tr><td></td>Number of " + person + "'s paydays: " + numberOfOccurrences + "</tr>"
        // Calculate the dates of the occurrences
        var occurrenceDates = [];
        var currentDate = new Date(income.startDate);
        for (var i = 0; i < numberOfOccurrences; i++) {
          console.log('# of occurrences: ', numberOfOccurrences);
          // Check if the occurrence falls within the current month
          if (currentDate >= startOfMonth && currentDate <= endOfMonth) {
            occurrenceDates.push(currentDate.toISOString().split('T')[0]);
          }
          // Increment the current date based on the recurrence factor
          currentDate.setDate(currentDate.getDate() + recurrenceFactor);
      }
      for(var j = 0; j < occurrenceDates.length; j++){
        html += "<tr><td>"+ occurrenceDates[j] +"</td><td>"+ person +"</td></tr>"
      }
      // document.getElementById('paydayInfoHolder' + person).innerHTML = html;
      html += "</tbody></table>";
      generateAndAppendHTML(html);
      console.log('Number of occurrences:', numberOfOccurrences);
      console.log('Occurrence dates:', occurrenceDates);


      // return (numberOfOccurrences, occurrenceDates);
    }
  function generateAndAppendHTML(htmlContent) {
      var targetElement = document.getElementById('singlePaydayHolder');
      if (targetElement.innerHTML.trim() === '') {
        // If the innerHTML is empty, set it using "="
        targetElement.innerHTML = htmlContent;
      } else {
        // If there is already content, append it using "+="
        targetElement.innerHTML += htmlContent;
      }
    }

