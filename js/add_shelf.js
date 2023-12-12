$(document).ready(function () {
    $("#addShelfBtn").click(function () {
        $("#shelfModal").modal("show");
    });

    $("#addShelfBtnAdd").click(function (e) {
        e.preventDefault(); // Prevent the default form submission
        addShelf();
    });

    function addShelf() {
        if (!validateForm()) {
            return; // Exit if validation fails
        }
        var formData = prepareFormData();
        $.ajax({
            url: '../operations/add_shelf.php',
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
        var form = $('#AddShelfModal')[0];

        if (!form) {
            console.error('Form element not found.');
            return false;
        }

        form.classList.add('was-validated');

        var requiredFields = ['#addShelfId', '#addShelfCategory'];

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
        formData.append('shelfId', $('#addShelfId').val());
        formData.append('shelfCategory', $('#addShelfCategory').val());

        return formData;
    }

    function handleAjaxSuccess(response, operationType) {
        try {
            if (response.success) {
                handleSuccessConfirmation('AddShelfModal', operationType);
            } else {
                showError(response.message || `Failed to ${operationType === 'add' ? 'add' : 'update'} the shelf. Please try again.`);
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
            if (result.isConfirmed) {
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
});
