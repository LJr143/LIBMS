$(document).ready(function() {
    // Add click event listener to the "ADD" button
    $('#addBookBtn').on('click', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Call the addBook function when the button is clicked
        addBook();
    });
});

function addBook() {
    // Validate the form fields before proceeding
    if (!validateForm()) {
        return; // Exit if validation fails
    }

    // Prepare form data
    var formData = prepareFormData();

    // AJAX request
    $.ajax({
        url: '../operations/add_book.php',
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
    // Add validation logic for each required field
    var requiredFields = [
        '#bookBookID',
        '#bookBookTitle',
        '#bookBookAuthor',
        '#bookISBN',
        '#bookCopies',
        '#bookShelf',
        '#bookPublishers',
        '#bookSummary',
    ];

    for (let i = 0; i < requiredFields.length; i++) {
        const field = $(requiredFields[i]);
        console.log('Field:', field);  // Log the field to the console
        console.log('Field Value:', field.val());  // Log the field value to the console

        if (field.val().trim() === '') {
            showValidationError('Please fill in all required fields.');
            return false; // Validation failed
        }
    }

    // Validate the file input (if applicable)
    var profileFileInput = $('#profilePictureInput')[0];
    if (profileFileInput.files.length === 0) {
        showValidationError('Please select a book image.');
        return false; // Validation failed
    }

    return true; // Validation succeeded
}


function prepareFormData() {
    var formData = new FormData();
    var profileFileInput = $('#profilePictureInput')[0];
    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }

    // Append form data
    formData.append('bookID', $('#bookBookID').val());
    formData.append('bookTitle', $('#bookBookTitle').val());
    formData.append('bookGenre', $('#bookGenre').val());
    formData.append('bookAuthor', $('#bookBookAuthor').val());
    formData.append('bookISBN', $('#bookISBN').val());
    formData.append('bookCopies', $('#bookCopies').val());
    formData.append('bookShelf', $('#bookShelf').val());
    formData.append('bookPublisher', $('#bookPublishers').val());
    formData.append('bookCategory', $('#bookCategory').val());
    formData.append('bookSummary', $('#bookSummary').val());

    return formData;
}

function handleAjaxSuccess(response) {
    try {
        var result = typeof response === 'string' ? JSON.parse(response) : response;
        if (result.success) {
            handleSuccessConfirmation();
        } else {
            showError('Failed to add the book. Please try again.');
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


