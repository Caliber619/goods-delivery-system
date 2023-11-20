<?php
// Include your database connection file
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "item";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username, password, and customer_id from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the provided username, password, and customer_id
    if (!empty($username) && !empty($password)) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the user into the database with customer_id
        $insertUserQuery = "INSERT INTO customers_login (username, password) VALUES ('$username', '$hashedPassword')";
        
        if ($conn->query($insertUserQuery) === TRUE) {
            echo "User registered successfully.";
            // Redirect to the login page or wherever you want
            header("Location: login.html");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Please fill in all fields";
    }
}
?>
