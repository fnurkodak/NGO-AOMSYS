<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'indigent') {
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
    <title>Indigent Dashboard</title>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container mt-5">
        <h1 class="text-center">Welcome, Indigent!</h1>
        <div class="text-center mt-4">
            <a href="aid_request.php" class="btn btn-primary">Request Aid</a>
            <a href="logout.php" class="btn btn-secondary">Logout</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
