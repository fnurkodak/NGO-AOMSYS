<?php
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $role = $_POST['role'];

    $query = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$password', '$email', '$role')";
    if (mysqli_query($conn, $query)) {
        echo "Registration successful.";
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
    <title>Register</title>
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
    <form class="form-group" method="POST" action="register.php">
        Username: <input class="form-control" type="text" name="username" required><br>
        Password: <input class="form-control" type="password" name="password" required><br>
        Email: <input class="form-control" type="email" name="email" required><br>
        Role: <select class="form-control" name="role">
            <option value="donor">Donor</option>
            <option value="volunteer">Volunteer</option>
            <option value="indigent">Indigent</option>
            <option value="coordinator">Coordinator</option>
        </select><br>
        <input class="form-control" type="submit" value="Register">
    </form>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
</html>
</nav>