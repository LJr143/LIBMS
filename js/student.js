    //for add student input validation

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
    }

        form.classList.add('was-validated')
    }, false)
    })
    })()



        // Get the password input element
        var passwordInput = document.getElementById("addStudentPassword");

        // Add an event listener to the input to check the password requirements
        passwordInput.addEventListener("input", function () {
        // Get the invalid feedback element
        var passwordRequirements = document.getElementById("passwordRequirements");

        // Check if the password meets the requirements
        if (passwordInput.checkValidity()) {
        passwordRequirements.style.display = "none"; // Hide the requirements message
    } else {
        passwordRequirements.style.display = "block"; // Show the requirements message
    }
    });


        //reset form when clear button click
        function clearPhoto() {
        // Reset form fields
        var form = document.querySelector('.needs-validation');
        form.reset();

        // Reset form validation state
        form.classList.remove('was-validated');

        // Reset the password requirements message
        var passwordRequirements = document.getElementById("passwordRequirements");
        passwordRequirements.style.display = "none";
    }


