var userId;
var studentMemberName;
$(document).ready(function() {
    // Attach click event to delete buttons
    $('.deleteStudent').on('click', function(e) {
        e.preventDefault();
        userId = $(this).data('user-id');

        // Get staff member's name for the confirmation message
        studentMemberName = $(this).data('student-name');

        // Call your delete function or AJAX request here with the adminId
        showDeleteConfirmation(studentMemberName);
    });
});

function deleteStudent(userId) {
    console.log(userId);

    $.ajax({
        url: '../operations/delete_student.php',
        type: 'POST',
        data: { user_id: userId,
                studentName: studentMemberName,},
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // Handle the response, e.g., update the UI or remove the row from the table
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
        },
        error: function() {
            console.error('Error Deleting student member.');
            alert('Error Deleting student member. Please try again.');
            location.reload();
        }
    });
}

function showDeleteConfirmation(studentMemberName) {
    Swal.fire({
        title: 'ARE YOU SURE?',
        text: 'Do you really want to delete the account for ' + studentMemberName + '? This process cannot be undone.',
        icon: 'error', // Set the icon as 'error'
        iconHtml: '<div style="background-color: white; display: inline-block; padding: 20px; border-radius: 5px;"><i class="bi bi-trash3-fill" style="font-size: 50px; color: #711717;"></i></div>',
        showCancelButton: true,
        confirmButtonColor: '#711717',
        confirmButtonText: 'DELETE',
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
            deleteStudent(userId);

        }
    });
}
