$(document).ready(function() {
    // Add click event listener to the "ADD" button
    $('#addStdntBtn').on('click', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Call the addStudent function when the button is clicked
        addStudent();
    });
});

function addStudent() {
    var formData = new FormData();
    var profileFileInput = $('#addStudentinput-file')[0]; // Consistent naming
    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }

    // Append form data
    formData.append('first_name', $('#addStudentFirstName').val());
    formData.append('last_name', $('#addStudentLastName').val());
    formData.append('mi', $('#addStudentMI').val());
    formData.append('studentID', $('#addStudentStudID').val());
    formData.append('personalEmail', $('#addStudentPersonalEmail').val());
    formData.append('phoneNumber', $('#addStudentPhoneNumber').val());
    formData.append('address', $('#addStudentAddress').val());
    formData.append('year', $('#addStudentSectionYear').val());
    formData.append('course', $('#addStudentCourse').val());
    formData.append('major', $('#addStudentMajor').val());
    formData.append('usepEmail', $('#addStudentUsepEmail').val());
    formData.append('username', $('#addStudentUsername').val());
    formData.append('password', $('#addStudentPassword').val());

    // AJAX request
    $.ajax({
        url: '../operations/add_student.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            try {
                var result = typeof response === 'string' ? JSON.parse(response) : response;
                if (result.success) {
                    $("#StudentModal").modal("hide");
                    Swal.fire({
                        title: 'ADDED!',
                        text: 'SUCCESSFULLY ADDED!',
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
                            // Reload the page after a short delay
                            setTimeout(function() {
                                location.reload();
                            });
                        }
                    });

                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to add the student. Please try again.',
                        icon: 'error'
                    });
                }
            } catch (e) {
                console.error('Failed to parse JSON response:', response);
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to process the server response.',
                    icon: 'error'
                });
            }
        },
        error: function() {
            alert('AJAX request failed.'); // Consider improving the user experience
        }
    });
}
