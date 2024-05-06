<?php
session_start();
require_once 'database.php'; // Include database connection file

// Mail
require_once "../mail/mail.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if the provider ID is provided
  if (isset($_POST["providerId"])) {
    $providerId = $_POST["providerId"];

    // Update the database to mark the provider as rejected
    $sql = "UPDATE freelance_service_provider SET status = 'rejected' WHERE provider_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $providerId);

    if ($stmt->execute()) {
      // Fetch provider's email for sending rejection notification
      $emailQuery = "SELECT email, firstname, lastname FROM freelance_service_provider WHERE provider_id = ?";
      $stmtEmail = $mysqli->prepare($emailQuery);
      $stmtEmail->bind_param("s", $providerId);
      $stmtEmail->execute();
      $resultEmail = $stmtEmail->get_result();
      $rowEmail = $resultEmail->fetch_assoc();
      $providerFirstName = $rowEmail["firstname"];
      $providerLastName = $rowEmail["lastname"];
      $providerEmail = $rowEmail["email"];

      // Send rejection email
      // Compose the email message
      $emailMessage = "Dear sir,<br><br>";
      $emailMessage .= "<b>After careful review and consideration, we regret to inform you that we have chosen not to move forward with your application at this time after the background check and interview result. We appreciate the time and effort you dedicated to the application process and wish you the best in your future endeavors.<br>";
      $emailMessage .= "Thank You<br><br>";
      $emailMessage .= "Best Regards,<br>";
      $emailMessage .= "House Pro Team";

      // Send the email
      Mail::sendMail($providerEmail, $providerFirstName . ' ' . $providerLastName, "Rejection Email", $emailMessage);
      // Provide a success response
      echo "Provider rejected successfully. Rejection email sent.";
    } else {
      // Provide an error response if the update fails
      echo "Error rejecting provider. Please try again.";
    }
  } else {
    // If provider ID is not provided, return an error
    echo "Provider ID not provided.";
  }
} else {
  // If the request method is not POST, return an error
  echo "Invalid request method.";
}
?>
