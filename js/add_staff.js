function addStaff() {
    var formData = new FormData();
    var profileFileInput = $('#addStaffinput-file')[0];
    if (profileFileInput.files.length > 0) {
        formData.append('profile', profileFileInput.files[0]);
    }
    formData.append('first_name', $('#addStaffFname').val());
    formData.append('last_name', $('#addStaffLname').val());
    formData.append('mi', $('#addStaffInitial').val());
    formData.append('staffID', $('#addStaffID').val());
    formData.append('officeEmail', $('#addStaffOemail').val());
    formData.append('PhoneNumber', $('#addStaffPnumber').val());
    formData.append('Telephone', $('#addStaffTnumber').val());
    formData.append('address', $('#addStaffAddress').val());
    formData.append('role', $('#addStaffRole').val());
    formData.append('personalEmail', $('#addStaffPemail').val());
    formData.append('username', $('#addStaffUsername').val());
    formData.append('password', $('#psw').val());

    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    $.ajax({
        url: '../operations/add_staff.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            try {
                var result = JSON.parse(response);
                if (result.success) {
                    alert('Staff member added successfully!');
                    location.reload();
                } else {
                    alert('Failed to add staff member: ' + result.error);
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