I AM GETTING THE VALUE OF THE FREQUENCY OF THE RECURRENCE. NOW I NEED TO FIGURE OUT HOW TO CALCUALTE THE NUMBER OF TIMES IT WILL OCCUR WITH IN THE CURRENT MONTH GIVEN THE START DATE AND FREQUENCY
<script>
  // Assuming I can actually get an 'income' object with properties 'startDate' and 'recurrence'
var income = {
  startDate: '2023-07-12',
  recurrence: 'bi-weekly'
};

// Define the start date and end date of the current month
var currentDate = new Date();
var startOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
var endOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

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
      var numberOfOccurrences = Math.floor(totalDays / recurrenceFactor);

      // Calculate the dates of the occurrences
      var occurrenceDates = [];
      var currentDate = new Date(income.startDate);
      for (var i = 0; i < numberOfOccurrences; i++) {
        // console.log(numberOfOccurrences);
        // Check if the occurrence falls within the current month
        if (currentDate >= startOfMonth && currentDate <= endOfMonth) {
          occurrenceDates.push(currentDate.toISOString().split('T')[0]);
        }
        // Increment the current date based on the recurrence factor
        currentDate.setDate(currentDate.getDate() + recurrenceFactor);
      }

      console.log('Number of occurrences:', numberOfOccurrences);
      console.log('Occurrence dates:', occurrenceDates);

      </script>
