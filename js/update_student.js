function updateStudent() {
    var formData = new FormData();
    var profileFileInput = $('#profilePictureInput')[0];
    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }
    formData.append('first_name', $('#EditStudentFname').val());
    formData.append('last_name', $('#EditStudentLname').val());
    formData.append('mi', $('#EditStudentInitial').val());
    formData.append('StudentID', $('#EditStudentID').val());
    formData.append('officeEmail', $('#EditStudentOemail').val());
    formData.append('PhoneNumber', $('#EditStudentPnumber').val());
    formData.append('Telephone', $('#EditStudentTnumber').val());
    formData.append('Address', $('#EditStudentAddress').val());
    formData.append('role', $('#EditStudentRole').val());
    formData.append('personalEmail', $('#EditStudentPemail').val());
    formData.append('username', $('#EditStudentUsername').val());
    formData.append('password', $('#Editpsw').val());

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