
$(document).ready(function () {
    // Attach a click event to the "ADD STUDENT" button
    $("#addCourseBtn").click(function () {
        // Show the student modal
        $("#courseModal").modal("show");

        // Fetch college options
        fetchCollegeOptions();

        // Attach click event for addcoursebtn
        $("#addCllgBtn").click(function (e) {
            e.preventDefault(); // Prevent the default form submission
            addCourse();
        });
    });

    function fetchCollegeOptions() {
        $.ajax({
            url: '../operations/fetch_college_options.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                // Populate the select options
                populateCollegeOptions(response);
            },
            error: function () {
                // Handle errors
                console.error('Error fetching College options.');
            }
        });
    }

    function populateCollegeOptions(data) {
        // Get the select element
        var selectElement = $('#addSelectCollege');

        // Clear existing options
        selectElement.empty();

        // Add a default option
        selectElement.append('<option value="" disabled selected>Select College</option>');

        // Add options based on the fetched data
        data.forEach(function (college) {
            selectElement.append('<option value="' + college.college_id + '">' + college.college_name + '</option>');
        });
    }

    function addCourse() {
        console.log('Adding course');
        if (!validateForm()) {
            console.log('Validation failed.');
            return; // Exit if validation fails
        }
        var formData = prepareFormData();
        $.ajax({
            url: '../operations/add_course.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                handleAjaxSuccess(response, 'add');
            },
            error: handleAjaxError
        });
    }

    function validateForm() {
        // Trigger form validation manually
        var form = $('#AddCourseModal')[0];
        form.classList.add('was-validated');

        // Add validation logic for each field
        var validations = {
            '#addSelectCollege': {
                required: true,
                fieldName: 'College'
            },
            '#addCourseName': {
                required: true,
                pattern: /^([A-Za-z]+\s*)+$/,
                fieldName: 'Course Name'
            },
            '#addCourseMajor': {
                required: true,
                pattern: /^([A-Za-z]+\s*)+$/,
                fieldName: 'Course Major'
            }
        };

        for (var fieldId in validations) {
            var field = $(fieldId);
            var validation = validations[fieldId];

            if (!field.length) {
                console.error('Field not found:', fieldId);
                continue; // Skip to the next field if not found
            }

            if (validation.required && (field.val() === null || field.val().trim() === '')) {
                showValidationError(validation.fieldName + ' is required.');
                return false; // Validation failed
            }


            if (validation.pattern && !validation.pattern.test(field.val())) {
                var errorMessage = getCustomAddCourseErrorMessage(fieldId, 'add_course');
                showValidationError(errorMessage);
                return false; // Validation failed
            }
        }

        return true; // Validation succeeded
    }


    $(document).ready(function () {
        // Listen for input changes in the addCourseName field
        $('#addCourseName').on('input', function () {
            // Get the current value of the input
            var inputValue = $(this).val();

            // Capitalize the first letter of each word
            var capitalizedValue = inputValue.replace(/\b\w/g, function (match) {
                return match.toUpperCase();
            });

            // Update the input value with the capitalized text
            $(this).val(capitalizedValue);
        });

        // Listen for input changes in the addCourseMajor field
        $('#addCourseMajor').on('input', function () {
            // Get the current value of the input
            var inputValue = $(this).val();

            // Capitalize the first letter of each word
            var capitalizedValue = inputValue.replace(/\b\w/g, function (match) {
                return match.toUpperCase();
            });

            // Update the input value with the capitalized text
            $(this).val(capitalizedValue);
        });
    });

    function prepareFormData() {
        var formData = new FormData();
        formData.append('collegeId', $('#addSelectCollege').val());
        formData.append('courseName', $('#addCourseName').val());
        formData.append('courseMajor', $('#addCourseMajor').val());

        return formData;
    }

    function handleAjaxSuccess(response, operationType) {
        try {
            if (response.success) {
                handleSuccessConfirmation('AddCourseModal', operationType);
            } else {
                showError(response.message || `Failed to ${operationType === 'add' ? 'add' : 'update'} the Course. Please try again.`);
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
        }).then(function (result) {
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

    $('#courseModal').on('hidden.bs.modal', function () {
        $('#AddCourseModal')[0].reset();
    });
});

function getCustomAddCourseErrorMessage(fieldId) {
    switch (fieldId) {
        case '#addSelectCollege':
            return 'Please select a college.';
        case '#addCourseName':
            return 'Invalid Course Name. It should only contain letters.';
        case '#addCourseMajor':
            return 'Invalid Course Major. It should only contain letters.';
        default:
            return 'Invalid input for ' + $(fieldId).attr('placeholder') + '.';
    }
}
