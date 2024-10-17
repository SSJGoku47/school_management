<?php
require_once '../config/database.php'; 

header('Content-Type: application/json');

$sql = "SELECT * FROM students";
$stmt = $conn->prepare($sql);
$stmt->execute();

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($students);
