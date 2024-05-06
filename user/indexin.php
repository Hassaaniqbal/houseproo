<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit;
}

//session_start();

//if (isset($_SESSION["user_id"])) {

//  $mysqli = require __DIR__ . "/database.php";

//$sql = "SELECT * FROM users
//      WHERE id = {$_SESSION["user_id"]}";

//$result = $mysqli->query($sql);

//$user = $result->fetch_assoc();
//}

?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Pro</title>



    <link rel="stylesheet" type="text/css" href="./css/style.css" />


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
    <div>
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



        <main>
            <div id="main">
                <section id="sectionone">
                    <h1 class="display-5" style="font-weight: bold;" id="sectiononepar">Connect directly with top-tier
                        service
                        providers for<br> your
                        household needs, right at your fingertips.</h1>

                    

                </section>


                <section id="sectiontwo">
                    <div id="sectiontwoin">

                        <h2 style="font-weight: 700;">Our Services</h2>

                        <p id="sectiontwopar">Instantly book highly rated service providers for cleaning to handyman
                            services.
                        </p>

                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <div class="col">

                                <div class="card h-100">
                                    <a href="cleaning.php">
                                        <img src="./assets/images/cleaning.jpg" class="card-img-top" alt="..."
                                            id="imgg">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title" style="color: #00BF63; font-weight: bold;">Cleaning &
                                            Maintenance</h5>
                                        <p class="card-text">From regular maintenance to deep cleaning, our platform
                                            connects you with
                                            expert cleaners dedicated to ensuring your home is spotless and inviting.
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <a href="plumbing.php">
                                        <img src="./assets/images/plumbing.jpg" class="card-img-top" alt="..."
                                            id="imgg">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title" style="color: #00BF63; font-weight: bold;">Plumbing
                                        </h5>
                                        <p class="card-text">Connect with skilled plumbers for all your plumbing needs.
                                            From leaky faucets
                                            to complex installations.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <a href="painting.php">
                                        <img src="./assets/images/painting.png" class="card-img-top" alt="..."
                                            id="imgg">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title" style="color: #00BF63; font-weight: bold;">Painting
                                        </h5>
                                        <p class="card-text">Transform your living spaces with the help of skilled
                                            painters available on
                                            House Pro. From touch-ups to complete makeovers, connect you with painters
                                            who bring color and
                                            precision to your home.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <a href="electrical.php">
                                        <img src="./assets/images/electrical.jpg" class="card-img-top" alt="..."
                                            id="imgg">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title" style="color: #00BF63; font-weight: bold;">Electrical
                                        </h5>
                                        <p class="card-text">Ensure the safety and efficiency of your home's electrical
                                            systems by booking
                                            experienced electricians. Whether it's wiring, installations, or repairs.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <a href="electronic.php">
                                        <img src="./assets/images/electronic.jpg" class="card-img-top" alt="..."
                                            id="imgg">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title" style="color: #00BF63; font-weight: bold;">Electronic
                                        </h5>
                                        <p class="card-text">From malfunctioning gadgets to home appliance tune-ups, our
                                            service providers
                                            have the technical know-how to keep your electronics running smoothly.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <a href="handyman.php">
                                        <img src="./assets/images/handyman.jpg" class="card-img-top" alt="..."
                                            id="imgg">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title" style="color: #00BF63; font-weight: bold;">Handyman
                                        </h5>
                                        <p class="card-text">From furniture assembly to general repairs, our platform
                                            ensures you find
                                            skilled professionals to handle various tasks efficiently.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: center; align-items: center;">
                            <a href="servicesin.php">
                                <button type="button" class="btn btn-success btn-lg"
                                    style="margin-top: 2rem; font-weight: 540;">View All Services</button>
                            </a>
                        </div>

                    </div>
                </section>



                <section id="sectionthree">
                    <div id="sectionthreein">
                        <h2 style="font-weight: 700" id="sectionthreeh2">Your satisfaction, guaranteed</h2>
                        <div class="container text-left">

                            <div class="row">

                                <div class="col">
                                    <p class="h4" style="font-weight: 700">Happiness Pledge</p>
                                    <br>
                                    <p class="h5" style="font-weight: 450;">If you’re not satisfied, <br>we’ll work to
                                        make it right.</p>
                                </div>
                                <div class="col">
                                    <p class="h4" style="font-weight: 700">Vetted Service Providers</p>
                                    <br>
                                    <p class="h5" style="font-weight: 450;">Service providers are always background<br>
                                        checked before
                                        joining the platform.</p>
                                </div>
                                <div class="col">
                                    <p class="h4" style="font-weight: 700">Dedicated Support</p>
                                    <br>
                                    <p class="h5" style="font-weight: 450;">Friendly service when you need us –
                                        <br>every day of the week.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="sectionfour">
                    <div id="sectionfourin">
                        <!--
            <img src="./assets/images/sectionfour.png" alt="..." style="margin-left: auto; margin-right: auto; display: block; margin-bottom: 10px;" height="500" width="auto">
            <br>
            <h2 style="font-weight: 700; text-align: center;">Choose either company based or freelance based service provider.</h2>
            -->

                        <div class="container text-left">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h2 style="font-weight: 700"><span
                                            style="font-weight: 700; font-size: 55px;">"</span>Choose either company
                                        based or freelance based service provider. <span
                                            style="font-weight: 700; font-size: 55px;">"</span></h2>
                                </div>
                                <div class="col">
                                    <img src="./assets/images/sectionfour.png" class="img-fluid" alt="...">
                                </div>



                            </div>
                </section>

                <section id="sectionfive">
                    <div id="sectionfivein">
                        <h2 style="font-weight: 700">How it works</h2>
                        <br><br>
                        <div class="container text-center">
                            <div class="row align-items-center">
                                <div class="col">
                                    <img src="./assets/images/sectionfive1.png" alt="..." height="300" width="300">
                                    <br><br>
                                    <p class="h5" style="font-weight: 500;">Choose a Service provider by price, skills,
                                        and reviews.</p>
                                </div>
                                <div class="col">
                                    <img src="./assets/images/sectionfive2.png" alt="..." height="300" width="300">
                                    <br><br>
                                    <p class="h5" style="font-weight: 500;">Schedule a service provider as early as
                                        today.</p>

                                </div>
                                <div class="col">
                                    <img src="./assets/images/sectionfive3.png" alt="..." height="300" width="300">
                                    <br>
                                    <p class="h5" style="font-weight: 500;">Chat, get the work done, pay and review.</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="sectionsix">
                    <div id="sectionsixin">
                        <div class="container text-left">
                            <div class="row align-items-start">
                                <div class="col">
                                    <img src="./assets/images/handyman.jpg" class="img-fluid" alt="...">
                                </div>
                                <div class="col">
                                    <br>
                                    <br>
                                    <h2 style="font-weight: 700">Are you a service provider ?</h2>
                                    <br>
                                    <p class="h5" style="font-weight: 450;">House Pro is always looking for service
                                        professionals who are
                                        experts in their trade and provide great service to their customers. The best
                                        home service
                                        professionals use House Pro to find jobs with no lead fees and flexible
                                        scheduling.
                                    </p>
                                    <br>
                                    <button type="button" class="btn btn-success btn-lg">Become a service
                                        provider</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <!-- Footer -->
                <footer class="text-center text-lg-start bg-body-tertiary text-muted"
                    style="font-family: 'Poppins', sans-serif;">
                    <!-- Section: Social media -->
                    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                        <!-- Left -->
                        <div class="me-5 d-none d-lg-block" id="footerdivoneleft">
                            <span>Get connected with us on social networks:</span>
                        </div>
                        <!-- Left -->

                        <!-- Right -->
                        <div id="footerdivoneright">
                            <a href="" class="me-4 text-reset">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="" class="me-4 text-reset">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="" class="me-4 text-reset">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="" class="me-4 text-reset">
                                <i class="fab fa-instagram"></i>
                            </a>

                        </div>
                        <!-- Right -->
                    </section>
                    <!-- Section: Social media -->

                    <!-- Section: Links  -->
                    <section class="">
                        <div class="container text-center text-md-start mt-5">
                            <!-- Grid row -->
                            <div class="row mt-3">
                                <!-- Grid column -->
                                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                                    <!-- Content -->
                                    <!--<img src="./assets/images/green/1.png" alt="Logo" width="200" height="60">-->
                                    <!--
                                    <h6 class="text-uppercase fw-bold mb-4">
                                        <i class="fas fa-gem me-3"></i>House Pro
                                    </h6>
                                    -->
                                    <a class="navbar-brand" href="index.html">
                                        <img src="./assets/images/green/1.png" alt="Logo" width="200" height="60">
                                    </a>
                                    <br>

                                    <p>
                                        Connects customers with freelance and company based service providers for
                                        various household needs.
                                    </p>
                                </div>
                                <!-- Grid column -->

                                <!-- Grid column -->
                                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                                    <!-- Links -->
                                    <h6 class="text-uppercase fw-bold mb-4">
                                        Locations
                                    </h6>
                                    <p>
                                        <a href="#!" class="text-reset">Wellawatte</a>
                                    </p>
                                    <p>
                                        <a href="#!" class="text-reset">Kollupitiya</a>
                                    </p>
                                    <p>
                                        <a href="#!" class="text-reset">Dematagoda</a>
                                    </p>
                                    <p>
                                        <a href="#!" class="text-reset">Pettah</a>
                                    </p>
                                    <p>
                                        <a href="#!" class="text-reset">Grandpass</a>
                                    </p>
                                </div>
                                <!-- Grid column -->

                                <!-- Grid column -->
                                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                                    <!-- Links -->
                                    <h6 class="text-uppercase fw-bold mb-4">
                                        Popular Services
                                    </h6>
                                    <p>
                                        <a href="#!" class="text-reset">Plumbing</a>
                                    </p>
                                    <p>
                                        <a href="#!" class="text-reset">Electrical</a>
                                    </p>
                                    <p>
                                        <a href="#!" class="text-reset">Electronic</a>
                                    </p>
                                    <p>
                                        <a href="#!" class="text-reset">Cleaning</a>
                                    </p>
                                </div>
                                <!-- Grid column -->

                                <!-- Grid column -->
                                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                                    <!-- Links -->
                                    <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                                    <p><i class="fas fa-home me-3"></i> Rajagiriya, Colombo, SL</p>
                                    <p>
                                        <i class="fas fa-envelope me-3"></i>
                                        houseprosupport@gmail.com
                                    </p>
                                    <p><i class="fas fa-phone me-3"></i> + 94 77 234 5678</p>
                                    <p><i class="fas fa-print me-3"></i> + 94 77 234 5679</p>
                                </div>
                                <!-- Grid column -->
                            </div>
                            <!-- Grid row -->
                        </div>
                    </section>
                    <!-- Section: Links  -->

                    <!-- Copyright -->
                    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                        © 2023 Copyright:
                        <a class="text-reset fw-bold" href="">House Pro</a>
                    </div>
                    <!-- Copyright -->
                </footer>
                <!-- Footer -->
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>


    <!--md-->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>


</body>

</html>



<!--<div id="sectionsixin">
    <div class="container">
        <div class="row">
          <div class="col-9">
            <h2 style="font-weight: 700">Are you a service provider</h2>
          </div>
          <div class="col-4">.col-4<br>Since 9 + 4 = 13 &gt; 12, this 4-column-wide div gets wrapped onto a new line as one contiguous unit.</div>
          <div class="col-6">.col-6<br>Subsequent columns continue along the new line.</div>
        </div>
      </div>
</div>
-->

<!--<nav class="navbar bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="index.html">
        <img src="./assets/images/green/1.png" alt="Bootstrap" width="170" height="60">
      </a>
    </div>
  </nav>
-->