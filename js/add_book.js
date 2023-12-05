$(document).ready(function () {
    $('#addBookBtn').on('click', function (e) {
        e.preventDefault();
        addBook();
    });
});

function addBook() {
    if (!validateForm()) {
        return;
    }

    var formData = prepareFormData();

    $.ajax({
        url: '../operations/add_book.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: handleAjaxSuccess,
        error: handleAjaxError
    });
}

function validateForm() {
    var requiredFields = [
        '#bookBookID', '#bookBookTitle', '#bookBookAuthor', '#bookISBN',
        '#bookCopies', '#bookShelf', '#bookPublishers', '#bookSummary'
    ];

    for (let i = 0; i < requiredFields.length; i++) {
        const field = $(requiredFields[i]);
        console.log('Field:', field);
        console.log('Field Value:', field.val());

        if (field.val().trim() === '') {
            showValidationError('Please fill in all required fields.');
            return false;
        }
    }

    var profileFileInput = $('#profilePictureInput')[0];
    if (profileFileInput.files.length === 0) {
        showValidationError('Please select a book image.');
        return false;
    }

    return true;
}

function prepareFormData() {
    var formData = new FormData();
    var profileFileInput = $('#profilePictureInput')[0];
    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }

    var formFields = [
        'bookID', 'bookTitle', 'bookGenre', 'bookAuthor', 'bookISBN',
        'bookCopies', 'bookShelf', 'bookPublisher', 'bookCategory', 'bookSummary'
    ];

    formFields.forEach(function (field) {
        formData.append(field, $('#' + field).val());
    });

    return formData;
}

function handleAjaxSuccess(response) {
    console.log(response);
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
    }).then(function (result) {
        if (result.isConfirmed) {
            setTimeout(function () {
                location.reload();
            });
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
