<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>service details</title>



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

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



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
              <a class="nav-link active text-dark" style="font-weight: 700" aria-current="page" href="home.php">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link active text-dark" style="font-weight: 700" aria-current="page"
                href="myservices.php">My services</a>
            </li>

            <li class="nav-item">
              <a class="nav-link text-dark" style="font-weight: 700" href="sp_profile.php">Account</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main id="main">
    <section id="sectionone">
      <div class="card" style="width: 40rem;">
        <div class="card-body">

        <?php
// Include the database connection file
include 'database.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["provider_id"]) && !isset($_SESSION["name"]) && !isset($_SESSION["role"])) {
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

        // Fetch user details based on the user_id associated with the booking
        $user_id = $booking['user_id'];
        $_SESSION['suser_id'] = $user_id;
        $sql_user = "SELECT * FROM users WHERE id = ?";
        $stmt_user = $mysqli->prepare($sql_user);
        $stmt_user->bind_param("i", $user_id);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();
        $user = $result_user->fetch_assoc();
        $_SESSION['pic2'] = "../user/" . $user['picture'];
        // Display user details
        if ($user) {
            echo "<h4 style='color: black;'>User Details</h4>";
            echo "<img src='../user/" . $user['picture'] . "' alt='User Picture' style='width: 100px; height: 100px;' />";
            echo "<p style='color: black;'><strong>Name:</strong> " . $user['firstname'] . " " . $user['lastname'] . "<br></p>";
            echo "<p style='color: black;'><strong>Number:</strong> " . $user['number'] . "<br></p>";
            echo "<p style='color: black;'><strong>Email:</strong> " . $user['email'] . "<br></p>";

            echo '<hr>';
            echo "<div data-mdb-input-init class='form-outline mb-4'>
                    <label for='datetime'>Date & Time:</label>
                    <input type='datetime-local' id='datetime' name='datetime'>
                  </div>";

            // Check the booking status to decide which buttons to display
            switch ($booking['status']) {
                case 'pending':
                    // Display confirm and cancel buttons
                    echo "<button type='button' class='btn btn-success' data-mdb-ripple-init onclick='confirmBooking()' style='margin-right: 1rem;'>Confirm</button>";
                    echo "<button type='button' class='btn btn-danger' data-mdb-ripple-init onclick='cancelBooking()'>Cancel</button>";
                    break;
                case 'accepted':
                    // Display reschedule, cancel, and completed task buttons
                    echo "<button type='button' class='btn btn-primary' data-mdb-ripple-init style='margin-right: 1rem;' onclick='rescheduleBooking()'>Reschedule</button>";
                    echo "<button type='button' class='btn btn-danger' data-mdb-ripple-init style='margin-right: 1rem;' onclick='cancelBooking()'>Cancel</button>";
                    echo "<button type='button' class='btn btn-success' data-mdb-ripple-init onclick='completeBooking()'>Completed Service</button>";
                    break;
                case 'completed':
                    // Display a message indicating that the task is completed
                    echo "<p style='color: black;'>service completed</p>";
                    break;
                    case 'cancelled':
                      // Display a message indicating that the task is completed
                      echo "<p style='color: black;'>service cancelled</p>";
                      break;
                default:
                    // Display a message indicating an invalid status
                    echo "<p style='color: black;'>Invalid Status</p>";
                    break;
            }
        } else {
            echo "User details not found.";
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
      <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      // echo $_SESSION['provider_id'];
      //  echo $_SESSION['suser_id']; 
       ?>

                <div class="card-body">
                    <iframe src="../chat/chat.php?user_id=<?php echo $_SESSION['suser_id']; ?>" frameborder="0" width="200%" height="100%"></iframe>
                    
                </div>
            </div>
           


      <!-- <div class="card">
        <div class="card-body">
          <section class="msger">
            <header class="msger-header">
              <div class="msger-header-title">
                <i class="fas fa-comment-alt"></i>Chat
              </div>
              <div class="msger-header-options">
                <span><i class="fas fa-cog"></i></span>
              </div>
            </header>

            <main class="msger-chat">
              <div class="msg left-msg">
                <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)">
                </div>

                <div class="msg-bubble">
                  <div class="msg-info">
                    <div class="msg-info-name">BOT</div>
                    <div class="msg-info-time">12:45</div>
                  </div>

                  <div class="msg-text">
                    Hi, welcome to SimpleChat! Go ahead and send me a message. 😄
                  </div>
                </div>
              </div>

              <div class="msg right-msg">
                <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)">
                </div>

                <div class="msg-bubble">
                  <div class="msg-info">
                    <div class="msg-info-name">Sajad</div>
                    <div class="msg-info-time">12:46</div>
                  </div>

                  <div class="msg-text">
                    You can change your name in JS section!
                  </div>
                </div>
              </div>
            </main>

            <form class="msger-inputarea">
              <input type="text" class="msger-input" placeholder="Enter your message...">
              <button type="submit" class="msger-send-btn">Send</button>
            </form>
          </section>
        </div>
      </div> -->


    </section>
  </main>






  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>


  <!--md-->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


  <script>
    function confirmBooking() {
      // Retrieve the value of the date and time input
      var dateTimeValue = document.getElementById('datetime').value;

      // Check if the date and time are filled
      if (dateTimeValue) {
        // Show confirmation dialog
        swal({
          text: "Are you sure to accept the service?",
          icon: "info",
          buttons: ["Cancel", "OK"],
          dangerMode: false,
        }).then((ok) => {
          if (ok) {
            // Send data to accept_booking.php
            var booking_id = '<?php echo $_GET['booking_id']; ?>';
            var formData = new FormData();
            formData.append('booking_id', booking_id);
            formData.append('booking_datetime', dateTimeValue);

            fetch('accept_booking.php', {
              method: 'POST',
              body: formData
            }).then(response => {
              if (response.ok) {
                // If response status is 200 OK, show success message
                swal("Success!", "Booking accepted successfully.", "success").then(() => {
                  // Reload the page
                  location.reload();
                });
              } else {
                // If response status is not 200, show error message
                swal("Error!", "Failed to accept booking.", "error");
              }
            }).catch(error => {
              console.error('Error:', error);
              // Show error message
              swal("Error!", "Failed to accept booking.", "error");
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
// Function to handle booking rescheduling
function rescheduleBooking() {
  // Retrieve the value of the date and time input
  var dateTimeValue = document.getElementById('datetime').value;

  // Check if the date and time are filled
  if (dateTimeValue) {
    // Show confirmation dialog for rescheduling
    swal({
      text: "Are you sure to reschedule and has the client agreed to the new time ?",
      icon: "info",
      buttons: ["Cancel", "OK"],
      dangerMode: false,
    }).then((ok) => {
      if (ok) {
        // Retrieve the booking ID from the query parameters
        var bookingId = '<?php echo $_GET['booking_id']; ?>';
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
          // Check response status
          if (response.status === 200) {
            // Show success message
            swal("Success!", "Booking rescheduled successfully.", "success").then(() => {
              // Reload the page
              location.reload();
            });
          } else {
            // Show error message
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
    // Function to cancel booking
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
                        if (response.status === 200) {
                            return response.text(); // Return the response text if status is 200
                        } else {
                            throw new Error('Failed to cancel booking'); // Throw an error if status is not 200
                        }
                    })
                    .then(result => {
                        // If cancellation is successful, show success message and redirect to myservices.php
                        swal("Success!", "Booking cancelled successfully.", "success").then(() => {
                            window.location.href = "myservices.php";
                        });
                    })
                    .catch(error => {
                        // If there is an error with the AJAX request or the status is not 200, show error message
                        console.error('Error:', error);
                        swal("Error!", "Failed to cancel booking.", "error");
                    });
            }
        });
    }
</script>


<script>
function completeBooking() {
    // Show confirmation dialog
    swal({
        text: "Are you sure the service has been completed?",
        icon: "info",
        buttons: ["Cancel", "Yes"],
        dangerMode: false,
    }).then((ok) => {
        if (ok) {
            // Send AJAX request to mark the booking as completed
            var bookingId = '<?php echo $_GET['booking_id']; ?>';
            fetch('complete_booking.php?booking_id=' + bookingId)
                .then(response => {
                    if (response.status === 200) {
                        // If the response status is 200, show success message
                        swal("Success!", "Booking marked as completed.", "success").then(() => {
                            // Optionally, you can redirect the user to another page or perform any other action
                            // For example:
                            window.location.href = "myservices.php";
                        });
                    } else {
                        // If the response status is not 200, show error message
                        swal("Error!", "Failed to mark booking as completed.", "error");
                    }
                })
                .catch(error => {
                    // If there is an error with the AJAX request, show error message
                    console.error('Error:', error);
                    swal("Error!", "Failed to mark booking as completed.", "error");
                });
        }
    });
}
</script>

</script>













</body>

</html>