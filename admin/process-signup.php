<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        die("Username is required");
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        die("Password is required");
    }

    // Check if confirm password is empty
    if (empty(trim($_POST["password_confirmation"]))) {
        die("Confirm password is required");
    }

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $password_confirmation = trim($_POST["password_confirmation"]);

    // Check if passwords match
    if ($password !== $password_confirmation) {
        die("Passwords do not match");
    }

    // Password validation
    if (strlen($password) < 8) {
        die("Password must be at least 8 characters long");
    }

    // Hash the password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Your database connection code
    require_once 'database.php'; // Include database connection script

    // Insert user data into database
    $stmt = $mysqli->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");

    // Bind parameters
    $stmt->bind_param("ss", $username, $password_hash);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to login page after successful signup
        header("Location: login.php");
        exit;
    } else {
        die("Failed to execute query: " . $mysqli->error);
    }
}
?>
