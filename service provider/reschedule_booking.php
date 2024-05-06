<?php
// Include the database connection file
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

// Check if the booking_id and new_datetime are provided in the POST request
if (isset($_POST['booking_id']) && isset($_POST['new_datetime'])) {
    // Retrieve the booking_id and new_datetime from the POST request
    $booking_id = $_POST['booking_id'];
    $new_datetime = $_POST['new_datetime'];

    // Update the bookingg table with the new datetime
    $sql_update_booking = "UPDATE bookingg SET booking_datetime = ? WHERE booking_id = ?";
    $stmt_update_booking = $mysqli->prepare($sql_update_booking);
    $stmt_update_booking->bind_param("si", $new_datetime, $booking_id);
    $stmt_update_booking->execute();

    // Check if the update was successful
    if ($stmt_update_booking->affected_rows > 0) {
        // Fetch user_id associated with the booking_id
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

                // Compose the email message
                $emailMessage = "Your booking has been rescheduled by the service provider.<br><br>";
                $emailMessage .= "<b>Booking details:<br>";
                $emailMessage .= "<b>Booking ID:<b> $booking_id<br>";
                $emailMessage .= "<b>Date and Time:<b>$new_datetime <br>";
                $emailMessage .= "Thank You<br><br>";
                $emailMessage .= "Best Regards,<br>";
                $emailMessage .= "House Pro Team";

                // Send the email
                Mail::sendMail('hassaaniqbalcool1787@gmail.com', $firstname . ' ' . $lastname, "Booking Rescheduled", $emailMessage);//change the exact mail

                // Perform any subsequent actions here
                echo 'success';
            } else {
                // User not found
                echo 'error: User not found';
            }
        } else {
            // Booking not found
            echo 'error: Booking not found';
        }
    } else {
        // Return error message
        echo 'error: Unable to update booking';
    }
} else {
    // Return error message if booking_id and new_datetime are not provided
    echo 'error: Missing parameters';
}
?>
