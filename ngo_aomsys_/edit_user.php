<?php
session_start();
include 'config.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch user details
    $query = "SELECT id, username, email, role FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->bind_result($id, $username, $email, $role);
        $stmt->fetch();
        $stmt->close();
    }

    // Update user details
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        $query = "UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param('sssi', $username, $email, $role, $user_id);
            if ($stmt->execute()) {
                echo "User updated successfully.";
            } else {
                echo "Error updating user: " . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . htmlspecialchars($conn->error);
        }
    }
} else {
    echo "No user ID specified.";
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit User</title>
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
    <h1>Edit User</h1>
    <form class="form-group" method="POST" action="edit_user.php?id=<?php echo $user_id; ?>">
        Username: <input class="form-control" type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required><br>
        Email: <input class="form-control" type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>
        Role: <select class="form-control" name="role" required>
            <option value="donor" <?php if ($role == 'donor') echo 'selected'; ?>>Donor</option>
            <option value="volunteer" <?php if ($role == 'volunteer') echo 'selected'; ?>>Volunteer</option>
            <option value="indigent" <?php if ($role == 'indigent') echo 'selected'; ?>>Indigent</option>
            <option value="coordinator" <?php if ($role == 'coordinator') echo 'selected'; ?>>Coordinator</option>
            <option value="admin" <?php if ($role == 'admin') echo 'selected'; ?>>Admin</option>
        </select><br>
        <input class="form-control" type="submit" value="Update User">
    </form>
    <a href="manage_users.php">Back to Manage Users</a>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
</html>
</nav>