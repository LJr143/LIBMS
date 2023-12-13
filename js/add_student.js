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
    // Trigger form validation manually
    var form = $('#AddStudentModal')[0]; // Replace 'yourFormId' with the actual ID of your form
    form.classList.add('was-validated');

    // Add validation logic for each required field
    var requiredFields = [
        '#addStudentFirstName',
        '#addStudentLastName',
        '#addStudentMI',
        '#addStudentStudID',
        '#addStudentPersonalEmail',
        '#addStudentPhoneNumber',
        '#addStudentAddress',
        '#addStudentSectionYear',
        '#addStudentCourse',
        '#addStudentMajor',
        '#addStudentUsepEmail',
        '#addStudentUsername',
        '#addStudentPassword'
    ];

    for (var i = 0; i < requiredFields.length; i++) {
        var field = $(requiredFields[i]);
        if (field.val().trim() === '') {
            showValidationError('Please fill in all required fields.');
            return false; // Validation failed
        }
    }

    // Validate the file input
    var profileFileInput = $('#addStudentinput-file')[0];
    var profileFile = profileFileInput.files[0];

    if (!profileFile) {
        showValidationError('Please select a profile image.');
        return false; // Validation failed
    }
// Validate patterns for specific fields
    var patterns = {
        '#addStudentFirstName': /^[A-Za-z]+(?: [A-Za-z]+)?$/,
        '#addStudentLastName': /^[A-Za-z]+$/,
        '#addStudentMI': /^[A-Za-z]{1}$/,
        '#addStudentStudID': /^202[0-9]{1}-[0-9]{5}$/,
        '#addStudentPersonalEmail': /^[^\s@]+@gmail\.com$/,
        '#addStudentPhoneNumber': /^09[0-9]{9}$/,
        '#addStudentAddress': /^[A-Za-z0-9,.\s]+$/,
        '#addStudentUsepEmail': /^[^\s@]+@usep\.edu\.ph$/,
        '#addStudentUsername': /^(?=.*[A-Za-z0-9])[A-Za-z0-9]{6,}$/,
        '#addStudentPassword': /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@_]).{8,}$/
    };

    for (var fieldId in patterns) {
        var field = $(fieldId);
        var pattern = patterns[fieldId];

        console.log('Field:', fieldId, 'Value:', field.val());

        if (!pattern.test(field.val())) {
            var fieldName = field.attr('placeholder');
            var errorMessage = getCustomErrorMessage(fieldId);

            showValidationError('' + errorMessage);
            return false; // Validation failed
        }
    }

    function getCustomErrorMessage(fieldId) {
        switch (fieldId) {
            case '#addStudentFirstName':
                return 'Invalid First Name. It should only contain letters.';
            case '#addStudentLastName':
                return 'Invalid Last Name. It should only contain letters.';
            case '#addStudentMI':
                return 'Invalid Middle Initial. It should be a single letter.';
            case '#addStudentStudID':
                return 'Invalid Student ID. It should be in the format 202*-*****.';
            case '#addStudentPersonalEmail':
                return 'Invalid Personal Email. It should be a Gmail address.';
            case '#addStudentPhoneNumber':
                return 'Invalid Phone Number. It should start with 09 and have 11 digits.';
            case '#addStudentAddress':
                return 'Invalid Address. It should only contain letters, numbers, and basic symbols.';
            case '#addStudentUsepEmail':
                return 'Invalid USEP Email. It should be a USEP email address.';
            case '#addStudentUsername':
                return 'Invalid Username. It should contain at least 6 alphanumeric characters.';
            case '#addStudentPassword':
                return 'Invalid Password. It should be at least 8 characters with at least one digit, one lowercase letter, one uppercase letter, and one special character (@ or _).';
            default:
                return 'Invalid input for ' + field.attr('placeholder') + '.';
        }
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


