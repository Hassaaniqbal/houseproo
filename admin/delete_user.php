<?php
// Include the database connection file
include 'database.php';

// Check if user ID is provided and valid
if(isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
    // Prepare a delete statement
    $sql = "DELETE FROM users WHERE id = ?";

    if($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = $_POST['user_id'];

        // Attempt to execute the prepared statement
        if($stmt->execute()) {
            // Records deleted successfully
            echo "User deleted successfully.";
        } else {
            echo "Error deleting user.";
        }
    }
    // Close statement
    $stmt->close();
}
// Close connection
$mysqli->close();
?>
