<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit;
}

// Include the database connection file
require_once "database.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user_id = $_SESSION['user_id'];
    $booking_id = $_POST['bookingId'];
    $rating = $_POST['rating'];
    $review = $_POST['review_text'];

    // Insert review into reviews table
    $insertReviewQuery = "INSERT INTO reviews (booking_id, user_id, rating, review_text) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($insertReviewQuery);
    if ($stmt === false) {
        die("Error preparing statement: " . $mysqli->error);
    }
    if (!$stmt->bind_param("iiis", $booking_id, $user_id, $rating, $review)) {
        die("Error binding parameters: " . $stmt->error);
    }
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }

    // Update review_status in bookingg table
    $updateStatusQuery = "UPDATE bookingg SET review_status = 'completed' WHERE booking_id = ?";
    $stmt = $mysqli->prepare($updateStatusQuery);
    if ($stmt === false) {
        die("Error preparing statement: " . $mysqli->error);
    }
    if (!$stmt->bind_param("i", $booking_id)) {
        die("Error binding parameters: " . $stmt->error);
    }
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }

    // Close statement
    $stmt->close();

    // Close the database connection
    $mysqli->close();

    // Redirect to the home page
    header("Location: indexin.php");
    exit;
} else {
    // Redirect to the home page if form is not submitted
    header("Location: indexin.php");
    exit;
}
?>
