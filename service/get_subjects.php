<?php
require_once '../config/database.php'; 

header('Content-Type: application/json');

$sql = "SELECT * FROM subjects";
$stmt = $conn->prepare($sql);
$stmt->execute();

$subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($subjects);
