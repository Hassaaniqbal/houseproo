<?php
session_start(); // Start the session to enable session usage

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>company service provider list</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    #sidebar {
      background-color: #343a40;
      color: white;
      height: 100vh;
    }

    #sidebar a {
      color: white;
    }
  </style>

  <script defer src="https://code.jquery.com/jquery-3.7.0.js"> </script>
  <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script defer src="./javascript/script.js"></script>


</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Admin Panel</a>

    <button type="button" class="btn btn-danger ml-auto" style="margin-right: 4rem;" data-mdb-ripple-init>
      <a href="logout.php" style="color: white; text-decoration: none;">Logout</a>
    </button>

  </nav>

  <div class="container-fluid">
    <div class="row">

      <!-- Sidebar -->
      <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column" style="margin-top: 4rem;">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="users.php">
                Users
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="spcompany.php">
                Company service Providers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="spfreeelance.php">
                Freelance service Providers
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Main Content -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <!-- Content goes here -->
        <h2 style="margin-top: 2rem; margin-bottom: 2rem;">Company based service providers list</h2>

        <table id="example" class="table table-striped" style="width:100%">
          <thead>
            <tr>
              <th>Id</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Service Category</th>
              <th>Area</th>
              <th>Operations</th>
            </tr>
          </thead>


          <tbody>

            <?php
            require_once 'database.php';

            // Query to fetch data from the database
            $sql = "SELECT * FROM company_service_provider";
            $result = $mysqli->query($sql);

            // Check if any rows are returned
            if ($result->num_rows > 0) {
              // Fetch rows one by one and display them in the table
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["provider_id"] . "</td>";
                echo "<td>" . $row["firstname"] . "</td>";
                echo "<td>" . $row["lastname"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["number"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>" . $row["area"] . "</td>";
                echo "<td>";

                // View Details button
                echo "<button type='button' class='btn btn-primary view-details-btn' data-provider-id='" . $row["provider_id"] . "' data-toggle='modal' data-target='#detailsModal' style='margin-right:1rem;'>View Details</button>";

                // Check if the status is "Approved"
                if ($row["status"] == "approved") {
                  echo "<button type='button' class='btn btn-secondary' style='margin-right:2rem; background-color: green;' disabled>Approved</button>";
                } else {
                  // Display the "Accept" button
                  echo "<button type='button' id='accept-btn' class='btn btn-success' style='margin-right:2rem;' data-provider-id='" . $row["provider_id"] . "'>Accept</button>";
                }

                // echo "<button type='button' class='btn btn-warning' data-mdb-ripple-init data-provider-id='" . $row["provider_id"] . "'>Reject</button>";
                // echo "<button type='button' class='btn btn-warning reject-btn' data-mdb-ripple-init data-provider-id='" . $row["provider_id"] . "'>Reject</button>";
            
                // Check if the status is "Rejected"
                if ($row["status"] == "rejected") {
                  echo "<button type='button' class='btn btn-warning reject-btn' disabled>Rejected</button>";
                } else {
                  // Display the "Reject" button
                  echo "<button type='button' class='btn btn-warning reject-btn' data-provider-id='" . $row["provider_id"] . "'>Reject</button>";
                }



                //echo "<button type='button' class='btn btn-danger'>Delete</button>";
                echo "<button type='button' class='btn btn-danger delete-btn' data-provider-id='" . $row["provider_id"] . "'>Delete</button>";

                echo "</td>";
                echo "</tr>";
              }
            } else {
              // If no rows are returned, display a message
              echo "<tr><td colspan='8'>No records found</td></tr>";
            }

            ?>




          </tbody>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Service Category</th>
              <th>Area</th>
              <th>Operations</th>
            </tr>
          </tfoot>
        </table>





        <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document"
            style="max-width: 900px;">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                

                <div id="providerIdContainer"></div>





              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

      </main>
    </div>
  </div>

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <!-- SweetAlert JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>





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
          url: 'company_sp_documents.php',
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
      // Retrieve the data-provider-id attribute value when the button is clicked
      $(document).on('click', '#accept-btn', function () {
        var button = $(this); // Reference to the clicked button
        var providerId = button.data('provider-id');

        // Display a SweetAlert confirmation dialog
        Swal.fire({
          title: 'Are you sure?',
          text: "Do you want to let the service provider " + providerId + " in?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, let in !',
          cancelButtonText: 'No, cancel!',
        }).then((result) => {
          if (result.isConfirmed) {
            // Send AJAX request to update status
            $.ajax({
              url: 'company_update_status.php',
              type: 'POST',
              data: { providerId: providerId },
              success: function (response) {
                // Display custom success message
                Swal.fire('Success', 'Status updated successfully and notified service provider', 'success').then(() => {
                  // Redirect to another page
                  window.location.href = 'spcompany.php'; 
                });
                // Update button appearance
                button.text('Approved');
                button.prop('disabled', true);
                button.addClass('btn-secondary');
                button.removeAttr('data-provider-id');
                button.attr('title', 'Provider ' + providerId + ' is approved');
              },
              error: function (xhr, status, error) {
                // Display error message
                Swal.fire('Error', 'Error updating status: ' + error, 'error');
              }
            });
          }
        });
      });
    });
  </script>



  <script>
    $(document).ready(function () {
      // Delete button click event
      $(document).on('click', '.delete-btn', function () {
        var providerId = $(this).data('provider-id');

        // Display a confirmation dialog
        Swal.fire({
          title: 'Are you sure?',
          text: "Do you want to delete/reject the service provider with ID " + providerId + "?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            // Send AJAX request to delete the provider
            $.ajax({
              url: 'delete_csp.php', // Path to your PHP script handling delete operation
              type: 'POST',
              data: { delete_provider_id: providerId },
              success: function (response) {
                // Display success message
                Swal.fire('Deleted!', response, 'success').then((result) => {
                  // Redirect to spcompany.php after displaying the success message
                  window.location.href = "spcompany.php";
                });
                // Reload the page or update the table as needed
              },
              error: function (xhr, status, error) {
                // Display error message
                Swal.fire('Error', 'Error deleting provider: ' + error, 'error');
              }
            });
          }
        });
      });
    });
  </script>


<script>
    $(document).ready(function () {
      // Reject button click event
      $(document).on('click', '.reject-btn', function () {
        var providerId = $(this).data('provider-id');

        // Display a confirmation dialog
        Swal.fire({
          title: 'Are you sure?',
          text: "Do you want to reject the service provider with ID " + providerId + "?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, reject it!',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            // Send AJAX request to handle rejection
            $.ajax({
              url: 'reject_csp.php', // PHP file to handle rejection
              type: 'POST',
              data: { providerId: providerId },
              success: function (response) {
                // Display success message
                if (response.includes('rejected successfully')) {
                  Swal.fire('Rejected!', 'Provider rejected successfully.', 'success').then((result) => {
                    // Redirect or update the page as needed
                    location.reload(); // reload the page
                  });
                } else {
                  Swal.fire('Error', response, 'error');
                }
              },
              error: function (xhr, status, error) {
                // Display error message
                Swal.fire('Error', 'Error rejecting provider: ' + error, 'error');
              }
            });
          }
        });
      });
    });
  </script>



</body>



</html>