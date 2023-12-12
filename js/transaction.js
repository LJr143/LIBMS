
$(document).ready(function () {
    function updateNotifications() {
        // Fetch new transactions using AJAX
        $.ajax({
            url: '../operations/update_notifications_endpoint.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.length > 0) {
                    // Update the notification dropdown
                    updateNotificationDropdown(response);
                }
            },
            error: function () {
                console.error('Error fetching new transactions.');
            }
        });
    }

    function updateNotificationDropdown(transactions) {
        var notificationList = $('#notificationList');
        notificationList.empty();

        transactions.forEach(function (transact) {
            // Inside updateNotificationDropdown function
            var listItem = $('<li></li>');
            listItem.html('<div class="d-flex justify-content-between align-items-center" style=" background-color: #F8F8FF; padding: 10px; height: 35px; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); margin-bottom: 8px;">' +
                '<span style="text-transform: capitalize;">' + transact.fname + ' ' + transact.initial + '.' + ' ' + transact.lname + ' has requested to ' + transact.transaction_type + ' a book</span>' +
                '<div class="btn-group ms-4">' +
                '<button type="button" class="btn custom-btn transaction_modal" data-transaction-id="' + transact.id + '">' +
                '<i class="bi bi-info-circle" style="color:blue; font-size: 20px;"></i>' +
                '</button>' +
                '<button type="button" class="btn custom-btn">' +
                '<i class="bi bi-check-circle" style="color:green; font-size: 20px;"></i>' +
                '</button>' +
                '<button type="button" class="btn custom-btn">' +
                '<i class="bi bi-x-circle" style="color:red; font-size: 20px;"></i>' +
                '</button>' +
                '</div>' +
                '</div>' +
                '</li>');

            notificationList.append(listItem);


        });
    }
    // Periodically update notifications and modal data
    setInterval(function () {
        updateNotifications();
    }, 30000);


});
