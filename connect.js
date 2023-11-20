const mysql = require('mysql2');

console.log("hello");

// Define variables (assuming you're receiving POST data through a request)
const item1 = req.body.item1;
const item2 = req.body.item2;
const item3 = req.body.item3;
const item4 = req.body.item4; 
const item5 = req.body.item5;

// Database connection
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'project3'
});

// Establish the database connection
connection.connect((err) => {
  if (err) {
    console.error('Connection failed:', err);
    return;
  }

  console.log('Connected to the database');

  // Prepare and execute the SQL statement
  const query = 'INSERT INTO itemlist (item1, item2, item3, item4, item5) VALUES (?, ?, ?, ?, ?)';
  connection.execute(query, [item1, item2, item3, item4, item5], (error, results) => {
    if (error) {
      console.error('Error while inserting data:', error);
    } else {
      console.log('Items recorded successfully...');
    }

    // Close the database connection
    connection.end();
  });
});
