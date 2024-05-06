<?php
session_start();

// Check if session variables are set
if(isset($_SESSION["provider_id"]) && isset($_SESSION["name"])) {
    // Session variables are set, display them
    echo "Provider ID: " . $_SESSION["provider_id"] . "<br>";
    echo "Provider Name: " . $_SESSION["name"];
} else {
    // Session variables are not set
    echo "Session variables are not set";
}
?>