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
                    alert('Staff member Edited successfully!');
                    location.reload();
                } else {
                    alert('Failed to Edit staff member: ' + result.error);
                    location.reload();
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