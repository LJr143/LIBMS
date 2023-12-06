function updateBook() {
    var formData = new FormData();
    var profileFileInput = $('#editprofilePictureInput')[0];
    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }
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

    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    $.ajax({
        url: '../operations/update_book.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            try {
                var result = JSON.parse(response);
                if (result.success) {
                    $("#staffModal").modal("hide");
                    Swal.fire({
                        title: 'UPDATED!',
                        text: 'SUCCESSFULLY UPDATED!',
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
                            // Reload the page
                            location.reload();
                        }
                    });

                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to delete the student. Please try again.',
                        icon: 'error'
                    });
                }
            } catch (e) {
                console.error('Failed to parse JSON response:', response);
            }
        },
        error: function () {
            alert('AJAX request failed.');
        }
    });
}

// Attach the updateStudent function to the Save button click event
$('#updateBookBtn').click(function() {
    // Disable the button to prevent multiple clicks
    $(this).prop('disabled', true);
    updateBook();
});