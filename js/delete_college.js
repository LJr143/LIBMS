var collegeId;
var collegeName;
$(document).ready(function() {
    // Attach click event to delete buttons
    $('.deleteCollegeBtn').on('click', function(e) {
        e.preventDefault();
        collegeId = $(this).data('college-id');
        console.log(collegeId);

        // Get staff member's name for the confirmation message
        collegeName = $(this).data('college-name');

        // Call your delete function or AJAX request here with the adminId
        showDeleteConfirmation(collegeName);
    });
});

function deleteCollege(collegeId) {
    console.log(collegeId);

    $.ajax({
        url: '../operations/delete_college.php',
        type: 'POST',
        data: { college_id: collegeId,
                collegeName: collegeName,},
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
            console.error('Error Deleting college member.');
            alert('Error Deleting college member. Please try again.');
            location.reload();
        }
    });
}

function showDeleteConfirmation(collegeName) {
    Swal.fire({
        title: 'ARE YOU SURE?',
        html: 'Do you really want to delete the account for <strong><em>' + collegeName + '?</em></strong> This process cannot be undone.',
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
        },
    }).then((result) => {
        if (result.isConfirmed) {
            deleteCollege(collegeId);
        }
    });

}
