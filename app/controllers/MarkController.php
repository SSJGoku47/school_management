<?php
session_start();
require_once '../config/database.php'; 
require_once 'C:\xampp\htdocs\school_management\app\models\Marks.php';
require_once 'C:\xampp\htdocs\school_management\helpers\helpers.php';

class MarkController {

    private $markModel;

    public function __construct($db) {
        $this->markModel = new Marks($db); 
    }

    public function markForm() {
        require_once BASE_PATH . '/views/marks/marks.view.php';
    }

    public function addMarks() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $studentId = $_POST['student_id'];
            $subjectId = $_POST['subject_id'];
            $marks = $_POST['marks'];
    
            // Check for empty or null values
            if (!isNotNullOrEmpty($studentId) || !isNotNullOrEmpty($subjectId) || !isNotNullOrEmpty($marks)) {
                echo json_encode(['success' => false, 'message' => 'All fields are required.']);
                return;
            }
    
            if (!validateMarks($marks)) {
                echo json_encode(['success' => false, 'message' => 'Invalid marks! Marks must be greater than 0 and less than or equal to 100.']);
                return;
            }
    
            if ($this->markModel->save($studentId, $subjectId, $marks)) { // calling markModel::save
                $_SESSION['message'] = 'Marks added successfully!';
                $_SESSION['msg_type'] = 'success';
                header('Location: /school_management/marks/');
            } else {
                $_SESSION['message'] = 'ERROR!';
                $_SESSION['msg_type'] = 'danger';
            }
        } else {
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['msg_type'] = 'danger';
        }
    }
    
    
}
?>
