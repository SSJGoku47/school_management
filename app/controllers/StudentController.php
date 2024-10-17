<?php
session_start();
require_once '../config/database.php'; 
require_once 'C:\xampp\htdocs\school_management\app\models\Student.php';


class StudentController {
    private $studentModel;

    public function __construct($db) {
        $this->studentModel = new Student($db);
    }

    public function studentForm() {
        require_once BASE_PATH . '/views/students/student_form.view.php';
    }

    public function saveStudent() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = htmlspecialchars(trim($_POST['first_name']));
            $lastName = htmlspecialchars(trim($_POST['last_name']));
            $dob = htmlspecialchars(trim($_POST['dob']));
            $gender = htmlspecialchars(trim($_POST['gender']));
            $cityId = (int)$_POST['city_id']; 
            $stateId = (int)$_POST['state_id'];
            $countryId = (int)$_POST['country_id'];

            // Save student data using the model
            if ($this->studentModel->save($firstName, $lastName, $dob, $gender, $cityId, $stateId, $countryId)) {
                $_SESSION['message'] = 'Student added successfully!';
                $_SESSION['msg_type'] = 'success';
                header('Location: /school_management/student/');
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
