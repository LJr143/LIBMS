$(document).ready(function () {
    $('.suspend_student, .activate_student').on('click', function (e) {
        e.preventDefault();
        var userId = $(this).data('user-id');
        var studentMemberName = $(this).data('student-name');

        if ($(this).hasClass('suspend_student')) {
            showConfirmation('SUSPEND', 'suspended', userId, studentMemberName);
        } else {
            showConfirmation('ACTIVATE', 'activated', userId, studentMemberName);
        }
    });
});

function performAction(actionType, userId, studentMemberName) {
    $.ajax({
        url: `../operations/${actionType.toLowerCase()}_student.php`,
        type: 'POST',
        data: { user_id: userId, studentName: studentMemberName },
        dataType: 'json',
        success: function (response) {
            handleSuccess(response, actionType);
        },
        error: function () {
            handleError(actionType);
        }
    });
}

function handleSuccess(response, actionType) {
    console.log(response);

    Swal.fire({
        title: `${actionType.toUpperCase()}ED!`,
        text: `SUCCESSFULLY ${actionType.toUpperCase()}ED!`,
        icon: 'success',
        customClass: getSwalCustomClasses()
    }).then((result) => {
        if (result.isConfirmed) {
            location.reload();
        }
    });
}

function handleError(actionType) {
    console.error(`Error ${actionType.toLowerCase()}ing student member.`);
    alert(`Error ${actionType.toLowerCase()}ing student member. Please try again.`);
}

function showConfirmation(actionType, pastTense, userId, studentMemberName) {
    Swal.fire({
        title: `ARE YOU SURE?`,
        text: `Do you really want to ${actionType.toLowerCase()} ${studentMemberName}?`,
        icon: 'error',
        iconHtml: getSwalIconHtml(),
        showCancelButton: true,
        confirmButtonColor: '#711717',
        confirmButtonText: `${actionType.toUpperCase()}`,
        cancelButtonText: 'CANCEL',
        cancelButtonColor: '#e3e6e9',
        customClass: getSwalCustomClasses()
    }).then((result) => {
        if (result.isConfirmed) {
            performAction(actionType.toLowerCase(), userId, studentMemberName);
        }
    });
}

function getSwalIconHtml() {
    return '<div style="background-color: white; display: inline-block; padding: 20px; border-radius: 5px;">' +
        '<i class="bi bi-exclamation-triangle" style="font-size: 50px; color: #711717;"></i></div>';
}

function getSwalCustomClasses() {
    return {
        popup: 'my-swal-popup',
        content: 'my-swal-content',
        title: 'swal-title',
        cancelButton: 'my-cancel-button',
        confirmButton: 'my-confirm-button'
    };
}
