$(document).ready(function () {
    $('#borrowBookBtn').on('click', function () {
        var bookId = $('#book_id').val();
        var userId = $(this).data('user-id');
        $('#bookModal').modal('hide');
        $('#borrowModal').modal('show');

        setBorrowDateFields();

        fetchBookData(bookId, function (response) {
            $('#book_title').text(response[0].book_title);
            $('#book_author').text(response[0].author);
        });

        $('.barrow_confirm_btn').on('click', function () {
            var date = $('#date_borrowed_vw').val();
            $('#borrowModal').modal('hide');
            processBookBorrowing(bookId, userId, date);
        });
    });

    function setBorrowDateFields() {
        var today = new Date();
        var formattedToday = today.toISOString().split('T')[0];
        $('#date_borrowed_vw').val(formattedToday);

        var dueDate = new Date();
        dueDate.setDate(today.getDate() + 3);
        var formattedDueDate = dueDate.toISOString().split('T')[0];
        $('#date_due_vw').val(formattedDueDate);
    }

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

    function processBookBorrowing(bookId, userId, date) {
        $.ajax({
            url: '../operations/borrow_book.php',
            type: 'POST',
            data: { bookId: bookId, userId: userId, date: date },
            success: function (borrowResponse) {
                Swal.fire({
                    title: 'SUCCESS!',
                    text: 'YOUR REQUEST IS SENT!',
                    icon: 'success',
                    customClass: {
                        popup: 'my-swal-popup',
                        title: 'swal-title',
                        content: 'my-swal-content',
                        confirmButton: 'my-confirm-button'
                    },
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#FF0000'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
                console.log('Book borrowing processed:', borrowResponse);
            },
            error: function () {
                console.error('Error processing book borrowing.');
            }
        });
    }
});




























