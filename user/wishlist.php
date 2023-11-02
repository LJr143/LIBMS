<?php
include 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_wishlist.php';
$database = new Database();
$wishData = new WishDataWithStatus($database);

$allBooks = $wishData->getAllBooks();
$availableBooks = $wishData->getBooksByStatus('available');


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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/user_wishlist.css">
    <style>

        swiper-container {

            width: 100%;
            height: 650px;
            margin-left: auto;
            margin-right: auto;
            justify-content: center;
        }

        swiper-slide {
            text-align: center;
            font-size: 18px;
            height: calc((100% - 10px) / 2) !important;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.32);
        }
    </style>
</head>
<body>
<div style=" width: 100%; overflow-x: hidden">
    <nav class="navbar navbar-light bg-light header">
        <div class="container-fluid">

            <div class="head-text">
                <div> <img src="../icons/usep-logo.png" alt="" class="custom_img"></div>
                <div class="usep-text">
                    <p style="font-size: 14px; font-weight: bold">University of Southeastern Philippines Tagum - Mabini Campus</p>
                    <p style="font-size: 12px; font-weight: 600; margin-top: -20px">Apokon RD, Tagum City Davao Del Norte 8100</p>
                </div>
            </div>
            <div class="right-side">
                <div class="right-side-text">
                    <p style="font-size: 14px; font-weight: bold;">LIBRARY MANAGEMENT SYSTEM</p>
                    <p style="font-size: 12px; font-weight: 600; margin-top: -20px">E - System Environment</p>
                </div>
            </div>
        </div>
    </nav>
    <div class="user-nav bg-dark text-white">
        <ul class="nav justify-content-center align-items-center align-content-center" style="width: 100%">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="home.php">BOOKS</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="wishlist.php">WISHLIST</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="penalties.php">PENALTIES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="credit_score.php"  >CREDIT SCORE</a>
            </li>
        </ul>
    </div>
    <div class="main-content">
        <div class="container-fluid">
            <p class="text-main"">WISHLIST</p>
        </div>
        <div class="row search-by">


            <div class="search-input col-md-12 d-flex justify-content-center">
                <input class="form-control me-2" type="search" placeholder="Search Books" aria-label="Search" autocomplete="off">
                <button>Search</button>
            </div>

        </div>
        <div class="container mt-4 card " style="min-height: 100vh; max-height: 100vh; width: 100%">
            <div style=" margin-top: 10px">
                <p style="font-size: 12px; font-weight: bold; font-style: italic">Books Recently Wished</p>
                <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" slides-per-view="3" grid-rows="2"
                                  space-between="30">
                    <?php foreach ($availableBooks as $book) { ?>
                    <swiper-slide class="mt-2">

                                <div class="custom_book_container d-flex flex-column align-items-center justify-content-center swiper-slide">

                                    <img src="../wish_img/<?php echo $book['img']; ?>" alt="" class="custom-book-img">
                                    <div style="width: 100%; height: 30px; margin-top: 10px;" class="d-flex align-items-center  flex-column">
                                        <p style="font-size: 12px; text-align: center" class="custom-book-text"><?php echo $book['book_title']; ?></p>
                                        <p style="margin-top: -20px; font-size: 8px;" class="custom-book-text"><?php echo $book['author']; ?></p>
                                    </div>
                                    <div style="width: 100%; margin-top: 10px;" class="d-flex justify-content-center">
                                        <button style="font-size: 10px; width: 80%; border: 1px solid black" class="btn">View Book</button>
                                    </div>
                                </div>

                    </swiper-slide>
                    <?php } ?>
                </swiper-container>

            </div>
        </div>
        <div class="container mt-4 card  " style="min-height: 50vh; max-height: 100vh; width: 100%">
            <div style=" margin-top: 10px">
                <p style="font-size: 12px; font-weight: bold; font-style: italic">Wishlist Status</p>
            </div>
            <main class="table">
                <section class="table__header">
                    <div class="input-group">
                        <input type="search" placeholder="Search Data...">
                    </div>
                    <div class="export__file">
                        <label for="export-file" class="export__file-btn" title="Export File"></label>
                        <input type="checkbox" id="export-file">
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
                            <th> Id <span class="icon-arrow">&UpArrow;</span></th>
                            <th></th>
                            <th> Book <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Author <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Date Wished <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Status <span class="icon-arrow">&UpArrow;</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($allBooks as $book) { ?>
                        <tr>
                            <td> 1 </td>
                            <td><img src="../wish_img/<?php echo $book['img'] ?>" alt=""></td>
                            <td> <?php echo $book['book_title'] ?></td>
                            <td><?php echo $book['author'] ?></td>
                            <td> <?php echo $book['date_wished'] ?> </td>
                            <td>
                                <p class="status <?php echo ($book['status'] === 'available') ? 'delivered' : (($book['status'] === 'not available') ? 'cancelled' : 'pending'); ?>"><?php echo $book['status']; ?></p>
                            </td>

                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </section>
            </main>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
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
