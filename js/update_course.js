
$(document).ready(function () {
    var courseId;

    // Fetch college options
    fetchCollegeOptions();

    function fetchCollegeOptions() {
        $.ajax({
            url: '../operations/fetch_college_options.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                // Populate the select options
                populateCollegeOptions(response);
            },
            error: function () {
                // Handle errors
                console.error('Error fetching College options.');
            }
        });
    }

    function populateCollegeOptions(data) {
        // Get the select element
        var selectElement = $('#addSelectCollege');

        // Clear existing options
        selectElement.empty();

        // Add a default option
        selectElement.append('<option value="" disabled selected>Select College</option>');

        // Add options based on the fetched data
        data.forEach(function (college) {
            selectElement.append('<option value="' + college.college_id + '">' + college.college_name + '</option>');
        });
    }



    $(".editCourseBtn").click(function() {
        // Show the student modal
        $("#editCourseModal").modal("show");

        // Fetch course options
        fetchCollegeOptionsEdit();

        // Get the course_id from the data attribute
         courseId = $(this).data('course-id');
         var collegeId = $(this).data('college-id');

         console.log(courseId,collegeId);
        // Make an AJAX request to fetch course data
        $.ajax({
            url: '../operations/fetch_course.php',
            type: 'POST',
            data: {
                courseId: courseId,
                collegeId: collegeId,
            },
            dataType: 'json',
            success: function(response) {
                // Log the response to inspect the structure

                // Handle the response and populate your modal with data
                populateModal(response);
            },
            error: function() {
                // Handle errors
                console.error('Error fetching course data.');
            }
        });

    });
    // Bind the click event for #addCrseBtn
    $("#saveCourseBtnEdit").click(function (e) {
        console.log('clicked!');
        e.preventDefault(); // Prevent the default form submission

        updateCourse(courseId);  // Pass the courseId to updateCourse
    });
});

function populateModal(data) {

    // Populate the modal fields with data received from the server
    $('#editStudentCollege').val(data[0].college_id);
    $('#editCourse').val(data[0].course_name);
    $('#editMajor').val(data[0].course_major);
}

function updateCourse(courseId) {
    // Validate the form fields before proceeding
    if (!validateUpdateForm()) {
        return; // Exit if validation fails
    }

    // Prepare form data for update
    var formData = prepareUpdateFormData(courseId);

    // AJAX request for update_course.php
    $.ajax({
        url: '../operations/update_course.php',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: handleAjaxUpdateSuccess,
        error: handleAjaxError
    });
}

function fetchCollegeOptionsEdit() {
    $.ajax({
        url: '../operations/fetch_college_options.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {

            // Populate the select options
            populateCollegeOptionsEdit(response);
        },
        error: function() {
            // Handle errors
            console.error('Error fetching College options.');
        }
    });
}
function populateCollegeOptionsEdit(data) {
    // Log the data to inspect the structure

    // Get the select element
    var selectElement = $('#editStudentCollege');

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
    var validations = {
        '#editStudentCollege': {
            required: true,
            fieldName: 'College'
        },
        '#editCourse': {
            required: true,
            pattern: /^([A-Za-z]+\s*)+$/,
            fieldName: 'Course Name'
        },
        '#editMajor': {
            required: true,
            pattern: /^([A-Za-z]+\s*)+$/,
            fieldName: 'Course Major'
        }
    };

    for (var fieldId in validations) {
        var field = $(fieldId);
        var validation = validations[fieldId];

        if (!field.length) {
            console.error('Field not found:', fieldId);
            continue; // Skip to the next field if not found
        }

        if (validation.required && (field.val() === null || field.val().trim() === '')) {
            showValidationError(validation.fieldName + ' is required.');
            return false; // Validation failed
        }

        if (validation.pattern && !validation.pattern.test(field.val())) {
            var errorMessage = getCustomEditCourseErrorMessage(fieldId);
            showValidationError(errorMessage);
            return false; // Validation failed
        }
    }

    return true; // Validation succeeded
}


function getCustomEditCourseErrorMessage(fieldId) {
    switch (fieldId) {
        case '#editStudentCollege':
            return 'Please select a college.';
        case '#editCourse':
            return 'Invalid Course Name. It should only contain letters.';
        case '#editMajor':
            return 'Invalid Course Major. It should only contain letters.';
        default:
            return 'Invalid input for ' + $(fieldId).attr('placeholder') + '.';
    }
}

    function prepareUpdateFormData(courseId) {
    var formData = new FormData();
    // Append form data for update_course.php
    formData.append('courseId', courseId);  // Include courseId in the form data
    formData.append('editCollege', $('#editStudentCollege').val());
    formData.append('editCourse', $('#editCourse').val());
    formData.append('editMajor', $('#editMajor').val());

    return formData;
}
function handleAjaxUpdateSuccess(response) {
    try {
        var result = typeof response === 'string' ? JSON.parse(response) : response;
        if (result.success) {
            handleSuccessConfirmation('editCourseModal');
        } else {
            showError('Failed to update the course. Please try again.');
        }
    } catch (e) {
        console.error('Failed to parse JSON response:', response);
        showError('Failed to process the server response.');
    }
}
function handleAjaxError() {
    showError('AJAX request failed.');
}
function showError(message) {
    Swal.fire({
        title: 'Error!',
        text: message,
        icon: 'error'
    });
}
function showValidationError(message) {
    showError(message);
}
function handleSuccessConfirmation(modalId) {
    $("#" + modalId).modal("hide");
    var successTitle = 'UPDATED!';
    var successText = 'SUCCESSFULLY UPDATED!';
    Swal.fire({
        title: successTitle,
        text: successText,
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
            // Reload the page after a short delay
            setTimeout(function() {
                location.reload();
            }, 0);
        }
    });
}
