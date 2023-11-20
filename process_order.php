<?php
session_start();
var_dump($_SESSION);  // Add this line for debugging
// Include your database connection code here
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

// Check if the customer ID is set in the session
if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
    echo '<pre>';
    var_dump($customer_id);
    echo '</pre>';

    // Check if the customer exists
    $check_customer_sql = "SELECT * FROM customers_login WHERE customer_id = $customer_id";
    $result = $conn->query($check_customer_sql);

    if ($result->num_rows > 0) {
        // Customer exists, proceed to insert items
        foreach ($_POST["items"] as $item) {
            $escaped_item = mysqli_real_escape_string($conn, $item);
            $sql = "INSERT INTO items (item_name) VALUES ('$escaped_item')";
            $conn->query($sql);
        }

        // Close the database connection
        $conn->close();
        // Redirect to the customer page with a success message
        header("Location: customer.php?success=1");
        exit();
    } else {
        // Customer does not exist, handle accordingly
        echo "Customer does not exist!";
    }
} else {
    // Customer ID not set in the session, handle accordingly
    echo "Customer ID not set in the session!";
}

?>
