
function addStudent() {
    var formData = new FormData();
    var profileFileInput = $('#addStudentinput-file')[0];
    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }
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

    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    $.ajax({
        url: '../operations/add_student.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
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
                            setTimeout(function () {
                                // Reload the page
                                location.reload();
                            }, 2000);
                        }
                    });

                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to Add the student. Please try again.',
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