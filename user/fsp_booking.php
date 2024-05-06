<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  // Return error response if user is not logged in
  http_response_code(401);
  echo "User not logged in.";
  exit;
}

// Include the database connection file
require_once "database.php";
// Mail
require_once "../mail/mail.php";


// Get data from session
$user_id = $_SESSION['user_id'];
$provider_id = $_POST['providerId'];
$datetime = $_SESSION['datetime'];
$description = $_SESSION['description'];
$address = $_SESSION['address'];
$category = $_SESSION['service_type'];
$status = 'pending'; // Default status
$sptype = 'freelance';


// Print received data for debugging
print_r($_POST);

// Initialize variables to store provider details
$provider_firstname = "";
$provider_lastname = "";
$provider_email = "";

// Fetch provider details from the database
$select_sql = "SELECT firstname, lastname, email FROM freelance_service_provider WHERE provider_id = ?";
$select_stmt = $mysqli->prepare($select_sql);
if ($select_stmt === false) {
  // Return error response if SQL statement preparation fails
  http_response_code(500);
  echo "Error preparing SQL statement: " . $mysqli->error;
  exit;
}

// Bind parameters and execute the statement
$select_stmt->bind_param("i", $provider_id);
if (!$select_stmt->execute()) {
  // Return error response if execution fails
  http_response_code(500);
  echo "Error executing SQL statement: " . $select_stmt->error;
  exit;
}

// Bind result variables
$select_stmt->bind_result($provider_firstname, $provider_lastname, $provider_email);

// Fetch provider details
if (!$select_stmt->fetch()) {
  // Return error response if provider not found
  http_response_code(404);
  echo "Provider not found.";
  exit;
}

// Close the statement
$select_stmt->close();





// Prepare SQL statement to insert booking data
$sql = "INSERT INTO bookingg (user_id, provider_id, booking_datetime, description, address, sptype, status, category) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
if ($stmt === false) {
  // Return error response if SQL statement preparation fails
  http_response_code(500);
  echo "Error preparing SQL statement: " . $mysqli->error;
  exit;
}

// Bind parameters and execute the statement
$stmt->bind_param("iissssss", $user_id, $provider_id, $datetime, $description, $address, $sptype, $status, $category);
if (!$stmt->execute()) {
  // Return error response if execution fails
  http_response_code(500);
  echo "Error executing SQL statement: " . $stmt->error;
  exit;
}

// Close the statement
$stmt->close();

// Return success response
http_response_code(200);
echo "Booking saved successfully.";


// Compose the email message
$emailMessage = "We are delighted to inform you that you have been selected to provide a service for one of our esteemed customers. This email serves as a notification to visit our site for further details regarding the booking and to proceed with delivering the service.<br><br>";
$emailMessage .= "<b>Booking details:<b><br>";
$emailMessage .= "<b>Date and Time:<b> $datetime<br>";
$emailMessage .= "<b>Description:<b> $description<br>";
$emailMessage .= "<b>Address:<b> $address<br><br>";
$emailMessage .= "Thank You<br><br>";
$emailMessage .= "Best Regards,<br>";
$emailMessage .= "House Pro Team";

// Send the email
Mail::sendMail($provider_email, $provider_firstname.' '.$provider_lastname, "Booking Details", $emailMessage); //replace the email


?>
