
    function clearForm() {
    // Assuming you have assigned an id to your form (e.g., 'AddStudentModal')
    var form = document.getElementById('AddStudentModal');

    // Iterate through form elements and reset their values
    var elements = form.elements;
    for (var i = 0; i < elements.length; i++) {
    var element = elements[i];

    // Check if the element is an input field, textarea, or select
    if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA' || element.tagName === 'SELECT') {
    element.value = '';
}
}

    // Reset the file input (this is a workaround, creating a new input element and replacing the old one)
    var fileInput = document.getElementById('addStudentinput-file');
    var newFileInput = fileInput.cloneNode(true);
    fileInput.parentNode.replaceChild(newFileInput, fileInput);

    // Manually remove the 'was-validated' class to clear validation styles
    form.classList.remove('was-validated');
}
