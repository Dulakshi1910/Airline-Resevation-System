<?php
session_start();

if (!isset($_SESSION["username"])) {
    // If the user is not logged in, redirect to login page
    header("Location: login.php");
    exit;
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the username parameter is set
    if (isset($_POST["username"])) {
        // Retrieve the username from the POST parameters
        $username = $_POST["username"];
        
        // Connect to the database
        $conn = new mysqli("localhost", "root", "root", "iwt");
        
        // Check connection
        if ($conn->connect_error) {
            // If connection fails, return error response
            http_response_code(500);
            echo "Connection failed: " . $conn->connect_error;
            exit;
        }
        
        // Prepare a delete statement
        $sql_delete_user = "DELETE FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql_delete_user);
        
        if (!$stmt) {
            // If statement preparation fails, return error response
            http_response_code(500);
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            exit;
        }
        
        // Bind parameters and execute the delete statement
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            session_destroy();
            http_response_code(200);
            echo "User deleted successfully";
            header("Location: ../signup.php");
            exit;
        } else {
            // If deletion fails, return error response
            http_response_code(500);
            echo "Error deleting user: " . $conn->error;
            exit;
        }
    } else {
        // If username parameter is not set, return error response
        http_response_code(400);
        echo "Username parameter is missing";
        exit;
    }
} else {
    // If request method is not POST, return error response
    http_response_code(405);
    echo "Method Not Allowed";
    exit;
}
?>
