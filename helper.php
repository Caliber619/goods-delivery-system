<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "item";

    //create connection
    $conn = new mysqli("localhost", "username", "password", "your_database");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch customer orders from the database
    $sql = "SELECT * FROM items";
    $result = $conn->query($sql);

    $orders = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = array('item_name' => $row['item_name']);
        }
    }
    
    // Return orders as JSON
    echo json_encode($orders);
    
    // Close the database connection
    $conn->close();
?>
