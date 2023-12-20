var bookId;
var bookName;
$(document).ready(function() {
    // Attach click event to delete buttons
    $('.deleteBook').on('click', function(e) {
        e.preventDefault();
        bookId = $(this).data('book-id');

        // Get staff member's name for the confirmation message
        bookName = $(this).data('book-name');

        // Call your delete function or AJAX request here with the adminId
        showDeleteConfirmation(bookName);
    });
});

function deleteBook(bookId) {
    console.log(bookId);

    $.ajax({
        url: '../operations/delete_book.php',
        type: 'POST',
        data: { book_id: bookId,
                bookName: bookName,},
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // Handle the response, e.g., update the UI or remove the row from the table
            Swal.fire({
                title: 'DELETED!',
                text: 'SUCCESSFULLY DELETED!',
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
        },
        error: function() {
            console.error('Error Deleting book member.');
            alert('Error Deleting book member. Please try again.');
            location.reload();
        }
    });
}

function showDeleteConfirmation(bookName) {
    Swal.fire({
        title: 'ARE YOU SURE?',
        text: 'Do you really want to delete the account for ' + bookName + '? This process cannot be undone.',
        icon: 'error', // Set the icon as 'error'
        iconHtml: '<div style="background-color: white; display: inline-block; padding: 20px; border-radius: 5px;"><i class="bi bi-trash3-fill" style="font-size: 50px; color: #711717;"></i></div>',
        showCancelButton: true,
        confirmButtonColor: '#711717',
        confirmButtonText: 'DELETE',
        cancelButtonText: 'CANCEL',
        cancelButtonColor: '#e3e6e9',
        customClass: {
            popup: 'my-swal-popup',
            content: 'my-swal-content',
            title: 'swal-title',
            cancelButton: 'my-cancel-button',
            confirmButton: 'my-confirm-button'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            deleteBook(bookId);

        }
    });
}
