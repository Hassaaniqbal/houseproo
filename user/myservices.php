<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
</head>

<link rel="stylesheet" type="text/css" href="./css/myservices.css" />


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


<!-- md-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
<!-- Google Fonts 
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
-->

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>


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

        <section id="sectionone">
            <h2 style="font-weight: 700;  color: black;">My Bookings</h2>


        </section>

        <section id="sectiontwo" style="margin-top: 3rem;">

            <?php
            // Start the session
            session_start();

            // Check if the user is logged in
            if (!isset ($_SESSION['user_id'])) {
                // Redirect to the login page if not logged in
                header("Location: login.php");
                exit;
            }

            // Include the database connection file
            require_once "database.php";

            // Fetch bookings for the logged-in user
            $user_id = $_SESSION['user_id'];

            // Prepare the SQL query to fetch bookings for the user with pending or accepted status
            $sql = "SELECT * FROM bookingg WHERE user_id = ? AND (status IN ('pending', 'accepted') OR (status = 'completed' AND review_status = 'pending'))";

            // Prepare the SQL statement
            $stmt = $mysqli->prepare($sql);
            if ($stmt === false) {
                die ("Error preparing statement: " . $mysqli->error);
            }

            // Bind parameters
            if (!$stmt->bind_param("i", $user_id)) {
                die ("Error binding parameters: " . $stmt->error);
            }

            // Execute the statement
            if (!$stmt->execute()) {
                die ("Error executing statement: " . $stmt->error);
            }

            // Get the result
            $result = $stmt->get_result();

            // Check if there are any bookings for the user
            if ($result->num_rows > 0) {
                // Fetch the data and display each booking separately
                while ($row = $result->fetch_assoc()) {
                    // Display booking details in separate divs
                    echo "<div class='card' style='margin-bottom: 1rem;'>";
                    echo "<div class='card-body'>";
                    echo "<div class='list-group-item d-flex justify-content-between align-items-center'>";
                    echo "<div class='d-flex align-items-center'>";
                    echo "<div class='ms-3'>";
                    echo "<p class='fw-bold mb-1'>Booking ID: " . $row['booking_id'] . "</p>";
                    echo "<p class='text-muted mb-0'>Provider ID: " . $row['provider_id'] . "</p>";
                    echo "<p class='text-muted mb-0'>Booking Datetime: " . $row['booking_datetime'] . "</p>";
                    //echo "<p class='text-muted mb-0'>Description: " . $row['description'] . "</p>";
                    echo "<p class='text-muted mb-0'>Address: " . $row['address'] . "</p>";
                    echo "<p class='text-muted mb-0'>Service Type: " . $row['sptype'] . "</p>";
                    echo "<p class='text-muted mb-0'>Category: " . $row['category'] . "</p>";
                    echo "<p class='text-muted mb-0'>Status: " . $row['status'] . "</p>";
                    echo "</div>";
                    echo "</div>";
                    if ($row['status'] === 'completed' && $row['review_status'] === 'pending') {
                        // Display a button to review if status is completed and review_status is pending
                        echo "<button type='button' class='btn btn-primary review-btn' data-booking-id='" . $row['booking_id'] . "' data-mdb-ripple-init>Review</button>";


                    } else {
                        // Hide view button if status is completed and review_status is pending
                        echo "<button type='button' class='btn btn-success' data-mdb-ripple-init onclick=\"window.location.href='booking_details.php?booking_id=" . $row['booking_id'] . "';\">View</button>";
                    }

                    echo "</div>";
                    echo "</div>";
                    echo "</div>";


                }
            } else {
                // No bookings found for the user
                echo "<p>No pending or accepted bookings found.</p>";
            }

            // Close the statement
            $stmt->close();

            // Close the database connection
            $mysqli->close();
            ?>


<!--add css later-->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reviewModalLabel">Write a Review</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="reviewForm" action="submit_review.php" method="POST">
          <!-- Span to display booking ID -->
          <!--<p>Booking ID: <span id="bookingIdDisplay"></span></p>-->

          <input type="hidden" id="bookingIdInput" name="bookingId" value="">


          <div class="mb-3">
            <label for="reviewRating" class="form-label">Rating</label>
            <div class="star-rating">
            <input type="radio" id="star1" name="rating" value="1">
              <label for="star1" class="star">&#9733;</label>

              <input type="radio" id="star2" name="rating" value="2">
              <label for="star2" class="star">&#9733;</label>

              <input type="radio" id="star3" name="rating" value="3">
              <label for="star3" class="star">&#9733;</label>

              <input type="radio" id="star4" name="rating" value="4">
              <label for="star4" class="star">&#9733;</label>

              <input type="radio" id="star5" name="rating" value="5">
              <label for="star5" class="star">&#9733;</label>
              
              
              
            </div>
          </div>

          <div class="mb-3">
            <label for="reviewText" class="form-label">Your Review</label>
            <textarea class="form-control" id="reviewText" name="review_text" rows="3" placeholder="Write your review here..." required></textarea>
          </div>

          <button type="submit" class="btn btn-primary" id="submitReviewBtn">Submit Review</button>
        </form>
      </div>
    </div>
  </div>
</div>














        </section>


    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>


    <!--md-->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>


        <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Get all elements with the class "review-btn"
    const reviewButtons = document.querySelectorAll('.review-btn');

    // Loop through each "Review" button
    reviewButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Get the booking ID associated with the clicked button
            const bookingId = this.dataset.bookingId;

            // Set the booking ID in the hidden input field inside the form
            document.getElementById('bookingIdInput').value = bookingId;

            // Show the modal
            const reviewModal = new bootstrap.Modal(document.getElementById('reviewModal'));
            reviewModal.show();
        });
    });

    // Add event listener to form submission
    document.getElementById('reviewForm').addEventListener('submit', function (event) {
        // Prevent the default form submission
        event.preventDefault();

        // Get the values of the rating and review text fields
        const rating = document.querySelector('input[name="rating"]:checked');
        const reviewText = document.getElementById('reviewText').value.trim();

        // Check if both fields are filled
        if (!rating) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select a rating.'
            });
            return;
        }

        if (reviewText === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter your review.'
            });
            return;
        }

        // If both fields are filled, submit the form
        Swal.fire({
            icon: 'success',
            title: 'Submit Review',
            text: 'Your review has been submitted successfully!'
        }).then(() => {
            this.submit();
        });
    });
});


</script>




</body>

</html>