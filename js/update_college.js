$(document).ready(function () {
    // Add click event listener to the "UPDATE" button
    $('#saveCllgBtn').on('click', function (e) {
        e.preventDefault(); // Prevent the default form submission
        updateCollege();

    });
});


function updateCollege() {
    // Validate the form fields before proceeding
    if (!validateUpdateForm()) {
        return; // Exit if validation fails
    }

    // Prepare form data for update
    var formData = prepareUpdateFormData();

    // AJAX request for update_book.php
    $.ajax({
        url: '../operations/update_college.php',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            handleAjaxUpdateSuccess(response);
        },
        error: function () {
            handleAjaxError();
        }
    });
}

function validateUpdateForm() {
    // Trigger form validation manually
    var form = $('#EditCollegeModal')[0];
    form.classList.add('was-validated');

    // Add validation logic for each required field in the update form
    var requiredFields = [
        '#editCollegeId',
        '#editCollegeName',
    ];

    for (var i = 0; i < requiredFields.length; i++) {
        var fieldId = requiredFields[i];
        var field = $(fieldId);

        if (field.length === 0) {
            console.error('Field not found with ID:', fieldId);
            continue; // Skip to the next iteration if the field is not found
        }

        if (field.val().trim() === '') {
            showValidationError('Please fill in all required fields.');
            return false; // Validation failed
        }
    }


    return true; // Validation succeeded
}



function prepareUpdateFormData()     {
    var formData = new FormData();

    // Append form data for update_book
    formData.append('collegeId', $('#editCollegeId').val());
    formData.append('collegeName', $('#editCollegeName').val());


    return formData;
}


function handleAjaxUpdateSuccess(response) {
    console.log(response); // Log the response for debugging
    try {
        var result = typeof response === 'string' ? JSON.parse(response) : response;
        if (result.success) {
            Swal.fire({
                icon: 'success',
                title: 'UPDATED!',
                text: 'SUCCESSFULLY UPDATED!.',
                confirmButtonText: 'OK'
            }).then(() => {
                location.reload();
                // Handle any additional logic after the user clicks "OK"
                // For example, redirect to another page or perform some action
            });
        } else {
            showError('Failed to update the college. Please try again.');
        }
    } catch (e) {
        console.error('Failed to parse JSON response:', response);
        showError('Failed to process the server response.');
    }
}


function validateUpdateForm() {
    // Trigger form validation manually
    var form = $('#EditCollegeModal')[0];
    form.classList.add('was-validated');

    // Add validation logic for each required field in the update form
    var requiredFields = [
        '#editCollegeId',
        '#editCollegeName',
    ];

    var nameRegex = /^[A-Za-z\s]+$/; // Regex for letters and spaces

    for (var i = 0; i < requiredFields.length; i++) {
        var fieldId = requiredFields[i];
        var field = $(fieldId);

        if (field.length === 0) {
            console.error('Field not found with ID:', fieldId);
            continue; // Skip to the next iteration if the field is not found
        }

        if (field.val().trim() === '') {
            showValidationError(getCustomErrorMessage(fieldId));
            return false; // Validation failed
        }

        // Validate college name using regex
        if (fieldId === '#editCollegeName' && !nameRegex.test(field.val().trim())) {
            showValidationError(getCustomErrorMessage(fieldId));
            return false; // Validation failed
        }
    }

    return true; // Validation succeeded
}

function showValidationError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: message,
    });
}

function getCustomErrorMessage(fieldId) {
    var errorMessage = '';

    switch (fieldId) {
        case '#editCollegeId':
            errorMessage = 'Invalid College ID. It should follow the pattern COL-****.';
            break;
        case '#editCollegeName':
            errorMessage = 'Invalid College Name. It should only contain letters and spaces.';
            break;
        // Add more cases for other fields as needed
        default:
            errorMessage = 'Invalid input for ' + $(fieldId).attr('placeholder') + '.';
            break;
    }

    return errorMessage;
}

