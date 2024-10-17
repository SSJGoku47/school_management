<!-- views/reports/report.view.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .report-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .total-container {
            font-weight: bold;
            text-align: center;
            margin-top: 30px;
        }

        .table th,
        .table td {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container report-container">
        <h1>Student Report</h1>
        <div class="form-group">
            <label for="student_id">Select Student:</label>
            <select name="student_id" id="student_id" class="form-control" required>
                <option value="">Select Student</option>
            </select>
        </div>

        <!-- Report table -->
        <div id="reportSection" class="mt-5" style="display:none;">
            <h2>Report for <span id="studentName"></span></h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Marks</th>
                    </tr>
                </thead>
                <tbody id="reportTableBody">
                    <!-- Marks will be populated dynamically -->
                </tbody>
            </table>

            <div class="total-container">
                Total Marks: <span id="totalMarks"></span><br>
                Grade: <span id="grade"></span>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Fetch students dynamically on page load
            $.ajax({
                url: '/school_management/service/get_students.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#student_id').html('<option value="">Select Student</option>');
                    $.each(data, function(index, student) {
                        $('#student_id').append(`<option value="${student.id}">${student.first_name} ${student.last_name}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });

            // Fetch report data automatically when student is selected
            $('#student_id').on('change', function() {
                const studentId = $(this).val();
                if (!studentId) {
                    $('#reportSection').hide(); // Hide the report section if no student is selected
                    return;
                }

                // Fetch report data for the selected student
                $.ajax({
                    url: '/school_management/service/get_student_report.php',
                    type: 'GET',
                    data: { student_id: studentId },
                    dataType: 'json',
                    success: function(data) {
                        if (data && data.subjects.length > 0) {
                            $('#reportSection').show();
                            $('#studentName').text(data.first_name + ' ' + data.last_name);

                            let totalMarks = 0;
                            let reportTableBody = '';
                            data.subjects.forEach(function(subject) {
                                reportTableBody += `<tr><td>${subject.subject_name}</td><td>${subject.marks}</td></tr>`;
                                totalMarks += parseFloat(subject.marks);
                            });

                            $('#reportTableBody').html(reportTableBody);
                            $('#totalMarks').text(totalMarks);
                            $('#grade').text(data.grade);
                        } else {
                            // Hide report and alert if no subjects found
                            $('#reportSection').hide();
                            alert('No data available for this student.');
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
