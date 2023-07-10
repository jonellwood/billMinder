SELECT i.* FROM income AS i
INNER JOIN recurrences AS r ON i.id = r.billId
WHERE r.startDate <= '2023-07-31'
AND DAYOFMONTH(r.startDate) <= r.dayOfMonth
AND r.frequency = 'monthly' order by date ASC

