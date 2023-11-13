// Handle the logout button click event
$(document).ready(function() {
    $('#logoutButton').click(function(e) {
        // Prevent the default form submission
        e.preventDefault();

        // Display a confirmation dialog
        Swal.fire({
            title: 'LOGOUT?',
            text: 'You will be logged out!',
            icon: null,
            iconHtml: '<div style="background-color: white; padding: 31px; "><i class="bi bi-box-arrow-in-right" style="font-size: 60px; color: #711717; margin-left: -25px;"></i></div>',
            showCancelButton: true,
            cancelButtonColor: '#3085d6',
            confirmButtonColor: '#d33',
            cancelButtonText: 'CANCEL',
            confirmButtonText: 'LOGOUT'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log('Performing logout operation...');

                // Display a loading message
                Swal.fire({
                    title: 'Logging Out',
                    html: 'Please wait...',
                    timer: 2000,
                    timerProgressBar: true,
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        // Perform the logout operation after a delay
                        setTimeout(() => {
                            // Perform the logout operation
                            $.ajax({
                                url: '../operations/logout.php',
                                type: 'POST',
                                dataType: 'json',
                                success: function(logoutData) {
                                    if (logoutData.success) {
                                        // Upon successful logout, redirect to the login page
                                        console.log('Logout successful. Redirecting to login page...');
                                        window.location.href = '../index_admin.php';
                                    }
                                },
                                error: function() {
                                    // Display an error message if the logout operation fails
                                    console.error('Logout failed. Please try again.');
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Logout failed. Please try again.',
                                        icon: 'error'
                                    });
                                }
                            });
                        }, 2000); // 2000 milliseconds (2 seconds) delay
                    }
                });
            }
        });
    });
});
