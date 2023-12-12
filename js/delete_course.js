var courseId;
var courseName;
$(document).ready(function() {
    // Attach click event to delete buttons
    $('.deleteCourseBtn').on('click', function(e) {
        e.preventDefault();
        courseId = $(this).data('course-id');
        console.log(courseId);

        // Get staff member's name for the confirmation message
        courseName = $(this).data('course-name');

        // Call your delete function or AJAX request here with the adminId
        showDeleteConfirmation(courseName);
    });
});

function deleteCourse(courseId) {
    console.log(courseId);

    $.ajax({
        url: '../operations/delete_course.php',
        type: 'POST',
        data: { course_id: courseId,
                courseName: courseName,},
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
            console.error('Error Deleting course member.');
            alert('Error Deleting course member. Please try again.');
            location.reload();
        }
    });
}

function showDeleteConfirmation(courseName) {
    Swal.fire({
        title: 'ARE YOU SURE?',
        html: 'Do you really want to delete the course <strong><em>' + courseName + '?</em></strong> This process cannot be undone.',
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
            deleteCourse(courseId);
        }
    });

}
