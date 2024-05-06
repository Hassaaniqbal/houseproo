<?php
session_start();
require_once 'database.php'; // Include your database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the answer is provided
    if (!empty($_POST["answer"])) {
        // Get the form data
        $provider_id = $_POST["provider_id"];
        $question_id = $_POST["question_id"];
        $answer = trim($_POST["answer"]);

        // Insert the response into the database
        $insert_response = $mysqli->prepare("INSERT INTO responses (provider_id, question_id, answer) VALUES (?, ?, ?)");
        $insert_response->bind_param("iis", $provider_id, $question_id, $answer);

        if ($insert_response->execute()) {
            // Check if it's the last question
            if ($_SESSION['current_question_number'] >= 10) {
                // Redirect to the next page after finishing all questions
                header("Location: freelance_status2.php");
                exit;
            } else {
                // Redirect back to the quiz page to continue
                header("Location: quiz.php");
                exit;
            }
        } else {
            // Error
            echo "Error: " . $insert_response->error;
        }
        $insert_response->close();
    } else {
        // If answer is not provided, redirect back to the quiz page
        header("Location: quiz.php");
        exit;
    }
} else {
    // If the form is not submitted via POST method, redirect back to the quiz page
    header("Location: quiz.php");
    exit;
}
?>
