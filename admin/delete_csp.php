<?php
// Include the database connection file
require_once 'database.php';

// Check if the delete_provider_id is set in the POST request
if (isset($_POST['delete_provider_id'])) {
    // Get the provider ID from the POST request
    $delete_provider_id = $_POST['delete_provider_id'];

    // SQL query to delete associated records from company_sp_documents
    $delete_documents_query = "DELETE FROM company_sp_documents WHERE provider_id = '$delete_provider_id'";

    // Perform the deletion query for associated documents
    if ($mysqli->query($delete_documents_query)) {
        // Now, delete the service provider from the company_service_provider table
        $delete_query = "DELETE FROM company_service_provider WHERE provider_id = '$delete_provider_id'";

        // Perform the deletion query for the service provider
        if ($mysqli->query($delete_query)) {
            // If deletion is successful, echo a success message
            echo "Service provider with ID $delete_provider_id and associated documents have been successfully deleted.";
            
        } else {
            // If deletion of service provider fails, echo an error message
            echo "Error deleting service provider: " . $mysqli->error;
        }
    } else {
        // If deletion of associated documents fails, echo an error message
        echo "Error deleting associated documents: " . $mysqli->error;
    }
} else {
    // If delete_provider_id is not set in the POST request, echo an error message
    echo "Error: Delete provider ID not specified.";
}

// Close the database connection
$mysqli->close();
?>
