<?php
// Include the database connection file
require_once "database.php";

// Mail
require_once "../mail/mail.php";

// Initialize a variable to track the success of both operations
$success = false;

// Check if the booking_id is provided
if (isset($_GET['booking_id'])) {
    // Retrieve the booking_id
    $booking_id = $_GET['booking_id'];

    // Update the status of the booking to 'cancelled'
    $sql = "UPDATE bookingg SET status = 'cancelled' WHERE booking_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $booking_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Close the statement
        $stmt->close();

        // Retrieve provider_id and sptype
        $sql_provider = "SELECT provider_id, sptype FROM bookingg WHERE booking_id = ?";
        $stmt_provider = $mysqli->prepare($sql_provider);
        $stmt_provider->bind_param("i", $booking_id);
        $stmt_provider->execute();
        $stmt_provider->bind_result($provider_id, $sptype);
        $stmt_provider->fetch();
        $stmt_provider->close();

        // Initialize variables to store provider information
        $provider_firstname = "";
        $provider_lastname = "";
        $provider_email = "";

        // Fetch provider information based on sptype
        if ($sptype == "company") {
            $sql_company = "SELECT firstname, lastname, email FROM company_service_provider WHERE provider_id = ?";
            $stmt_company = $mysqli->prepare($sql_company);
            $stmt_company->bind_param("i", $provider_id);
            $stmt_company->execute();
            $stmt_company->bind_result($provider_firstname, $provider_lastname, $provider_email);
            $stmt_company->fetch();
            $stmt_company->close();
        } elseif ($sptype == "freelance") {
            $sql_freelance = "SELECT firstname, lastname, email FROM freelance_service_provider WHERE provider_id = ?";
            $stmt_freelance = $mysqli->prepare($sql_freelance);
            $stmt_freelance->bind_param("i", $provider_id);
            $stmt_freelance->execute();
            $stmt_freelance->bind_result($provider_firstname, $provider_lastname, $provider_email);
            $stmt_freelance->fetch();
            $stmt_freelance->close();
        }

        // Construct email message
        $emailMessage = "We wanted to inform you that the booking has been cancelled by the customer<br><br>";
        $emailMessage .= "<b>Booking details:<b><br>";
        $emailMessage .= "<b>Booking ID:<b> $booking_id<br><br>";
        $emailMessage .= "Thank You<br><br>";
        $emailMessage .= "Best Regards,<br>";
        $emailMessage .= "House Pro Team";

        // Send the email
        if (Mail::sendMail('$provider_email', $provider_firstname . ' ' . $provider_lastname, "Booking Cancellation", $emailMessage)) {
            $success = true;
        }
    }
}

// Check if both cancellation and email sending were successful
if ($success) {
    // Success message
    echo "success";
} else {
    // Error message
    echo "error";
}

// Close the database connection
$mysqli->close();
?>
