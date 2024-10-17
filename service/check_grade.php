<?php
require_once '../config/database.php';

header('Content-Type: application/json');

if (isset($_POST['student_id']) && isset($_POST['subject_id'])) {
    $studentId = $_POST['student_id'];
    $subjectId = $_POST['subject_id'];

    // SQL statement to check for existing grade
    $sql = "SELECT COUNT(*) FROM marks WHERE student_id = :student_id AND subject_id = :subject_id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
    $stmt->bindParam(':subject_id', $subjectId, PDO::PARAM_INT);
    
    if ($stmt->execute()) {

        $count = $stmt->fetchColumn();
        
        // response
        $response = ['exists' => $count > 0];
    } else {
        $response = ['error' => 'Query execution failed'];
    }
} else {
    $response = ['error' => 'Invalid input'];
}

echo json_encode($response);
