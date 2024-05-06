<?php
include 'database.php';

// Mail
require_once "../mail/mail.php";

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["provider_id"]) && !isset($_SESSION["name"]) && !isset($_SESSION["role"])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $booking_id = $_POST['booking_id'];
    $booking_datetime = $_POST['booking_datetime'];

    // Update booking status and datetime in the database
    $sql_select_booking = "SELECT user_id FROM bookingg WHERE booking_id = ?";
    $stmt_select_booking = $mysqli->prepare($sql_select_booking);
    $stmt_select_booking->bind_param("i", $booking_id);
    $stmt_select_booking->execute();
    $stmt_select_booking->store_result();

    if ($stmt_select_booking->num_rows > 0) {
        $stmt_select_booking->bind_result($user_id);
        $stmt_select_booking->fetch();

        // Fetch user details from users table
        $sql_select_user = "SELECT firstname, lastname, email FROM users WHERE id = ?";
        $stmt_select_user = $mysqli->prepare($sql_select_user);
        $stmt_select_user->bind_param("i", $user_id);
        $stmt_select_user->execute();
        $stmt_select_user->store_result();

        if ($stmt_select_user->num_rows > 0) {
            $stmt_select_user->bind_result($firstname, $lastname, $email);
            $stmt_select_user->fetch();

            // Update booking status and datetime in the database
            $sql_update_booking = "UPDATE bookingg SET status = 'accepted', booking_datetime = ? WHERE booking_id = ?";
            $stmt_update_booking = $mysqli->prepare($sql_update_booking);
            $stmt_update_booking->bind_param("si", $booking_datetime, $booking_id);

            // Execute the statement
            if ($stmt_update_booking->execute()) {

                // Compose the email message
                $emailMessage = "Your booking has been accepted by the service provider. To stay updated or make any changes, please visit our site.<br><br>";
                $emailMessage .= "<b>Booking details:<br>";
                $emailMessage .= "<b>Booking ID:<b> $booking_id<br>";
                $emailMessage .= "<b>Date and Time:<b> $booking_datetime<br>";
                $emailMessage .= "Thank You<br><br>";
                $emailMessage .= "Best Regards,<br>";
                $emailMessage .= "House Pro Team";

                // Send the email
                Mail::sendMail($email, $firstname . ' ' . $lastname, "Booking Accepted", $emailMessage);

                // Booking successfully updated
                echo "success";
            } else {
                // Error occurred
                echo "error";
            }
        } else {
            // User not found
            echo "User not found";
        }
    } else {
        // Booking not found
        echo "Booking not found";
    }

} else {
    // If not a POST request, redirect to the previous page
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
?>
