<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You need to log in first.";
    exit();
}

$user_id = $_SESSION['user_id'];

// Initialize variables with default values
$profession = '';
$avg_income = '';
$region = '';
$transport_availability = 'yes';
$edit_mode = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        $profession = mysqli_real_escape_string($conn, $_POST['profession']);
        $avg_income = mysqli_real_escape_string($conn, $_POST['avg_income']);
        $region = mysqli_real_escape_string($conn, $_POST['region']);
        $transport_availability = mysqli_real_escape_string($conn, $_POST['transport_availability']);

        $query = "INSERT INTO volunteers (user_id, profession, avg_income, region, transport_availability) VALUES (?, ?, ?, ?, ?)
                  ON DUPLICATE KEY UPDATE profession=VALUES(profession), avg_income=VALUES(avg_income), region=VALUES(region), transport_availability=VALUES(transport_availability)";

        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param('issss', $user_id, $profession, $avg_income, $region, $transport_availability);
            if ($stmt->execute()) {
                echo "Volunteer profile updated successfully.";
                $edit_mode = false; // Lock the form after updating
            } else {
                echo "Error executing query: " . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . htmlspecialchars($conn->error);
        }
    } elseif (isset($_POST['edit'])) {
        $edit_mode = true; // Enable edit mode
    }
}

// Fetch current volunteer details if available
$query = "SELECT profession, avg_income, region, transport_availability FROM volunteers WHERE user_id = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->bind_result($profession, $avg_income, $region, $transport_availability);
    $stmt->fetch();
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Volunteer Dashboard</title>
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
    <h1>Volunteer Dashboard</h1>
    <h2>Profile</h2>
    <form class="form-group" method="POST" action="volunteer_dashboard.php">
        Profession: <input class="form-control" type="text" name="profession" value="<?php echo htmlspecialchars($profession); ?>" <?php if (!$edit_mode) echo 'readonly'; ?> required><br>
        Average Annual Income: <input class="form-control" type="number" name="avg_income" value="<?php echo htmlspecialchars($avg_income); ?>" <?php if (!$edit_mode) echo 'readonly'; ?> required><br>
        Region: <input class="form-control" type="text" name="region" value="<?php echo htmlspecialchars($region); ?>" <?php if (!$edit_mode) echo 'readonly'; ?> required><br>
        Transport Availability: 
        <select class="form-control" name="transport_availability" <?php if (!$edit_mode) echo 'disabled'; ?>>
            <option value="yes" <?php if ($transport_availability == 'yes') echo 'selected'; ?>>Yes</option>
            <option value="no" <?php if ($transport_availability == 'no') echo 'selected'; ?>>No</option>
        </select><br>
        <?php if ($edit_mode): ?>
            <input class="form-control" type="submit" name="update" value="Update Profile">
        <?php else: ?>
            <input class="form-control" type="submit" name="edit" value="Edit Profile">
        <?php endif; ?>
    </form>
    <form class="form-group" method="POST" action="logout.php">
        <input class="form-control" type="submit" value="Logout">
    </form>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
</html>
</nav>