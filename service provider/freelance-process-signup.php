<?php

if (empty(trim($_POST["firstname"]))) {
    die("First name is required");
}

if (empty(trim($_POST["lastname"]))) {
    die("Last name is required");
}

if (empty(trim($_POST["number"]))) {
    die("Number is required");
}



if (empty($_POST['service_category'])) {
    die("Service category is required");
}

if (empty($_POST['area'])) {
    die("area is required");
}




if (empty(trim($_POST["email"]))) {
    die("Email is required");
}

$email = trim($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

$password = trim($_POST["password"]);
if (strlen($password) < 8) {
    die("Password must be at least 8 characters");
}


if (!preg_match("/[a-z]/i", $password)) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $password)) {
    die("Password must contain at least one number");
}

$password_confirmation = trim($_POST["password_confirmation"]);
if ($password !== $password_confirmation) {
    die("Passwords must match");
}

$firstname = trim($_POST["firstname"]);
$lastname = trim($_POST["lastname"]);
$number = trim($_POST["number"]);
$service_category = $_POST["service_category"];
$selected_area = $_POST["area"];

$password_hash = password_hash($password, PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

// Check if email is already taken
$email_check_query = "SELECT COUNT(*) FROM freelance_service_provider WHERE email = ?";
$stmt_email_check = $mysqli->prepare($email_check_query);
$stmt_email_check->bind_param("s", $email);
$stmt_email_check->execute();
$stmt_email_check->bind_result($email_count);
$stmt_email_check->fetch();
$stmt_email_check->close();

session_start();

$errors = [];

if ($email_count > 0) {
 /*
    die("email already taken");
   **/

    $_SESSION['error'] = "Email already taken";
    header("Location: freeelancesignup.php");
    exit;
    
}

$sql = "INSERT INTO freelance_service_provider (firstname, lastname, number, category, area, email, password)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sssssss", $firstname, $lastname, $number, $service_category, $selected_area, $email, $password_hash);

if ($stmt->execute()) {
    //header("login.html");
    header("Location: login.php");
    exit;
} else {
    die("Failed to execute query: " . $mysqli->error);
}

?>
