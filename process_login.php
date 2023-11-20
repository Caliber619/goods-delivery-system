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

// Start session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the provided username and password
    if (!empty($username) && !empty($password)) {
        // Hash the password (use appropriate hashing algorithm)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if the username exists in the 'customers_login' table
$checkUserQuery = "SELECT * FROM customers_login WHERE username = ?";
$stmt = $conn->prepare($checkUserQuery);

// Check for errors in preparing the statement
if (!$stmt) {
    die('Error in statement preparation: ' . $conn->error);
}

$stmt->bind_param("s", $username);

// Check for errors in binding parameters
if (!$stmt->bind_param("s", $username)) {
    die('Error in binding parameters: ' . $stmt->error);
}

$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    // User exists, now verify the password
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Password is correct, set up the session
        session_start();
        $_SESSION['customer_id'] = $row['customer_id'];

        // Redirect to the customer dashboard or wherever you want
        header("Location: customer.php");
        exit();
    } else {
        // Incorrect password
        echo "Incorrect password";
    }
} else {
    // Username not found
    echo "Username not found";
}
    } else {
        // Fields not filled
        echo "Please fill in all fields";
    }
}
?>
