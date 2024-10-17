<?php

// check if the value is empty or null
function isNotNullOrEmpty($value) {
    return isset($value) && trim($value) !== '';
}


// validator for marks
function validateMarks($marks) {
   
    return is_numeric($marks) && $marks > 0 && $marks <= 100;
}

// redirect 

function redirect($url) {
    header('Location: ' . $url);
    exit; 
}

?>
