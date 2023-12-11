$(document).ready(function() {
    $("#addCollegeBtn").click(function() {
        $("#collegeModal").modal("show");
        $("#addCllgBtn").click(function(e) {
            e.preventDefault(); // Prevent the default form submission
            addCollege();
        });
    });
});

function addCollege() {
    if (!validateForm()) {
        return; // Exit if validation fails
    }
    var formData = prepareFormData();
    $.ajax({
        url: '../operations/add_college.php',
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
    var form = $('#AddCollegeModal')[0];
    form.classList.add('was-validated');

    // Add validation logic for each required field
    var requiredFields = ['#addCollegeId', '#addCollegeName'];

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
    formData.append('collegeId', $('#addCollegeId').val());
    formData.append('collegeName', $('#addCollegeName').val());

    return formData;
}

function handleAjaxSuccess(response, operationType) {
    try {
        if (response.success) {
            handleSuccessConfirmation('collegeModal', operationType);
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
