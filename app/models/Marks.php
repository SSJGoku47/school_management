<?php
class Marks {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Save marks data
    public function save($studentId, $subjectId, $marks) {
        $sql = "INSERT INTO marks (student_id, subject_id, marks) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$studentId, $subjectId, $marks]);
    }

    // Fetch marks by student ID
    public function fetchByStudentId($studentId) {
        $sql = "SELECT * FROM marks WHERE student_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$studentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
