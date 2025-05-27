<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ticket_id"])) {
    $ticket_id = $_POST["ticket_id"];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "root", "iwt");
    if ($conn->connect_error) {
        http_response_code(500);
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL statement to delete the ticket
    $sql = "DELETE FROM tickets_info WHERE ticket_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ticket_id);
    if ($stmt->execute()) {
        // Ticket deleted successfully
        http_response_code(200);
        echo "success";
    } else {
        // Error occurred while deleting the ticket
        http_response_code(500);
        echo "error: " . mysqli_error($conn); // Include detailed error message
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request method or missing ticket ID
    http_response_code(400);
    echo "error: Invalid request";
}
?>
