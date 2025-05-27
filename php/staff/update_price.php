<?php
session_start();

// Check if the user is not logged in or is not an admin
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "STAFF") {
    // Redirect to the login page or any other page for unauthorized access
    header("Location: ../login.php");
    exit;
}

// Check if flight ID and new price are set in the request
if (isset($_POST['id']) && isset($_POST['price'])) {
    // Sanitize input to prevent SQL injection
    $flight_id = intval($_POST['id']);
    $new_price = floatval($_POST['price']);

    // Connect to the database
    $conn = new mysqli("localhost", "root", "root", "iwt");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the update statement
    $stmt = $conn->prepare("UPDATE available_flights SET price = ? WHERE id = ?");
    $stmt->bind_param("di", $new_price, $flight_id);

    // Execute the update statement
    if ($stmt->execute()) {
        header("Location: ../login.php");
        echo "success";
    } else {
        // Update failed, return error response
        echo "error";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request, return error response
    echo "error";
}
?>
