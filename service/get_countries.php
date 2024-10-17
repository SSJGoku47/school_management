<?php
require_once '../config/database.php'; 

header('Content-Type: application/json');

// Prepare the SQL statement
$sql = "SELECT * FROM countries";
$stmt = $conn->prepare($sql);
$stmt->execute();

$countries = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($countries);
