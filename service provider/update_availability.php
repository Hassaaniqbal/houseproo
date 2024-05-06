<?php
session_start();

// Include the database connection file
require_once 'database.php';

// Retrieve the role from the session
$role = $_SESSION['role'];
echo "Role from session: $role\n"; // Debugging: Output role to check if session is correctly set

// Retrieve the provider ID from the session
$provider_id = $_SESSION['provider_id'];
echo "Provider ID from session: $provider_id\n"; // Debugging: Output provider ID to check if session is correctly set

// Retrieve the availability value from the request
$availability = isset($_POST['availability']) ? $_POST['availability'] : 0;
echo "Availability received: $availability\n"; // Debugging: Output received availability value

// Determine the table name based on the role
$table_name = '';
if ($role === 'company') {
    $table_name = 'company_service_provider';
} elseif ($role === 'freelance') {
    $table_name = 'freelance_service_provider';
}
echo "Table name: $table_name\n"; // Debugging: Output table name

if ($table_name !== '') {
    // Perform the database update
    $sql = "UPDATE $table_name SET availability = $availability WHERE provider_id = $provider_id";

    if ($mysqli->query($sql) === TRUE) {
        echo "Availability updated successfully\n";
    } else {
        echo "Error updating availability: " . $mysqli->error;
    }
} else {
    echo "Invalid role";
}

// Close the database connection
$mysqli->close();
?>
