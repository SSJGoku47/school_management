<?php
require_once '../config/database.php'; 

header('Content-Type: application/json');

// Get the cities based on the state Id;

$state_id = $_GET['state_id'];  //get the state id from the the input field

$sql = "SELECT * FROM cities WHERE state_id = :state_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':state_id', $state_id);
$stmt->execute();

$cities = $stmt->fetchAll(PDO::FETCH_ASSOC); // will fetch all cities

echo json_encode($cities);
