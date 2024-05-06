<?php
session_start();
require_once 'database.php'; //include database 
// Check if the session variables are set
if (isset ($_SESSION["provider_id"]) && isset ($_SESSION["name"]) && isset ($_SESSION["role"])) {
    $provider_id = $_SESSION["provider_id"];
    $name = $_SESSION["name"];
    $role = $_SESSION["role"];

    // Check if questions are already set in the session
    if (!isset ($_SESSION['questions'])) {
        // Fetch 10 random questions based on the provider's category
        $category_query = $mysqli->query("SELECT category FROM freelance_service_provider WHERE provider_id = $provider_id");
        $category_row = $category_query->fetch_assoc();
        $category = $category_row['category'];
        $questions_query = $mysqli->query("SELECT * FROM questions WHERE category = '$category' ORDER BY RAND() LIMIT 10");
        // Store the questions in the session
        $_SESSION['questions'] = $questions_query->fetch_all(MYSQLI_ASSOC);
        // Reset current question number
        $_SESSION['current_question_number'] = 0;
    }
    // Get the current question number from session or set it to 0 if not set
    $current_question_number = isset ($_SESSION['current_question_number']) ? $_SESSION['current_question_number'] : 0;
    // Get the current question from the session
    $questions = $_SESSION['questions'];
    $current_question = $questions[$current_question_number];
    // Increment the current question number
    $_SESSION['current_question_number']++;
} else {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interview Quiz</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet">
    <link href="css/quizePage.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-light bg-white fixed-top">
        <div class="container d-flex justify-content-center">
            <a class="navbar-brand" href="#">
                <img src="assets/images/green/1.png" height="50" alt="Your Logo">
            </a>
        </div>
    </nav>

    <!-- Cards Section -->
    <div class="container-fluid h-100 d-flex align-items-center justify-content-center">
        <div class="row">
            <!-- First Card (Bigger Width) -->
            <div class="col-lg-8 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <!-- Box in Center -->

                        <div class="box-container">
                            <div class="box">
                                <p class="box-text">
                                    <?php echo $current_question['question']; ?>
                                </p>
                            </div>
                        </div>
                        <!-- Textarea -->
                        <form id="answerForm" action="submit_answer.php" method="POST"
                            onsubmit="return validateForm();">
                            <textarea class="form-control mt-5" name="answer" id="answer" rows="5"
                                placeholder="Type Your Answer Here"></textarea>
                            <input type="hidden" name="provider_id" value="<?php echo $provider_id; ?>">
                            <input type="hidden" name="question_id"
                                value="<?php echo $current_question['question_id']; ?>">
                            <?php if ($_SESSION['current_question_number'] < 10) { ?>
                                <button type="submit" class="btn btn-success btn-lg mt-3">Next</button>
                            <?php } else { ?>
                                <button type="submit" class="btn btn-success btn-lg mt-3">Finish</button>
                            <?php } ?>
                        </form>


                    </div>
                </div>
            </div>
            <!-- Second Card (Smaller Width) -->
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title" style="margin-top: 10px;">Question <span id="questionNumber">
                                <?php echo str_pad($_SESSION['current_question_number'], 2, '0', STR_PAD_LEFT); ?>
                            </span></h5>
                        </h5>

                        <!-- Time Left Box -->
                        <div class="time-left-box">
                            Time Left: <span id="timeLeft">05:00</span> <!-- Adjust the time left dynamically -->
                        </div>

                        <!-- Buttons -->
                        <div class="text-center mt-5">
                            <a href="freelance_status2.php" class="btn btn-danger btn-lg">Quit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

    <script>
        // JavaScript code for handling timer and form submission
        var timer = 300; 
        var timerInterval = setInterval(updateTimer, 1000);

        function updateTimer() {
            var minutes = Math.floor(timer / 60);
            var seconds = timer % 60;
            var timeString = minutes.toString().padStart(2, '0') + ":" + seconds.toString().padStart(2, '0');
            document.getElementById("timeLeft").innerText = timeString;

            if (timer <= 0) {
                clearInterval(timerInterval);
                var answer = document.getElementById("answer").value.trim();
                if (answer === "") {
                    answer = "No Answer";
                }
                var questionId = <?php echo $current_question['question_id']; ?>;
                var providerId = <?php echo $provider_id; ?>;
                // Send question ID, answer, and provider ID to submit_answer.php using AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "submit_answer.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Optionally handle the response
                        console.log(xhr.responseText);
                        // Proceed to the next question if available
                        if (<?php echo $_SESSION['current_question_number']; ?> < 10) {
                            getNextQuestion();
                        }
                    }
                };
                xhr.send("question_id=" + questionId + "&answer=" + encodeURIComponent(answer) + "&provider_id=" + providerId);
                alert("Time's up! Moving on to the next question.");
            } else {
                timer--;
            }
        }

        function validateForm() {
            var answer = document.getElementById("answer").value.trim();
            if (answer === "") {

                alert("Please provide an answer.");
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }

        function getNextQuestion() {
            // Logic to fetch and display the next question goes here
            // For now, let's just reload the page
            location.reload();
        }
    </script>




</body>

</html>