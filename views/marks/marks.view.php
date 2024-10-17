<!-- views/marks/marks.view.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Entry</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/school_management/assets/css/styles.css">
</head>

<?php
if (isset($_SESSION['message'])): ?>
    <div class="d-flex justify-content-center mt-4">
        <div class="alert alert-<?= $_SESSION['msg_type'] ?> alert-dismissible fade show text-center" role="alert" style="width: 50%;">
            <?= $_SESSION['message'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
<?php
    unset($_SESSION['message']);
    unset($_SESSION['msg_type']);
endif;
?>

<body>
    <div class="container mt-5">
        <div class="form-container mx-auto shadow p-10 bg-white rounded">
            <h2 class="text-center mb-5">Add Marks for Subject</h2>
            <form action="/school_management/marks/add" method="POST" id="gradeForm">
                <div class="form-group mb-3">
                    <label for="student_id" class="form-label">Student Name:</label>
                    <select name="student_id" id="student_id" required class="form-control">
                        <option value="">Select Student</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="subject_id" class="form-label">Subject Name:</label>
                    <select name="subject_id" id="subject_id" required class="form-control">
                        <option value="">Select Subject</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="marks" class="form-label">Marks:</label>
                    <input type="number" name="marks" step="0.10" min="0" max="100" required class="form-control" placeholder="Enter Marks">
                    <div id="marksError" class="text-danger mt-2"></div> <!-- Error message for marks -->
                </div>

                <input type="submit" value="Submit Grade" class="btn btn-primary w-100">
            </form>
        </div>
    </div>

    <!-- Bootstrap and jQuery Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert").alert('close');
            }, 5000);
        });
        $(document).ready(function() {

            // Load students on page load
            $.ajax({
                url: '/school_management/service/get_students.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#student_id').html('<option value="">Select Student</option>');
                    $.each(data, function(index, student) {
                        $('#student_id').append(`<option value="${student.id}">${student.first_name} ${student.last_name}</option>`);
                    });
                }
            });

            // Load subjects on page load
            $.ajax({
                url: '/school_management/service/get_subjects.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#subject_id').html('<option value="">Select Subject</option>');
                    $.each(data, function(index, subject) {
                        $('#subject_id').append(`<option value="${subject.id}">${subject.name}</option>`);
                    });
                }
            });

            // Prevent duplicate grade entry
            $('#gradeForm').on('submit', function(e) {
                e.preventDefault();

                var studentId = $('#student_id').val();
                var subjectId = $('#subject_id').val();

                $.ajax({
                    url: '/school_management/service/check_grade.php',
                    type: 'POST',
                    data: {
                        student_id: studentId,
                        subject_id: subjectId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.exists) {
                            alert('This student has already received a grade for this subject.');
                        } else {
                            $('#gradeForm').off('submit').submit();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            });

        });
    </script>
</body>

</html>