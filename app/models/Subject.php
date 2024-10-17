<?php
class Subject {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all subjects
    public function fetchAll() {
        $sql = "SELECT * FROM subjects";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
