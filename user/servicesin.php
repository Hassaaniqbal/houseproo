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
    <title>Services</title>

    <link rel="stylesheet" type="text/css" href="./css/services.css" />

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
            <section id="sectiontwo">
                <div id="sectiontwoin">

                    <h2 style="font-weight: 700; color: black;">Hire a trusted service provider</h2>

                    <p id="sectiontwopar">
                    </p>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">

                            <div class="card h-100">
                                <a href="cleaning.php">
                                    <img src="./assets/images/cleaning.jpg" class="card-img-top" alt="..." id="imgg">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #00BF63; font-weight: bold;">Cleaning &
                                        Maintenance</h5>
                                    <p class="card-text">From regular maintenance to deep cleaning, our platform
                                        connects you with
                                        expert cleaners dedicated to ensuring your home is spotless and inviting.</p>
                                        <hr style="margin: auto;">

                                </div>   
                                
                                <ul style="list-style-type: none">
                                    <li>
                                        <a href="" id="cleaningg" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Bedroom Cleaning</a>  
                                    </li> 
                                    <li>
                                        <a href="" id="cleaningg" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Apartment Cleaning</a>  
                                    </li>
                                    <li>
                                        <a href="" id="cleaningg" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Move In Cleaning</a>  
                                    </li>
                                    <li>
                                        <a href="" id="cleaningg" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Move Out Cleaning</a>  
                                    </li>   
                                    <li>
                                        <a href="" id="cleaningg" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Room Cleaning</a>  
                                    </li> 
                                    <li>
                                        <a href="" id="cleaningg" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Office Cleaning</a>  
                                    </li> 
                                    <li>
                                        <a href="" id="cleaningg" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Deep Cleaning Service</a>  
                                    </li> 
                                    <li>
                                        <a href="" id="cleaningg" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Kitchen Cleaning</a>  
                                    </li> 
                                    <li>
                                        <a href="" id="cleaningg" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Living Room Cleaning</a>  
                                    </li> 
                                    <li>
                                        <a href="" id="cleaningg" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Home sanitization</a>  
                                    </li> 
                                    <li>
                                        <a href="" id="cleaningg" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Roof Cleaning</a>  
                                    </li> 
                                    <li>
                                        <a href="" id="cleaningg" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Maid Service</a>  
                                    </li>

                                 </ul>
                            </div>

                        </div>


                        <div class="col">
                            <div class="card 100">
                                <a href="plumbing.php">
                                    <img src="./assets/images/plumbing.jpg" class="card-img-top" alt="..." id="imgg">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #00BF63; font-weight: bold;">Plumbing</h5>
                                    <p class="card-text">Connect with skilled plumbers for all your plumbing needs. From
                                        leaky faucets
                                        to complex installations.</p>

                                        <hr style="margin: auto;">
                                </div>

                                
                                <ul style="list-style-type: none;">
                                    <li>
                                        <a href="" id="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Drain Repair</a>  
                                    </li>   
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Faucet Installation</a>  
                                    </li>
                                    <li>
                                        <a href=""  style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Faucet Repair</a>  
                                    </li>
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Sink Replacement</a>  
                                    </li>
                                    <li>
                                        <a href=""  style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Toilet Repair</a>  
                                    </li>
                                    <li>
                                        <a href=""  style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Toilet Replacement</a>  
                                    </li>
                                    <li>
                                        <a href=""  style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Unclog Toilet</a>  
                                    </li>
                                    <li>
                                        <a href=""  style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Faucet Replacement</a>  
                                    </li>
                                    <li>
                                        <a href=""  style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Rain Water System</a>  
                                    </li>
                
                            
                                 </ul>
                                 
                            </div>
                        </div>

                        
                        <div class="col">
                            <div class="card">
                                <a href="painting.php">
                                    <img src="./assets/images/painting.png" class="card-img-top" alt="..." id="imgg">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #00BF63; font-weight: bold;">Painting</h5>
                                    <p class="card-text">Transform your living spaces with the help of skilled painters
                                        available on
                                        House Pro. From touch-ups to complete makeovers, connect you with painters who
                                        bring color and
                                        precision to your home.</p>
                                        <hr style="margin: auto;">
                                </div>

                                <ul style="list-style-type: none">
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Interior Painting</a>  
                                    </li>  
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Baseboard Painting</a>  
                                    </li>
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Doorframe Painting</a>  
                                    </li>
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Crown Molding Painting</a>  
                                    </li>  
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Bedroom Painting</a>  
                                    </li>
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Door Painting</a>  
                                    </li>
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Wall Painting</a>  
                                    </li> 
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Accent Wall Painting</a>  
                                    </li> 
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Exterior Painting</a>  
                                    </li> 
                            
                                 </ul>
                            </div>
                        </div>





                        <div class="col">
                            <div class="card">
                                <a href="electrical.php">
                                    <img src="./assets/images/electrical.jpg" class="card-img-top" alt="..." id="imgg">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #00BF63; font-weight: bold;">Electrical</h5>
                                    <p class="card-text">Ensure the safety and efficiency of your home's electrical
                                        systems by booking
                                        experienced electricians. Whether it's wiring, installations, or repairs.</p>
                                        <hr style="margin: auto;">
                                </div>

                                <ul style="list-style-type: none">
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">House Wiring</a>  
                                    </li>   
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Outlet Installation</a>  
                                    </li>
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Light Fixtures</a>  
                                    </li>
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Light Switch Installation</a>  
                                    </li>
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Doorbell Installation & repair</a>  
                                    </li>
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Ceiling & Bath Fans</a>  
                                    </li>
                                    
                                 </ul>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <a href="electronic.php">
                                    <img src="./assets/images/electronic.jpg" class="card-img-top" alt="..." id="imgg">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #00BF63; font-weight: bold;">Electronic</h5>
                                    <p class="card-text">From malfunctioning gadgets to home appliance tune-ups, our
                                        service providers
                                        have the technical know-how to keep your electronics running smoothly.</p>
                                        <hr style="margin: auto;">
                                </div>

                                <ul style="list-style-type: none">
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">TV Installation & Repair</a>  
                                    </li>   
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">TV Mounting</a>  
                                    </li>   
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Air Conditioner Installation</a>  
                                    </li> 
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Air Conditioner Service & Repair</a>  
                                    </li> 
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Home Theater AV Setup</a>  
                                    </li> 
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">CCTV</a>  
                                    </li> 
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Smart Home</a>  
                                    </li> 

                                 </ul>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <a href="handyman.php">
                                    <img src="./assets/images/handyman.jpg" class="card-img-top" alt="..." id="imgg">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title" style="color:#00BF63; font-weight: bold;">Handyman</h5>
                                    <p class="card-text">From furniture assembly to general repairs, our platform
                                        ensures you find
                                        skilled professionals to handle various tasks efficiently.</p>
                                        <hr style="margin: auto;">
                                </div>

                                <ul style="list-style-type: none">
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Carpentry Repairs</a>  
                                    </li>   
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Furniture Assembly</a>  
                                    </li> 
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Home Repair Service</a>  
                                    </li> 
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Locks Installation</a>  
                                    </li>  
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Knobs Installation</a>  
                                    </li>   
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Ceiling Fan Installation</a>  
                                    </li> 
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Heavyy Lifting</a>  
                                    </li> 
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Hanging Curtains & Installing Blinds</a>  
                                    </li> 
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Light Installation</a>  
                                    </li>   
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Furniture Moving</a>  
                                    </li> 
                                    <li>
                                        <a href="" style="color: #00BF63; font-weight: 545;" onmouseover="this.style.color='black'" onmouseout="this.style.color='#00BF63'">Carpet Cleaning</a>  
                                    </li>  
                                 </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>            
        </main>

        <!-- Footer -->
        <footer class="text-center text-lg-start bg-body-tertiary text-muted" style="font-family: 'Poppins', sans-serif;">
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
                    <h6 class="text-uppercase fw-bold mb-4">
                      <i class="fas fa-gem me-3"></i>Company name
                    </h6>
                    <p>
                      Connects customers with freelance and company based service providers for various household needs.
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>


    <!--md-->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

</body>

</html>