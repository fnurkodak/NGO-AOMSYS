<?php
session_start();
include 'config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Manage Users</title>
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
    <h1>Users</h1>
    <table class="table table-striped" border="1">
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Username</th>
            <th class="text-center">Email</th>
            <th class="text-center">Role</th>
            <th class="text-center">Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td class="text-center"><?php echo $user['id']; ?></td>
            <td class="text-center"><?php echo $user['username']; ?></td>
            <td class="text-center"><?php echo $user['email']; ?></td>
            <td class="text-center"><?php echo $user['role']; ?></td>
            <td class="text-center">
                <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a>
                <a href="delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="admin_dashboard.php">Back to Dashboard</a>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
</html>
</nav>