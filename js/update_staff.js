function updateStudent() {
    var formData = new FormData();
    var profileFileInput = $('#profilePictureInput')[0];
    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }
    formData.append('first_name', $('#EditStaffFname').val());
    formData.append('last_name', $('#EditStaffLname').val());
    formData.append('mi', $('#EditStaffInitial').val());
    formData.append('staffID', $('#EditStaffID').val());
    formData.append('officeEmail', $('#EditStaffOemail').val());
    formData.append('PhoneNumber', $('#EditStaffPnumber').val());
    formData.append('Telephone', $('#EditStaffTnumber').val());
    formData.append('Address', $('#EditStaffAddress').val());
    formData.append('role', $('#EditStaffRole').val());
    formData.append('personalEmail', $('#EditStaffPemail').val());
    formData.append('username', $('#EditStaffUsername').val());
    formData.append('password', $('#Editpsw').val());

    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    $.ajax({
        url: '../operations/update_staff.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            try {
                var result = JSON.parse(response);
                if (result.success) {
                    $("#editStudentModal").modal("hide");
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
$('#saveButton').click(function (event) {
    // Prevent the default form submission
    event.preventDefault();

    // Enable HTML5 form validation
    var form = document.getElementById('editStudentForm');
    if (form.checkValidity() === false) {
        event.stopPropagation();
    }

    form.classList.add('was-validated');

    // Check if the form is valid before calling updateStudent
    if (form.checkValidity()) {
        // Disable the button to prevent multiple clicks
        $(this).prop('disabled', true);
        updateStudent();
    }
});
