<?php
// Start the session if not already started
session_start();

// Check if the user is logged in
if (!isset($_SESSION['provider_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            /* Adjust this to control the height of the centered section */
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        h1 {
            font-size: 36px;
            /* Adjust as needed */
        }

        #message
{
    width: 600px;
    padding: 2rem;
}

#btn {
    background-color: #00BF63; /* Change the button color */
}

#btn:hover {
    background-color: #00BF63; /* Change the button color on hover */
}
    </style>

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
</head>

<body>


    <div class="card text-center" id="message">
        <h1>You are almost there</h1>
        <div class="card-header"></div>
        <div class="card-body">
            <h5 class="card-title">Thank you for applying to become a service provider. Your application is currently
                under review and you can expect to receive a notification with the results within 3 business days. We
                appreciate your patience as we complete the background check and final review. We are excited to
                potentially welcome you aboard soon!</h5>
            <p class="card-text"></p>

            <!--<a href="#" class="btn btn-primary" data-mdb-ripple-init>Got It</a>-->
            <form action="logout.php" method="post">
            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4" id="btn">Got It</button>
            </form>
            
        </div>
        <div class="card-footer text-muted">3 days to ago</div>
    </div>


    <!-- MDB -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

</body>

</html>