<?php
// Include the database connection file
require_once 'database.php';

// Mail
require_once "../mail/mail.php";

// Check if provider ID is set in the POST request
if(isset($_POST['providerId'])) {
    // Sanitize the input to prevent SQL injection
    $providerId = $mysqli->real_escape_string($_POST['providerId']);
    
    // Update the status of the service provider as approved
    $updateSuccess = $mysqli->query("UPDATE freelance_service_provider SET status = 'approved' WHERE provider_id = '$providerId'");
    
    // Variable to track the success of email sending
    $emailSent = false;
    
    if($updateSuccess) {
        // Send the email asynchronously
        $emailSent = sendApprovalEmail($providerId, $mysqli);
        
        // If email is sent successfully
        if($emailSent) {
            // Return a success message if both database update and email sending are successful
            echo "Status updated successfully and email sent";
        } else {
            // Return an error message if email sending fails
            echo "Error sending email";
        }
    } else {
        // Return an error message if the database update fails
        echo "Error updating status: " . $mysqli->error;
    }
} else {
    // Return an error message if provider ID is not set
    echo "Provider ID not provided";
}

// Function to send approval email
function sendApprovalEmail($providerId, $mysqli) {
    $detailsQuery = "SELECT firstname, lastname, email FROM freelance_service_provider WHERE provider_id = '$providerId'";
    $result = $mysqli->query($detailsQuery);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['firstname'];
        $lastName = $row['lastname'];
        $providerEmail = $row['email'];

        $emailMessage = "<b>Congratulations<b><br><br>";
        $emailMessage .= "<b>We are thrilled to inform you that your application to become a service provider through our freelance service web application has been successful! Congratulations from the entire team at House Pro!

        You are now officially approved to offer your services to our valued customers. To get started, please visit our website and set up your profile. Once your profile is complete, you can begin providing your services to clients in need.
        
        We are confident that your expertise and skills will greatly benefit our platform and our clients. Thank you for choosing to join House Pro as a freelance service provider.
        
        If you have any questions or need assistance with setting up your profile, please don't hesitate to contact our support team. We are here to help you every step of the way.
        
        Once again, congratulations on becoming a part of the House Pro community. We look forward to seeing your success on our platform!<b><br><br>";
        $emailMessage .= "Thank You<br><br>";
        $emailMessage .= "Best Regards,<br>";
        $emailMessage .= "House Pro Team";

        // Send the email asynchronously
        return Mail::sendMail($providerEmail, $firstName . ' ' . $lastName, "Welcome to House Pro: Start Providing Services Today!", $emailMessage);
    } else {
        return false; // Return false if no details found or email not sent
    }
}
?>
