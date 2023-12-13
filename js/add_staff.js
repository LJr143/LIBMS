$(document).ready(function () {
    // Add click event listener to the "ADD" button for adding staff
    $('#addStaffBtn').on('click', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Show the staff modal
        $("#staffModal").modal("show");
    });

    // Add click event listener to the "ADD" button inside the modal
    $('#addStaffModalBtn').on('click', function (e) {
        // Validate the form fields before proceeding
        if (validateStaffForm()) {
            // Prepare form data
            var formData = prepareStaffFormData();

            // AJAX request
            $.ajax({
                url: '../operations/add_staff.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    handleStaffAjaxSuccess(response);
                },
                error: function () {
                    handleStaffAjaxError();
                }
            });
        } else {
            // Validation failed, show the validation errors
            showValidationErrors();
        }
    });
});


function addStaff() {
    // Validate the form fields before proceeding
    if (!validateStaffForm()) {
        return; // Exit if validation fails
    }

    // Prepare form data
    var formData = prepareStaffFormData();

    // AJAX request
    $.ajax({
        url: '../operations/add_staff.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            handleStaffAjaxSuccess(response);
        },
        error: function () {
            handleStaffAjaxError();
        }
    });
}

function validateStaffForm() {
    // Trigger form validation manually
    var form = $('#addStaffForm')[0]; // Replace 'AddStaffModal' with the actual ID of your staff form
    form.classList.add('was-validated');

    // Add validation logic for each required field
    var requiredFields = [
        '#addStaffFname',
        '#addStaffLname',
        '#addStaffInitial',
        '#addStaffID',
        '#addStaffOemail',
        '#addStaffPnumber',
        '#addStaffTnumber',
        '#addStaffAddress',
        '#addStaffRole',
        '#addStaffPemail',
        '#addStaffUsername',
        '#psw'
    ];

    for (var i = 0; i < requiredFields.length; i++) {
        var field = $(requiredFields[i]);
        if (field.val().trim() === '') {
            showStaffValidationError('Please fill in all required fields.');
            return false; // Validation failed
        }
    }

    // Validate the file input
    var profileFileInput = $('#addStaffinput-file')[0];
    var profileFile = profileFileInput.files[0];

    if (!profileFile) {
        showStaffValidationError('Please select a profile image.');
        return false; // Validation failed
    }


    var patterns = {
        '#addStaffFname': /^[A-Za-z]+$/,
        '#addStaffLname': /^[A-Za-z]+$/,
        '#addStaffInitial': /^$|^[A-Za-z]{1}$/,
        '#addStaffID': /^[0-9]{4}-[0-9]{5}$/,
        '#addStaffPemail': /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/,
        '#addStaffPnumber': /^09[0-9]{9}$/,
        '#addStaffTnumber': /^[0-9]{3}-[0-9]{4}$/,
        '#addStaffAddress': /^[A-Za-z0-9,.\s]+$/,
        '#addStaffRole': /^[A-Za-z]+$/,
        '#addStaffOemail': /^[^\s@]+@usep\.edu\.ph$/,
        '#addStaffUsername': /^(?=.*[A-Za-z0-9])[A-Za-z0-9]{6,}$/,
        '#psw': /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@_]).{8,}$/
    };
    for (var fieldId in patterns) {
        var field = $(fieldId);
        var pattern = patterns[fieldId];

        console.log('Field:', fieldId, 'Value:', field.val());

        if (!pattern.test(field.val())) {
            var fieldName = field.attr('placeholder');
            var errorMessage = getStaffCustomErrorMessage(fieldId);

            showStaffValidationError('' + errorMessage);
            return false; // Validation failed
        }
    }

    function getStaffCustomErrorMessage(fieldId) {
        switch (fieldId) {
            case '#addStaffFname':
                return 'Invalid First Name. It should only contain letters.';
            case '#addStaffLname':
                return 'Invalid Last Name. It should only contain letters.';
            case '#addStaffInitial':
                return 'Invalid Middle Initial. It should be a single letter.';
            case '#addStaffID':
                return 'Invalid Staff ID. It should be in the format 20**-*****.';
            case '#addStaffOemail':
                return 'Invalid Office Email. It should be a valid USeP email.';
            case '#addStaffPnumber':
                return 'Invalid Phone Number. It should start with 09 and have 11 digits.';
            case '#addStaffTnumber':
                return 'Invalid Telephone Number. It should be in the format ***-****.';
            case '#addStaffAddress':
                return 'Invalid Address. It should only contain letters, numbers, and basic symbols.';
            case '#addStaffRole':
                return 'Invalid Role. Please select a valid role.';
            case '#addStaffPemail':
                return 'Invalid Personal Email. It should be a valid gmail address.';
            case '#addStaffUsername':
                return 'Invalid Username. It should contain at least 6 alphanumeric characters.';
            case '#psw':
                return 'Invalid Password. It should be at least 8 characters with at least one digit, one lowercase letter, one uppercase letter, and one special character (@ or _).';
            default:
                return 'Invalid input for ' + $(fieldId).attr('placeholder') + '.';
        }
    }

    return true; // Validation succeeded
}


function prepareStaffFormData() {
    var formData = new FormData();
    var profileFileInput = $('#addStaffinput-file')[0];
    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }

    // Append form data
    formData.append('first_name', $('#addStaffFname').val());
    formData.append('last_name', $('#addStaffLname').val());
    formData.append('mi', $('#addStaffInitial').val());
    formData.append('staffID', $('#addStaffID').val());
    formData.append('officeEmail', $('#addStaffOemail').val());
    formData.append('PhoneNumber', $('#addStaffPnumber').val());
    formData.append('Telephone', $('#addStaffTnumber').val());
    formData.append('address', $('#addStaffAddress').val());
    formData.append('role', $('#addStaffRole').val());
    formData.append('personalEmail', $('#addStaffPemail').val());
    formData.append('username', $('#addStaffUsername').val());
    formData.append('password', $('#psw').val());

    return formData;
}

function handleStaffAjaxSuccess(response) {
    console.log('Response from server:', response);

    try {
        var result = typeof response === 'string' ? JSON.parse(response) : response;
        if (result.success) {
            handleStaffSuccessConfirmation();
        } else {
            showStaffError('Failed to add the staff. Please try again.');
        }
    } catch (e) {
        console.error('Failed to parse JSON response:', response);
        showStaffError('Failed to process the server response.');
    }
}

function handleStaffSuccessConfirmation() {
    $("#staffModal").modal("hide");
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
            setTimeout(function () {
                location.reload();
            });
        }
    });
}

function handleStaffAjaxError() {
    showStaffError('AJAX request failed.'); // Consider improving the user experience
}

function showStaffError(message) {
    Swal.fire({
        title: 'Error!',
        text: message,
        icon: 'error'
    });
}

function showStaffValidationError(message) {
    showStaffError(message);
}
