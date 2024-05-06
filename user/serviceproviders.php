<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  // Redirect to the login page if not logged in
  header("Location: login.php");
  exit;
}


// Check if form data is provided in the query parameters
if (isset($_GET['datetime']) && isset($_GET['address']) && isset($_GET['description']) && isset($_GET['service_type'])) {
  // Store the form data in the session
  $_SESSION['datetime'] = $_GET['datetime'];
  $_SESSION['address'] = $_GET['address'];
  $_SESSION['description'] = $_GET['description'];
  $_SESSION['service_type'] = $_GET['service_type'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show service providers</title>

  <link rel="stylesheet" type="text/css" href="./css/serviceproviders.css" />


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
              <a class="nav-link text-dark" style="font-weight: bold; color: red;" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main id="main">
    <section>

      <?php
      // Include the database connection file
      require_once "database.php";

      // Get the service category from the session
      $category = $_SESSION['service_type'];


      // Prepare the SQL query to fetch service providers based on availability and category
      $sql = "SELECT csp.firstname, csp.lastname, csp.email, csp.provider_id, csd.picture 
        FROM company_service_provider csp
        LEFT JOIN company_sp_documents csd ON csp.provider_id = csd.provider_id
        WHERE csp.availability = 1 AND csp.category = ?";

      // Prepare the SQL statement
      $stmt = $mysqli->prepare($sql);
      if ($stmt === false) {
        die("Error preparing statement: " . $mysqli->error);
      }

      // Bind parameters
      if (!$stmt->bind_param("s", $category)) {
        die("Error binding parameters: " . $stmt->error);
      }

      // Execute the statement
      if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
      }

      // Get the result
      $result = $stmt->get_result();

      // Check if there are any rows returned
      if ($result->num_rows > 0) {
        // Fetch the data and store it in an array
        $serviceProviders = $result->fetch_all(MYSQLI_ASSOC);
      } else {
        // No service providers found
        $serviceProviders = [];
      }

      // Close the statement
      $stmt->close();
      ?>

      <h2 style="font-weight: 700; color: black; margin-top: 3rem; margin-bottom: 2rem;">Choose a service provider
      </h2>

      <div class="card" id="sectionn" style="overflow-y: scroll;"> <!--HAVE ADDED STYLE style="overflow-y: scroll;"-->
        <div class="row">
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title" style="margin-bottom: 2rem;">Available company based service providers</h5>
                <ul class="list-group list-group-light">
                  <?php foreach ($serviceProviders as $provider): ?>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="d-flex align-items-center">
                        <img src='../service provider/uploads/pictures/<?= $provider['picture'] ?>' alt='Profile Picture'
                          style='width: 45px; height: 45px' class="rounded-circle"><br>
                        <!-- You can customize the display of service providers here -->
                        <div class="ms-3">
                          <p class="fw-bold mb-1">
                            <?= $provider['firstname'] ?>
                            <?= $provider['lastname'] ?>
                          </p>
                          <p class="text-muted mb-0">
                            <?= $provider['email'] ?>
                          </p>
                        </div>
                      </div>
                      <a class="btn btn-link btn-rounded btn-sm view-details-btn" href="#" id="" role="button"
                        data-provider-id="<?= $provider['provider_id'] ?>" data-toggle='modal'
                        data-target='#detailsModal'>View</a>
                      <button type="button" class="btn btn-success" data-mdb-ripple-init>select</button>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>




          <?php
          // Include the database connection file
          require_once "database.php";

          // Get the service category from the session
          $category = $_SESSION['service_type'];


          // Prepare the SQL query to fetch service providers based on availability and category
          $sql = "SELECT fsp.firstname, fsp.lastname, fsp.email, fsp.provider_id, fsd.picture 
          FROM freelance_service_provider fsp
          LEFT JOIN freelance_sp_documents fsd ON fsp.provider_id = fsd.provider_id
         WHERE fsp.availability = 1 AND fsp.category = ?";

          // Prepare the SQL statement
          $stmt = $mysqli->prepare($sql);
          if ($stmt === false) {
            die("Error preparing statement: " . $mysqli->error);
          }

          // Bind parameters
          if (!$stmt->bind_param("s", $category)) {
            die("Error binding parameters: " . $stmt->error);
          }

          // Execute the statement
          if (!$stmt->execute()) {
            die("Error executing statement: " . $stmt->error);
          }

          // Get the result
          $result = $stmt->get_result();

          // Check if there are any rows returned
          if ($result->num_rows > 0) {
            // Fetch the data and store it in an array
            $fserviceProviders = $result->fetch_all(MYSQLI_ASSOC);
          } else {
            // No service providers found
            $fserviceProviders = [];
          }

          // Close the statement
          $stmt->close();
          ?>







          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title" style="margin-bottom: 2rem;">Available Freelance based service providers</h5>

                <?php
                // Echo the stored values from the session
                //echo "Datetime: " . $_SESSION['datetime'] . "<br>";
                //echo "Address: " . $_SESSION['address'] . "<br>";
                //echo "Description: " . $_SESSION['description'] . "<br>";
                //echo "Service Type: " . $_SESSION['service_type'] . "<br>";
                

                ?>
                <!---->
                <ul class="list-group list-group-light" style="overflow-y: scroll;">
                  <!--HAVE ADDED STYLE style="overflow-y: scroll;"-->
                  <?php foreach ($fserviceProviders as $fprovider): ?>

                    <li class="list-group-itemm d-flex justify-content-between align-items-center">
                      <div class="d-flex align-items-center">
                        <img src='../service provider/uploads/freelance sp/pictures/<?= $fprovider['picture'] ?>'
                          alt='Profile Picture' style='width: 45px; height: 45px' class="rounded-circle"><br>
                        <!-- You can customize the display of service providers here -->
                        <div class="ms-3">
                          <p class="fw-bold mb-1">
                            <?= $fprovider['firstname'] ?>
                            <?= $fprovider['lastname'] ?>
                          </p>
                          <p class="text-muted mb-0">
                            <?= $fprovider['email'] ?>
                          </p>
                        </div>
                      </div>

                      <a class="btn btn-link btn-rounded btn-sm view-details-btnn" href="#" id="" role="button"
                        data-provider-id="<?= $fprovider['provider_id'] ?>" data-toggle='modal'
                        data-target='#detailsModall'>View</a>


                      <button type="button" class="btn btn-successs" data-mdb-ripple-init>select</button>

                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section>


    <!-- Modal -->
    <!-- Modal for company based service provider-->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document" style="max-width: 900px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="detailsModalLabel">Service Provider Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Content goes here -->
            <div id="providerIdContainer"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>



    <!-- Modal for freelance based service provider-->
    <div class="modal fade" id="detailsModall" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document" style="max-width: 900px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="detailsModalLabel">Service Provider Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Content goes here -->
            <div id="providerIdContainer"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>





  </main>

  <!-- Include SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>


  <!--md-->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

  <script>
    $(document).ready(function () {
      $(document).on('click', '.view-details-btn', function () {
        console.log("Button clicked");
        var providerId = $(this).data('provider-id');
        // Update modal content with provider_id
        $('#providerIdContainer').html('<p>Provider ID: ' + providerId + '</p>');
        // Perform AJAX request or other actions if needed
        // Example AJAX request:
        $.ajax({
          url: 'get_companysp_details.php',
          type: 'POST',
          data: { providerId: providerId },
          success: function (response) {
            // Update modal content with response data
            $('#detailsModal .modal-body').html(response);
            $('#detailsModal').modal('show');
          },
          error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
          }
        });
      });
    });
  </script>

  <script>
    $(document).ready(function () {
      $(document).on('click', '.view-details-btnn', function () {
        console.log("Button clicked");
        var providerId = $(this).data('provider-id');
        // Update modal content with provider_id
        $('#providerIdContainer').html('<p>Provider ID: ' + providerId + '</p>');
        // Perform AJAX request or other actions if needed
        // Example AJAX request:
        $.ajax({
          url: 'get_freelancesp_details.php',
          type: 'POST',
          data: { providerId: providerId },
          success: function (response) {
            // Update modal content with response data
            $('#detailsModal .modal-body').html(response);
            $('#detailsModal').modal('show');
          },
          error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
          }
        });
      });
    });
  </script>




  <script>
    $(document).ready(function () {
      // Event listener for select button click
      $('.btn-success').click(function () {
        // Get the service provider details
        var providerId = $(this).closest('.list-group-item').find('.view-details-btn').data('provider-id');

        // Show SweetAlert confirmation dialog
        Swal.fire({
          title: 'Are you sure?',
          text: `Do you want to select this company based service provider?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, select!'
        }).then((result) => {
          // If user confirms, perform the selection action
          if (result.isConfirmed) {
            // Send AJAX request to store booking
            $.ajax({
              type: "POST",
              url: "csp_booking.php",
              data: {
                providerId: providerId,
                datetime: "<?php echo $_SESSION['datetime']; ?>",
                address: "<?php echo $_SESSION['address']; ?>",
                description: "<?php echo $_SESSION['description']; ?>",
                service_type: "<?php echo $_SESSION['service_type']; ?>"
              },
              success: function (response) {
                // Show success message
                Swal.fire({
                  title: 'Success!',
                  text: 'Booking has been saved successfully.',
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                }).then((result) => {
                  // Redirect to myservices.php after OK button is clicked
                  if (result.isConfirmed) {
                    window.location.href = 'myservices.php';
                  }
                });
              },
              error: function (xhr, status, error) {
                // Show error message
                Swal.fire({
                  title: 'Error!',
                  text: 'Failed to save booking: ' + xhr.responseText,
                  icon: 'error',
                  confirmButtonColor: '#3085d6',
                });
              }
            });
          }
        });
      });
    });
  </script>

  <script>
    $(document).ready(function () {
      // Event listener for select button click
      $('.btn-successs').click(function () {
        // Get the service provider details
        var providerId = $(this).closest('.list-group-itemm').find('.view-details-btnn').data('provider-id');

        // Show SweetAlert confirmation dialog
        Swal.fire({
          title: 'Are you sure?',
          text: `Do you want to select this feeelance based service provider?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, select!'
        }).then((result) => {
          // If user confirms, perform the selection action
          if (result.isConfirmed) {
            // Send AJAX request to store booking
            $.ajax({
              type: "POST",
              url: "fsp_booking.php",
              data: {
                providerId: providerId,
                datetime: "<?php echo $_SESSION['datetime']; ?>",
                address: "<?php echo $_SESSION['address']; ?>",
                description: "<?php echo $_SESSION['description']; ?>",
                service_type: "<?php echo $_SESSION['service_type']; ?>"
              },
              success: function (response) {
                // Show success message
                Swal.fire({
                  title: 'Success!',
                  text: 'Booking has been saved successfully.',
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                }).then((result) => {
                  // Redirect to myservices.php after OK button is clicked
                  if (result.isConfirmed) {
                    window.location.href = 'myservices.php';
                  }
                });
              },
              error: function (xhr, status, error) {
                // Show error message
                Swal.fire({
                  title: 'Error!',
                  text: 'Failed to save booking: ' + xhr.responseText,
                  icon: 'error',
                  confirmButtonColor: '#3085d6',
                });
              }
            });
          }
        });
      });
    });
  </script>



  <!--
<script>
  $(document).ready(function() {
    // Event listener for select button click
    $('.btn-success').click(function() {
      // Get the service provider details
      var providerName = $(this).closest('.list-group-item').find('.fw-bold').text();
      
      // Show SweetAlert confirmation dialog
      Swal.fire({
        title: 'Are you sure?',
        text: `Do you want to select ${providerName} as your service provider?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, select!'
      }).then((result) => {
        // If user confirms, perform the selection action
        if (result.isConfirmed) {
          // Add your selection logic here
          // For example, you can redirect to another page or perform an AJAX request
          // You can access the provider details using $(this).data('provider-id')
          // Replace the next line with your action
          alert('Service provider selected!');
        }
      });
    });
  });
</script>
-->








</body>

</html>