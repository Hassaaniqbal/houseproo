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
        <h1>You are almost there!</h1>
        <div class="card-header"></div>
        <div class="card-body">

    

            <h5 class="card-title"><strong>Thank you for applying to become a service provider!.</strong><br><br>

        We're excited to inform you that your application is currently under review, and we're pleased to invite you for an interview.
        <br>
<br>
You're one step closer to potentially joining our team, and we're eager to get to know you better.
<br>

When you're ready, simply click the button below to enter your interview. Alternatively, you can log out and return at your convenience.
<br>
<br>
We look forward to potentially welcoming you aboard soon!</h5>
            <p class="card-text"></p>

            <form action="" method="post">
            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4" id="btn">Attend interview</button>
            </form>

            <!--<a href="#" class="btn btn-primary" data-mdb-ripple-init>Got It</a>-->
            <form action="logout.php" method="post">
    <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4" id="btn" style="background-color: red;">Log Out</button>
</form>
            
        </div>
        <div class="card-footer text-muted"></div>
    </div>


    <!-- MDB -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>


        
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    

    <script>
        // Function to handle button click event
        document.getElementById("btn").addEventListener("click", function(event) {
            event.preventDefault(); // Prevent form submission
            // Show SweetAlert dialog
            Swal.fire({
                title: 'Interview Details',
                html: '1. You are able to attend or do the interview only once.<br><br>' +
                    '2. The interview will consist of 10 questions from your proffession and experience. Each have to be answered accordingly.<br><br>' +
                    '3. You will have 5 minutes for each question.<br><br>' +
                    '4. Your facial actions is being monitored. so dont try to copy.',
                icon: 'info',
                confirmButtonText: 'OK'
            }).then((result) => {
                // Redirect to quiz page if "OK" is clicked
                if (result.isConfirmed) {
                    window.location.href = 'quiz.php';
                }
            });
        });
    </script>



</body>

</html>