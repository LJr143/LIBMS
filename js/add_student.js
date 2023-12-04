$(document).ready(function() {
    // Add click event listener to the "ADD" button
    $('#addStdntBtn').on('click', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Call the addStudent function when the button is clicked
        addStudent();
    });
});

function addStudent() {
    // Validate the form fields before proceeding
    if (!validateForm()) {
        return; // Exit if validation fails
    }

    // Prepare form data
    var formData = prepareFormData();

    // AJAX request
    $.ajax({
        url: '../operations/add_student.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            handleAjaxSuccess(response);
        },
        error: function() {
            handleAjaxError();
        }
    });
}

function validateForm() {
    // Add validation logic for each required field
    var requiredFields = [
        '#addStudentFirstName',
        '#addStudentLastName',
        // ... Add other required fields ...
        '#addStudentPassword'
    ];

    for (var i = 0; i < requiredFields.length; i++) {
        var field = $(requiredFields[i]);
        if (field.val().trim() === '') {
            showValidationError('Please fill in all required fields.');
            return false; // Validation failed
        }
    }

    // Validate the file input (if applicable)
    var profileFileInput = $('#addStudentinput-file')[0];
    if (profileFileInput.files.length === 0) {
        showValidationError('Please select a profile image.');
        return false; // Validation failed
    }

    return true; // Validation succeeded
}

function prepareFormData() {
    var formData = new FormData();
    var profileFileInput = $('#addStudentinput-file')[0];
    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }

    // Append form data
    formData.append('first_name', $('#addStudentFirstName').val());
    formData.append('last_name', $('#addStudentLastName').val());
    formData.append('mi', $('#addStudentMI').val());
    formData.append('studentID', $('#addStudentStudID').val());
    formData.append('personalEmail', $('#addStudentPersonalEmail').val());
    formData.append('phoneNumber', $('#addStudentPhoneNumber').val());
    formData.append('address', $('#addStudentAddress').val());
    formData.append('year', $('#addStudentSectionYear').val());
    formData.append('course', $('#addStudentCourse').val());
    formData.append('major', $('#addStudentMajor').val());
    formData.append('usepEmail', $('#addStudentUsepEmail').val());
    formData.append('username', $('#addStudentUsername').val());
    formData.append('password', $('#addStudentPassword').val());

    return formData;
}

function handleAjaxSuccess(response) {
    try {
        var result = typeof response === 'string' ? JSON.parse(response) : response;
        if (result.success) {
            handleSuccessConfirmation();
        } else {
            showError('Failed to add the student. Please try again.');
        }
    } catch (e) {
        console.error('Failed to parse JSON response:', response);
        showError('Failed to process the server response.');
    }
}

function handleSuccessConfirmation() {
    $("#StudentModal").modal("hide");
    Swal.fire({
        title: 'ADDED!',
        text: 'SUCCESSFULLY ADDED!',
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
            setTimeout(function() {
                location.reload();
            });
        }
    });
}

function handleAjaxError() {
    showError('AJAX request failed.'); // Consider improving the user experience
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


