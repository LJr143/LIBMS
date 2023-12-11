
$(document).ready(function () {
    // Add click event listener to the "UPDATE" button
    $('#submitBtn').click(function (event) {
        // Prevent the default form submission
        event.preventDefault();
        // Call the updateBook function when the button is clicked
        updateProfileStaff();
    });
});





function updateProfilePictureForUpdate(event) {
    var input = event.target;
    var image = $('#displayUpdatedBookPicture')[0];
    var updateImageIcon = $('#updateImageIcon');

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            image.src = e.target.result;
            updateImageIcon.hide(); // Hide the "+" sign when an image is added
        };

        reader.readAsDataURL(input.files[0]);
    }
}


function updateProfileStaff() {
    // Validate the form fields before proceeding
    if (!validateUpdateStaffForm()) {
        return; // Exit if validation fails
    }

    // Prepare form data for update
    var formData = prepareUpdateFormData();

    $.ajax({
        url: '../operations/update_staff_profile.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            handleAjaxSuccess(response);
        },
        error: function () {
            handleAjaxError();
        }
    });
}

function validateUpdateStaffForm() {
    // Trigger form validation manually
    var form = $('#UpdateStaffProfileDisplay')[0];
    form.classList.add('was-validated');

    // Add validation logic for each required field in the update staff form
    var requiredFields = [
        '#editStaffFirstName',
        '#editStaffLastName',
        '#editStaffMI',
        '#editStaffEmail',
        '#editStaffPhoneNumber',
        '#editStaffTelNumber',
        '#editStaffAddress',
        '#editStaffUsername',
    ];
    for (var i = 0; i < requiredFields.length; i++) {
        var fieldId = requiredFields[i];
        var field = $(fieldId);

        if (field.length === 0) {
            console.error('Field not found with ID:', fieldId);
            continue; // Skip to the next iteration if the field is not found
        }

        if (field.val().trim() === '') {
            showValidationError('Please input all fields.');
            return false; // Validation failed
        }
    }

    // Validate the file input for update only if a new image is selected
    var profileFileInput = $('#editprofilePictureInput')[0];

    if (profileFileInput.files.length > 0) {
        var profileFile = profileFileInput.files[0];
        // Additional validation code for the profile image if needed
    } else {
        // No new image selected, so no validation needed for the image
    }
    // Validate patterns for specific fields
    var patterns = {
        '#editStaffFirstName': /^[A-Za-z]+(\s[A-Za-z]+)?$/,
        '#editStaffLastName': /^[A-Za-z]+$/,
        '#editStaffMI': /^[A-Za-z]{1}$/,
        '#editStaffEmail': /^[A-Za-z0-9._%+-]+@usep\.edu\.ph$/i,
        '#editStaffPhoneNumber': /^09\d{9}$/,
        '#editStaffTelNumber': /^\d{3}-\d{4}$/,
        '#editStaffAddress': /^[A-Za-z0-9\s]+$/,
        // '#editStaffUsername': /^[A-Za-z0-9]+$/,
    };
    for (var fieldId in patterns) {
        var field = $(fieldId);

        if (field.length === 0) {
            console.error('Field not found with ID:', fieldId);
            continue; // Skip to the next iteration if the field is not found
        }

        var pattern = patterns[fieldId];

        if (!pattern.test(field.val())) {
            var errorMessage = getCustomErrorMessage(fieldId, 'edit_staff');
            showValidationError(errorMessage);
            return false; // Validation failed
        }
    }
    return true; // Validation succeeded
}









function prepareUpdateFormData() {
    var formData = new FormData();
    var profileFileInput = $('#editprofilePictureInput')[0];

    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }
    formData.append('first_name', $('#editStaffFirstName').val());
    formData.append('last_name', $('#editStaffLastName').val());
    formData.append('mi', $('#editStaffMI').val());
    formData.append('officeEmail', $('#editStaffEmail').val());
    formData.append('PhoneNumber', $('#editStaffPhoneNumber').val());
    formData.append('Telephone', $('#editStaffTelNumber').val());
    formData.append('Address', $('#editStaffAddress').val());
    formData.append('username', $('#editStaffUsername').val());
    formData.append('staffID', $('#userID').val());


    return formData;
    }



function handleAjaxSuccess(response, operationType) {
    console.log(response); // Log the response for debugging

    try {
        var result = typeof response === 'string' ? JSON.parse(response) : response;
        if (result.success) {
            handleSuccessConfirmation('EditStaffModal');
        } else {
            showError('Failed to ' + (operationType ===  'update') + ' the Staff. Please try again.');
        }
    } catch (e) {
        console.error('Failed to parse JSON response:', response);
        showError('Failed to process the server response.');
    }
}

function handleSuccessConfirmation(modalId, operationType) {
    $("#" + modalId).modal("hide");
    var successTitle = operationType === 'add' ? '' : 'UPDATED!';
    var successText = operationType === 'add' ? '' : 'SUCCESSFULLY UPDATED!';
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


function getCustomErrorMessage(fieldId, formType) {
    switch (fieldId) {
        case '#editStaffFirstName':
            return 'Invalid First Name. It should only contain letters.';
        case '#editStaffLastName':
            return 'Invalid Last Name. It should only contain letters.';
        case '#editStaffMI':
            return 'Invalid Middle Initial. It should only contain 1 letter.';
        case '#editStaffEmail':
            return 'Invalid Email Address. Please enter your USeP email.';
        case '#editStaffPhoneNumber':
            return 'Invalid Phone Number. Follow the format 09********* .';
        case '#editStaffTelNumber':
            return 'Invalid Telephone Number. Follow the format ***-**** .';
        case '#editStaffAddress':
            return 'Invalid Address. It should only contain letters and numbers.';
        case '#editStaffUsername':
            // return 'Invalid Username. It should only contain letters and numbers.';
        default:
            return 'Invalid input for ' + $(fieldId).attr('placeholder') + '.';
    }
}




