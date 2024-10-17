<?php
require_once '../config/database.php';

if (isset($_GET['student_id'])) {
    $studentId = $_GET['student_id'];

    // Fetch student information and their marks with subject names
    $query = "
        SELECT 
            students.first_name,
            students.last_name,
            subjects.name AS subject_name,
            marks.marks
        FROM marks
        JOIN students ON marks.student_id = students.id
        JOIN subjects ON marks.subject_id = subjects.id
        WHERE students.id = :student_id
    ";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $reportData = [];
    $totalMarks = 0;
    $subjectCount = 0;

    if ($result) {
        foreach ($result as $row) {
            $reportData[] = [
                'subject_name' => $row['subject_name'],
                'marks' => $row['marks']
            ];
            $totalMarks += $row['marks'];
            $subjectCount++;
        }

        // Calculate total marks and grade
        $grade = calculateGrade($totalMarks, $subjectCount);

        // response
        $response = [

            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'subjects' => $reportData,
            'total_marks' => $totalMarks,
            'grade' => $grade
        ];

        echo json_encode($response);
    } else {
        $response = NULL;

        echo json_encode($response);
    }
} else {
    echo json_encode(['error' => 'No student ID provided']);
}

function calculateGrade($totalMarks, $subjectCount) { // Grade assign based on marks 
    if ($subjectCount == 0) return 'N/A'; // No subjects

    $averageMarks = $totalMarks / $subjectCount;

    if ($averageMarks >= 90) return 'A';
    if ($averageMarks >= 80) return 'B';
    if ($averageMarks >= 70) return 'C';
    if ($averageMarks >= 60) return 'D';
    return 'F';
}
?>
