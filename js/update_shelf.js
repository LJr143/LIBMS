$(document).ready(function () {
    var shelfId;

    $(".editShelfBtn").click(function () {
        // Show the student modal
        $("#editShelfModal").modal("show");

        // Get the shelf_id from the data attribute
        shelfId = $(this).data('shelf-id');
        var shelfName = $(this).data('category-name');

        console.log(shelfId, shelfName);

        // Make an AJAX request to fetch shelf data
        $.ajax({
            url: '../operations/fetch_shelf.php',
            type: 'POST',
            data: {
                shelfId: shelfId,
                shelfName: shelfName,
            },
            dataType: 'json',
            success: function (response) {
                // Log the response to inspect the structure

                // Handle the response and populate your modal with data
                populateModal(response);
            },
            error: function () {
                // Handle errors
                console.error('Error fetching shelf data.');
            }
        });
    });

    // Bind the click event for #saveShlfBtn
    $("#saveShlfBtn").click(function (e) {
        console.log('clicked!');
        e.preventDefault(); // Prevent the default form submission

        updateShelf(shelfId);  // Pass the shelfId to updateShelf
    });
});

function populateModal(data) {
    // Populate the modal fields with data received from the server
    $('#editShelfId').val(data[0].shelf_id);
    $('#editShelfCategory').val(data[0].shelf_category);
}

function updateShelf(shelfId) {
    // Validate the form fields before proceeding
    if (!validateUpdateForm()) {
        return; // Exit if validation fails
    }

    // Prepare form data for update
    var formData = prepareUpdateFormData(shelfId);

    // AJAX request for update_shelf.php
    $.ajax({
        url: '../operations/update_shelf.php',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: handleAjaxUpdateSuccess,
        error: handleAjaxError
    });
}

function validateUpdateForm() {
    // Trigger form validation manually
    var form = $('#EditShelfModal')[0];
    form.classList.add('was-validated');

    // Add validation logic for each required field in the update form
    var requiredFields = [
        '#editShelfId',
        '#editShelfCategory',
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

function prepareUpdateFormData(shelfId) {
    var formData = new FormData();
    // Append form data for update_shelf.php
    formData.append('Id', shelfId);  // Include shelfId in the form data
    formData.append('shelfId', $('#editShelfId').val());
    formData.append('shelfCategory', $('#editShelfCategory').val());

    return formData;
}

function handleAjaxUpdateSuccess(response) {
    try {
        var result = typeof response === 'string' ? JSON.parse(response) : response;
        if (result.success) {
            handleSuccessConfirmation('editShelfModal');
        } else {
            showError('Failed to update the shelf. Please try again.');
        }
    } catch (e) {
        console.error('Failed to parse JSON response:', response);
        showError('Failed to process the server response.');
    }
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

function handleSuccessConfirmation(modalId) {
    $("#" + modalId).modal("hide");
    var successTitle = 'UPDATED!';
    var successText = 'SUCCESSFULLY UPDATED!';
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
