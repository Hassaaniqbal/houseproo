<?php
// Start the session
session_start();

//Check if the session variables are set
if (isset ($_SESSION["provider_id"]) && isset ($_SESSION["name"]) && isset ($_SESSION["role"])) {
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




// Include the database connection file
require_once "database.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'description' field is set and not empty
    if (isset ($_POST["description"]) && !empty ($_POST["description"])) {
        $description = $_POST["description"];

        // Update the description based on the provider's role
        if ($role === 'company') {
            $update_sql = "UPDATE company_sp_documents SET description = ? WHERE provider_id = ?";
        } elseif ($role === 'freelance') {
            $update_sql = "UPDATE freelance_sp_documents SET description = ? WHERE provider_id = ?";
        } else {
            echo "Invalid role.";
            exit;
        }

        // Prepare and execute the update statement
        $stmt = $mysqli->prepare($update_sql);
        $stmt->bind_param("si", $description, $provider_id);
        if ($stmt->execute()) {
            echo "Description updated successfully.";
        } else {
            echo "Error updating description: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Description field is required.";
    }
}







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sp profile</title>
</head>

<link rel="stylesheet" type="text/css" href="./css/spprofile.css" />


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

    <main id="main">
        <section id="sectionone">

            <div class="card">
                <div class="card-body">
                    <a style="margin-left:1rem;" href="logout.php" class="btn btn-danger" role="button">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <br>
                    <?php
                    require_once "database.php";
                    if ($role === 'company') {
                        // Query to fetch details from company_service_provider and company_sp_documents tables
                        $sql = "SELECT csp.firstname, csp.lastname, csp.number, csp.category, csp.area, csp.email,
                       csd.address, csd.zipcode, csd.companyname, csd.companyaddress, csd.date, csd.picture, csd.description
                FROM company_service_provider csp
                INNER JOIN company_sp_documents csd ON csp.provider_id = csd.provider_id
                WHERE csp.provider_id = $provider_id";

                        $result = $mysqli->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Display fetched details
                                echo "<div>";

                                //echo "<p><strong>Profile Picture:</strong></p>";
                    
                                echo "<img src='uploads/pictures/" . $row['picture'] . "' alt='Profile Picture' class='rounded mx-auto d-block'  style='width: 200px; height: 200px; margin-bottom: 1rem;'><br>";


                                echo '<h4 style="color: black; font-weight: 600; margin-top: 2rem;">Skills & Experience</h4>';
                                echo "<p style='font-size: 20px;'>" . $row["description"] . "</p>";

                                echo '<hr>';


                                echo "<p>Name: " . $row["firstname"] . " " . $row["lastname"] . "</p>";

                                echo "<p>Role: $role</p>";
                                echo "<p>Number: " . $row["number"] . "</p>";
                                echo "<p>Category: " . $row["category"] . "</p>";
                                echo "<p>Area: " . $row["area"] . "</p>";
                                echo "<p>Email: " . $row["email"] . "</p>";
                                echo "<p>Address: " . $row["address"] . "</p>";
                                echo "<p>Zipcode: " . $row["zipcode"] . "</p>";
                                echo "<p>Company Name: " . $row["companyname"] . "</p>";
                                echo "<p>Company Address: " . $row["companyaddress"] . "</p>";
                                echo "<p>Date Joined: " . $row["date"] . "</p>";
                                echo "</div>";
                            }
                        }
                    } elseif ($role === 'freelance') {
                        // Query to fetch details from freelance_service_provider and freelance_sp_documents tables
                        $sql = "SELECT fsp.firstname, fsp.lastname, fsp.number, fsp.category, fsp.area, fsp.email,
                       fsd.address, fsd.zipcode, fsd.date, fsd.picture, fsd.description
                FROM freelance_service_provider fsp
                INNER JOIN freelance_sp_documents fsd ON fsp.provider_id = fsd.provider_id
                WHERE fsp.provider_id = $provider_id";

                        $result = $mysqli->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Display fetched details
                                echo "<div>";
                                echo "<img src='uploads/freelance sp/pictures/" . $row['picture'] . "' alt='Profile Picture' class='rounded mx-auto d-block'  style='width: 200px; height: 200px; margin-bottom: 1rem;'><br>";

                                echo '<h4 style="color: black; font-weight: 600; margin-top: 2rem;">Skills & Experience</h4>';
                                echo "<p style='font-size: 20px;'>" . $row["description"] . "</p>";
                                echo '<hr>';


                                echo "<p>Name: " . $row["firstname"] . " " . $row["lastname"] . "</p>";

                                echo "<p>Number: " . $row["number"] . "</p>";
                                echo "<p>Category: " . $row["category"] . "</p>";
                                echo "<p>Area: " . $row["area"] . "</p>";
                                echo "<p>Email: " . $row["email"] . "</p>";
                                echo "<p>Address: " . $row["address"] . "</p>";
                                echo "<p>Zipcode: " . $row["zipcode"] . "</p>";
                                echo "<p>Date: " . $row["date"] . "</p>";
                                echo "</div>";
                            }
                        }
                    } else {
                        // Invalid role
                        echo "Invalid role.";
                    }
                    ?>

                </div>
            </div>
        </section>
        <br><br>

        <section>
            <div class="card" id="cardd">
                <div class="card-body">






                    <form action="sp_profile.php" method="post" enctype="multipart/form-data">
                        <p>UPDATE DESCRIPTION</p>

                        <div class="form-outline" data-mdb-input-init>
                            <textarea class="form-control" name="description" id="textAreaExample" rows="4"></textarea>
                            <label class="form-label" for="textAreaExample">Description</label>
                        </div>
                        <br>

                        <!-- Submit button -->
                        <button data-mdb-ripple-init type="submit"
                            class="btn btn-primary btn-block mb-4">Update</button>
                    </form>
                </div>
            </div>
        </section>


        <?php
        // Fetch and display ratings and reviews based on role and provider_id
        if ($role === 'company') {
            // Check if the provider_id exists in the bookingg table and it's associated with the company role
            $booking_check_sql = "SELECT * FROM bookingg WHERE provider_id = ? AND sptype = 'company'";
        } elseif ($role === 'freelance') {
            // Check if the provider_id exists in the bookingg table and it's associated with the freelance role
            $booking_check_sql = "SELECT * FROM bookingg WHERE provider_id = ? AND sptype = 'freelance'";
        } else {
            // Invalid role
            echo "Invalid role.";
            exit;
        }

        // Prepare and execute the statement to check booking
        $stmt_booking = $mysqli->prepare($booking_check_sql);
        $stmt_booking->bind_param("i", $provider_id);
        $stmt_booking->execute();
        $result_booking = $stmt_booking->get_result();

        // Initialize arrays to store review data
        $reviews = [];
        $total_rating = 0;
        $total_reviews = 0;

        // If there are bookings found
        if ($result_booking->num_rows > 0) {
            while ($row_booking = $result_booking->fetch_assoc()) {
                $booking_id = $row_booking['booking_id'];
                // Fetch reviews for each booking_id
                $reviews_sql = "SELECT * FROM reviews WHERE booking_id = ?";
                $stmt_reviews = $mysqli->prepare($reviews_sql);
                $stmt_reviews->bind_param("i", $booking_id);
                $stmt_reviews->execute();
                $result_reviews = $stmt_reviews->get_result();

                // If reviews are found for the booking
                if ($result_reviews->num_rows > 0) {
                    while ($row_review = $result_reviews->fetch_assoc()) {
                        // Fetch user details based on user_id
                        $user_id = $row_review['user_id'];
                        $user_sql = "SELECT * FROM users WHERE id = ?";
                        $stmt_user = $mysqli->prepare($user_sql);
                        $stmt_user->bind_param("i", $user_id);
                        $stmt_user->execute();
                        $result_user = $stmt_user->get_result();
                        $row_user = $result_user->fetch_assoc();

                        // Construct review data array
                        $review_data = [
                            'user_name' => $row_user['firstname'] . ' ' . $row_user['lastname'],
                            'user_picture' => $row_user['picture'],
                            'rating' => $row_review['rating'],
                            'review_text' => $row_review['review_text'],
                            'date' => $row_review['date']
                        ];

                        // Add review data to reviews array
                        $reviews[] = $review_data;

                        // Update total rating and total reviews count
                        $total_rating += $row_review['rating'];
                        $total_reviews++;
                    }
                }
            }
        }

        // Calculate average rating
        $average_rating = $total_reviews > 0 ? round($total_rating / $total_reviews, 1) : 0;
        ?>

        <!-- UI Section to Display Ratings and Reviews -->
