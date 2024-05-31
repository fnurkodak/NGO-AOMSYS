
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'coordinator') {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Schedule Operations</title>
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
    <h1>Schedule Operations</h1>
    <!-- Form to schedule operations -->
    <form class="form-group" method="POST" action="schedule_operations.php">
        Operation Type: 
        <select class="form-control" name="type">
            <option value="collection">Collection</option>
            <option value="distribution">Distribution</option>
            <option value="publicity">Publicity</option>
        </select><br>
        Scheduled Date: <input class="form-control" type="date" name="scheduled_date" required><br>
        Details: <textarea name="details"></textarea><br>
        <input class="form-control" type="submit" value="Schedule">
    </form>
    <a href="coordinator_dashboard.php">Back to Dashboard</a>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
</html>
</nav>