<?php
session_start();

// Check if the customer is logged in
if (!isset($_SESSION['customer_id'])) {
    // Redirect to login page or display an error message
    header("Location: login.html");
    exit();
}

// Display success message if redirected from process_order.php with success parameter
if (isset($_GET['success']) && $_GET['success'] == 1) {
    // Display customer ID for debugging
    echo '<p>Customer ID: ' . $_SESSION['customer_id'] . '</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Page</title>
    <link rel="stylesheet" href="customer.css">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@300&family=Kanit:ital@1&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="left">
            <img src="img/icons8_Account_50px.png" alt="">
            <div>Customer</div>
        </div>
        <div class="mid">
            <ul class="navbar">
                <li><a href="index.html">Home</a></li>
                <li><a href="#">Order History</a></li>
                <li><a href="#">Payments</a></li>
                <li><a href="#">Helper Details</a></li>
                <li><a href="#">Extra(FFU)</a></li>
            </ul>
        </div>
        <div class="right">
            <button class="btn">Call us</button>
            <button class="btn">E-mail us</button>
        </div>
    </header>
    <div class="container">
        <h1>Enter the items you want to buy</h1>
        <form action="process_order.php" method="post">
            <!-- Use an array for item names to allow adding multiple items -->
            <div class="form-group">
                <input type="text" name="items[]" placeholder="Item 1">
            </div>
            <div class="form-group">
                <input type="text" name="items[]" placeholder="Item 2">
            </div>
            <div class="form-group">
                <input type="text" name="items[]" placeholder="Item 3">
            </div>
            <!-- Allow dynamic addition of more items -->
            <div id="additional-items"></div>
            <button type="button" onclick="addNewItem()">Add Item</button>
            <input type="submit" value="Place Order">
        </form>
    </div>

    <!-- Add a simple script to dynamically add more item fields -->
    <script>
        function addNewItem() {
            var container = document.getElementById('additional-items');
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'items[]';
            input.placeholder = 'Additional Item';
            container.appendChild(input);
        }
    </script>
</body>
</html>
