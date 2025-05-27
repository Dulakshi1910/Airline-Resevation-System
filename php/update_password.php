<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];
    $confNew_password = $_POST["confNew_password"];

    $conn = new mysqli("localhost", "root", "root", "iwt");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION["username"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($old_password === $user["password"]) {
      
        if ($new_password === $confNew_password) {
     
            $update_sql = "UPDATE users SET password = ? WHERE username = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ss", $new_password, $_SESSION["username"]);
            $update_stmt->execute();

            if ($update_stmt->affected_rows > 0) {
                echo "Password updated successfully";
                header("Location: ../login.php");
            } else {
                echo "Failed to update password";
            }

            $update_stmt->close();
        } else {
            echo "New passwords do not match";
        }
    } else {
        echo "Incorrect old password";
    }

    $stmt->close();
    $conn->close();
}
?>
