function updateStaff() {
    var formData = new FormData();
    var profileFileInput = $('#EditprofilePictureInput')[0];
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

$('#saveButton').click(function (event) {

        updateStaff();
});