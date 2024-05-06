<?php
// Start the session
session_start();

//Check if the session variables are set
if (isset ($_SESSION["provider_id"]) && isset ($_SESSION["name"]) && isset ($_SESSION["role"])) {
    $provider_id = $_SESSION["provider_id"];
    $name = $_SESSION["name"];
    $role = $_SESSION["role"];
    //Display the provider ID and name
    //echo "Provider ID: $provider_id <br>";
    //echo "Name: $name";
    //echo "Name: $role";

} else {
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

        #message {
            width: 600px;
            padding: 2rem;
        }

        #btn {
            background-color: #00BF63;
            /* Change the button color */
        }

        #btn:hover {
            background-color: #00BF63;
            /* Change the button color on hover */
        }
    </style>

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
</head>

<body>


    <div class="card text-center" id="message">
        <h1>You are almost there!</h1>
        <div class="card-header"></div>
        <div class="card-body">

       
            <h5 class="card-title"><strong>Thank you for completing the interview!.</strong><br><br>

                We're excited to inform you that your application and the interview answers is currently under review,
                <br>

                and we're eager to get to know you better.
                <br>

                We look forward to potentially welcoming you aboard soon!
            </h5>
            <p class="card-text"></p>

            <form action="logout.php" method="post">
                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4" id="btn">Got
                    it</button>
            </form>

            

        </div>
        <div class="card-footer text-muted"></div>
    </div>


    <!-- MDB -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

</body>

</html>