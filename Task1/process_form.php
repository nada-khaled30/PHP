<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form inputs
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Validate inputs
    if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid input. Please fill in both name and a valid email address.";
    } else {
        // Display confirmation message
        echo "Thank you, $name! Your email ($email) has been submitted.";
    }
} else {
    // Redirect if accessed directly
    header("Location: index.html");
    exit();
}
?>