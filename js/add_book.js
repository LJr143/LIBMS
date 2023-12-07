$(document).ready(function() {
    // Add click event listener to the "ADD" button
    $('#addBookBtn').on('click', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Call the addBook function when the button is clicked
        addBook();
    });
});

function updateProfilePicture(event) {
    var input = event.target;
    var image = $('#displayBookPicture')[0];
    var addImageIcon = $('#addImageIcon');

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            image.src = e.target.result;
            addImageIcon.hide(); // Hide the "+" sign when an image is added
        };

        reader.readAsDataURL(input.files[0]);
    }
}




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
        method: 'POST',
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
    var form = $('#AddBookDisplay')[0];
    form.classList.add('was-validated');

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

    for (var i = 0; i < requiredFields.length; i++) {
        var field = $(requiredFields[i]);
        if (field.val().trim() === '') {
            showValidationError('Please fill in all required fields.');
            return false; // Validation failed
        }
    }

    // Validate the file input
    var profileFileInput = $('#profilePictureInput')[0];
    var profileFile = profileFileInput.files[0];

    if (!profileFile) {
        showValidationError('Please select a profile image.');
        return false; // Validation failed
    }

    // Validate patterns for specific fields
    var patterns = {
        '#bookBookID': /^\d{4}-\d{5}$/,
        '#bookBookTitle': /^[A-Za-z0-9\s]+$/,
        '#bookBookAuthor': /^[A-Za-z0-9\s]+$/,
        '#bookISBN': /^\d{13}$/,
        '#bookCopies': /^\d{3}$/,
        '#bookShelf': /^[A-Za-z0-9\s]+$/,
        '#bookPublishers': /^[A-Za-z0-9\s]+$/,
        '#bookSummary': /^[A-Za-z0-9,.\s]+$/,
    };

    for (var fieldId in patterns) {
        var field = $(fieldId);
        var pattern = patterns[fieldId];

        if (!pattern.test(field.val())) {
            var errorMessage = getCustomErrorMessage(fieldId, 'add_book');
            showValidationError(errorMessage);
            return false; // Validation failed
        }
    }

    return true; // Validation succeeded
}

function prepareFormData() {
    var formData = new FormData();
    var profileFileInput = $('#profilePictureInput')[0];

    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }

    // Append form data for add_book
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
            handleSuccessConfirmation('BookModal');
        } else {
            showError('Failed to add the book. Please try again.');
        }
    } catch (e) {
        console.error('Failed to parse JSON response:', response);
        showError('Failed to process the server response.');
    }
}

// Use the same handleSuccessConfirmation function for both add_book and add_student
function handleSuccessConfirmation(modalId) {
    $("#" + modalId).modal("hide");
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
            }, 0); // <-- Add the missing closing parenthesis here
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

function getCustomErrorMessage(fieldId, formType) {
    switch (fieldId) {
        case '#bookBookID':
            return 'Invalid Book ID. It should be in a specific format ****-*****.';
        case '#bookBookTitle':
            return 'Invalid Book Title. It should only contain letters and numbers.';
        case '#bookBookAuthor':
            return 'Invalid Book Author. It should only contain letters.';
        case '#bookISBN':
            return 'Invalid ISBN. It should contain 13 numbers.';
        case '#bookCopies':
            return 'Invalid Copies. It should be a three-digit number.';
        case '#bookShelf':
            return 'Invalid Shelf. It should only contain letters and numbers.';
        case '#bookPublishers':
            return 'Invalid Publishers. It should only contain letters and numbers.';
        case '#bookSummary':
            return 'Invalid Summary. It should only contain letters, numbers, and basic symbols.';
        default:
            return 'Invalid input for ' + $(fieldId).attr('placeholder') + '.';
    }
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
    $("#BookModal").modal("hide");
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
