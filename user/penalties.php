<?php
session_start();
require_once '../db_config/config.php';
include '../operations/authentication.php';
include '../includes/fetch_user_data.php';
include '../includes/fetch_books_data.php';
include '../includes/fetch_student_data.php';
include '../includes/fetch_transaction_data.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$database = new Database();
$userAuth = new UserAuthentication($database);
$bookData = new BookData($database);
$userData = new StudentData($database);
$transactionData = new TransactionData($database);


$book = $bookData->getAllBook();

if($userAuth->isAuthenticated()){

} else {
    header('Location: ../index.php');
}
if (isset($_POST['logout'])) {
    $userAuth->logout();
    header('Location: ../index.php');
    exit();
}

if (isset($_SESSION['user'])) {
    $userUsername = $_SESSION['user'];

    $userID = $userData->getStudentIdByUsername($userUsername);
    if (!empty($userID)) {
        $user = $userData->getStudentById($userID);

        if (!empty($user)) {
            $loggedUser = $user[0];
            $userID = $loggedUser['user_id'];
        } else {
            echo 'Admin data not found.';
        }
    } else {
        echo 'Invalid admin ID.';
    }

}
$transaction = $transactionData->getTransactionByUser($userID);
$getAllTransaction = $transactionData->getAllTransactionByUser($userID);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USeP | LMS</title>
    <link rel="icon" href="../icons/usep-logo.png">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../node_modules/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/user_penalties.css">
    <style>
            /* style for feedback modal */
        .rating {
            display: flex;
            align-items: center;
            gap: 20px;
            /* Adjust this value for spacing between stars within a group */
            height: 30px;

        }
        swiper-container {
            width: 100%;
            height: 55vh;
        }

        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div style=" width: 100%; overflow-x: hidden">
    <?php include 'header.php'?>
    <div class="user-nav text-white">
        <ul class="nav justify-content-center align-items-center align-content-center" style="width: 100%">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="home.php">BOOKS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="wishlist.php">WISHLIST</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="penalties.php">TRANSACTION</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="credit_score.php"  >CREDIT SCORE</a>
            </li>
        </ul>
    </div>
    <div class="main-content">
        <div class="container-fluid">
            <p class="text-main"">HOME</p>
        </div>
        <div class="row search-by">
            <div class="dropdown col-md-4">
                <select name="" id="select-book-category">
                    <option value="Search Categories">Search Categories</option>
                    <option value="Environment and Forestry">Environment and Forestry</option>
                    <option value="Agriculture and Agriculture Engineering">Agriculture and Agriculture Engineering</option>
                    <option value="Usepiana">Usepiana</option>
                    <option value="General Information">General Information</option>
                    <option value="Filipiñiana">Filipiñiana </option>
                    <option value="Educational">Educational</option>
                    <option value="Video Tapes"> Video Tapes</option>
                    <option value="Special Education"> Special Education</option>
                    <option value="Overall">Overall</option>
                </select>

            </div>

            <div class="search-input col-md-8 d-flex">
                <input class="form-control me-2" type="search" placeholder="Search Books" aria-label="Search" autocomplete="off">
                <button>Search</button>
            </div>

        </div>
            <div class="container mt-4 card " style="min-height: 65vh; max-height: 100vh; width: 100%">
                <div style=" margin-top: 10px">
                    <p style="font-size: 12px; font-weight: bold; font-style: italic">Books Recently Borrowed</p>
                    <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" space-between="30"
                                      slides-per-view="3">
                        <?php foreach ($transaction as $transact) { ?>
                                <swiper-slide class="mt-2">

                                <div class="custom_book_container d-flex flex-column align-items-center justify-content-center swiper-slide">

                                        <img src="../book_img/<?php echo $transact['book_img'];?>" alt="" class="custom-book-img">
                                    <div style="width: 100%; height: 30px; margin-top: 10px;" class="d-flex align-items-center  flex-column">
                                        <p style="font-size: 12px; text-align: center" class="custom-book-text"><?php echo $transact['book_title'] ?></p>
                                        <p style="margin-top: -20px; font-size: 8px;" class="custom-book-text"><?php echo $transact['author']?></p>
                                    </div>
                                    <div style="width: 100%; margin-top: 10px;" class="d-flex justify-content-center">
                                        <button style="font-size: 10px; width: 30%; border: 1px solid black" class="btn reviewBooKBtn" data-user-id="<?= $transact['user_id'];?>" data-book-id="<?= $transact['book_id'];?>">Review Book</button>
                                    </div>
                                </div>

                            </swiper-slide>
                        <?php } ?>


                    </swiper-container>

                </div>
            </div>
        <div class="container mt-4 card  " style="min-height: 50vh; max-height: 200vh; width: 100%;">
            <div style=" margin-top: 10px">
                <p style="font-size: 12px; font-weight: bold; font-style: italic">Borrowed Book Status</p>
            </div>
            <main class="table" style= "height: 100vh; overflow: scroll">
                <section class="table__header">
                    <div class="input-group">
                        <input type="search" placeholder="Search Data...">
                    </div>
                    <div class="export__file">
                        <label for="export-file" class="export__file-btn" title="Export File"></label>
                        <input type="checkbox" id="export-file"style="background-color: red; width: 1000px">
                        <div class="export__file-options">
                            <label>Export As &nbsp; &#10140;</label>
                            <label for="export-file" id="toPDF">PDF <img src="../icons/pdf.png" alt=""></label>
                            <label for="export-file" id="toCSV">CSV <img src="../icons/csv.png" alt=""></label>
                            <label for="export-file" id="toEXCEL">EXCEL <img src="../icons/xls-file.png" alt=""></label>
                        </div>
                    </div>
                </section>
                <section class="table__body">
                    <table>
                        <thead>
                        <tr>
                            <th>Transaction Id</th>
                            <th></th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Transaction Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($getAllTransaction as $userTransaction) { ?>
                            <tr>
                                <td><?php echo $userTransaction['id'] ?> </td>
                                <td><img src="../book_img/<?php echo $userTransaction['book_img'] ?>" alt=""></td>
                                <td><?php echo $userTransaction['book_title'] ?></td>
                                <td><?php echo $userTransaction['author'] ?></td>
                                <td> <?php echo $userTransaction['date_requested'] ?> </td>
                                <td>
                                    <p class="status <?php echo ($userTransaction['status'] === 'Approved') ? 'approve' : (($userTransaction['status'] === 'Rejected') ? 'reject' : 'pending'); ?>"><?php echo $userTransaction['status']; ?></p>
                                </td>

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    </table>
                </section>
            </main>

        </div>
        </div>
</div>
<!-- Book Review Modal -->
<div class="modal fade " id="bookReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form action="" method="post">
                    <div style="width: 100%; height: 300px">
                        <div style="font-size: 14px; letter-spacing: 0.2px; width: 100%; color: #711717; display: flex; justify-content: center; margin-top: 30px">
                            <p style="font-style: italic; font-weight: 700;">BOOK REVIEW</p>
                        </div>
                        <div style="font-size: 30px; width: 40%; display: flex; justify-content: center; height: 70px; margin-left: 30%;">
                            <div class="rating">
                                <i class="bi bi-star" data-index="0"></i>
                                <i class="bi bi-star" data-index="1"></i>
                                <i class="bi bi-star" data-index="2"></i>
                                <i class="bi bi-star" data-index="3"></i>
                                <i class="bi bi-star" data-index="4"></i>
                            </div>
                        </div>
                        <p id="bookTitle" style="text-transform: uppercase; text-align: center; padding: 5px 0px; font-weight: 700; font-size:12px;">

                        </p>
                        <div style="font-size: 12px; width: 85%; display: flex; align-content: center; margin-left:35px;">
                            <textarea id="reviewComment" type="text" rows="6" class="form-control" aria-describedby="inputGroupPrepend" style="font-size: 10px; resize: none;" required></textarea>
                        </div>
                    </div>
                    <div style="font-size: 12px; width: 100%; display: flex; justify-content: center;">
                        <button data-bs-dismiss="modal" type="button" style="width: 95px; margin: 0px 20px; font-weight: bold; border-radius: 5px; padding: 8px; color: #711717; background-color: transparent; border: 1px solid #711717">CANCEL</button>
                        <button data-bs-toggle="modal" id="submitReviewBtn" class="review_submit_btn" type="button" style="width: 95px; font-weight: bold; border-radius: 5px; padding: 8px; color: white; background-color: #740000; border: 1px solid #711717">SUBMIT</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

<script>
    const listItems = document.querySelectorAll('.user-nav .nav-item');
    listItems.forEach((listItem) => {
        listItem.addEventListener('click', () => {
            listItems.forEach((item) => {
                item.classList.remove('active');
            });

            listItem.classList.add('active');
        });
    });
</script>
<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../node_modules/swiper/swiper-bundle.min.js"></script>
<script src="../node_modules/chart.js/dist/chart.umd.js"></script>
<script src="../node_modules/swiper/swiper-element-bundle.min.js"></script>

<script src="../js/add_book_review.js"></script>
<script>
    const search = document.querySelector('.input-group input'),
        table_rows = document.querySelectorAll('tbody tr'),
        table_headings = document.querySelectorAll('thead th');

    // 1. Searching for specific data of HTML table
    search.addEventListener('input', searchTable);

    function searchTable() {
        table_rows.forEach((row, i) => {
            let table_data = row.textContent.toLowerCase(),
                search_data = search.value.toLowerCase();

            row.classList.toggle('hide', table_data.indexOf(search_data) < 0);
            row.style.setProperty('--delay', i / 25 + 's');
        })

        document.querySelectorAll('tbody tr:not(.hide)').forEach((visible_row, i) => {
            visible_row.style.backgroundColor = (i % 2 == 0) ? 'transparent' : '#0000000b';
        });
    }

    // 2. Sorting | Ordering data of HTML table

    table_headings.forEach((head, i) => {
        let sort_asc = true;
        head.onclick = () => {
            table_headings.forEach(head => head.classList.remove('active'));
            head.classList.add('active');

            document.querySelectorAll('td').forEach(td => td.classList.remove('active'));
            table_rows.forEach(row => {
                row.querySelectorAll('td')[i].classList.add('active');
            })

            head.classList.toggle('asc', sort_asc);
            sort_asc = head.classList.contains('asc') ? false : true;

            sortTable(i, sort_asc);
        }
    })


    function sortTable(column, sort_asc) {
        [...table_rows].sort((a, b) => {
            let first_row = a.querySelectorAll('td')[column].textContent.toLowerCase(),
                second_row = b.querySelectorAll('td')[column].textContent.toLowerCase();

            return sort_asc ? (first_row < second_row ? 1 : -1) : (first_row < second_row ? -1 : 1);
        })
            .map(sorted_row => document.querySelector('tbody').appendChild(sorted_row));
    }

    // 3. Converting HTML table to PDF

    const pdf_btn = document.querySelector('#toPDF');
    const customers_table = document.querySelector('#customers_table');

    const toPDF = function (customers_table) {
        const html_code = `
    <link rel="stylesheet" href="style.css">
    <main class="table" >${customers_table.innerHTML}</main>
    `;

        const new_window = window.open();
        new_window.document.write(html_code);

        setTimeout(() => {
            new_window.print();
            new_window.close();
        }, 400);
    }

    pdf_btn.onclick = () => {
        toPDF(customers_table);
    }

    // 4. Converting HTML table to JSON

    const json_btn = document.querySelector('#toJSON');

    const toJSON = function (table) {
        let table_data = [],
            t_head = [],

            t_headings = table.querySelectorAll('th'),
            t_rows = table.querySelectorAll('tbody tr');

        for (let t_heading of t_headings) {
            let actual_head = t_heading.textContent.trim().split(' ');

            t_head.push(actual_head.splice(0, actual_head.length - 1).join(' ').toLowerCase());
        }

        t_rows.forEach(row => {
            const row_object = {},
                t_cells = row.querySelectorAll('td');

            t_cells.forEach((t_cell, cell_index) => {
                const img = t_cell.querySelector('img');
                if (img) {
                    row_object['customer image'] = decodeURIComponent(img.src);
                }
                row_object[t_head[cell_index]] = t_cell.textContent.trim();
            })
            table_data.push(row_object);
        })

        return JSON.stringify(table_data, null, 4);
    }

    json_btn.onclick = () => {
        const json = toJSON(customers_table);
        downloadFile(json, 'json')
    }

    // 5. Converting HTML table to CSV File

    const csv_btn = document.querySelector('#toCSV');

    const toCSV = function (table) {
        // Code For SIMPLE TABLE
        // const t_rows = table.querySelectorAll('tr');
        // return [...t_rows].map(row => {
        //     const cells = row.querySelectorAll('th, td');
        //     return [...cells].map(cell => cell.textContent.trim()).join(',');
        // }).join('\n');

        const t_heads = table.querySelectorAll('th'),
            tbody_rows = table.querySelectorAll('tbody tr');

        const headings = [...t_heads].map(head => {
            let actual_head = head.textContent.trim().split(' ');
            return actual_head.splice(0, actual_head.length - 1).join(' ').toLowerCase();
        }).join(',') + ',' + 'image name';

        const table_data = [...tbody_rows].map(row => {
            const cells = row.querySelectorAll('td'),
                img = decodeURIComponent(row.querySelector('img').src),
                data_without_img = [...cells].map(cell => cell.textContent.replace(/,/g, ".").trim()).join(',');

            return data_without_img + ',' + img;
        }).join('\n');

        return headings + '\n' + table_data;
    }

    csv_btn.onclick = () => {
        const csv = toCSV(customers_table);
        downloadFile(csv, 'csv', 'customer orders');
    }

    // 6. Converting HTML table to EXCEL File

    const excel_btn = document.querySelector('#toEXCEL');

    const toExcel = function (table) {
        // Code For SIMPLE TABLE
        // const t_rows = table.querySelectorAll('tr');
        // return [...t_rows].map(row => {
        //     const cells = row.querySelectorAll('th, td');
        //     return [...cells].map(cell => cell.textContent.trim()).join('\t');
        // }).join('\n');

        const t_heads = table.querySelectorAll('th'),
            tbody_rows = table.querySelectorAll('tbody tr');

        const headings = [...t_heads].map(head => {
            let actual_head = head.textContent.trim().split(' ');
            return actual_head.splice(0, actual_head.length - 1).join(' ').toLowerCase();
        }).join('\t') + '\t' + 'image name';

        const table_data = [...tbody_rows].map(row => {
            const cells = row.querySelectorAll('td'),
                img = decodeURIComponent(row.querySelector('img').src),
                data_without_img = [...cells].map(cell => cell.textContent.trim()).join('\t');

            return data_without_img + '\t' + img;
        }).join('\n');

        return headings + '\n' + table_data;
    }

    excel_btn.onclick = () => {
        const excel = toExcel(customers_table);
        downloadFile(excel, 'excel');
    }

    const downloadFile = function (data, fileType, fileName = '') {
        const a = document.createElement('a');
        a.download = fileName;
        const mime_types = {
            'json': 'application/json',
            'csv': 'text/csv',
            'excel': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        }
        a.href = `
        data:${mime_types[fileType]};charset=utf-8,${encodeURIComponent(data)}
    `;
        document.body.appendChild(a);
        a.click();
        a.remove();
    }
</script>
</body>


</html>
