$(document).ready(function () {
    $('#saveButton').click(function() {
        updateStudent();
    });
});

function updateStudent() {
    // Validate form fields
    if (!validateUpdateForm()) {
        return;
    }

    var formData = prepareUpdateFormData();

    // Log form data for debugging
    for (var pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }

    // Disable the button to prevent multiple clicks
    $('#saveButton').prop('disabled', true);

    $.ajax({
        url: '../operations/update_student.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            handleAjaxUpdateSuccess(response);
        },
        error: function () {
            showError('AJAX request failed.');
        },
        complete: function () {
            // Re-enable the button regardless of success or failure
            $('#saveButton').prop('disabled', false);
        }
    });
}

function validateUpdateForm() {
    // Add validation logic for each required field
    var requiredFields = [
        '#editStudentFname',
        '#editStudentLname',
        '#editStudentID',
        '#editStudentEmail',
        '#editStudentNumber',
        '#editStudentAddress',
        '#editStudentYear',
        '#editStudentCourse',
        '#editStudentMajor',
    ];

    for (var i = 0; i < requiredFields.length; i++) {
        var field = $(requiredFields[i]);
        if (field.val().trim() === '') {
            showError('Please fill in all required fields.');
            return false; // Validation failed
        }
    }

    // Add additional validation logic as needed

    return true; // Validation succeeded
}

function prepareUpdateFormData() {
    var formData = new FormData();
    var profileFileInput = $('#profilePictureInput')[0];

    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }

    formData.append('first_name', $('#editStudentFname').val());
    formData.append('last_name', $('#editStudentLname').val());
    formData.append('mi', $('#editStudentInitial').val());
    formData.append('studentID', $('#editStudentID').val());
    formData.append('personalEmail', $('#editStudentEmail').val());
    formData.append('phoneNumber', $('#editStudentNumber').val());
    formData.append('address', $('#editStudentAddress').val());
    formData.append('year', $('#editStudentYear').val());
    formData.append('course', $('#editStudentCourse').val());
    formData.append('major', $('#editStudentMajor').val());
    formData.append('usepEmail', $('#editStudentUsepEmail').val());
    formData.append('username', $('#editStudentUsername').val());
    formData.append('password', $('#editpsw').val());

    return formData;
}
function handleAjaxUpdateSuccess(response) {
    try {
        var result = JSON.parse(response);

        if (result.success && !result.validationError) {
            // If both success and validationError are true, show success message
            $("#staffModal").modal("hide");
            Swal.fire({
                title: 'UPDATED!',
                text: 'SUCCESSFULLY UPDATED!',
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
                    // Reload the page
                    location.reload();
                }
            });
        } else {
            showError(result.message || 'Failed to update the student. Please check your inputs and try again.');        }
    } catch (e) {
        console.error('Failed to parse JSON response:', response);
        showError('Failed to process the server response.');
    }
}

