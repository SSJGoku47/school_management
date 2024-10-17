<?php
require_once '../config/database.php'; 

header('Content-Type: application/json');

// Get the states based on the country Id;

$country_id = $_GET['country_id'];   //get the country id from the the input field

$sql = "SELECT * FROM states WHERE country_id = :country_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':country_id', $country_id);
$stmt->execute();

$states = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($states);   // Json encoded data wih all states from database
