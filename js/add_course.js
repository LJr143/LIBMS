$(document).ready(function() {
    // Attach a click event to the "ADD STUDENT" button
    $("#addCourseBtn").click(function() {
        // Show the student modal
        $("#courseModal").modal("show");

        $.ajax({
            url: '../operations/fetch_college_options.php', // Replace with your backend endpoint
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                // Log the response to inspect the structure
                console.log(response);

                // Populate the select options
                populateCollegeOptions(response);
            },
            error: function () {
                // Handle errors
                console.error('Error fetching College options.');
            }
        });

        function populateCollegeOptions(data) {
            // Log the data to inspect the structure
            console.log(data);

            // Get the select element
            var selectElement = $('#editSelectCollege');

            // Clear existing options
            selectElement.empty();

            // Add a default option
            selectElement.append('<option value="" disabled selected>Select College</option>');

            // Add options based on the fetched data
            data.forEach(function (college) {
                selectElement.append('<option value="' + college.college_id + '">' + college.college_name + '</option>');
            });
        }
    });

    function addCollege() {
        if (!validateForm()) {
            return; // Exit if validation fails
        }
        var formData = prepareFormData();
        $.ajax({
            url: '../operations/add_course.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                handleAjaxSuccess(response, 'add');
            },
            error: handleAjaxError
        });
    }

    function validateForm() {
        // Trigger form validation manually
        var form = $('#AddCourseModal')[0];
        form.classList.add('was-validated');

        // Add validation logic for each required field
        var requiredFields = ['#editSelectCollege', '#addCourseName'];

        for (var i = 0; i < requiredFields.length; i++) {
            var fieldId = requiredFields[i];
            var field = $(fieldId);

            if (field.val().trim() === '') {
                showValidationError('Please input all fields.');
                return false; // Validation failed
            }
        }
        return true; // Validation succeeded
    }

    function prepareFormData() {
        var formData = new FormData();
        formData.append('collegeId', $('#addCourseName').val());
        formData.append('courseName', $('#editSelectCollege').val());

        return formData;
    }

    function handleAjaxSuccess(response, operationType) {
        try {
            if (response.success) {
                handleSuccessConfirmation('AddCourseModal', operationType);
            } else {
                showError(response.message || `Failed to ${operationType === 'add' ? 'add' : 'update'} the college. Please try again.`);
            }
        } catch (e) {
            console.error('Failed to process the server response:', e);
            showError('Failed to process the server response.');
        }
    }

    function handleSuccessConfirmation(modalId, operationType) {
        $("#" + modalId).modal("hide");
        var successTitle = operationType === 'add' ? 'ADDED!' : 'UPDATED!';
        var successText = operationType === 'add' ? 'SUCCESSFULLY ADDED!' : 'SUCCESSFULLY UPDATED!';
        Swal.fire({
            title: successTitle,
            text: successText,
            icon: 'success',
            customClass: {
                popup: 'my-swal-popup',
                title: 'swal-title',
                content: 'my-swal-content',
                confirmButton: 'my-confirm-button'
            }
        }).then((result) => {
            // Check if the user clicked "OK"
            if (result.isConfirmed) {
                // Reload the page after a short delay
                setTimeout(function () {
                    location.reload();
                }, 0);
            }
        });
    }

    function handleAjaxError() {
        showError('AJAX request failed.');
    }

    function showError(message) {
        Swal.fire({
            title: 'Error!',
            text: message,
            icon: 'error'
        });
    }

    function showValidationError(message) {
        showError(message);
    }


    $("#editCourseBtn").click(function() {
        // Show the student modal
        $("#editCourseModal").modal("show");
    });

    $("#addMajorBtn").click(function() {
        // Show the student modal
        $("#majorModal").modal("show");
    });

    // Handle the file input change event
    $("#addStudentinput-file").change(function() {
        readURL(this);
    });
});