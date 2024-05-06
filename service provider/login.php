<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ . "/database.php";

    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    // Query to check in company_service_provider table
    $sql_company = sprintf(
        "SELECT * FROM company_service_provider WHERE email = '%s'",
        $mysqli->real_escape_string($email)
    );

    $result_company = $mysqli->query($sql_company);

    $user_company = $result_company->fetch_assoc();

    // Query to check in freelance_service_provider table
    $sql_freelance = sprintf(
        "SELECT * FROM freelance_service_provider WHERE email = '%s'",
        $mysqli->real_escape_string($email)
    );

    $result_freelance = $mysqli->query($sql_freelance);

    $user_freelance = $result_freelance->fetch_assoc();

    // Check if the email exists in either table and verify password
    if ($user_company && password_verify($password, $user_company["password"])) {
        $user = $user_company;
        $role = $user_company["role"]; // Get role from company_service_provider table
    } elseif ($user_freelance && password_verify($password, $user_freelance["password"])) {
        $user = $user_freelance;
        $role = $user_freelance["role"]; // Get role from freelance_service_provider table
    } else {
        // Invalid login
        $is_invalid = true;
    }

    if (isset($user)) {
        session_start();
        session_regenerate_id();
        $_SESSION["provider_id"] = $user["provider_id"];
        $_SESSION["name"] = $user["firstname"];
        $_SESSION["role"] = $role;
        

        // After setting up the session variables
if ($role === "company") {
    // Check if verification is completed for company_service_provider
    if ($user["verification_completed"] == 1) {
        // Check the status
        $status = $user["status"];
        if ($status === "approved") {
            // Redirect to home page if status is approved
            header("Location: home.php"); 
            exit;
        } else {
            // Redirect to status page if verification is completed but status is not approved
            header("Location: status.php");
            exit;
        }
    } else {
        // Redirect to verification page if verification is pending
        header("Location: companyverification.php");
        exit;
    }
    
} elseif ($role === "freelance") {
    // Check if verification is completed for freelance_service_provider
    if ($user["verification_completed"] == 1) {
        // Check if there are interview responses in the responses table for this provider_id
        $sql_responses_check = sprintf(
            "SELECT * FROM responses WHERE provider_id = %d",
            $user["provider_id"]
        );
        $result_responses_check = $mysqli->query($sql_responses_check);
        
        if ($result_responses_check->num_rows > 0) {
            // Redirect to freelance_status2.php if interview has been completed
            header("Location: freelance_status2.php");
            exit;
        } else {
            // Check the status
            $status = $user["status"];
            if ($status === "approved") {
                // Redirect to home page if status is approved and interview not completed
                header("Location: home.php"); 
                exit;
            } else {
                // Redirect to status page if verification is completed but status is not approved and interview not completed
                header("Location: freelance_status.php");
                exit;
            }
        }
    } else {
        // Redirect to verification page if verification is pending
        header("Location: freelanceverification.php");
        exit;
    }
}

        
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>service provider login</title>

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

                    <img src="./assets/images/green/1.png" alt="Logo" height="70" width="300"
                        style=" display: block; margin: auto;">

                    <!-- Email input -->
                    <span style="color: red; font-weight: normal;">
                        <?php if ($is_invalid): ?>
                            <em>Invalid login</em>
                        <?php endif; ?>
                    </span>

                    <div data-mdb-input-init class="form-outline mb-4" style="margin-top: 2rem;">
                        <input type="email" id="email" name="email" class="form-control"
                            value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" />
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
                        <p>don't have an account, <a href="choose.html" class="green-link">sign up</a>.</p>
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