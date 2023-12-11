$(document).ready(function () {

    $(".editCourseBtn").click(function() {
        // Show the student modal
        $("#editCourseModal").modal("show");

        // Get the course_id from the data attribute
        var courseId = $(this).data('course-id');
        console.log(courseId);
        // Make an AJAX request to fetch Book data
        $.ajax({
            url: '../operations/fetch_course.php', // Replace with your backend endpoint
            type: 'POST',
            data: {
                courseId: courseId,
            },
            dataType: 'json',
            success: function(response) {
                // Log the response to inspect the structure
                console.log(response);

                // Handle the response and populate your modal with data
                populateModal(response);
            },
            error: function() {
                // Handle errors
                console.error('Error fetching course data.');
            }
        });
        // Fetch course options
        fetchCollegeOptions();

        $("#addCllgBtn").click(function (e){
            e.preventDefault(); // Prevent the default form submission

            addCourse();
        });

    });
});

$('.editCourseBtn').click(function(e) {
    $("#editCourseModal").modal("show");
    e.preventDefault();

});


function populateModal(data) {
    // Log the data to inspect the structure
    console.log(data);

    // Populate the modal fields with data received from the server
    $('#editCollegeId').val(data[0].college_id);
    $('#editCollegeName').val(data[0].college_name);

}


function updateCourse() {
    // Validate the form fields before proceeding
    if (!validateUpdateForm()) {
        return; // Exit if validation fails
    }

    // Prepare form data for update
    var formData = prepareUpdateFormData();

    // AJAX request for update_book.php
    $.ajax({
        url: '../operations/update_college.php',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            handleAjaxUpdateSuccess(response);
        },
        error: function () {
            handleAjaxError();
        }
    });
}
function fetchCollegeOptions() {
    $.ajax({
        url: '../operations/fetch_college_options.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Log the response to inspect the structure
            console.log(response);

            // Populate the select options
            populateCollegeOptions(response);
        },
        error: function() {
            // Handle errors
            console.error('Error fetching College options.');
        }
    });
}
function populateCollegeOptions(data) {
    // Log the data to inspect the structure
    console.log(data);

    // Get the select element
    var selectElement = $('#editCollege');

    // Clear existing options
    selectElement.empty();

    // Add a default option
    selectElement.append('<option value="" disabled selected>Select College</option>');

    // Add options based on the fetched data
    data.forEach(function(college) {
        selectElement.append('<option value="' + college.college_id + '">' + college.college_name + '</option>');
    });
}

function validateUpdateForm() {
    // Trigger form validation manually
    var form = $('#editCourseModal')[0];
    form.classList.add('was-validated');

    // Add validation logic for each required field in the update form
    var requiredFields = [
        '#editCollege',
        '#editCourse',
    ];

    for (var i = 0; i < requiredFields.length; i++) {
        var fieldId = requiredFields[i];
        var field = $(fieldId);

        if (field.length === 0) {
            console.error('Field not found with ID:', fieldId);
            continue; // Skip to the next iteration if the field is not found
        }

        if (field.val().trim() === '') {
            showValidationError('Please fill in all required fields.');
            return false; // Validation failed
        }
    }


    return true; // Validation succeeded
}



function prepareUpdateFormData()     {
    var formData = new FormData();

    // Append form data for update_book
    formData.append('editCollege', $('#editCollege').val());
    formData.append('editCourse', $('#editCourse').val());
    formData.append('editMajor', $('#editMajor').val());


    return formData;
}


function handleAjaxUpdateSuccess(response) {
    console.log(response); // Log the response for debugging

    try {
        var result = typeof response === 'string' ? JSON.parse(response) : response;
        if (result.success) {
            handleSuccessConfirmation('editCollegeModal');
        } else {
            showError('Failed to update the college. Please try again.');
        }
    } catch (e) {
        console.error('Failed to parse JSON response:', response);
        showError('Failed to process the server response.');
    }
}


