<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Admin Dashboard</title>
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

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <!-- Content goes here -->
    <h2 style="margin-top: 2rem; margin-bottom: 2rem;">Users list</h2>

    <div style="max-height: calc(100vh - 100px); overflow-y: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection file
                $mysqli = include 'database.php';

                // SQL query to fetch users from the 'users' table
                $sql = "SELECT id, firstname, lastname, email, number FROM users";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row["id"] . "</th>";
                        echo "<td>" . $row["firstname"] . "</td>";
                        echo "<td>" . $row["lastname"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["number"] . "</td>";
                        //echo "<td><button type='button' class='btn btn-danger'>Delete</button></td>";
                        echo "<td><button type='button' class='btn btn-danger' onclick='deleteUser(" . $row["id"] . ")'>Delete</button></td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No users found</td></tr>";
                }

                // Close the connection
                $mysqli->close();
                ?>
            </tbody>
        </table>
    </div>
</main>



    </div>
  </div>

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<!-- Include SweetAlert CSS and JS -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<script>
function deleteUser(userId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "delete_user.php",
                data: { user_id: userId },
                success: function(response) {
                    Swal.fire(
                        'Deleted!',
                        'User has been deleted.',
                        'success'
                    ).then(() => {
                        window.location.href = 'users.php'; // Redirect to users.php
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'Failed to delete user.',
                        'error'
                    );
                }
            });
        }
    });
}
</script>
</body>
</html>
