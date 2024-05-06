<?php
// Assuming you have already started the session and set the user_id
session_start();

$user_id = $_SESSION['user_id'];

// Include your database connection file here
include_once "database.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle file uploads and other form data
    $picture = $_FILES["picture"];
    $phone_number = $_POST["number"]; // Assuming this is the input field for the phone number

    // Validate form inputs
    $errors = [];
    
    // Validate picture
    if (!file_exists($picture["tmp_name"]) || !is_uploaded_file($picture["tmp_name"])) {
        $errors[] = "Please upload a picture.";
    }
    // Validate phone number
    if (empty($phone_number)) {
        $errors[] = "Phone number is required.";
    }

    // If there are no errors, update the database
    if (empty($errors)) {
        // Upload directory
        $upload_directory = 'uploads/';

        // Handle picture upload
        $picture_name = $picture["name"];
        $target_file = $upload_directory . basename($picture_name);
        
        if (move_uploaded_file($picture["tmp_name"], $target_file)) {
            // Update picture location and name in database
            $sql = "UPDATE users SET picture = '$target_file' WHERE id = $user_id"; 
            if ($mysqli->query($sql) === TRUE) {
                $picture_message = "Picture updated successfully. ";
            } else {
                $errors[] = "Error updating picture: " . $mysqli->error;
            }
        } else {
            $errors[] = "Sorry, there was an error uploading your picture.";
        }

        // Update phone number in database
        $sql = "UPDATE users SET number = '$phone_number' WHERE id = $user_id"; 
        if ($mysqli->query($sql) === TRUE) {
            $phone_message = "Phone number updated successfully.";
        } else {
            $errors[] = "Error updating phone number: " . $mysqli->error;
        }

        // Close connection
        $mysqli->close();

        // If there are no errors, redirect to the same page after displaying success message
        if (empty($errors)) {
            echo "<script>
                    window.onload = function() {
                        alert('$picture_message\\n$phone_message');
                        window.location.href = 'account.php';
                    };
                  </script>";
            exit; // Stop executing PHP code to prevent displaying HTML content below
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
        echo "<a href='javascript:history.go(-1)'>Go back</a>"; // Provide a way to go back to the form
    }
}
?>
