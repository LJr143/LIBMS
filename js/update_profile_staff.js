function updateProfileStaff() {
    var formData = new FormData();
    var profileFileInput = $('#profilePictureInput')[0];
    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }
    formData.append('first_name', $('#editStaffFirstName').val());
    formData.append('last_name', $('#editStaffLastName').val());
    formData.append('mi', $('#editStaffMI').val());
    formData.append('officeEmail', $('#editStaffEmail').val());
    formData.append('PhoneNumber', $('#editStaffPhoneNumber').val());
    formData.append('Telephone', $('#editStaffTelNumber').val());
    formData.append('Address', $('#editStaffAddress').val());
    formData.append('username', $('#editStaffUsername').val());
    formData.append('staffID', $('#userID').val());


    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }


    $.ajax({
        url: '../operations/update_staff_profile.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            try {
                var result = JSON.parse(response);
                if (result.success) {
                    $("#editStaffModal").modal("hide");
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


$('#submitBtn').click(function (event) {
    // Prevent the default form submission
    event.preventDefault();

    // // Enable HTML5 form validation
    // var form = document.getElementById('editStaffForm');
    // if (form.checkValidity() === false) {
    //     event.stopPropagation();
    // }
    //
    // form.classList.add('was-validated');
    //
    // // Check if the form is valid before calling updateStudent
    // if (form.checkValidity()) {
    //     // Disable the button to prevent multiple clicks
    //     $(this).prop('disabled', true);
        updateProfileStaff();
    // }
});