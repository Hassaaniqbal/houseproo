<?php
// Include the database connection file
require_once "database.php";

// Mail
require_once "../mail/mail.php";

// Check if the booking_id is provided
if (isset($_GET['booking_id'])) {
    // Retrieve the booking_id
    $booking_id = $_GET['booking_id'];

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

            // Update the status of the booking to 'cancelled'
            $sql_update_booking = "UPDATE bookingg SET status = 'cancelled' WHERE booking_id = ?";
            $stmt_update_booking = $mysqli->prepare($sql_update_booking);
            $stmt_update_booking->bind_param("i", $booking_id);

            // Execute the statement
            if ($stmt_update_booking->execute()) {

                // Compose the email message
                $emailMessage = "We regret to inform you that your booking has been cancelled by the service provider. We apologize for any inconvenience this may cause. Please don't hesitate to explore alternative service providers through our website. We're here to assist you in finding the perfect match for your needs.<br><br>";
                $emailMessage .= "<b>Booking details:<br>";
                $emailMessage .= "<b>Booking ID:<b> $booking_id<br>";
                $emailMessage .= "Thank You<br><br>";
                $emailMessage .= "Best Regards,<br>";
                $emailMessage .= "House Pro Team";

                // Send the email
                Mail::sendMail('hassaaniqbalcool1787@gmail.com', $firstname . ' ' . $lastname, "Booking Cancellation", $emailMessage);//change the exact mail

                echo "success";
            } else {
                echo "error";
            }

            // Close the statement
            $stmt_update_booking->close();
        } else {
            // User not found
            echo "error: User not found";
        }
    } else {
        // Booking not found
        echo "error: Booking not found";
    }

    // Close the statement and connection
    $stmt_select_user->close();
    $stmt_select_booking->close();
    $mysqli->close();
} else {
    // If booking_id is not provided, return an error
    echo "error: Booking ID not provided";
}
?>
