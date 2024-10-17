<?php
class Student {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Save student data
    public function save($firstName, $lastName, $dob, $gender, $cityId, $stateId, $countryId) {
        $sql = "INSERT INTO students (first_name, last_name, dob, gender, city_id, state_id, country_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$firstName, $lastName, $dob, $gender, $cityId, $stateId, $countryId]);
    }

    // Fetch all students
    public function fetchAll() {
        $sql = "SELECT * FROM students";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch student by ID
    public function fetchById($id) {
        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
