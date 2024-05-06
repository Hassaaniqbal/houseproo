
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>service details</title>
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/green/3.png"      />
    
    
   

    <link rel="stylesheet" type="text/css" href="./css/servicedetails.css" />


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
            <div class="card" style="width: 45rem;">
                <div class="card-body">

                    <?php
                    // Include the database connection file
                    include 'database.php';

                    // Start the session
                    session_start();

                    // Check if the user is logged in
                    if (!isset($_SESSION['user_id'])) {
                        // Redirect to the login page if not logged in
                        header("Location: login.php");
                        exit;
                    }

                    // Check if the booking_id is provided in the query parameters
                    if (isset($_GET['booking_id'])) {
                        // Retrieve the booking_id from the query parameters
                        $booking_id = $_GET['booking_id'];
                      
                        // Fetch booking details based on the booking_id
                        $sql = "SELECT * FROM bookingg WHERE booking_id = ?";
                        $stmt = $mysqli->prepare($sql);
                        $stmt->bind_param("i", $booking_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $booking = $result->fetch_assoc();

                        // Check if booking details are fetched
                        if ($booking) {
                            // Display booking details
                            echo "<h2 style='font-weight: 700; color: black; margin-bottom: 1rem;'>Booking Detail</h2>";


                            echo "<p><strong>Booking ID:</strong> " . $booking['booking_id'] . "<br></p>";

                            echo "<h4 style='color: black;'>Service Detail</h4>";
                            echo "<p style='color: black;'>" . $booking['description'] . "<br></P>";
                            echo '<hr>';

                            echo "<h4 style='color: black;'>Address</h4>";
                            echo "<p style='color: black;'>" . $booking['address'] . "<br></P>";
                            echo '<hr>';

                            echo "<h4 style='color: black;'>Status</h4>";
                            echo "<p style='color: black;'> " . $booking['status'] . "<br></p>";
                            echo '<hr>';

                            echo "<h4 style='color: black;'>Date & Time Of Service Required</h4>";
                            echo "<p style='color: black;'> " . $booking['booking_datetime'] . "<br></p>";
                            echo '<hr>';

                            // Determine service provider type
                            $sptype = $booking['sptype'];

                            // Fetch service provider details based on the type
                            if ($sptype == 'company') {
                                // Fetch company service provider details
                                $provider_id = $booking['provider_id'];
                        
                                $company_sql = "SELECT csp.firstname, csp.lastname, csd.picture 
                    FROM company_service_provider csp 
                    INNER JOIN company_sp_documents csd ON csp.provider_id = csd.provider_id 
                    WHERE csp.provider_id = ?";
                                $stmt = $mysqli->prepare($company_sql);
                                $stmt->bind_param("i", $provider_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $provider = $result->fetch_assoc();
                                echo "<h4 style='color: black;'>Company Service Provider Details</h4>";
                                echo '<br>';
                                $_SESSION['pic1'] = " ../service provider/uploads/pictures/" . $provider['picture'];
                                // Display company service provider details
                                echo '<div class="d-flex align-items-center">';
                                if (!empty($provider['picture'])) {
                                    echo '<img src="../service provider/uploads/pictures/' . $provider['picture'] . '" alt="Provider Picture" style="width: 45px; height: 45px" class="rounded-circle" />';
                                }
                                echo '<div class="ms-3">';
                                echo '<p class="fw-bold mb-1">' . $provider['firstname'] . ' ' . $provider['lastname'] . '</p>';
                                echo '<a class="btn btn-link btn-rounded btn-sm view-details-btn" href="#" data-provider-id="' . $provider_id . '" role="button" data-toggle="modal" data-target="#detailsModal">View details of service provider</a>';
                                echo '</div>';
                                echo '</div>';
                                echo '<hr>';

                                echo "<div data-mdb-input-init class='form-outline mb-4'>
                    <label for='datetime'>Date & Time:</label>
                    <input type='datetime-local' id='datetime' name='datetime'>
                  </div>";


                                echo "<button type='button' class='btn btn-primary' data-mdb-ripple-init style='margin-right: 1rem;' onclick='rescheduleBooking()'>Reschedule</button>";
                                echo "<button type='button' class='btn btn-danger' data-mdb-ripple-init onclick='cancelBooking()'>Cancel</button>";


                            } elseif ($sptype == 'freelance') {
                                // Fetch freelance service provider details
                                $provider_id = $booking['provider_id'];
                                $freelance_sql = "SELECT fsp.firstname, fsp.lastname, fsd.picture 
                                                  FROM freelance_service_provider fsp 
                                                  INNER JOIN freelance_sp_documents fsd ON fsp.provider_id = fsd.provider_id 
                                                  WHERE fsp.provider_id = ?";
                                $stmt = $mysqli->prepare($freelance_sql);
                                $stmt->bind_param("i", $provider_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $provider = $result->fetch_assoc();
                                echo "<h4 style='color: black;'>Freelance Service Provider Details</h4>";
                                $_SESSION['pic1'] = " ../service provider/uploads/pictures/" . $provider['picture'];
                                // Display freelance service provider details
                                echo '<div class="d-flex align-items-center">';
                                if (!empty($provider['picture'])) {
                                    echo '<img src="../service provider/uploads/freelance sp/pictures/' . $provider['picture'] . '" alt="Provider Picture" style="width: 45px; height: 45px" class="rounded-circle" />';
                                }
                                echo '<div class="ms-3">';
                                echo '<p class="fw-bold mb-1">' . $provider['firstname'] . ' ' . $provider['lastname'] . '</p>';
                                echo '<a class="btn btn-link btn-rounded btn-sm view-details-btnn" href="#" data-provider-id="' . $provider_id . '" role="button" data-toggle="modal" data-target="#detailsModal">View details of service provider</a>';
                                echo '</div>';
                                echo '</div>';
                                echo '<hr>';
                                echo "<div data-mdb-input-init class='form-outline mb-4'>
                    <label for='datetime'>Date & Time:</label>
                    <input type='datetime-local' id='datetime' name='datetime'>
                  </div>";

                                echo "<button type='button' class='btn btn-primary' data-mdb-ripple-init style='margin-right: 1rem;' onclick='rescheduleBooking()'>Reschedule</button>";
                                echo "<button type='button' class='btn btn-danger' data-mdb-ripple-init onclick='cancelBooking()'>Cancel</button>";
                            } else {
                                echo "Invalid service provider type.";
                            }
                        } else {
                            echo "Booking not found.";
                        }
                    } else {
                        // Redirect the user back to the previous page if booking_id is not provided
                        header("Location: myservices.php");
                        exit;
                    }
                    ?>







                    <!--should include work done button and closing message - look taskrabbit scenario-->
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" style="max-width: 900px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Service Provider Details</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Content goes here -->
                            <div id="providerDetails"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- You can add additional buttons here if needed -->
                        </div>
                    </div>
                </div>
            </div>







     


            
            <div class="card">
            <?php
            //  echo $_SESSION['user_id'];
            //  echo $provider_id; 
             ?>
                <div class="card-body">
                    <iframe src="../chat/chat.php?user_id=<?php echo $provider_id; ?>" frameborder="0" width="200%" height="100%"></iframe>
                    
                </div>
            </div>
           
            
            

            
            



        </section>
    </main>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>


    <!--md-->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

        <!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    



    <script>
        // JavaScript to handle the click event of the view button
        $(document).ready(function () {
            $('.view-details-btn').click(function () {
                // Get the provider_id from the data attribute
                var providerId = $(this).data('provider-id');

                // Send the provider_id via AJAX to another PHP file
                $.ajax({
                    type: 'POST',
                    url: 'get_companysp_details.php', // Replace with the path to your PHP file
                    data: { providerId: providerId },
                    success: function (response) {
                        // Handle the response here if needed
                        console.log(response);
                        // Display the response within the modal
                        $('#providerDetails').html(response);
                        // Show the modal
                        $('#detailsModal').modal('show');


                    }
                });
            });
        });
    </script>

<script>
        // JavaScript to handle the click event of the view button
        $(document).ready(function () {
            $('.view-details-btnn').click(function () {
                // Get the provider_id from the data attribute
                var providerId = $(this).data('provider-id');

                // Send the provider_id via AJAX to another PHP file
                $.ajax({
                    type: 'POST',
                    url: 'get_freelancesp_details.php', // Replace with the path to your PHP file
                    data: { providerId: providerId },
                    success: function (response) {
                        // Handle the response here if needed
                        console.log(response);
                        // Display the response within the modal
                        $('#providerDetails').html(response);
                        // Show the modal
                        $('#detailsModal').modal('show');


                    }
                });
            });
        });
    </script>


<script>
function rescheduleBooking() {
  // Retrieve the value of the date and time input
  var dateTimeValue = document.getElementById('datetime').value;

  // Retrieve the booking ID from the query parameters
  var bookingId = '<?php echo $_GET['booking_id']; ?>';

  // Log the values to the console to check if they are correct
  console.log("Booking ID:", bookingId);
  console.log("New Date Time:", dateTimeValue);

  // Check if the date and time are filled
  if (dateTimeValue) {
    // Show confirmation dialog for rescheduling
    swal({
      text: "Are you sure to reschedule to the new time?",
      icon: "info",
      buttons: ["Cancel", "OK"],
      dangerMode: false,
    }).then((ok) => {
      if (ok) {
        // Create a FormData object to send data to the server
        var formData = new FormData();
        // Append booking ID and new date time to the FormData object
        formData.append('booking_id', bookingId);
        formData.append('new_datetime', dateTimeValue);
        // Perform AJAX request to update the booking
        fetch('reschedule_booking.php', {
          method: 'POST',
          body: formData
        }).then(response => {
          // Check the status code directly
          if (response.ok) {
            // If response status is OK (200), show success message
            swal("Success!", "Booking rescheduled successfully.", "success").then(() => {
              // Reload the page
              location.reload();
            });
          } else {
            // If response status is not OK, show error message
            swal("Error!", "Failed to reschedule booking.", "error");
          }
        }).catch(error => {
          // Show error message
          console.error('Error:', error);
          swal("Error!", "Failed to reschedule booking.", "error");
        });
      }
    });
  } else {
    // Display an error message asking to choose date and time
    swal("Choose Date and Time", "Please select a date and time.", "error");
  }
}
</script>






<script>
    // cancel booking
    function cancelBooking() {
        // Show confirmation dialog
        swal({
            text: "Are you sure you want to cancel this booking?",
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        }).then((willCancel) => {
            if (willCancel) {
                // If user confirms cancellation, send AJAX request
                var bookingId = '<?php echo $_GET['booking_id']; ?>';
                fetch('cancel_booking.php?booking_id=' + bookingId)
                    .then(response => {
                        // Check the status code directly
                        if (response.ok) {
                            // If response status is OK (200), redirect to myservices.php
                            swal("Success!", "Booking cancelled successfully.", "success").then(() => {
                                window.location.href = "myservices.php";
                            });
                        } else {
                            // If response status is not OK, show error message
                            swal("Error!", "Failed to cancel booking.", "error");
                        }
                    })
                    .catch(error => {
                        // If there is an error with the AJAX request, show error message
                        console.error('Error:', error);
                        swal("Error!", "Failed to cancel booking.", "error");
                    });
            }
        });
    }
</script>








</body>

</html>