<h4 style="color: black; font-weight: 600; margin-top: 2rem;">Rating & Review</h4>
<div class="card" style="margin-top: 2rem;">
    <h4 style="color: black; font-weight: 600; margin-top: 2rem; margin-left: 2rem;">Rating</h4>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4 text-center">
                <h1 class="text-warning mt-4 mb-4">
                    <b><span id="average_rating"><?php echo $average_rating; ?></span> / 5</b>
                </h1>
                <div class="mb-3">
                    <?php
                    // Output stars for average rating
                    $full_stars = floor($average_rating);
                    $half_star = $average_rating - $full_stars >= 0.5 ? true : false;
                    for ($i = 0; $i < $full_stars; $i++) {
                        echo '<i class="fas fa-star text-warning star-light mr-1 main_star"></i>';
                    }
                    if ($half_star) {
                        echo '<i class="fas fa-star-half-alt text-warning star-light mr-1 main_star"></i>';
                        $full_stars++; // Increment full stars count for accurate progress bar
                    }
                    $empty_stars = 5 - $full_stars;
                    for ($i = 0; $i < $empty_stars; $i++) {
                        echo '<i class="far fa-star star-light mr-1 main_star"></i>';
                    }
                    ?>
                </div>
                <h3><span id="total_review"><?php echo $total_reviews; ?></span> Review</h3>
            </div>
            <!-- Display progress bars for different star ratings -->
            <div class="col-sm-4">
                <?php
                // Fetch and display progress bars for different star ratings
                for ($i = 5; $i >= 1; $i--) {
                    $total_star_reviews = array_filter($reviews, function ($review) use ($i) {
                        return $review['rating'] == $i;
                    });
                    $total_star_reviews_count = count($total_star_reviews);
                    $progress_id = "star_" . $i . "_progress";
                    echo '<p>';
                    echo '<div class="progress-label-left"><b>' . $i . '</b> <i class="fas fa-star text-warning"></i></div>';
                    echo '<div class="progress-label-right">(<span id="total_' . $i . '_star_review">' . $total_star_reviews_count . '</span>)</div>';
                    echo '<div class="progress">';
                    echo '<div class="progress-bar bg-warning" role="progressbar" aria-valuenow="' . ($total_star_reviews_count / $total_reviews * 100) . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . ($total_star_reviews_count / $total_reviews * 100) . '%" id="' . $progress_id . '"></div>';
                    echo '</div>';
                    echo '</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>


<div class="mt-5" id="review_content" style="height: 600px; overflow-y: auto; margin-bottom: 10rem;">
    <?php
    // Display individual reviews
    foreach ($reviews as $review) {
        echo '<div class="review-card" style="margin-top: 2rem;">
                <div class="card-body">
                  <div class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="d-flex align-items-center">
                        <img src="../user/' . $review['user_picture'] . '" alt="" style="width: 45px; height: 45px"
                          class="rounded-circle" />
                        <div class="ms-3">
                          <p class="fw-bold mb-1">' . $review['user_name'] . '</p>
                          <p class="text-muted mb-0">' . $review['date'] . '</p>
                        </div>
                      </div>
                      <div>';

        // Output stars for individual review rating
        for ($i = 0; $i < $review['rating']; $i++) {
            echo '<i class="fas fa-star text-warning"></i>'; // Add text-warning class to make stars gold
        }

        echo '</div>
                    </li>
                    <br>
                    <p>' . $review['review_text'] . '</p>


                    <!--SHOULD DO REVIEW REPLY FUNCTIONN-->
                    <div class="reply-form">
                      <form action="process_reply.php" method="post"> <!-- Adjust action and method as per your requirements -->
                        <div class="mb-3">
                          <label for="reply_text" class="form-label">Reply to Review:</label>
                          <textarea class="form-control" id="reply_text" name="reply_text" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Reply</button>
                      </form>
                    </div>
                    
                    <hr>

                    
                  </div>
                </div>
              </div>';
    }
    ?>
</div>








        <!--
        <div>
            <div class="card" style="margin-top: 2rem;">
                <h4 style="color: black; font-weight: 600; margin-top: 2rem; margin-left: 2rem;">Review &Rating</h4>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 text-center">
                            <h1 class="text-warning mt-4 mb-4">
                                <b><span id="average_rating">0.0</span> / 5</b>
                            </h1>
                            <div class="mb-3">
                                <i class="fas fa-star star-light mr-1 main_star"></i>
                                <i class="fas fa-star star-light mr-1 main_star"></i>
                                <i class="fas fa-star star-light mr-1 main_star"></i>
                                <i class="fas fa-star star-light mr-1 main_star"></i>
                                <i class="fas fa-star star-light mr-1 main_star"></i>
                            </div>
                            <h3><span id="total_review">0</span> Review</h3>
                        </div>
                        <div class="col-sm-4">
                            <p>
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                            </p>
                            <p>
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>
                            </p>
                            <p>
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>
                            </p>
                            <p>
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>
                            </p>
                            <p>
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="mt-5" id="review_content"></div>
        </div>


        <section id="sectionthree" style="margin-top: 2rem;">


        <div class="card">
                          <div class="card-body">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              <div class="d-flex align-items-center">
                                <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px"
                                  class="rounded-circle" />
                                <div class="ms-3">
                                  <p class="fw-bold mb-1">John Doe</p>
                                  <p class="text-muted mb-0">john.doe@gmail.com</p>
                                </div>
  
                              </div>
                              <div>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                  </div>
                            </li>
                            <br>
                            <p>Outstanding work! [Service Provider's Name] transformed our space with their expert painting skills. Professional, reliable, and the results speak for themselves. Highly recommended!"

"Impressive service! [Service Provider's Name] tackled our painting project with precision and care. From color selection to execution, they exceeded our expectations. A pleasure to work with!</p>
<p>Date: 19/03.2024</p>
                          </div>
                          
                        </div>


        </section>

-->

    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>


    <!--md-->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

</body>

</html>