<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit;
}



// Include database connection
$mysqli = require __DIR__ . "/database.php";

// Fetch user data based on user ID stored in session
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if user data is fetched successfully
if (!$user) {
    echo "Error: User data not found!";
    exit;
}

// Extract user details
$first_name = $user['firstname'];
$last_name = $user['lastname'];
$number = $user['number'];
$email = $user['email'];


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User profile</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<link rel="stylesheet" type="text/css" href="./css/spprofile.css" />


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


<!-- md-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
<!-- Google Fonts 
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  -->

<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@12">

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

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
                                <a class="nav-link text-dark" style="font-weight: 700" href="servicesin.php">Book a
                                    service</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-dark" style="font-weight: 700" href="myservices.php">My service</a>
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
        <section id="sectionone">

            <div class="card">
                <div class="card-body">

                    <div style="display: flex; align-items: center;">


                        


                            <?php if (!empty($user['picture'])): ?>
                            <img src="<?php echo $user['picture']; ?>" class="img-fluid rounded"
                                style="height: 12rem; width: 12rem;" alt="Profile Picture" />
                                <?php else: ?>
                        <div style="display: flex; align-items: center;">
                            <!-- Default icon with similar styling -->
                            <img src="uploads/userprofile.jpg" class="img-fluid rounded"
                                style="height: 12rem; width: 12rem; border-radius:50%" alt="Profile Picture" />
                                <?php endif; ?>


                        <div>



                            <h4 style="margin-left: 1rem; color: black; font-weight: 600;"><i
                                    style="margin-right: 1rem;" class="fa-solid fa-user"></i>
                                <?php echo $first_name . " " . $last_name; ?>
                            </h4>
                            <p style="margin-left:1rem; font-weight: 500;"><i style="margin-right: 1rem;"
                                    class="fa-solid fa-envelope"></i>
                                <?php echo "" . $email; ?>
                            </p>
                            <p style="margin-left:1rem; font-weight: 500;"><i style="margin-right: 1rem;"
                                    class="fa-solid fa-phone"></i>
                                <?php echo "" . $number; ?>
                            </p>

                            <a style="margin-left:1rem;" href="logout.php" class="btn btn-danger" role="button">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>


                        </div>
                    </div>

                    <h4 style="color: black; font-weight: 600; margin-top: 2rem;"></h4>
                    <p style="font-size: 20px;"></p>


                    <!--
                  <h5 class="card-title" style="margin-top: 2rem;">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <button type="button" class="btn btn-primary" data-mdb-ripple-init>Button</button>
                  -->




                </div>
            </div>
        </section>

        <br><br>
        <section>
            <div class="card" id="cardd">
                <div class="card-body">






                    <form action="updateprofile.php" method="post" enctype="multipart/form-data">
                        <p>UPDATE DETAILS</p>
                        <label class="form-label" for="customFile">Current picture of yourself</label>
                        <input type="file" class="form-control" id="picture" name="picture" accept="image/*" required />
                        <br>
                        <!--phone number input-->
                        <span id="number-error" class="error-message" style="color: red; font-weight: normal;"></span>
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="tel" id="number" name="number" class="form-control" />
                            <label class="form-label" for="number">Phone number</label>
                        </div>

                        <!-- Submit button -->
                        <button data-mdb-ripple-init type="submit"
                            class="btn btn-primary btn-block mb-4">Update</button>
                    </form>
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