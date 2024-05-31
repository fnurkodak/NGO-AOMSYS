<?php
session_start();
include 'config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'coordinator') {
    header('Location: login.php');
    exit();
}

$query = "SELECT * FROM aid_requests";
$result = mysqli_query($conn, $query);
$requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>View Aid Requests</title>
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
    <h1>Aid Requests</h1>
    <table class="table table-striped" border="1">
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Indigent ID</th>
            <th class="text-center">Monthly Income</th>
            <th class="text-center">Household Size</th>
            <th class="text-center">Number of Children</th>
            <th class="text-center">Education Status</th>
            <th class="text-center">Employment Status</th>
            <th class="text-center">Monthly Expenditures</th>
            <th class="text-center">Support Needed</th>
            <th class="text-center">Request Date</th>
        </tr>
        <?php foreach ($requests as $request): ?>
        <tr>
            <td class="text-center"><?php echo $request['id']; ?></td>
            <td class="text-center"><?php echo $request['indigent_id']; ?></td>
            <td class="text-center"><?php echo $request['monthly_income']; ?></td>
            <td class="text-center"><?php echo $request['household_size']; ?></td>
            <td class="text-center"><?php echo $request['num_children']; ?></td>
            <td class="text-center"><?php echo $request['education_status']; ?></td>
            <td class="text-center"><?php echo $request['employment_status']; ?></td>
            <td class="text-center"><?php echo $request['monthly_expenditures']; ?></td>
            <td class="text-center"><?php echo $request['support_needed']; ?></td>
            <td class="text-center"><?php echo $request['request_date']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="operation_dashboard.php">Back to Dashboard</a>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
</html>
</nav>