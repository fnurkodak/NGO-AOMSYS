<?php
session_start();
include 'config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'indigent') {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $monthly_income = $_POST['monthly_income'];
    $household_size = $_POST['household_size'];
    $num_children = $_POST['num_children'];
    $education_status = json_encode($_POST['education_status']);
    $employment_status = $_POST['employment_status'];
    $monthly_expenditures = $_POST['monthly_expenditures'];
    $support_needed = $_POST['support_needed'];

    $query = "INSERT INTO aid_requests (indigent_id, monthly_income, household_size, num_children, education_status, employment_status, monthly_expenditures, support_needed) VALUES ('$user_id', '$monthly_income', '$household_size', '$num_children', '$education_status', '$employment_status', '$monthly_expenditures', '$support_needed')";
    if (mysqli_query($conn, $query)) {
        echo "Aid request submitted successfully.";
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
    <title>Aid Request</title>
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
    <form class="form-group" method="POST" action="aid_request.php">
        Monthly Income: <input class="form-control" type="text" name="monthly_income" required><br>
        Household Size: <input class="form-control" type="text" name="household_size" required><br>
        Number of Children: <input class="form-control" type="text" name="num_children" required><br>
        Education Status (JSON format): <textarea name="education_status" required></textarea><br>
        Employment Status: <input class="form-control" type="text" name="employment_status" required><br>
        Monthly Expenditures: <input class="form-control" type="text" name="monthly_expenditures" required><br>
        Support Needed: <select class="form-control" name="support_needed">
            <option value="furniture">Furniture</option>
            <option value="food">Food</option>
            <option value="cash">Cash</option>
            <option value="medical">Medical</option>
        </select><br>
        <input class="form-control" type="submit" value="Request Aid">
    </form>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
</html>
</nav>