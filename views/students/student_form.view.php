<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <div class="form-container mx-auto shadow p-5 bg-white rounded">
            <h1 class="text-center mb-4">Student Registration</h1>
            <form action="/school_management/student/create/" method="POST">
                <div class="form-group mb-3">
                    <label for="first_name" class="form-label">First Name:</label>
                    <input type="text" name="first_name" required class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="last_name" class="form-label">Last Name:</label>
                    <input type="text" name="last_name" required class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="dob" class="form-label">Date of Birth:</label>
                    <input type="date" name="dob" required class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="gender" class="form-label">Gender:</label>
                    <select name="gender" required class="form-control">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="country_id" class="form-label">Country:</label>
                    <select name="country_id" id="country_id" required class="form-control">
                        <option value="">Select Country</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="state_id" class="form-label">State:</label>
                    <select name="state_id" id="state_id" required class="form-control">
                        <option value="">Select State</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="city_id" class="form-label">City:</label>
                    <select name="city_id" id="city_id" required class="form-control">
                        <option value="">Select City</option>
                    </select>
                </div>

                <input type="submit" value="Register" class="btn btn-primary w-100">
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert").alert('close');
            }, 5000);
        });
        $(document).ready(function() {
            // Load countries on page load
            $.ajax({
                url: '/school_management/service/get_countries.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#country_id').html('<option value="">Select Country</option>');
                    $.each(data, function(index, country) {
                        $('#country_id').append(`<option value="${country.id}">${country.name}</option>`);
                    });
                }
            });

            // Load states based on selected country
            $('#country_id').on('change', function() {
                var countryId = $(this).val();
                if (countryId) {
                    $.ajax({
                        url: '/school_management/service/get_states.php',
                        type: 'GET',
                        data: {
                            country_id: countryId
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#state_id').html('<option value="">Select State</option>');
                            $.each(data, function(index, state) {
                                $('#state_id').append(`<option value="${state.id}">${state.name}</option>`);
                            });
                            $('#city_id').html('<option value="">Select City</option>'); // Clear city dropdown
                        }
                    });
                } else {
                    $('#state_id').html('<option value="">Select State</option>');
                    $('#city_id').html('<option value="">Select City</option>');
                }
            });

            // Load cities based on selected state
            $('#state_id').on('change', function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: '/school_management/service/get_cities.php',
                        type: 'GET',
                        data: {
                            state_id: stateId
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#city_id').html('<option value="">Select City</option>');
                            $.each(data, function(index, city) {
                                $('#city_id').append(`<option value="${city.id}">${city.name}</option>`);
                            });
                        }
                    });
                } else {
                    $('#city_id').html('<option value="">Select City</option>');
                }
            });
        });
    </script>
</body>

</html>