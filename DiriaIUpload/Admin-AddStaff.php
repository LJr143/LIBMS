    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    </head>


    <!--  css  -->
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300&family=Poppins&display=swap');

        *{
            font-family: 'inter' !important;
        }
        .ImportFile {
            padding: 20px;
        }

        .ImportFile input {
            width: 50%;
        }

        .AddImageContainer {
            position: relative;
            margin-top: 20px;
            width:70px;
            height:70px;
            border-radius: 50%;
            overflow: hidden;
        }

        .AddImageContainer i {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 50px;
            cursor: pointer;
        }

        .SI img {
            border-radius: 50%;
        }



        .SI input {
            display: none;
        }
        /* Hide "Choose File" button */
        #input-file{
            visibility: hidden !important;
        }
        .clear {
            padding: 3px 30px;
            color: #800000;
            border: 1px #800000 solid;
            font-size: 10px;
            border-radius: 5px;
            background-color: white;
            font-weight: bold;
            margin-right: 15px;

        }
        .add{

            background-color: #800000;
            padding: 3px 30px;
            color: white;
            border: none;
            font-size: 10px;
            border-radius: 5px;
        }
        .clear, .add:hover{
            opacity: 0.8;
            cursor: pointer;
        }

        @media only screen and (max-width: 767px) {
            .firstname{
                margin-top: 50px !important;
            }
        }


    </style>
    <!-- end css -->
    <body>
    <button id="addStudentBtn">
        ADD STAFF
    </button>

    <!-- Modal for admin ADD student details -->
    <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document" style="max-width: 600px;">
            <div class="modal-content">
                <div class="modal-header">

                    <p class="modal-title" id="borrowModalLabel " style="font-size: 16px; color: #800000; font-weight: 600;">
                        <i class="bi bi-pencil-square ml-3 m-3" style="font-size: 20px; color: #800000;"></i>ADD STAFF</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid " style="padding-left: 40px ; padding-right: 40px">
                        <div class="row">

                            <!-- uploading image -->
                            <form class="row  needs-validation"      novalidate>
                                <div class="col-md-2 " style="margin-bottom: -70px;">
                                    <div class="AddImageContainer">
                                        <i class="bi bi-plus-circle" title="Add Image" style="color: gray"></i>
                                        <img src="" width="100" height="100" id="Profile-Pic">
                                    </div>
                                    <input type="file" accept="image/jpeg, image/png, image/jpg" id="input-file"
                                           class="visually-hidden mb-0">
                                </div>






                                <div class="col-md-4 firstname">
                                    <label for="validationCustom01" class="form-label mb-0" style="font-size: 12px;">FIRST NAME</label>
                                    <input type="text" class="form-control" placeholder="Juan" id="validationCustom01" style="font-size: 10px; text-transform: capitalize !important;" required>

                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom02" class="form-label mb-0" style="font-size: 12px;">LAST NAME</label>
                                    <input type="text" class="form-control" placeholder="Dela Cruz" id="validationCustom02" style="font-size: 10px; text-transform: capitalize !important;" required>

                                </div>
                                <div class="col-md-2">
                                    <label for="validationCustom02" class="form-label mb-0" style="font-size: 12px;">M.I.</label>
                                    <input type="text" class="form-control mb-0" placeholder="I" id="validationCustom02" style="font-size: 10px; text-transform: capitalize !important;" required>
                                    <div class="invalid-feedback">
                                        Please type the middle initial .
                                    </div>
                                </div>

                                <div class="col-md-2"></div>



                                <div class="col-md-4 mt-2">
                                    <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;" >EMAIL ADDRESS</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control " id="validationCustomUsername"
                                               aria-describedby="inputGroupPrepend" placeholder="@usep.edu.ph" style="font-size: 10px;" required>

                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label for="validationCustom01" class="form-label mb-0" style="font-size: 12px;">PHONE NUMBER</label>
                                    <input type="number" class="form-control" id="validationCustom01" placeholder="091234567890" style="font-size: 10px;" required>

                                </div>

                                <div class="col-md-2 mt-0" >

                                </div>


                                <div class="col-md-10 mt-2" style="margin-left: 90px" >
                                    <label for="validationCustom03" class="form-label mb-0"  style="font-size: 12px; ">ADDRESS</label>
                                    <input type="text" class="form-control" id="validationCustom03" style="font-size: 10px; text-transform: capitalize !important;"  placeholder="Purok, Baranggay, City/Municipality, Province">

                                </div>

                                <div class="col-md-4 mt-3">
                                    <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;" >EMAIL ADDRESS</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control " id="validationCustomUsername"
                                               aria-describedby="inputGroupPrepend" placeholder="@usep.edu.ph" style="font-size: 10px;" required>

                                    </div>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;">USERNAME</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="juandlz" style="font-size: 10px;"
                                               required>

                                    </div>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label for="validationCustomUsername" class="form-label mb-0" style="font-size: 12px;">PASSWORD</label>
                                    <div class="input-group has-validation">
                                        <input type="password" class="form-control" placeholder="Password123." id="psw" style="font-size: 10px;"
                                               aria-describedby="inputGroupPrepend" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                               title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                               required>

                                    </div>
                                </div>



                        </div>
                        </form>

                        <div class=" wishlist-container  mt-4 mb-0 " style="margin-left: 270px">
                            <button type="button" class="clear shadow "   onclick="clearPhoto()">CLEAR</button>
                            <button type="button" class="add shadow" onclick="addStudent()">ADD</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            // Attach a click event to the "ADD STUDENT" button
            $("#addStudentBtn").click(function () {
                // Show the student modal
                $("#studentModal").modal("show");
            });

            // Handle the file input change event
            $("#input-file").change(function () {
                readURL(this);
            });

            // Handle click event on the Add Image icon
            $(".AddImageContainer i").click(function () {
                $("#input-file").click();
            });
        });

        // Function to display the selected image in the modal
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#Profile-Pic').attr('src', e.target.result);
                    $(".AddImageContainer i").hide();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Function to change the displayed photo
        function changePhoto() {
            $("#input-file").click();
        }

        // Function to clear the displayed photo
        function clearPhoto() {
            $('#Profile-Pic').attr('src', '');
            $(".AddImageContainer i").show();
        }

        // Function to handle adding a student (you can replace this with your actual logic)
        function addStudent() {
            // Add your logic here
            $("#studentModal").modal("hide");
        }
    </script>

</body>

</html>




