<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";

    $username = trim($_POST["username"] ?? ""); 
    $password = trim($_POST["password"] ?? "");

    $sql = sprintf("SELECT * FROM admin
                    WHERE username = '%s'", // Change 'email' to 'username'
                   $mysqli->real_escape_string($username));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($password, $user["password"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            
            header("Location: users.php");
            exit;
        }
    }
    
    $is_invalid = true;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin User login</title>

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
                <form action="login.php" method="post">

                    <img src="./assets/images/1.png" alt="Logo" height="70" width="300"
                        style=" display: block; margin: auto;">

                    <h3 style="font-weight: 600; margin-top: 2rem; color: black; text-align: center;">Admin</h3>
                    
                    <!-- Name input -->
                    <span style="color: red; font-weight: normal;">
                    <?php if ($is_invalid): ?>
                        <em>Invalid login</em>
                    <?php endif; ?></span>

                    <div data-mdb-input-init class="form-outline mb-4" style="margin-top: 2rem;">
                        <input type="text" id="form4Example1" name="username" class="form-control" />
                        <label class="form-label" for="form4Example1">User Name</label>
                    </div>
    
                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="form3Example4" name="password" class="form-control" />
                        <label class="form-label" for="form3Example4">Password</label>
                    </div>

                    <!-- Submit button -->
                    <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">log in</button>

                    <div class="noaccount">
                        <p>don't have an account, <a href="signup.html" class="green-link">sign up</a>.</p>
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
