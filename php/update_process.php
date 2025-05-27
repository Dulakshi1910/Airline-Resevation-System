<?php 
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "root", "iwt");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $username = $_POST["username"];
    $email = $_POST["email"];

    $sql = "UPDATE users SET full_name = ?, email = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $full_name, $email, $_SESSION["username"]);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "User details updated successfully";
        header("Location: ../userProfile.php");
        exit;
    } else {
        echo "Failed to update user details";
    }

    $stmt->close();

}

?>