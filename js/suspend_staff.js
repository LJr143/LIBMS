var adminId;
var staffMemberName;
$(document).ready(function() {
    // Attach click event to delete buttons
    $('.suspend_staff').on('click', function(e) {
        e.preventDefault();
        adminId = $(this).data('admin-id');

        // Get staff member's name for the confirmation message
        staffMemberName = $(this).data('staff-name');

        // Call your delete function or AJAX request here with the adminId
        showSuspendConfirmation(staffMemberName);
    });

    $('.activate_staff').on('click', function(e) {
        e.preventDefault();
        adminId = $(this).data('admin-id');

        // Get staff member's name for the confirmation message
        staffMemberName = $(this).data('staff-name');

        // Call your delete function or AJAX request here with the adminId
        showActivateConfirmation(staffMemberName);
    });
});

function suspendStaff(adminId) {
    console.log(adminId);

    $.ajax({
        url: '../operations/suspend_staff.php',
        type: 'POST',
        data: { admin_id: adminId,
            staffName: staffMemberName,},
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // Handle the response, e.g., update the UI or remove the row from the table
            Swal.fire({
                title: 'SUSPENDED!',
                text: 'SUCCESSFULLY SUSPENDED!',
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
            console.error('Error suspending staff member.');
            alert('Error suspending staff member. Please try again.');
        }
    });
}

function activateStaff(adminId) {
    console.log(adminId);

    $.ajax({
        url: '../operations/activate_staff.php',
        type: 'POST',
        data: { admin_id: adminId,
            staffName: staffMemberName,},
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // Handle the response, e.g., update the UI or remove the row from the table
            Swal.fire({
                title: 'ACTIVATED!',
                text: 'SUCCESSFULLY ACTIVATED!',
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
            console.error('Error activating staff member.');
            alert('Error activating staff member. Please try again.');
        }
    });
}

function showSuspendConfirmation(staffMemberName) {
    Swal.fire({
        title: 'ARE YOU SURE?',
        text: 'Do you really want to suspend ' + staffMemberName + '?',
        icon: 'error', // Set the icon as 'error'
        iconHtml: '<div style="background-color: white; display: inline-block; padding: 20px; border-radius: 5px;"><i class="bi bi-exclamation-triangle" style="font-size: 50px; color: #711717; "></i></div>',
        showCancelButton: true,
        confirmButtonColor: '#711717',
        confirmButtonText: 'SUSPEND',
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
            suspendStaff(adminId);

        }
    });
}
function showActivateConfirmation(staffMemberName) {
    Swal.fire({
        title: 'ARE YOU SURE?',
        text: 'Do you really want to Activate ' + staffMemberName + '?',
        icon: 'error', // Set the icon as 'error'
        iconHtml: '<div style="background-color: white; display: inline-block; padding: 20px; border-radius: 5px;"><i class="bi bi-exclamation-triangle" style="font-size: 50px; color: #711717; "></i></div>',
        showCancelButton: true,
        confirmButtonColor: '#711717',
        confirmButtonText: 'ACTIVATE',
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
            activateStaff(adminId);

        }
    });
}