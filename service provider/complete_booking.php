<?php
// Include the database connection file
include 'database.php';

// Mail
require_once "../mail/mail.php";

// Initialize a variable to track success
$success = false;

// Check if the booking_id is provided in the query parameters
if (isset($_GET['booking_id'])) {
    // Retrieve the booking_id from the query parameters
    $booking_id = $_GET['booking_id'];

    // Update the status of the booking to "completed" and review_status to "pending" in the database
    $sql_update_booking = "UPDATE bookingg SET status = 'completed', review_status = 'pending' WHERE booking_id = ?";
    $stmt_update_booking = $mysqli->prepare($sql_update_booking);
    $stmt_update_booking->bind_param("i", $booking_id);

    if ($stmt_update_booking->execute()) {
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
                $emailMessage = "Thank you for utilizing House Pro for your household needs. We appreciate your trust in our platform. We hope your task was successfully completed. Your feedback is invaluable to us, so please feel free to review the service provider through our website.<br><br>";
                $emailMessage .= "<b>Booking details:<br>";
                $emailMessage .= "<b>Booking ID:<b> $booking_id<br>";
                $emailMessage .= "Thank You<br><br>";
                $emailMessage .= "Best Regards,<br>";
                $emailMessage .= "House Pro Team";

                // Send the email
                if (Mail::sendMail('hassaaniqbalcool1787@gmail.com', $firstname . ' ' . $lastname, "Thank You for Choosing House Pro!", $emailMessage)) {
                    $success = true; // Set success to true if email sending is successful
                }
            } else {
                // User not found
                echo 'error: User not found';
            }

            // Close the statement
            $stmt_select_user->close();
        } else {
            // Booking not found
            echo 'error: Booking not found';
        }

        // Close the statement
        $stmt_select_booking->close();
    } else {
        // If the update fails, return error message
        echo 'error';
    }

    // Close the statement
    $stmt_update_booking->close();
} else {
    // If booking_id is not provided, return error message
    echo 'error: Booking ID not provided';
}

// Close the database connection
$mysqli->close();

// Echo success message only if both update and email sending are successful
if ($success) {
    echo 'success';
}
?>
