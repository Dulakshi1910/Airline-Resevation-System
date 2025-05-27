<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are filled
    if (!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
        // Retrieve form data
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Create connection
        $conn = new mysqli("localhost", "root", "root", "iwt");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to insert data into the feedback table
        $sql = "INSERT INTO feedback (full_name, email, message) VALUES ('$full_name', '$email', '$message')";

        if ($conn->query($sql) === TRUE) {
            // Redirect back to contact page with success message
            header("Location: ../../contactus.php?success=1");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    } else {
        echo "All fields are required";
    }
} else {
    // Redirect to contactus.php if the form is not submitted
    header("Location: contactus.php");
    exit();
}
?>
