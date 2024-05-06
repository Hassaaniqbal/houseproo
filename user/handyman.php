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
    <title>handyman</title>

    <link rel="stylesheet" type="text/css" href="./css/cleaning.css" />


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

        <div>
            <section style="margin-bottom: 4rem;">
                <h2 style="font-weight: 700; color: black; margin-top: 3rem; margin-bottom: 2rem;">Handyman
                    </h2>


                <div class="container text-left">
                    <div class="row align-items-start">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                
                                    <p class="card-text">Count on our skilled service providers to cater to a diverse range of needs, delivering expert solutions to elevate your living spaces. From carpentry repairs and furniture assembly to comprehensive home repair services, our experienced professionals are equipped to enhance both the functionality and aesthetics of your home. <br><br>Entrust our team with locks and knobs installation for heightened security, as well as ceiling fan installations to optimize air circulation. Our skilled service providers excel in heavy lifting, curtain hanging, and blind installation, addressing various tasks with efficiency. Illuminate your space with confidence through our light installation services, and rely on our team for seamless furniture moving. <br><br>Additionally, refresh your home with our carpet cleaning services. Embrace quality and reliability with our skilled service providers, dedicated to transforming your home with precision and expertise.
                                    </p>
                                
                                </div>
                            </div>

                        </div>
                        <div class="col">
                            <img src="./assets/images/handyman.jpg" class="img-fluid rounded"
                                alt="Townhouses and Skyscrapers" />

                            <br><br><br>

                            <div style="text-align: center;">
                                <button type="button" class="btn btn-success btn-lg"
                                    style="font-weight: 700; padding-left: 4rem; padding-right: 4rem;" onclick="location.href='handymanform.php';">book now</button>
                            </div>


                        </div>

                    </div>
                </div>

            </section>

            <section id="sectiontwo">
                <div id="sectiontwoin">
                    <h2 style="font-weight: 700; color: black;">How it works</h2>
                    <br><br>
                    <div class="container text-center">
                        <div class="row align-items-center">
                            <div class="col">
                                <img src="./assets/images/sectionfive2.png" alt="..." height="300" width="300">
                                <br><br>
                                <p class="h5" style="font-weight: 600; color: black;">Describe Your Task</p>

                                <p class="h5" style="font-weight: 500; color: black;">Tell us what you need done, when
                                    and where it works for you.</p>
                            </div>
                            <div class="col">
                                <img src="./assets/images/sectionfive1.png" alt="..." height="300" width="300">
                                <br><br>
                                <p class="h5" style="font-weight: 600; color: black;">Choose Your Service provider</p>
                                <p class="h5" style="font-weight: 500; color: black;">Browse trusted Service providers
                                    by skills, reviews. Chat with them to confirm details.</p>

                            </div>
                            <div class="col">
                                <img src="./assets/images/sectionfive3.png" alt="..." height="300" width="300">
                                <br>
                                <p class="h5" style="font-weight: 600; color: black;">Get It Done!</p>
                                <p class="h5" style="font-weight: 500; color: black;">Your Service provider arrives and
                                    gets the job done. Pay and leave a review.</p>

                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section id="sectionthree">
                <div id="sectionthreein">
                    <div class="container text-left">
                        <div class="row align-items-start">
                            <div class="col">
                                <img src="./assets/images/handyman.jpg" class="img-fluid rounded" alt="...">
                            </div>
                            <div class="col">
                                <br>
                                <br>
                                <br>
                                <h2 style="font-weight: 700; color: black;">Ready to hire a handyman ?</h2>
                                <br>

                                <button type="button" class="btn btn-success btn-lg"
                                    style="font-weight: 700; padding-left: 4rem; padding-right: 4rem;" onclick="location.href='handymanform.html';">book now</button>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>


    <footer class="text-center text-lg-start bg-body-tertiary text-muted" style="font-family: 'Poppins', sans-serif;">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom" id="footersection">
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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>


    <!--md-->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>