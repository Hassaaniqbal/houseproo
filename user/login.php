<?php
$is_invalid = false;

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include the database connection file
    $mysqli = require __DIR__ . "/database.php";

    // Retrieve email and password from POST data
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    // Query the database to find the user by email
    $sql = sprintf("SELECT * FROM users WHERE email = '%s'", $mysqli->real_escape_string($email));
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    // Verify user credentials
    if ($user && password_verify($password, $user["password"])) {
        // Regenerate session ID for security
        session_regenerate_id(true);

        // Store user ID and name in session variables
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["firstname"];

        // Redirect to index page after successful login
        header("Location: indexin.php");
        exit;
    } else {
        // Set flag for invalid login attempt
        $is_invalid = true;
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User login</title>

    <link rel="stylesheet" type="text/css" href="./css/login.css" />

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <!-- Google Fonts 
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    -->

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>


</head>


<body>
    <section>
        <div class="card" id="registerform">
            <div class="card-body">


            
                <form method="post">

                    <img src="./assets/images/green/1.png" alt="Logo" height="70" width="300" style=" display: block; margin: auto;" >

                   
                    
                    <!-- Email input -->
                    <span style="color: red; font-weight: normal;">
                    <?php if ($is_invalid): ?>
                        <em>Invalid login</em>
                    <?php endif; ?></span>
                    <div data-mdb-input-init class="form-outline mb-4" style="margin-top: 1rem;">
                   
                        <input type="email" id="email" name="email" class="form-control"   value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" />
                        <label class="form-label" for="form3Example3">Email address</label>
                    </div>
    
                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="password" name="password" class="form-control" />
                        <label class="form-label" for="form3Example4">Password</label>
                    </div>

                    <!-- Submit button -->
                    <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">log in</button>

                    <div class="noaccount">
                        <p>don't have an account, <a href="signup.php" class="green-link">sign up</a>.</p>
                    </div>                    
    
                </form>
            </div>
          </div>
    </section>


    <!-- MDB -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>