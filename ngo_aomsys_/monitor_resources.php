<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] != 'coordinator' && $_SESSION['role'] != 'admin')) {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Fetch detailed donation information
$query = "SELECT area, type, amount, shipping_preference FROM donations";
$donations_result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Monitor Resources</title>
</head>
<body>
<div class="container mt-5">
    <h2>Monitoring Resources</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Area</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Shipping Preference</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($donations_result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['area']); ?></td>
                <td><?php echo htmlspecialchars($row['type']); ?></td>
                <td><?php echo htmlspecialchars($row['amount']); ?></td>
                <td><?php echo htmlspecialchars($row['shipping_preference']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
