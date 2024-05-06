<?php
session_start();

// Increment the current question number
if (isset($_SESSION['current_question_number'])) {
    $_SESSION['current_question_number']++;
} else {
    $_SESSION['current_question_number'] = 1;
}
