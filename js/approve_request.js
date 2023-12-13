$(document).ready(function () {
        $("#approveRequest").click(function (e) {
            e.preventDefault(); // Prevent the default form submission
            approveRequest();
    });

    function approveRequest() {
        console.log('Approving course');

        var formData = prepareFormData();
        $.ajax({
            url: '../operations/approve_request.php',
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
                handleSuccessConfirmation('infoModal1', operationType);
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

