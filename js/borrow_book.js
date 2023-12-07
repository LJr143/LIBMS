$(document).ready(function() {
    $('.borrow-button').on('click', function () {
        var bookId = $('#book_id').val();
        $('#bookModal').modal('hide');
        // Get today's date
        var today = new Date();

        // Format today's date as "YYYY-MM-DD" for input field
        var formattedToday = today.toISOString().split('T')[0];

        // Set the value of the borrowed date input field to today's date
        document.getElementById("date_borrowed_vw").value = formattedToday;

        // Calculate due date (3 days from today)
        var dueDate = new Date();
        dueDate.setDate(today.getDate() + 3);

        // Format due date as "YYYY-MM-DD" for input field
        var formattedDueDate = dueDate.toISOString().split('T')[0];

        // Set the value of the due date input field
        document.getElementById("date_due_vw").value = formattedDueDate;
        console.log(bookId);
        $.ajax({
            url: '../operations/fetch_book.php', // Replace with your backend endpoint
            type: 'POST',
            data: {bookId: bookId},
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('#book_title').text(response[0].book_title);
                $('#book_author').text(response[0].author);
            },
            error: function () {
                // Handle errors
                console.error('Error fetching Book data.');
            }
        });
    });

    $('.barrow_confirm_btn').on('click', function () {
        var bookId = $('#book_id').val();
        $('#borrowModal').modal('hide');
        $('#borrowConfirmationModal').modal('show');
        console.log(bookId);
        $.ajax({
            url: '../operations/fetch_book.php',
            type: 'POST',
            data: {bookId: bookId},
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('#book_title').text(response[0].book_title);
                $('#book_author').text(response[0].author);

            },
            error: function () {
                // Handle errors
                console.error('Error fetching Book data.');
            }
        });
    });
});
