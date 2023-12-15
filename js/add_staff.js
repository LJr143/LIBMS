$(document).ready(function () {
    $('#addStaffBtn').on('click', function (e) {
        e.preventDefault();

        $("#staffModal").modal("show");
    });

    $('#addStaffModalBtn').on('click', function (e) {
        addStaff();
    });
});


function addStaff() {
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

