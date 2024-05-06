<?php
// Start the session
session_start();

//Check if the session variables are set
if (isset($_SESSION["provider_id"]) && isset($_SESSION["name"]) && isset($_SESSION["role"])) {
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
    <title>House Pro</title>

    <link rel="stylesheet" type="text/css" href="./css/stylee.css" />


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



        <main>
            <div id="main">
                <section id="sectionone">
                    <h1 class="display-5" style="font-weight: bold;" id="sectiononepar">Connect with the customer and earn your income through our system. all in one place</h1>

                </section>

                <section id="sectiontwo" class="container mt-5">
                    <div class="row">
                        <!-- First Card - Image Card -->
                        <div class="col-md-6" style="border-radius: 10px;">
                            <div class="card h-100" >
                                <img src="assets/images/pic0101.png" class="card-img-top" alt="Image">
                            </div>
                        </div>
                        
                        <!-- Second Card - Text Card -->
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-none"> <!-- Added 'border-0' class to remove the border -->
                                <div class="card-body d-flex flex-column justify-content-center align-items-start">
                                    <h5 class="card-title" style="font-size: 40px; font-weight: bold; margin-top: 30px; margin-bottom: 40px; text-align: left;">Why Choose House Pro?</h5>
                                    <p class="card-text" style="font-size: 25px; text-align: left;">At House Pro, we understand the importance of reliable household services. That's why we've built a platform that connects skilled service providers with homeowners seeking assistance. Whether it's fixing a leaky faucet, cleaning a home, or tackling a landscaping project, we've got you covered.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <section id="whyHousePro" class="container mt-5 mb-5">
                    <!-- Section Heading -->
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="mb-4" style="font-weight: bold;">Why House Pro?</h2>
                        </div>
                    </div>
                
                    <!-- Cards -->
                    <div class="row mt-5 mb-5">
                        <!-- Card 1 -->
                        <div class="col-md-3">
                            <div class="card mb-4">
                                <img src="assets/images/why01.png" class="card-img-top" alt="Image 1">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight: bold;">Reach More Clients</h5>
                                    <p class="card-text">Expand your reach and connect with homeowners looking for your expertise.</p>
                                </div>
                            </div>
                        </div>
                
                        <!-- Card 2 -->
                        <div class="col-md-3">
                            <div class="card mb-4">
                                <img src="assets/images/why02.png" class="card-img-top" alt="Image 2">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight: bold;">Simplified Booking</h5>
                                    <p class="card-text">Effortlessly schedule appointments, manage bookings, and organize your calendar online.</p>
                                </div>
                            </div>
                        </div>
                
                        <!-- Card 3 -->
                        <div class="col-md-3">
                            <div class="card mb-4">
                                <img src="assets/images/why03.png" class="card-img-top" alt="Image 3">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight: bold;">Enhanced Visibility</h5>
                                    <p class="card-text">Showcase your skills, qualifications, and customer reviews to stand out prominently.</p>
                                </div>
                            </div>
                        </div>
                
                        <!-- Card 4 -->
                        <div class="col-md-3">
                            <div class="card mb-4">
                                <img src="assets/images/why04.png" class="card-img-top" alt="Image 4">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight: bold;">Seamless Communication</h5>
                                    <p class="card-text">Stay in constant touch with clients and effortlessly provide them with timely updates.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                

                
                
                
                
                
                
                
                


                
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