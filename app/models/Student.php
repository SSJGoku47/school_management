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
}
?>
