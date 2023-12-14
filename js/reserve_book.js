$(document).ready(function () {
    $('#reserveBookBtn').on('click', function () {
        var bookId = $('#book_id').val();
        var userId = $(this).data('user-id');
        $('#bookModal').modal('hide');

        fetchBookData(bookId);

        $('#reserveConfirmBtn').on('click', function () {
            var date = $('#date_reserve_vw').val();
            var returnDate = $('#date_return_vw').val();

            if (date && returnDate) {
                // Both dates are selected, proceed with reservation
                processBookReserving(bookId, userId, date, returnDate);
                $('#reserveModal').modal('hide');
            } else {
                // Show an error message because dates are not selected
                Swal.fire({
                    title: 'Error!',
                    text: 'Please select both reservation and return dates.',
                    icon: 'error'
                }).then(() => {
                    // Reload the reservation modal and set dates
                    $('#reserveModal').modal('show');
                    // Set the previously selected dates (if any)
                    $('#date_reserve_vw').val(date);
                    $('#date_return_vw').val(returnDate);
                });
            }
        });


        fetchBookData(bookId, function (response) {
            // Handle success of fetching book data
            $('#reserveBookTitle').text(response[0].book_title);
            $('#reserveBookAuthor').text(response[0].author);
            $('#reserveBookGenre').text(response[0].genre);
            $('#reserveBookPublisher').text(response[0].publisher);
        });
    });

    function fetchBookData(bookId, successCallback) {
        $.ajax({
            url: '../operations/fetch_book.php',
            type: 'POST',
            data: { bookId: bookId },
            dataType: 'json',
            success: successCallback,
            error: function () {
                console.error('Error fetching Book data.');
            }
        });
    }

    function processBookReserving(bookId, userId, date, returnDate) {
        $.ajax({
            url: '../operations/reserve_book.php',
            type: 'POST',
            data: { bookId: bookId, userId: userId, date: date, returnDate: returnDate },
            success: function (reserveResponse) {
                Swal.fire({
                    title: 'SUCCESS!',
                    text: 'YOUR REQUEST IS SENT!',
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
                console.log('Book reserving processed:', reserveResponse);
            },
            error: function () {
                console.error('Error processing book reserving.');
            }
        });
    }
});
