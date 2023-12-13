$(document).ready(function() {
    $("#addCollegeBtn").click(function() {
        $("#collegeModal").modal("show");
        $("#addCllgBtn").click(function(e) {
            e.preventDefault(); // Prevent the default form submission
            addCollege();
        });
    });

    function addCollege() {
        console.log('Adding college...'); // Add this log
        if (!validateForm()) {
            console.log('Validation failed.'); // Add this log
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
                console.log(response); // Log the response for debugging
                handleAjaxSuccess(response, 'add');
            },
            error: handleAjaxError
        });
    }

    function validateForm() {
        // Trigger form validation manually
        var form = $('#AddCollegeModal')[0];
        form.classList.add('was-validated');

        // Add validation logic for each field
        var validations = {
            '#addCollegeId': {
                required: true,
                pattern: /^COL-[0-9]{4}$/i
            },
            '#addCollegeName': {
                required: true,
                pattern: /^([A-Za-z][a-z]*\s*)+$/
            }
            // Add more fields as needed
        };

        for (var fieldId in validations) {
            var field = $(fieldId);
            var validation = validations[fieldId];

            if (validation.required && field.val().trim() === '') {
                showValidationError('Please input all fields.');
                return false; // Validation failed
            }

            if (validation.pattern && !validation.pattern.test(field.val())) {
                var errorMessage = getCustomErrorMessage(fieldId, 'add_college');
                showValidationError(errorMessage);
                return false; // Validation failed
            }
        }

        return true; // Validation succeeded
    }


    // to set the college name capitalize every word
    $(document).ready(function() {
        // Listen for input changes in the addCollegeName field
        $('#addCollegeName').on('input', function() {
            // Get the current value of the input
            var inputValue = $(this).val();

            // Capitalize the first letter of each word
            var capitalizedValue = inputValue.replace(/\b\w/g, function(match) {
                return match.toUpperCase();
            });

            // Update the input value with the capitalized text
            $(this).val(capitalizedValue);
        });
    });





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

    $('#collegeModal').on('hidden.bs.modal', function () {
        $('#AddCollegeModal')[0].reset();
    });
});


function getCustomErrorMessage(fieldId, formType) {
    switch (fieldId) {
        case '#addCollegeId':
            return 'Invalid College ID. It should follow the pattern COL-****.';
        case '#addCollegeName':
            return 'Invalid College Name. It should only contain letters and spaces.';
        // Add more cases for other fields as needed
        case '#editCollegeId': // Example for an edit form
            return 'Invalid Edited College ID. It should follow the pattern COL-****.';
        case '#editCollegeName': // Example for an edit form
            return 'Invalid Edited College Name. It should only contain letters and spaces.';
        default:
            return 'Invalid input for ' + $(fieldId).attr('placeholder') + '.';
    }
}
