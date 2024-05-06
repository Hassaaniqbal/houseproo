<?php
// Include the database connection file
include 'database.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the provider_id from the request
    $providerId = $_POST['provider_id'];

    // Initialize an array to store all data
    $responseData = array();

    // Fetch question and answer from the database based on provider_id
    $sql = "SELECT q.question, r.answer 
            FROM responses r 
            INNER JOIN questions q ON r.question_id = q.question_id 
            WHERE r.provider_id = ?";

    // Prepare and bind the SQL statement for question-answer pairs
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $providerId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize an array to store all question-answer pairs
    $questionAnswers = array();

    // Fetch all rows and store them in the array
    while ($row = $result->fetch_assoc()) {
        $questionAnswers[] = $row;
    }

    // Add question-answer pairs to the response data
    $responseData['questions_answers'] = $questionAnswers;

    // Fetch score and status from llm_response table
    $sql = "SELECT score, status FROM llm_response WHERE provider_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $providerId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the score and status
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $responseData['score'] = $row['score'];
        $responseData['status'] = $row['status'];
    } else {
        // Set default values if no record found
        $responseData['score'] = null;
        $responseData['status'] = null;
    }

    // Return the response data as JSON
    echo json_encode($responseData);
} else {
    // Return an error if the request method is not POST
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("message" => "Method Not Allowed"));
}

// Close the database connection
$mysqli->close();
?>
