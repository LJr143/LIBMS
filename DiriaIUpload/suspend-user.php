<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
  
</head>
 <!--  css  -->
 <style>
   @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300&family=Poppins&display=swap');
        
        *{
            font-family: 'inter' !important;
        }
        .custom-btn {
    padding: 0;
    /* Remove default padding */
  }
  
  .custom-btn .imgmng {
    width: 20px;
    /* Set the desired width */
    height: auto;
    /* Maintain aspect ratio */
  }
  
  .imgmngline {
    max-width: 10%;
  
  }
  .my-swal-popup {
    width: 330px;
    height: 300px;
    background-color: #ffffff;
  }
  

  
  /* Custom CSS for the title text */
  .my-swal-popup .swal-title {
    color: #711717;
    font-size: 14px;
  }

  
  .my-swal-popup  .my-swal-content {
    font-weight: 600;
    color: black;
    font-size: 12px;
  }

  .my-swal-popup .swal-cancel-button{
   background-color: #dfdfdf !important;
    color: #711717 !important;
    font-size: 13px !important;
}
.my-swal-popup .swal-confirm-button{
    background-color: #711717;
    color: #ffffff;
    font-size: 13px !important;
}

  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300&family=Poppins&display=swap');
        </style>
  <body>
    <a href="#" class="btn custom-btn" id="suspendUser"> <img class="imgmng" src="../icons/exclamation-octagon.svg" alt="Image Button"> </a>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="../../script/bootstrap.bundle.min.js"></script>
<script src="../../script/jquery-3.5.1.js"></script>
<script>
  document.getElementById('suspendUser').addEventListener('click', function () {
    showSuspendConfirmation(1); // Pass a unique identifier
});

function showSuspendConfirmation(id) {
    Swal.fire({
        title: 'ARE YOU SURE?',
        text: 'Do you really want to suspend this / these student?',
        icon: null,
        iconHtml: '<div style="background-color: white; padding: 30px;"><i class="bi bi-exclamation-triangle fill="rgb(113, 23, 23)" "></i></div>',
        showCancelButton: true,
        cancelButtonText: 'CANCEL',
        confirmButtonText: 'SUSPEND',
        confirmButtonColor: '#711717'
        ,
        customClass: {
            popup: 'my-swal-popup',
            content: 'my-swal-content',
            title: 'swal-title',
            cancelButton: 'swal-cancel-button',
            confirmButton: 'swal-confirm-button',
        }
    }).then((result) => {
        if (result.isConfirmed) {

            // If the user confirms, you can proceed with the deletion logic here

            Swal.fire('Suspended!', 'The account has been suspended.', 'success');
        }
    });
};
</script>