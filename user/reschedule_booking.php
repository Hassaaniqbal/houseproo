<?php
// Include the database connection file
include 'database.php';

// Mail
require_once "../mail/mail.php";



// Start the session
session_start();

// Check if the user is logged in
if (!isset ($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit;
}

// Check if the booking_id and new_datetime are provided in the POST request
if (isset ($_POST['booking_id']) && isset ($_POST['new_datetime'])) {
    // Retrieve the booking_id and new_datetime from the POST request
    $booking_id = $_POST['booking_id'];
    $new_datetime = $_POST['new_datetime'];

    // Update the bookingg table with the new datetime
    $sql_update = "UPDATE bookingg SET booking_datetime = ? WHERE booking_id = ?";
    $stmt_update = $mysqli->prepare($sql_update);
    $stmt_update->bind_param("si", $new_datetime, $booking_id);
    $stmt_update->execute();

    // Check if the update was successful
    if ($stmt_update->affected_rows > 0) {

        
        // Fetch provider_id and sptype from bookingg table
        $sql_booking = "SELECT provider_id, sptype FROM bookingg WHERE booking_id = ?";
        $stmt_booking = $mysqli->prepare($sql_booking);
        $stmt_booking->bind_param("i", $booking_id);
        $stmt_booking->execute();
        $stmt_booking->store_result();

        // Check if booking exists
        if ($stmt_booking->num_rows > 0) {
            $stmt_booking->bind_result($provider_id, $sptype);
            $stmt_booking->fetch();

            // Close the statement
            $stmt_booking->close();

            // Initialize variables to store provider details
            $provider_firstname = "";
            $provider_lastname = "";
            $provider_email = "";

            // Fetch provider details based on sptype
            if ($sptype == "company") {
                // Fetch provider details from company_service_provider table
                $sql_provider = "SELECT firstname, lastname, email FROM company_service_provider WHERE provider_id = ?";
            } elseif ($sptype == "freelance") {
                // Fetch provider details from freelance_service_provider table
                $sql_provider = "SELECT firstname, lastname, email FROM freelance_service_provider WHERE provider_id = ?";
            }

            // Prepare and execute statement to fetch provider details
            $stmt_provider = $mysqli->prepare($sql_provider);
            $stmt_provider->bind_param("i", $provider_id);
            $stmt_provider->execute();
            $stmt_provider->store_result();

            // Check if provider details were fetched
            if ($stmt_provider->num_rows > 0) {
                $stmt_provider->bind_result($provider_firstname, $provider_lastname, $provider_email);
                $stmt_provider->fetch();

                // Close the statement
                $stmt_provider->close();

                // Compose the email message
                $emailMessage = "We wanted to inform you that there has been a change in the booking schedule by the customer. The service has been rescheduled to a new time.<br><br>";
                $emailMessage .= "<b>Booking details:<b><br>";
                $emailMessage .= "<b>Booking ID:<b> $booking_id<br>";
                $emailMessage .= "<b>Updated Date and Time:<b> $new_datetime<br>";
                $emailMessage .= "Thank You<br><br>";
                $emailMessage .= "Best Regards,<br>";
                $emailMessage .= "House Pro Team";

                // Send the email
                Mail::sendMail($provider_email, $provider_firstname . ' ' . $provider_lastname, "Booking Reschedule", $emailMessage);

                

                // Return success message
                echo 'success';
            } else {
                // Provider details not found
                echo 'error';
            }
        } else {
            // Booking not found
            echo 'error';
        }
    } else {
        // Update unsuccessful
        echo 'error';
    }
} else {
    // Return error message if booking_id and new_datetime are not provided
    echo 'error';
}

//the ui dont shoowcase properly. backend does properly
?>