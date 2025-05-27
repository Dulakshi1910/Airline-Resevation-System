<?php
session_start();

if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "ADMIN") {
    header("HTTP/1.1 403 Forbidden");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    // Connect to the database
    $conn = new mysqli("localhost", "root", "root", "iwt");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a delete statement
    $stmt = $conn->prepare("DELETE FROM available_flights WHERE id = ?");
    $stmt->bind_param("i", $flightId);

    // Set parameters and execute
    $flightId = $_POST["id"];
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("HTTP/1.1 400 Bad Request");
    exit;
}
?>
