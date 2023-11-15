var adminId;
var staffMemberName;
$(document).ready(function() {
    // Attach click event to delete buttons
    $('.deleteStudent').on('click', function(e) {
        e.preventDefault();
        adminId = $(this).data('admin-id');

        // Get staff member's name for the confirmation message
        staffMemberName = $(this).data('staff-name');

        // Call your delete function or AJAX request here with the adminId
        showDeleteConfirmation(staffMemberName);
    });
});

function deleteStudent(adminId) {
    console.log(adminId);

    $.ajax({
        url: '../operations/delete_staff.php',
        type: 'POST',
        data: { admin_id: adminId,
                staffName: staffMemberName,},
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // Handle the response, e.g., update the UI or remove the row from the table
            alert('Staff member deleted successfully!');
            location.reload();
        },
        error: function() {
            console.error('Error deleting staff member.');
            alert('Error deleting staff member. Please try again.');
        }
    });
}

function showDeleteConfirmation(staffMemberName) {
    Swal.fire({
        title: 'ARE YOU SURE?',
        text: 'Do you really want to delete the account for ' + staffMemberName + '? This process cannot be undone.',
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
            deleteStudent(adminId);
        }
    });
}
