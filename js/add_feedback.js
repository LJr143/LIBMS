$(document).ready(function() {
    // Show feedback modal on button click
    $('#FeedbackBtn').click(function() {
        $('#feedbackModal').modal('show');
    });
    $('#bookReviewBtn').click(function() {
        $('#bookReviewModal').modal('show');
    });

    // Handle star rating click
    $('.rating i').click(function() {
        let index = $(this).data('index');

        // Reset all stars
        $('.rating i').removeClass('bi-star-fill text-warning').addClass('bi-star');

        // Fill stars up to the clicked one
        $('.rating i').each(function(i) {
            if (i <= index) {
                $(this).removeClass('bi-star').addClass('bi-star-fill text-warning');
            }
        });
    });

    // Reset star rating on modal close
    $('#feedbackModal').on('hidden.bs.modal', function() {
        $('.rating i').removeClass('bi-star-fill').addClass('bi-star');
    });

    // Handle form submission
    $('#submitFeedbackBtn').click(function() {
        // Get selected rating
        let selectedRating = $('.rating i.bi-star-fill').length;

        // Get feedback comment
        let feedbackComment = $('#feedbackComment').val();

        // Get user ID from the data attribute
        let user_id = $('#user_id').data('user-id');

        console.log(selectedRating, feedbackComment, user_id);

        // Make AJAX request
        $.ajax({
            type: 'POST',
            url: '../operations/add_feedback.php',
            data: {
                rating: selectedRating,
                comment: feedbackComment,
                userId: user_id,
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                handleAjaxSuccess(response, 'add');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log(xhr.responseText);
            }
        });
    });


    function handleAjaxSuccess(response, operationType) {
        try {
            if (response.success) {
                handleSuccessConfirmation('feedbackModal', operationType);
            } else {
                showError(response.message || `Failed to ${operationType === 'add' ? 'add' : 'update'} the feedback. Please try again.`);
            }
        } catch (e) {
            console.error('Failed to process the server response:', e);
            showError('Failed to process the server response.');
        }
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
            // Check if the user clicked "OK"
            if (result.isConfirmed) {
                // Reload the page after a short delay
                setTimeout(function () {
                    location.reload();
                }, 0);
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

});
