var adminId;
var staffMemberName;
var  userId;
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

    $('#deleteAllStaff').on('click', function(e) {
        e.preventDefault();
         userId = $(this).data('admin-id');


        // Call your delete function or AJAX request here with the adminId
        showDeleteAllConfirmation();
    });

    $('#suspendAll').on('click', function(e) {
        e.preventDefault();
        userId = $(this).data('admin-id');

        // Call your delete function or AJAX request here with the adminId
        showSuspendAllConfirmation();
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
function deleteAllStaff() {
    $.ajax({
        url: '../operations/delete_all_staff.php',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.success){
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
            }else {
                Swal.fire('Error', 'Error Deleting Staff!', 'error');
            }

        },
        error: function() {
            alert('Error deleting staff member. Please try again.');
        }
    });
}
function suspendAllStaff() {
    $.ajax({
        url: '../operations/suspend_all_staff.php',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.success){
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
            }else {
                Swal.fire('Error', 'Error Suspending Staff!', 'error');
            }

        },
        error: function() {
            alert('Error suspending staff member. Please try again.');
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

async function showDeleteAllConfirmation() {
    const iconHtml = '<div style="background-color: white; padding: 21px; "><i class="bi bi-trash3-fill" style="font-size: 50px; color: #711717;"></i></div>';
    const confirmationResult = await Swal.fire({
        title: 'ARE YOU SURE?',
        text: 'Do you really want to delete all these staff? Process cannot be undone.',
        icon: null,
        iconHtml: iconHtml,
        showCancelButton: true,
        confirmButtonColor: '#711717',
        confirmButtonText: 'PROCEED',
        cancelButtonText: 'CANCEL',
        cancelButtonColor: '#e3e6e9',
        customClass: {
            popup: 'my-swal-popup',
            content: 'my-swal-content',
            title: 'swal-title',
            cancelButton: 'my-cancel-button',
            confirmButton: 'my-confirm-button'
        },
        width: '520px'
    });

    if (confirmationResult.isConfirmed) {

        const { value: password } = await Swal.fire({
            title: 'Enter Password to Proceed',
            input: 'password',
            inputPlaceholder: 'Enter your administrative password',
            inputAttributes: {
                maxlength: '10',
                autocapitalize: 'off',
                autocorrect: 'off',
            },
            showCancelButton: true,
            customClass: {
                input: 'custom-input-class',
                cancelButton: 'custom-cancel-button-class'
            }
        });

        if (password) {
            console.log(userId,password);
            try {
                const response = await $.ajax({
                    type: 'POST',
                    url: '../operations/confirm_password_action.php',
                    data: { password: password, userId: userId },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                           deleteAllStaff();
                        } else {
                            Swal.fire('Error', 'Incorrect Password!', 'error');
                        }
                    }
                });

            } catch (error) {
                Swal.fire({
                    title: 'Error',
                    text: 'An error occurred while checking the password.',
                    icon: 'error'
                });
            }
        }
    }
}
async function showSuspendAllConfirmation() {
    const iconHtml = '<div style="background-color: white; padding: 21px; "><i class="bi bi-trash3-fill" style="font-size: 50px; color: #711717;"></i></div>';
    const confirmationResult = await Swal.fire({
        title: 'ARE YOU SURE?',
        text: 'Do you really want to suspend all these staff? Process cannot be undone.',
        icon: null,
        iconHtml: iconHtml,
        showCancelButton: true,
        confirmButtonColor: '#711717',
        confirmButtonText: 'PROCEED',
        cancelButtonText: 'CANCEL',
        cancelButtonColor: '#e3e6e9',
        customClass: {
            popup: 'my-swal-popup',
            content: 'my-swal-content',
            title: 'swal-title',
            cancelButton: 'my-cancel-button',
            confirmButton: 'my-confirm-button'
        },
        width: '520px'
    });

    if (confirmationResult.isConfirmed) {

        const { value: password } = await Swal.fire({
            title: 'Enter Password to Proceed',
            input: 'password',
            inputPlaceholder: 'Enter your administrative password',
            inputAttributes: {
                maxlength: '10',
                autocapitalize: 'off',
                autocorrect: 'off',
            },
            showCancelButton: true,
            customClass: {
                input: 'custom-input-class',
                cancelButton: 'custom-cancel-button-class'
            }
        });

        if (password) {
            console.log(userId,password);
            try {
                const response = await $.ajax({
                    type: 'POST',
                    url: '../operations/confirm_password_action.php',
                    data: { password: password, userId: userId },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            suspendAllStaff();
                        } else {
                            Swal.fire('Error', 'Incorrect Password!', 'error');
                        }
                    }
                });

            } catch (error) {
                Swal.fire({
                    title: 'Error',
                    text: 'An error occurred while checking the password.',
                    icon: 'error'
                });
            }
        }
    }
}

