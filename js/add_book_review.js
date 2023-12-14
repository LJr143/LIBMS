$(document).ready(function () {
    var user_id;
    var book_id;

    $('.reviewBooKBtn').click(function () {
        $('#bookReviewModal').modal('show');
        user_id = $(this).data('user-id');
        book_id = $(this).data('book-id');
        console.log(user_id, book_id);
        fetchBookTitle();
    });

    $('.rating i').click(handleStarRatingClick);

    $('#bookReviewModal').on('hidden.bs.modal', resetStarRating);

    $('#submitReviewBtn').click(handleFormSubmission);

    function handleStarRatingClick() {
        let index = $(this).data('index');
        resetAllStars();
        fillStars(index);
    }

    function resetAllStars() {
        $('.rating i').removeClass('bi-star-fill text-warning').addClass('bi-star');
    }

    function fillStars(index) {
        $('.rating i').each(function (i) {
            if (i <= index) {
                $(this).removeClass('bi-star').addClass('bi-star-fill text-warning');
            }
        });
    }

    function resetStarRating() {
        $('.rating i').removeClass('bi-star-fill').addClass('bi-star');
    }

    function handleFormSubmission() {
        let selectedRating = $('.rating i.bi-star-fill').length;
        let feedbackComment = $('#reviewComment').val();
        console.log(selectedRating, feedbackComment, user_id);

        $.ajax({
            type: 'POST',
            url: '../operations/add_book_review.php',
            data: {
                rating: selectedRating,
                comment: feedbackComment,
                userId: user_id,
                bookId: book_id,
            },
            dataType: 'json',
            success: handleAjaxSuccess,
            error: handleAjaxError,
        });
    }

    function handleAjaxSuccess(response) {
        console.log(response);
        handleSuccessConfirmation('bookReviewModal', 'add');
    }

    function handleAjaxError(xhr, status, error) {
        console.error('AJAX Error:', status, error);
        console.log(xhr.responseText);
        showError('AJAX request failed.');
    }

    function fetchBookTitle() {
        console.log('im called!');
        $.ajax({
            url: '../operations/fetch_book.php',
            type: 'POST',
            data: { bookId: book_id },
            dataType: 'json',
            success: function (response) {
                // Populate the select options
                populateBookTitle(response);
                console.log(response);
            },
            error: handleFetchError,
        });
    }

    function populateBookTitle(data) {
        if (data.length > 0) {
            const book = data[0]; // Assuming you're interested in the first book in the array
            const bookTitle = book.book_title;

            // Set the content of the HTML element with id "bookTitle"
            $('#bookTitle').text(bookTitle);
        }
    }


    function handleFetchError() {
        console.error('Error fetching book title.');
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
            if (result.isConfirmed) {
                setTimeout(function () {
                    location.reload();
                }, 0);
            }
        });
    }

    function showError(message) {
        Swal.fire({
            title: 'Error!',
            text: message,
            icon: 'error'
        });
    }
});
