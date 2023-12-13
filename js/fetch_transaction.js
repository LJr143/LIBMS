$(document).ready(function () {
    var transactionId;

    // Event listener for .transaction_modal using event delegation
    $(document).on('click', '.transaction_modal', function (e) {
        e.preventDefault();
        e.stopPropagation();

        // Show the modal
        $('#infoModal1').modal('show');

        // Get the transactionId from the data attribute
        transactionId = $(this).data('transaction-id');

        // Fetch and update the modal immediately when the button is clicked
        fetchAndUpdateModal(transactionId);


    });
    $(".approveRequest").click(function (e) {
        e.preventDefault(); // Prevent the default form submission
        approveRequest();
    });
    $(".rejectRequest").click(function (e) {
        e.preventDefault(); // Prevent the default form submission
        rejectRequest();
    });

    function fetchAndUpdateModal(transactionId) {
        // Make an AJAX request to fetch the latest transaction data
        $.ajax({
            url: '../operations/fetch_transaction.php',
            type: 'POST',
            data: { transactionId: transactionId },
            dataType: 'json',
            success: function (response) {
                // Handle the response and populate your modal with data
                if (response && response.length > 0) {
                    // If transactionData is not empty, populate the modal
                    populateModal(response);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                console.error('AJAX Error:', status, error);
            }
        });
    }

    function populateModal(data) {
        clearModalContent();
        // Assuming the data is an array and you want the first element
        const transactionData = data[0];

        // Populate the modal fields with data received from the server
        $('#userId').text(transactionData.user_id);
        $('#userName').text(transactionData.fname + ' ' + transactionData.initial + ' ' + transactionData.lname);
        $('#userCourse').text(transactionData.course);
        $('#userMajor').text(transactionData.major);
        $('#userYear').text(transactionData.year);

        const bookImagePath = '../book_img/' + transactionData.book_img; // Adjust property name as per your data
        $('#bookImage').attr('src', bookImagePath);
        $('#bookTitle').text(transactionData.book_title);
        $('#author').text(transactionData.author);
        $('#borrowDate').text(transactionData.date_requested);
        $('#shelf').text(transactionData.shelf);
        $('#publisher').text(transactionData.publisher);
        $('#dueDate').text(transactionData.date_return);
    }

    function clearModalContent() {
        // Clear content of modal fields
        $('#userId').empty();
        $('#userName').empty();
        $('#userCourse').empty();
        $('#userMajor').empty();
        $('#userYear').empty();
        $('#bookImage').empty();
        $('#bookTitle').empty();
        $('#author').empty();
        $('#borrowDate').empty();
        $('#shelf').empty();
        $('#publisher').empty();
        $('#dueDate').empty();
    }

    // Periodically update notifications and modal data
    setInterval(function () {
        // Fetch new transactions using AJAX
        $.ajax({
            url: '../operations/update_notifications_endpoint.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.length > 0) {
                    // Update the notification dropdown
                    updateNotificationDropdown(response);

                    // Update the notification counter
                    updateNotificationCounter();

                }
            },
            error: function () {
                console.error('Error fetching new transactions.');
            }
        });

        // Fetch and update the modal immediately when the button is clicked
        fetchAndUpdateModal(transactionId);
    }, 5000);

    function updateNotificationDropdown(transactions) {
        var notificationList = $('#notificationList');
        notificationList.empty();

        transactions.forEach(function (transact) {
            var listItem = $('<li></li>');
            listItem.html('<div class="d-flex justify-content-between align-items-center" style=" background-color: #F8F8FF; padding: 10px; height: 35px; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); margin-bottom: 8px;">' +
                '<span style="text-transform: capitalize;">' + transact.fname + ' ' + transact.initial + '.' + ' ' + transact.lname + ' has requested to ' + transact.transaction_type + ' a book</span>' +
                '<div class="btn-group ms-4">' +
                '<button type="button" class="btn custom-btn transaction_modal" data-transaction-id="' + transact.id + '">' +
                '<i class="bi bi-info-circle" style="color:blue; font-size: 20px;"></i>' +
                '</div>' +
                '</div>' +
                '</li>');

            notificationList.append(listItem);
        });
    }
    function updateNotificationCounter() {
        // Fetch the updated counter value using AJAX
        $.ajax({
            url: '../operations/fetch_notification_counter.php',
            type: 'GET',
            dataType: 'json',
            success: function (counterValue) {
                // Update the notification counter span with the new value
                $('#notificationCounter').text(counterValue);
                console.log('Notification counter updated:', counterValue);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching notification counter:', status, error);
            }
        });
    }


    function approveRequest() {
        console.log('Approving course');
        var status = 'Approved';
        $.ajax({
            url: '../operations/response_request.php',
            method: 'POST',
            data: {
                transactionId: transactionId,
                status: status,
            },
            dataType: 'json', // Expect JSON response
            success: function (response) {
                console.log(response);
                handleAjaxSuccess(response, 'approve');
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log(xhr.responseText); // Log the full response text
                handleAjaxError(xhr);
            },
        });
    }
    function rejectRequest() {
        console.log('Rejecting course');
        var status = 'Rejected';
        $.ajax({
            url: '../operations/response_request.php',
            method: 'POST',
            data: {
                transactionId: transactionId,
                status: status,
            },
            dataType: 'json', // Expect JSON response
            success: function (response) {
                console.log(response);
                handleAjaxSuccess(response, 'reject');
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log(xhr.responseText); // Log the full response text
                handleAjaxError(xhr);
            },
        });
    }


    function handleAjaxSuccess(response, operationType) {
        try {
            if (response.success) {
                handleSuccessConfirmation('infoModal1', operationType);
            } else {
                showError(response.message || `Failed to ${operationType === 'approve' ? 'reject' : 'update'} the Request. Please try again.`);
            }
        } catch (e) {
            console.error('Failed to process the server response:', e);
            showError('Failed to process the server response.');
        }
    }

    function handleSuccessConfirmation(modalId, operationType) {
        $("#" + modalId).modal("hide");
        var successTitle = operationType === 'approve' ? 'APPROVED!' : 'REJECTED!';
        var successText = operationType === 'approve' ? 'SUCCESSFULLY APPROVED!' : 'SUCCESSFULLY REJECTED!';
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

    function handleAjaxError(xhr) {
        // Extract error message from the response, if available
        var errorMessage = 'AJAX request failed.';
        if (xhr.responseJSON && xhr.responseJSON.error) {
            errorMessage = xhr.responseJSON.error;
        }
        showError(errorMessage);
    }

    function showError(message) {
        Swal.fire({
            title: 'Error!',
            text: message,
            icon: 'error'
        });
    }

});
