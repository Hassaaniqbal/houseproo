<?php
// Include or require the file that establishes the database connection
require_once 'database.php';

// Check if providerId is provided
if (isset($_POST['providerId'])) {
    $providerId = $_POST['providerId'];

    // Query to check if the provider is approved
    $query = "SELECT status FROM company_service_provider WHERE provider_id = ?";
    
    // Prepare and execute the statement
    $stmt = $pdo->prepare($query);
    $stmt->execute([$providerId]);
    
    // Fetch the result
    $result = $stmt->fetchColumn();

    if ($result === 'approved') {
        echo 'approved';
    } else {
        echo 'not_approved';
    }
} else {
    // If providerId is not provided, return an error
    echo 'error';
}
?>
