<?php
session_start();
include 'config.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Check if user ID is set
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Start transaction
    $conn->begin_transaction();

    // Delete related records from donations table
    $query = "DELETE FROM donations WHERE donor_id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $user_id);
        if (!$stmt->execute()) {
            echo "Error deleting donations: " . htmlspecialchars($stmt->error);
            $conn->rollback();
            exit();
        }
        $stmt->close();
    } else {
        echo "Error preparing statement for donations: " . htmlspecialchars($conn->error);
        $conn->rollback();
        exit();
    }

    // Delete related records from aid_requests table
    $query = "DELETE FROM aid_requests WHERE indigent_id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $user_id);
        if (!$stmt->execute()) {
            echo "Error deleting aid requests: " . htmlspecialchars($stmt->error);
            $conn->rollback();
            exit();
        }
        $stmt->close();
    } else {
        echo "Error preparing statement for aid requests: " . htmlspecialchars($conn->error);
        $conn->rollback();
        exit();
    }

    // Delete related records from volunteers table
    $query = "DELETE FROM volunteers WHERE user_id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $user_id);
        if (!$stmt->execute()) {
            echo "Error deleting volunteers: " . htmlspecialchars($stmt->error);
            $conn->rollback();
            exit();
        }
        $stmt->close();
    } else {
        echo "Error preparing statement for volunteers: " . htmlspecialchars($conn->error);
        $conn->rollback();
        exit();
    }

    // Delete user from users table
    $query = "DELETE FROM users WHERE id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $user_id);
        if ($stmt->execute()) {
            echo "User deleted successfully.";
        } else {
            echo "Error deleting user: " . htmlspecialchars($stmt->error);
            $conn->rollback();
            exit();
        }
        $stmt->close();
    } else {
        echo "Error preparing statement for user: " . htmlspecialchars($conn->error);
        $conn->rollback();
        exit();
    }

    // Commit transaction
    $conn->commit();
} else {
    echo "No user ID specified.";
}

// Close the connection
$conn->close();

// Redirect to manage_users.php
header('Location: manage_users.php');
exit();
?>
</nav>