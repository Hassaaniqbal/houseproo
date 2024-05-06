<?php
require_once 'database.php';

// Check if providerId is set and numeric
if (isset($_POST['providerId']) && is_numeric($_POST['providerId'])) {
    $providerId = $_POST['providerId'];

    // Fetch details from both tables based on provider ID
    $sql = "SELECT * FROM freelance_service_provider fsp INNER JOIN freelance_sp_documents fsd ON fsp.provider_id = fsd.provider_id WHERE fsp.provider_id = ?";
    $stmt = $mysqli->prepare($sql);

    if (!$stmt) {
        die("Error in prepared statement: " . $mysqli->error);
    }

    $stmt->bind_param("i", $providerId);
    if (!$stmt->execute()) {
        die("Error executing prepared statement: " . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display details
        $row = $result->fetch_assoc();


        // Display Profile Picture
        //echo "<p><strong>Profile Picture:</strong></p>";

        

        echo '<div style="display: flex; align-items: center;">
        
            <img src="../service provider/uploads/freelance sp/pictures/' . $row['picture'] . '" class="img-fluid rounded" style="height: 12rem; width: 12rem;" alt="Profile Picture" />
            <div>
              <h4 style="margin-left: 1rem; color: black; font-weight: 600;">' . $row['firstname'] . ' ' . $row['lastname'] . '</h4>
              <p style="margin-left: 1rem; font-size: 20px;">' . $row['category'] . '</p>
              
            </div>  
          </div>';

        // Display Skills & Experience
        echo '<h4 style="color: black; font-weight: 600; margin-top: 2rem;">Skills & Experience</h4>
          <p style="font-size: 20px;">' . $row['description'] . '</p>';


        echo '<hr>';

        //echo "<img src='../service provider/uploads/pictures/" . $row['picture'] . "' alt='Profile Picture' class='rounded mx-auto d-block'  style='width: 200px; height: 200px; margin-bottom: 1rem;'><br>";


        //echo "<p><strong>Name:</strong> " . $row['firstname'] . " " . $row['lastname'] . "</p>";
      

        echo "<p><strong>Number:</strong> " . $row['number'] . "</p>";
        echo "<p><strong>Proffession:</strong> " . $row['category'] . "</p>";
        echo "<p><strong>Area:</strong> " . $row['area'] . "</p>";
        echo "<p><strong>Role:</strong> " . $row['role'] . " based service provider</p>";
        echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
        // echo "<p><strong>Address:</strong> " . $row['address'] . "</p>";
        echo "<p><strong>Zip Code:</strong> " . $row['zipcode'] . "</p>";


        echo "<p><strong>Date Joined:</strong> " . $row['date'] . "</p>";
        echo '<hr>';
      



        
        // Step 1: Query bookings table to get relevant booking_ids
        $bookingSql = "SELECT booking_id FROM bookingg WHERE provider_id = ? AND sptype = 'freelance' AND status = 'completed' AND review_status = 'completed'";
        $bookingStmt = $mysqli->prepare($bookingSql);
        $bookingStmt->bind_param("i", $providerId);
        if (!$bookingStmt->execute()) {
            die("Error executing booking prepared statement: " . $bookingStmt->error);
        }
        $bookingResult = $bookingStmt->get_result();

        // Array to store booking_ids
        $bookingIds = [];
        while ($bookingRow = $bookingResult->fetch_assoc()) {
            $bookingIds[] = $bookingRow['booking_id'];
        }

        $bookingStmt->close();

        // Check if there are reviews available
        if (!empty($bookingIds)) {
            // Step 2: Query reviews table to get ratings for collected booking_ids
            $ratingSql = "SELECT rating FROM reviews WHERE booking_id IN (" . implode(',', $bookingIds) . ")";
            $ratingResult = $mysqli->query($ratingSql);

            // Variables to calculate ratings
            $totalReviews = 0;
            $totalRating = 0;
            $ratingCounts = array_fill(1, 5, 0);

            while ($ratingRow = $ratingResult->fetch_assoc()) {
                $rating = $ratingRow['rating'];
                $totalRating += $rating;
                $ratingCounts[$rating]++;
                $totalReviews++;
            }

            // Step 3: Calculate average rating
            $averageRating = $totalReviews > 0 ? round($totalRating / $totalReviews, 1) : 0;

            // Display the ratings in the specified UI format
            echo '<h4 style="color: black; font-weight: 600; margin-top: 2rem;">Rating & Review</h4>';
            echo '<div class="card" style="margin-top: 2rem;">
                    <h4 style="color: black; font-weight: 600; margin-top: 2rem; margin-left: 2rem;">Rating</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <h1 class="text-warning mt-4 mb-4">
                                    <b><span id="average_rating">' . $averageRating . '</span> / 5</b>
                                </h1>
                                <div class="mb-3">';

            // Display star rating
            for ($i = 1; $i <= 5; $i++) {
                echo '<i class="fas fa-star ' . ($i <= $averageRating ? 'text-warning' : 'star-light') . ' mr-1 main_star"></i>';
            }

            echo '              </div>
                                <h3><span id="total_review">' . $totalReviews . '</span> Review</h3>
                            </div>
                            <div class="col-sm-4">';

            // Display individual star rating progress bars
            for ($i = 5; $i >= 1; $i--) {
                echo '<p>
                                <div class="progress-label-left"><b>' . $i . '</b> <i class="fas fa-star text-warning"></i></div>
                                <div class="progress-label-right">(<span id="total_' . $i . '_star_review">' . $ratingCounts[$i] . '</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="' . ($ratingCounts[$i] / $totalReviews * 100) . '"
                                        aria-valuemin="0" aria-valuemax="100" id="' . $i . '_star_progress" style="width: ' . ($ratingCounts[$i] / $totalReviews * 100) . '%"></div>
                                </div>
                                </p>';
            }

            echo '              </div>
                        </div>
                    </div>
                </div>';

            // Step 4: Display Reviews
            echo '<h4 style="color: black; font-weight: 600; margin-top: 2rem;">Reviews</h4>';

            // Query to fetch reviews
            $reviewSql = "SELECT r.rating, r.review_text, r.date, u.firstname, u.lastname, u.picture, u.email 
                          FROM reviews r 
                          JOIN users u ON r.user_id = u.id 
                          WHERE r.booking_id IN (" . implode(',', $bookingIds) . ")";

            $reviewResult = $mysqli->query($reviewSql);

            if ($reviewResult->num_rows > 0) {
                while ($reviewRow = $reviewResult->fetch_assoc()) {
                    echo '<div class="card" style="margin-top: 2rem;">
                            <div class="card-body">
                              <div class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <div class="d-flex align-items-center">
                                    <img src="' . $reviewRow['picture'] . '" alt="" style="width: 45px; height: 45px"
                                      class="rounded-circle" />
                                    <div class="ms-3">
                                      <p class="fw-bold mb-1">' . $reviewRow['firstname'] . ' ' . $reviewRow['lastname'] . '</p>
                                      <p class="text-muted mb-0">' . $reviewRow['email'] . '</p>
                                    </div>
                                  </div>
                                  <div>';

                    // Display star rating
                    for ($i = 1; $i <= $reviewRow['rating']; $i++) {
                        echo '<i class="fa-solid fa-star text-warning"></i>';
                    }

                    echo '</div>
                                </li>
                                <br>
                                <p>' . $reviewRow['review_text'] . '</p>
                              </div>
                              <p>' . $reviewRow['date'] . '</p>
                            </div>
                          </div>';
                }
            } else {
                // Display message when there are no reviews
                echo '<div class="card" style="margin-top: 2rem;">
                        <div class="card-body">No reviews Yet.</div>
                      </div>';
            }
        } else {
            // Display message when there are no reviews
            echo '<h4 style="color: black; font-weight: 600; margin-top: 2rem;">Rating & Review</h4>';
            echo '<div class="card" style="margin-top: 2rem;">
                    <div class="card-body">
                        <p>No reviews Yet.</p>
                    </div>
                </div>';
        }
    } else {
        echo "No details found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}
?>
