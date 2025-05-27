<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $staff_name = htmlspecialchars($_POST["staff_name"]);
    $user_name = htmlspecialchars($_POST["username"]);
    $staff_password = $_POST["staff_password"]; // No need to sanitize as it's not displayed
    $role = $_POST["role"]; // No need to sanitize as it's selected from predefined options
    $email = $_POST["email"];

    // Database connection
    $conn = new mysqli("localhost", "root", "root", "iwt");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, password, role, full_name,email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user_name, $staff_password, $role, $staff_name, $email);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Staff added successfully.";
        header("Location: ../../admin/admin.php");
    } else {
        echo "Error adding staff: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
