function updateStudent() {
    var formData = new FormData();
    var profileFileInput = $('#profilePictureInput')[0];
    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }
    formData.append('first_name', $('#editStudentFname').val());
    formData.append('last_name', $('#editStudentLname').val());
    formData.append('mi', $('#editStudentInitial').val());
    formData.append('studentID', $('#editStudentID').val());
    formData.append('personalEmail', $('#editStudentEmail').val());
    formData.append('phoneNumber', $('#editStudentNumber').val());
    formData.append('address', $('#editStudentAddress').val());
    formData.append('year', $('#editStudentYear').val());
    formData.append('course', $('#editStudentCourse').val());
    formData.append('major', $('#editStudentMajor').val());
    formData.append('usepEmail', $('#editStudentUsepEmail').val());
    formData.append('username', $('#editStudentUsername').val());
    formData.append('password', $('#editpsw').val());

    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    $.ajax({
        url: '../operations/update_student.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            try {
                var result = JSON.parse(response);
                if (result.success) {
                    $("#staffModal").modal("hide");
                    Swal.fire({
                        title: 'UPDATED!',
                        text: 'SUCCESSFULLY UPDATED!',
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

                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to delete the student. Please try again.',
                        icon: 'error'
                    });
                }
            } catch (e) {
                console.error('Failed to parse JSON response:', response);
            }
        },
        error: function () {
            alert('AJAX request failed.');
        }
    });
}

// Attach the updateStudent function to the Save button click event
$('#saveButton').click(function() {
    // Disable the button to prevent multiple clicks
    $(this).prop('disabled', true);
    updateStudent();
});