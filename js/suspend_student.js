var userId;
var studentMemberName;
$(document).ready(function() {
    // Attach click event to delete buttons
    $('.suspend_student').on('click', function(e) {
        e.preventDefault();
        userId = $(this).data('user-id');

        // Get student member's name for the confirmation message
        studentMemberName = $(this).data('student-name');

        // Call your delete function or AJAX request here with the userId
        showSuspendConfirmation(studentMemberName);
    });

    $('.activate_student').on('click', function(e) {
        e.preventDefault();
        userId = $(this).data('user-id');

        // Get student member's name for the confirmation message
        studentMemberName = $(this).data('student-name');

        // Call your delete function or AJAX request here with the userId
        showActivateConfirmation(studentMemberName);
    });
});

function suspendstudent(userId) {
    console.log(userId);

    $.ajax({
        url: '../operations/suspend_student.php',
        type: 'POST',
        data: { user_id: userId,
            studentName: studentMemberName,},
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
            console.error('Error suspending student member.');
            alert('Error suspending student member. Please try again.');
        }
    });
}

function activatestudent(userId) {
    console.log(userId);

    $.ajax({
        url: '../operations/activate_student.php',
        type: 'POST',
        data: { user_id: userId,
            studentName: studentMemberName,},
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
            console.error('Error activating student member.');
            alert('Error activating student member. Please try again.');
        }
    });
}

function showSuspendConfirmation(studentMemberName) {
    Swal.fire({
        title: 'ARE YOU SURE?',
        text: 'Do you really want to suspend ' + studentMemberName + '?',
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
            suspendstudent(userId);

        }
    });
}
function showActivateConfirmation(studentMemberName) {
    Swal.fire({
        title: 'ARE YOU SURE?',
        text: 'Do you really want to Activate ' + studentMemberName + '?',
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
            activatestudent(userId);

        }
    });
}