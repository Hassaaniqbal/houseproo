<?php
session_start();

// Check if there is an error message in the session
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : "";
unset($_SESSION['error']); // Clear the error message from session
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>freelance sign up</title>

    <link rel="stylesheet" type="text/css" href="./css/signup.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <!-- Google Fonts 
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    -->

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <script src="./javascript/signup_validation.js"></script>

</head>


<body>
    <section>
        <div class="card" id="registerform" style="margin-top: 9rem">
            <div class="card-body">
                <img src="./assets/images/green/1.png" alt="Logo" height="70" width="300"
                    style=" display: block; margin: auto;">
                <br>
                <p>Create an account to get started.
                    Following login, undertake necessary verifications to finalize your registration. Once verified, you
                    gain access to our services.</p>

                <form action="freelance-process-signup.php" method="post" onsubmit="return validateForm()" novalidate>
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4" style="margin-top: 2rem;">
                        <div class="col">
                        <span id="name-error" class="error-message" style="color: red; font-weight: normal;"></span>
                            <div data-mdb-input-init class="form-outline" id="formoutline">
                                <input type="text" id="firstname" name="firstname" class="form-control" />
                                <label class="form-label" for="form3Example1">First name</label>
                            </div>
                        </div>
                        <div class="col">
                        <span id="lastname-error" class="error-message" style="color: red; font-weight: normal;"></span>
                            <div data-mdb-input-init class="form-outline">
                                <input type="text" id="lastname" name="lastname" class="form-control" />
                                <label class="form-label" for="form3Example2">Last name</label>
                            </div>
                        </div>
                    </div>

                    <!--phone number input-->
                    <span id="number-error" class="error-message" style="color: red; font-weight: normal;"></span>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="tel" id="number" name="number" class="form-control" />
                        <label class="form-label" for="form3Example4">Phone number</label>
                    </div>

                    <span id="service-category-error" class="error-message" style="color: red; font-weight: normal;"></span>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Choose Service Category
                        </button>
                        <ul class="dropdown-menu">
                            <li value="cleaning_maintenance"><a class="dropdown-item" href="#"
                                    onclick="selectService('cleaning_maintenance')">Cleaning & Maintenance</a></li>
                            <li value="Plumbing"><a class="dropdown-item" href="#"
                                    onclick="selectService('Plumbing')">Plumbing</a></li>
                            <li value="Painting"><a class="dropdown-item" href="#"
                                    onclick="selectService('Painting')">Painting</a></li>
                            <li value="Electrical"><a class="dropdown-item" href="#"
                                    onclick="selectService('Electrical')">Electrical</a></li>
                            <li value="Electronic"><a class="dropdown-item" href="#"
                                    onclick="selectService('Electronic')">Electronic</a></li>
                            <li value="Handyman"><a class="dropdown-item" href="#"
                                    onclick="selectService('Handyman')">Handyman</a></li>
                        </ul>
                        <!--Hidden input field to store the selected value -->
                        <input type="hidden" id="service_category" name="service_category">
                        <!--put required if needed-->

                    </div>


                    <br>

                    <span id="area-error" class="error-message" style="color: red; font-weight: normal;"></span>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" id="areaDropdownBtn" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            select your area
                        </button>
                        <ul class="dropdown-menu">
                            <li value="Colombo Fort"><a class="dropdown-item" href="#"
                                    onclick="selectArea('Colombo Fort')">Colombo Fort</a></li>
                            <li value="Slave Island"><a class="dropdown-item" href="#"
                                    onclick="selectArea('Slave Island')">Slave Island</a></li>
                            <li value="Kollupitya"><a class="dropdown-item" href="#"
                                    onclick="selectArea('Kollupitya')">Kollupitya</a></li>
                            <li value="Bambalapitiya"><a class="dropdown-item" href="#"
                                    onclick="selectArea('Bambalapitiya')">Bambalapitiya</a></li>
                            <li value="Narahenpita, Havelock Town , Kirulapona North"><a class="dropdown-item" href="#"
                                    onclick="selectArea('Narahenpita, Havelock Town , Kirulapona North')">Narahenpita,
                                    Havelock Town , Kirulapona North</a></li>
                            <li value="Wellawatta, Pamankada, Kirulapona South"><a class="dropdown-item" href="#"
                                    onclick="selectArea('Wellawatta, Pamankada, Kirulapona South')">Wellawatta,
                                    Pamankada, Kirulapona South</a></li>
                            <li value="Cinnamon Garden"><a class="dropdown-item" href="#"
                                    onclick="selectArea('Cinnamon Garden')">Cinnamon Garden</a></li>
                            <li value="Borella"><a class="dropdown-item" href="#"
                                    onclick="selectArea('Borella')">Borella</a></li>
                            <li value="Dematagoda"><a class="dropdown-item" href="#"
                                    onclick="selectArea('Dematagoda')">Dematagoda</a></li>
                            <li value="Maradana, Panchikawatte"><a class="dropdown-item" href="#"
                                    onclick="selectArea('Maradana, Panchikawatte')">Maradana, Panchikawatte</a></li>
                            <li value="Pettah"><a class="dropdown-item" href="#"
                                    onclick="selectArea('Pettah')">Pettah</a></li>
                            <li value="Hulsfdorf"><a class="dropdown-item" href="#"
                                    onclick="selectArea('Hulsfdorf')">Hulsfdorf</a></li>
                            <li value="Bloemendhal"><a class="dropdown-item" href="#"
                                    onclick="selectArea('Bloemendhal')">Bloemendhal</a></li>
                            <li value="Grandpass"><a class="dropdown-item" href="#"
                                    onclick="selectArea('Grandpass')">Grandpass</a></li>
                            <li value="Mattakkuliya, Modara, Mutwal, Madampitiya"><a class="dropdown-item" href="#"
                                    onclick="selectArea('Mattakkuliya, Modara, Mutwal, Madampitiya')">Mattakkuliya,
                                    Modara, Mutwal, Madampitiya</a></li>
                            <!--putting all? colombo 1 to 15-- after putting change on freelancer signup also-->

                        </ul>
                        <input type="hidden" id="area" name="area"> <!--put required if needed-->
                    </div>


                    


                    <br>

                    <!-- Email input -->
                    <span id="email-error" class="error-message" style="color: red; font-weight: normal;">

                    <?php if (!empty($error_message)): ?>
                        <?php echo $error_message; ?>
                  
                <?php endif; ?>

                    </span>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" id="email" name="email" class="form-control" />
                        <label class="form-label" for="form3Example3">Email address</label>
                    </div>

                    <!-- Password input -->
                    <span id="password-error" class="error-message" style="color: red; font-weight: normal;"></span>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="password" name="password" class="form-control" />
                        <label class="form-label" for="form3Example4">Password</label>
                    </div>

                    <!-- Password input repeat-->
                    <span id="password-confirm-error" class="error-message" style="color: red; font-weight: normal;"></span>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control" />
                        <label class="form-label" for="password_confirmation">confirm Password</label>
                    </div>


                    <span id="checkbox-error" class="error-message" style="color: red; font-weight: normal;"></span>
                    <div class="form-check d-flex justify-content-left mb-4">
                        <input class="form-check-input me-2" type="checkbox" value="" id="checkBox1" checked />
                        <label class="form-check-label" for="form6Example8"> I acknowledge i am a freelance based service
                            provider </label>
                    </div>

                    <div class="form-check d-flex justify-content-left mb-4">
                        
                        <input class="form-check-input me-2" type="checkbox" value="" id="checkBox2" checked />
                        <label class="form-check-label" for="form6Example8">I have read the
                            <a href="guidelines.html" class="green-link" target="_blank">Guidelines</a>
                            and
                            <a href="spcriteria.html" class="green-link" target="_blank">Criteria</a>. </label>
                    </div>

                    <p style="font-weight: 500;">
                        By clicking below and creating an account, I agree to House Pro’s
                        <a href="" class="green-link" target="_blank">Terms of Service</a>
                        and
                        <a href="" class="green-link" target="_blank">Privacy Policy</a>.
                    </p>



                    <!-- Submit button -->
                    <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>
                </form>

                <div class="noaccount">
                    <p>already have an account, <a href="login.php" class="green-link">log in</a>.</p>
                </div>

            </div>
        </div>
    </section>


    <!-- MDB -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>