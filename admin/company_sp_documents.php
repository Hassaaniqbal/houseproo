<?php
require_once 'database.php';

// Check if providerId is set and numeric
if (isset($_POST['providerId']) && is_numeric($_POST['providerId'])) {
  $providerId = $_POST['providerId'];

  // Fetch details from both tables based on provider ID
  $sql = "SELECT * FROM company_service_provider csp INNER JOIN company_sp_documents csd ON csp.provider_id = csd.provider_id WHERE csp.provider_id = ?";
  $stmt = $mysqli->prepare($sql);

  if (!$stmt) {
    die("Error in prepared statement: " . $mysqli->error);
  }

  $stmt->bind_param("i", $providerId);
  if (!$stmt->execute()) {
    die("Error executing prepared statement: " . $stmt->error);
  }

  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Fetch and display details
    $row = $result->fetch_assoc();


    // Display Profile Picture
    //echo "<p><strong>Profile Picture:</strong></p>";
    
    echo "<img src='../service provider/uploads/pictures/" . $row['picture'] . "' alt='Profile Picture' class='rounded mx-auto d-block'  style='width: 200px; height: 200px; margin-bottom: 1rem;'><br>";


    echo "<p><strong>Name:</strong> " . $row['firstname'] . " " . $row['lastname'] . "</p>";
    echo "<p><strong>Number:</strong> " . $row['number'] . "</p>";
    echo "<p><strong>Category:</strong> " . $row['category'] . "</p>";
    echo "<p><strong>Area:</strong> " . $row['area'] . "</p>";
    echo "<p><strong>Role:</strong> " . $row['role'] . "</p>";
    echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
    echo "<p><strong>Address:</strong> " . $row['address'] . "</p>";
    echo "<p><strong>Zip Code:</strong> " . $row['zipcode'] . "</p>";
    echo "<p><strong>Company Name:</strong> " . $row['companyname'] . "</p>";
    echo "<p><strong>Company Address:</strong> " . $row['companyaddress'] . "</p>";
    echo "<p><strong>Date:</strong> " . $row['date'] . "</p>";

    

    // Display NIC Images
    echo "<p><strong>NIC Images:</strong></p>";
    $NICs = json_decode($row['NIC'], true); // Decode JSON string into an array
    if (!empty($NICs)) {
      foreach ($NICs as $NIC) {

        echo "<img src='../service provider/uploads/nics/$NIC' alt='NIC Image'  class='img-fluid'  style='width: 300px; height: auto; margin-bottom: 1rem;'><br><br>";
      }
    } else {
      echo "No NIC images found.";
    }

    // Display Certificate Images
    echo "<p><strong>Certificate Images:</strong></p>";
    $certificates = json_decode($row['certificate'], true); // Decode JSON string into an array
    if (!empty($certificates)) {
      foreach ($certificates as $certificate) {
        echo "<img src='../service provider/uploads/certificates/$certificate' alt='Certificate Image' width='100%' height='600px' style='margin-bottom: 2rem; margin-top: 1rem;' ><br><br>";
        //echo "$certificate";//to check the destination
      }
    } else {
      echo "No certificate images found.";
    }

    echo "<p><strong>Permission Letter:</strong></p>";
    if (!empty($row['permissionletter'])) {
      echo "<iframe src='../service provider/uploads/permissionletters/" . $row['permissionletter'] . "' width='100%' height='600px'></iframe>";
    } else {
      echo "No permission letter found.";
    }

  } else {
    echo "No details found.";
  }

  $stmt->close();
} else {
  echo "Invalid request.";
}
?>