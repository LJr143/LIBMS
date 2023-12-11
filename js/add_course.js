$(document).ready(function () {
    // Attach a click event to the "ADD STUDENT" button
    $("#addCourseBtn").click(function () {
        // Show the student modal
        $("#courseModal").modal("show");

        // Fetch college options
        fetchCollegeOptions();

        // Attach click event for addCllgBtn
        $("#addCllgBtn").click(function (e) {
            e.preventDefault(); // Prevent the default form submission
            addCourse();
        });
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
        success: function (response) {
            handleAjaxSuccess(response, 'add');
        },
        error: handleAjaxError
    });
}

function validateForm() {
    // Trigger form validation manually
    var form = $('#AddCourseModal')[0];

    if (!form) {
        console.error('Form element not found.');
        return false;
    }

    form.classList.add('was-validated');

    // Add validation logic for each required field
    var requiredFields = ['#addSelectCollege', '#addCourseName'];

    for (var i = 0; i < requiredFields.length; i++) {
        var fieldId = requiredFields[i];
        var field = $(fieldId);

        if (!field || !field.val() || field.val().trim() === '') {
            showValidationError('Please input all fields.');
            return false; // Validation failed
        }
    }
    return true; // Validation succeeded
}

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
