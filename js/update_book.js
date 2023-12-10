
$(document).ready(function () {
    // Add click event listener to the "UPDATE" button
    $('#updateBookBtn').on('click', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Call the updateBook function when the button is clicked
        updateBook();
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

function updateBook() {
    // Validate the form fields before proceeding
    if (!validateUpdateForm()) {
        return; // Exit if validation fails
    }

    // Prepare form data for update
    var formData = prepareUpdateFormData();

    // AJAX request for update_book.php
    $.ajax({
        url: '../operations/update_book.php',
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
    var form = $('#UpdateBookDisplay')[0];
    form.classList.add('was-validated');

    // Add validation logic for each required field in the update form
    var requiredFields = [
        '#editBookID',
        '#editBookTitle',
        '#editBookGenre',
        '#editBookAuthor',
        '#editBookISBN',
        '#editBookCopies',
        '#editBookShelf',
        '#editBookPublishers',
        '#editBookCategory',
        '#editBookSummary',
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

    // Validate the file input for update only if a new image is selected
    var profileFileInput = $('#editprofilePictureInput')[0];

    if (profileFileInput.files.length > 0) {
        var profileFile = profileFileInput.files[0];
        // Additional validation code for the profile image if needed
    } else {
        // No new image selected, so no validation needed for the image
    }

    // Validate patterns for specific fields in the update form
    var patterns = {
        '#editBookID': /^\d{4}-\d{5}$/,
        '#editBookTitle': /^[A-Za-z0-9\s]+$/,
        '#editBookAuthor': /^[A-Za-z0-9\s]+$/,
        '#editBookISBN': /^\d{13}$/,
        '#editBookCopies': /^\d{3}$/,
        '#editBookShelf': /^[A-Za-z0-9\s]+$/,
        '#editBookPublishers': /^[A-Za-z0-9\s]+$/,
        '#editBookSummary': /^[A-Za-z0-9,.\s]+$/,
    };

    for (var fieldId in patterns) {
        var field = $(fieldId);

        if (field.length === 0) {
            console.error('Field not found with ID:', fieldId);
            continue; // Skip to the next iteration if the field is not found
        }

        var pattern = patterns[fieldId];

        if (!pattern.test(field.val())) {
            var errorMessage = getCustomErrorMessage(fieldId, 'update');
            showValidationError(errorMessage);
            return false; // Validation failed
        }
    }

    return true; // Validation succeeded
}



function prepareUpdateFormData()     {
    var formData = new FormData();
    var profileFileInput = $('#editprofilePictureInput')[0];

    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }

    // Append form data for update_book
    formData.append('bookId', $('#editBookID').val());
    formData.append('bookTitle', $('#editBookTitle').val());
    formData.append('bookGenre', $('#editBookGenre').val());
    formData.append('bookAuthor', $('#editBookAuthor').val());
    formData.append('bookISBN', $('#editBookISBN').val());
    formData.append('bookCopy', $('#editBookCopies').val());
    formData.append('bookShelf', $('#editBookShelf').val());
    formData.append('bookPublisher', $('#editBookPublishers').val());
    formData.append('bookCategory', $('#editBookCategory').val());
    formData.append('bookSummary', $('#editBookSummary').val());

    return formData;
}


function handleAjaxUpdateSuccess(response) {
    console.log(response); // Log the response for debugging

    try {
        var result = typeof response === 'string' ? JSON.parse(response) : response;
        if (result.success) {
            handleSuccessConfirmation('UpdateBookModal');
        } else {
            showError('Failed to update the book. Please try again.');
        }
    } catch (e) {
        console.error('Failed to parse JSON response:', response);
        showError('Failed to process the server response.');
    }
}


function clearUpdateForm() {
    // Clear the entire update form
    $('#UpdateBookDisplay')[0].reset();

    // Reset the profile picture display for update
    var defaultImageSrc = '../img'; // Replace with the path to your default image
    $('#displayUpdatedBookPicture').attr('src', defaultImageSrc);

    // Show the "+" sign for adding image in update form
    $('#updateImageIcon').show();

    // Clear validation styling
    var form = $('#UpdateBookDisplay')[0];
    form.classList.remove('was-validated');
}


