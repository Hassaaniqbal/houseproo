<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Services</title>
</head>

<link rel="stylesheet" type="text/css" href="./css/myservices.css" />


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

<script src="./javascript/update_availability.js"></script>

<!-- Include the jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
                                href="home.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active text-dark" style="font-weight: 700" aria-current="page"
                                href="myservices.php">My services</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-dark" style="font-weight: 700" href="sp_profile.php">Account</a>
                        </li>
                        <button onclick="logout()">Logout</button>

                        <script>
                            function logout() {
                                window.location.href = 'logout.php';
                            }
                        </script>


                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <main id="main">

        <section id="sectionone">
            <h2 style="font-weight: 700;  color: black;">My Services</h2>

            <div class="form-check form-switch" style="margin-left: auto;">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                    onclick="updateAvailability()">

                <label class="form-check-label" for="flexSwitchCheckDefault"
                    style="margin-left: 1rem; font-weight: 600; color: black;">Availability</label>
            </div>


        </section>

        <section id="sectiontwo" style="margin-top: 3rem;">

            <?php
            // Start the session
            session_start();

            // Check if the session variables are set
            if (isset($_SESSION["provider_id"]) && isset($_SESSION["name"]) && isset($_SESSION["role"])) {
                // Include database connection file
                include_once "database.php";

                // Get provider ID and role from session
                $provider_id = $_SESSION["provider_id"];
                $role = $_SESSION["role"];
                $name = $_SESSION["name"];

                // Fetch bookings from the database
                $query = "SELECT b.booking_id, b.provider_id, b.user_id, b.address, b.booking_datetime, b.category, b.status, u.firstname, u.lastname, u.picture 
              FROM Bookingg b
              INNER JOIN users u ON b.user_id = u.id
              WHERE b.provider_id = '$provider_id' AND b.sptype = '$role' AND b.status NOT IN ('completed', 'cancelled') ORDER BY b.booking_datetime DESC"; //check whether correctly displaying
                $result = mysqli_query($mysqli, $query);

                // Check if there are any bookings
                if (mysqli_num_rows($result) > 0) {
                    // Fetch and display bookings
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="card">';
                        echo '<div class="card-body">';
                        echo '<div class="list-group-item d-flex justify-content-between align-items-center">';

                        echo '<div class="d-flex align-items-center">';
                        // Check if picture is available
                        $picture_src = !empty($row['picture']) ? "../user/" . $row['picture'] : "./assets/images/userprofile.jpg";
                        echo '<img src="' . $picture_src . '" alt="" style="width: 60px; height: 60px" class="rounded-circle" />';
                        echo '<div class="ms-3">';



                        echo '<p class="fw-bold mb-1" style="font-size: 1.2em;">' . $row['firstname'] . ' ' . $row['lastname'] . '</p>';

                        echo '<p class="text-muted mb-0">Booking ID: ' . $row['booking_id'] . '</p>';
                        //echo '<p class="text-muted mb-0">Provider ID: ' . $row['provider_id'] . '</p>';
                        //echo '<p class="text-muted mb-0">User ID: ' . $row['user_id'] . '</p>';
                        echo '<p class="text-muted mb-0">Category: ' . $row['category'] . '</p>';
                        echo '<p class="text-muted mb-0">Address: ' . $row['address'] . '</p>';
                        echo '<p class="text-muted mb-0">Booking Date & Time: ' . $row['booking_datetime'] . '</p>';
                        echo '<p class="text-muted mb-0">Booking Status: ' . $row['status'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo "<button type='button' class='btn btn-success' data-mdb-ripple-init onclick=\"window.location.href='booking_details.php?booking_id=" . $row['booking_id'] . "';\">View</button>";
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '<br>';
                    }
                } else {
                    echo "No bookings available.";
                }

                // Close database connection
                mysqli_close($mysqli);
            } else {
                // Redirect to login page if session variables are not set
                header("Location: login.php");
                exit;
            }
            ?>






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