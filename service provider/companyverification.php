<?php
// Start the session if not already started
session_start();

// Check if the user is logged in
if (!isset($_SESSION['provider_id'])) {
  // Redirect to the login page if not logged in
  header("Location: login.php");
  exit;
}

// Check if there are any verification errors stored in session
$errorMessage = isset($_SESSION['verification_errors']) ? $_SESSION['verification_errors'] : "";
unset($_SESSION['verification_errors']); // Clear the error message once displayed

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>company verification</title>

  <link rel="stylesheet" type="text/css" href="./css/verification.css" />

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
</head>

<body>

  <section>
    <div class="card" id="cardd">
      <div class="card-body">

        <form action="logout.php" method="post" enctype="multipart/form-data">
          <button style="margin-left: 37rem; margin-bottom: 2rem;" type="submit">Logout</button>
        </form>


        <P style="font-weight: 600;">As part of our onboarding process and to ensure the accuracy and legitimacy of our
          platform, we kindly request the following documents for verification purposes:</P>
        <br>
        <form action="company_upload.php" method="post" enctype="multipart/form-data">

          <label class="form-label" for="customFile">Current picture of yourself</label>
          <input type="file" class="form-control" id="picture" name="picture" accept="image/*" required />
          <br>

          <label for="formFileMultiple" class="form-label">NIC/Passport/Driving License</label>
          <input class="form-control" type="file" id="nic" name="nic[]" accept="image/*" multiple required />
          <br>

          <label for="formFileMultiple" class="form-label">Certificates of qualifications</label>
          <input class="form-control" type="file" id="certificate" name="certificate[]" accept="image/*" multiple
            required />
          <br>

          <!-- Text input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="address" name="address" class="form-control" required />
            <label class="form-label" for="form6Example4">Current address</label>
          </div>

          <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="zipcode" name="zipcode" class="form-control" required />
            <label class="form-label" for="form5Example1">Zip code</label>
          </div>

          <!-- Text input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="companyname" name="companyname" class="form-control" required />
            <label class="form-label" for="form6Example3">Company you work for</label>
          </div>

          <!-- Text input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="companyaddress" name="companyaddress" class="form-control" />
            <label class="form-label" for="form6Example4">Company address</label>
          </div>

          <label class="form-label" for="customFile">Permission letter from company saying you are granted permission
            and skilled for the providing services</label>
          <input type="file" class="form-control" id="permissionletter" name="permissionletter" accept=".pdf,.doc,.docx"
            required />
          <br>



          <!-- Message input 
                    <div data-mdb-input-init class="form-outline mb-4">
                      <textarea class="form-control" id="form6Example7" rows="4"></textarea>
                      <label class="form-label" for="form6Example7">Additional information</label>
                    </div>
                    -->
          
      </div>

      
      <?php if (!empty($errorMessage)): ?>
          <div class='error' style='color: red; font-weight: normal;'>
            <p><?php echo $errorMessage; ?></p>
          </div>
        <?php endif; ?>
      <!-- Checkbox -->
      <div class="form-check d-flex justify-content-center mb-4">
        <input class="form-check-input me-2" type="checkbox" value="checkbox1" id="checkbox1" name="checkbox1" checked />
        <label class="form-check-label" for="form6Example8">The information and documents presented herein are authentic
          and accurate.</label>
      </div>
    <!-- Error message for checkbox -->
    
      
      <!-- Submit button -->
      <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4" value="submit">Submit</button>
      </form>

      


    </div>
    </div>
  </section>



  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>