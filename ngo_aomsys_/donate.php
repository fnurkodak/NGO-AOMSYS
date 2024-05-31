<?php
session_start();
include 'config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'donor') {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $donor_id = $_SESSION['user_id'];
    $area = $_POST['area'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $shipping_preference = $_POST['shipping_preference'];

    $query = "INSERT INTO donations (donor_id, area, type, amount, shipping_preference) VALUES ('$donor_id', '$area', '$type', '$amount', '$shipping_preference')";
    if (mysqli_query($conn, $query)) {
        echo "Donation successful.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Donate</title>
</head>
<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">NGO Management System</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    <form class="form-group" method="POST" action="donate.php">
        Area: <input class="form-control" type="text" name="area" required><br>
        Type: <select class="form-control" name="type">
            <option value="cash">Cash</option>
            <option value="food">Food</option>
            <option value="clothing">Clothing</option>
            <option value="furniture">Furniture</option>
        </select><br>
        Amount: <input class="form-control" type="text" name="amount" required><br>
        Shipping Preference: <select class="form-control" name="shipping_preference">
            <option value="self">Self</option>
            <option value="collect">Collect</option>
        </select><br>
        <input class="form-control" type="submit" value="Donate">
    </form>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
</html>
</nav>