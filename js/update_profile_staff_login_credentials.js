    function updateLoginCredentialsStaff() {
    var formData = new FormData();
    formData.append('staffId', $('#userID').val());
    formData.append('oldPassword', $('#change_password_old_pass').val());
    formData.append('newPassword', $('#change_password_new_pass').val());
    formData.append('confirmPassword', $('#change_password_confirm_new_pass').val());


    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }


    $.ajax({
        url: '../operations/update_staff_profile_login_credentials.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            try {
                var result = JSON.parse(response);
                if (result.success) {
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
                        text: 'Failed to Update Password. Please try again.',
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


$('#btnChangePass').click(function (event) {
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
    updateLoginCredentialsStaff();
    // }
});