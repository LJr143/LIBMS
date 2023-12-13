<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_transaction_data.php';

$database = new Database();
$transactionData = new TransactionData($database);

$transaction = $transactionData->getPendingTransaction();
$pendingTransaction = $transactionData->getPendingTransactionCount();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="mr-3" style="margin-left: 40px;">
    <a href="#" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-bell" style="font-size: 20px; color: #4d0202;"></i>
        <span style="position:absolute; font-size: 8px;" id="notificationCounter" class="badge bg-danger"><?= $pendingTransaction ?></span>

    </a>
    <div class="dropdown-menu" aria-labelledby="notificationDropdown" style="padding: 25px; font-size: 13px; background-color: white;">
        <div style="margin-bottom: 15px; background-color: white; width: 520px; box-shadow: 2px 4px 6px rgba(82,21,21,0.2); padding: 5px;">
            <span style="font-size: 12px;"><b>TRANSACTION REQUEST</b></span>
        </div>
        <ul id="notificationList" class="list-unstyled">
            <?php foreach ($transaction as $transact) : ?>
                <li>
                    <div class="d-flex justify-content-between align-items-center" style=" background-color: #F8F8FF; padding: 10px; height: 35px; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); margin-bottom: 8px;">
                        <span style="text-transform: capitalize;"><?= $transact['fname'] . " ". $transact['initial'] . "." . " " . $transact['lname']  ?> has requested to <?= $transact['transaction_type'] ?> a book</span>
                        <div class="btn-group ms-4">
                            <!-- Information button -->
                            <button type="button" class="btn custom-btn transaction_modal" data-transaction-id="<?php echo $transact['id'];?>">
                                <i class="bi bi-info-circle" style="color: blue; font-size: 20px;"></i>
                            </button>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>


<div class="modal fade" id="infoModal1" tabindex="-1" aria-labelledby="infoModal1Label" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header" style="height: 15px;">

                <p class="modal-title" id="borrowModalLabel " style="font-size: 12px; color: #800000; font-weight: 600;">
                    <i class="bi bi-info-circle" style="color:#800000; font-size: 17px; margin-right: 10px;"></i>TRANSACTION DETAILS
                </p>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="background-color: transparent; border:none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style=" margin-left: 20px;">
                <!-- User Information -->
                <div class="row" style="font-size: 12px;">
                    <div class="col-md-5">
                        <p style="font-size: 10px; font-weight: 600;">Student ID: <span id="userId"></span></p>
                        <p style="font-size: 10px; font-weight: 600;">Name: <span id="userName"></span></p>
                        <p style="font-size: 10px; font-weight: 600;">Course: <span id="userCourse"></span></p>
                    </div>
                    <div class="col-md-5">
                        <p style="font-size: 10px; font-weight: 600;">Year: <span id="userYear"></span></p>
                        <p style="font-size: 10px; font-weight: 600;">Major: <span id="userMajor"></span></p>
                    </div>
                </div>

                <!-- Book Information -->
                <div class="row" style="font-size: 12px;">

                    <div class="col-md-2">
                        <!-- Book Image -->
                        <img id="bookImage" alt="Book Image" class="img-fluid" style="max-height: 160px; max-width: 100%;">
                    </div>

                    <div class="col-md-5">
                        <p style="font-size: 10px; font-weight: 600;">Book Title: <span id="bookTitle"></span></p>
                        <p style="font-size: 10px; font-weight: 600;">Author: <span id="author"></span></p>
                        <p style="font-size: 10px; font-weight: 600;">Borrow date: <span id="borrowDate"></span></p>
                    </div>

                    <div class="col-md-5">
                        <p style="font-size: 10px; font-weight: 600;">Shelf: <span id="shelf"></span></p>
                        <p style="font-size: 10px; font-weight: 600;">Publisher: <span id="publisher"></span></p>
                        <p style="font-size: 10px; font-weight: 600;">Due Date: <span id="dueDate"></span></p>
                    </div>
                </div>
                <!-- Buttons -->
                <button style="margin-left: 60%; background-color:white; font-weight: bold; border-color:#4d0202; color:#4d0202; height: 30px; font-size:12px; width: 110px;" type="button" class="btn rejectRequest" id="rejectRequest">REJECT</button>
                <button style="margin-left: 10px; background-color:#740000; color:#fff; height: 30px; font-size:12px; width: 110px;" type="button" class="btn approveRequest" id="approveRequest">APPROVE</button>
            </div>

        </div>
    </div>
</div>


</body>
</html>


