<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
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
    <title>plumbing form</title>

    <link rel="stylesheet" type="text/css" href="./css/cleaningform.css" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <!-- md-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts 
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

</head>

<body>

<header>
            <nav class="navbar navbar-expand-lg bg-white">

                <div class="container-fluid " id="container-fluid">

                    <a class="navbar-brand" href="indexin.html">
                        <img src="./assets/images/green/1.png" alt="Logo" width="200" height="60"
                            class="d-inline-block align-text-top">
                    </a>

                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">

                            <li class="nav-item">
                                <a class="nav-link active text-dark" style="font-weight: 700" aria-current="page"
                                    href="indexin.php">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active text-dark" style="font-weight: 700" aria-current="page"
                                    href="#sectiontwo">Services</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-dark" style="font-weight: 700" href="servicesin.html">Book a
                                    service</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-dark" style="font-weight: 700" href="#">My service</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-dark" style="font-weight: 700" href="account.php">Account</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-dark" style="font-weight: bold; color: red;"
                                    href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

    <main id="main">
        <section>

            <h2 style="font-weight: 700; color: black; margin-top: 3rem; margin-bottom: 2rem;">Plumbing
            </h2>

            <div class="card" id="cleaningform">
                <div class="card-body">

                    <form>
                        <!-- Date time picker -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label for="datetime">Date & Time:</label>
                            <input type="datetime-local" id="datetime" name="datetime">
                        </div>
                        <!-- Text input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="address" class="form-control" name="address" />
                            <label class="form-label" for="address">Address</label>
                        </div>
                        <!-- Message input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <textarea class="form-control" id="description" rows="4" name="description"></textarea>
                            <label class="form-label" for="description">Description of the service needed</label>
                        </div>
                        <!-- Submit button -->
                        <button data-mdb-ripple-init type="button" class="btn btn-primary btn-block mb-4"
                            id="viewServiceProvidersBtn">View Service Providers</button>
                    </form>

                    <script>
                        document.getElementById("viewServiceProvidersBtn").addEventListener("click", function () {
                            // Get the form data
                            var datetime = document.getElementById("datetime").value;
                            var address = document.getElementById("address").value;
                            var description = document.getElementById("description").value;

                            // Check if any of the form fields are empty
                            if (datetime === "" || address === "" || description === "") {
                                alert("Please fill out all the fields.");
                                return; // Prevent further execution if any field is empty
                            }

                            var serviceType = "Plumbing"; // Assuming plumbing is the service type

                            // Redirect to the service providers page with the form data as query parameters
                            var queryParams = new URLSearchParams({
                                datetime: datetime,
                                address: address,
                                description: description,
                                service_type: serviceType
                            });
                            window.location.href = "serviceproviders.php?" + queryParams.toString();
                        });

                    </script>






                </div>
            </div>
        </section>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>


    <!--md-->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

</body>

</html>