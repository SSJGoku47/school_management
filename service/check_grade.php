<?php
require_once '../config/database.php';

header('Content-Type: application/json');

// Check if the POST request contains the required parameters
if (isset($_POST['student_id']) && isset($_POST['subject_id'])) {
    $studentId = $_POST['student_id'];
    $subjectId = $_POST['subject_id'];

    // Prepare the SQL statement to check for existing grade
    $sql = "SELECT COUNT(*) FROM marks WHERE student_id = :student_id AND subject_id = :subject_id";
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
    $stmt->bindParam(':subject_id', $subjectId, PDO::PARAM_INT);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Fetch the count
        $count = $stmt->fetchColumn();
        
        // Prepare the response
        $response = ['exists' => $count > 0];
    } else {
        $response = ['error' => 'Query execution failed'];
    }
} else {
    $response = ['error' => 'Invalid input'];
}

// Send the response back to AJAX
echo json_encode($response);
