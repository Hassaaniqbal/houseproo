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
    <title>Sign Up</title>

    <link rel="stylesheet" type="text/css" href="./css/signup.css" />

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
        <div class="card" id="registerform">
            <div class="card-body">
                <img src="./assets/images/green/1.png" alt="Logo" height="70" width="300" style=" display: block; margin: auto;" >
                
                <form action="process-signup.php" method="post" novalidate onsubmit="return validateForm()">
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4" style="margin-top: 2rem;">
                        <div class="col">
                            <span id="name-error" class="error-message" style="color: red; font-weight: normal;"></span>
                            <div data-mdb-input-init class="form-outline" id="formoutline">
                                <input type="text" id="name" name="firstname" class="form-control" />
                                <label class="form-label" for="name">First name</label>
                            </div>
                        </div>
                        <div class="col">
                            <span id="lastname-error" class="error-message" style="color: red; font-weight: normal;"></span>
                            <div data-mdb-input-init class="form-outline">
                                <input type="text" id="lastname" name="lastname" class="form-control" />
                                <label class="form-label" for="lastname">Last name</label>
                            </div>
                        </div>
                    </div>

                    <!--phone number input-->
                    <span id="number-error" class="error-message" style="color: red; font-weight: normal;"></span>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="tel" id="number" name="number" class="form-control"/>
                        <label class="form-label" for="number">Phone number</label>
                    </div>
                    
    
                    <!-- Email input -->
                    <span id="email-error" class="error-message" style="color: red; font-weight: normal;">

                    <?php if (!empty($error_message)): ?>
                        <?php echo $error_message; ?>
                  
                <?php endif; ?>

                    </span>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" id="email" name="email" class="form-control" />
                        <label class="form-label" for="email">Email address</label>
                    </div>
                    
    
                    <!-- Password input -->
                    <span id="password-error" class="error-message" style="color: red; font-weight: normal;"></span>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="password" name="password" class="form-control" />
                        <label class="form-label" for="password">Password</label>
                    </div>
                    

                    <!-- Password input repeat-->
                    <span id="password-confirm-error" class="error-message" style="color: red; font-weight: bold;"></span>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" />
                        <label class="form-label" for="password_confirmation">confirm Password</label>   
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
</body>

</html>