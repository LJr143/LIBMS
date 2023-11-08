<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USeP | LMS</title>
    <link rel="icon" href="../icons/usep-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/superadmin_report.css">
</head>

<body style="">
    <div>
        <nav class="navbar navbar-light bg-light header">
            <div class="container-fluid">

                <div class="head-text">
                    <div> <img src="../icons/usep-logo.png" alt="" class="custom_img" id="usep-logo"></div>
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

        <div class="main-content d-flex">
            <div class="col col-md-2 side_bar">
                <div class="profile_section">
                    <div>
                        <img style="width: 60px; border-radius: 60px;" src="../img/me_sample_profile.jpg" alt="">
                    </div>
                    <div style="display: block; text-align: center; color: white; height: 20px;">
                        <ul style="margin-right: 36px;">
                            <li style="font-size: 12px; color: #0cb90c; font-weight: 600">Active</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <ul class="menu_icon">
                        <li><img class="custom_menu_icon" src="../icons/dashboard_icon.png" alt=""><span><a href="dashboard.php">Dashboard</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/staff_icon.png" alt=""><span><a href="student.php">Student</a></span></li>
                        <li class="active"><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/admin_inventory_menu.png" alt=""><span><a href="inventory.php">Inventory</a></span></li>
                    </ul>
                </div>

            </div>
            <div class="col" style=" width: 100%; height: 100vh; ">
                <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                    <div style="width: 90%">
                        <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | REPORT</p>
                    </div>
                    <div class=" d-flex justify-content-end align-items-center" style="height: 50px; width: 10%; margin-right: 20px ">
                        <div class="dropdown" style=" margin-right: 0px; position: absolute">
                            <button style="background: none; border: none;" class=" dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../img/me_sample_profile.jpg" alt="" width="35px" style="border-radius: 60px; border: 1px solid #4d0202">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown_menu_setting aria-labelledby=" dropdownMenuButton2">
                                <li><a class="dropdown-item" href="manage_account.php"><img src="../icons/manage_account.png" alt="" class="custom_icon"><span>Manage Account</span></a></li>
                                <li><a class="dropdown-item" href="#"><img src="../icons/help.png" alt="" class="custom_icon"><span>Help</span></a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../operations/logout.php"><img src="../icons/plug.png" alt="" class="custom_icon"><span>Logout</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; ">
                    <div style="background-color: white; width: 95%; height: 40px; margin: 0px; border-radius: 5px;display: flex;  align-items: center; align-content: center;">
                        <div style="width: 60%; display: flex; justify-content: space-between">
                            <button id="bookInventoryButton" style=" font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/book_inventory_report_icon.png" alt=""><span style="margin-left: 10px;">Book Inventory</span></button>
                            <button id="categoriesButton" style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/categories_report_icon.png" alt=""><span style="margin-left: 10px;">Categories</span></button>
                            <button id="newUsersButton" style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/newuser_report_icon.png" alt=""><span style="margin-left: 10px;">New Users/Visitors</span></button>
                            <button id="bookStatusButton" style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/book_status_icon.png" alt=""><span style="margin-left: 10px;">Book Status</span></button>

                        </div>
                        <div style="width: 40%; display: flex; justify-content: flex-end; align-items: center; height: 35px;">
                            <div style="margin-right: 50px;"> <button style="border: none; background-color: transparent;"><img style="width: 20px;" src="../icons/export_icon.png" alt=""></button></div>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; ">
                    <div style=" width: 95%; height: 50px; margin: 10px 0 0 0; border-radius: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.27);    ">
                        <div style=" margin: 15px 30px; display: flex; ">
                            <div style="width: 85%;">
                                <h6 style="font-size: 12px; font-weight: 700;">QUARTERLY REPORTS</h6>
                            </div>
                            <div style="width: 15%; display: flex; justify-content: flex-end">
                            <select name="" id="navigationSelect" style="font-size: 12px; width: 150px; padding: 2px 5px; border-radius: 5px">
                                    <option value="overall">OVERALL</option>
                                    <option value="borrowed">BORROWED</option>
                                    <option value="reserved">RESERVED</option>
                                    <option value="returned">RETURNED</option>
                                    <option value="book-copies">BOOK COPIES</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; width: 100%; height: 100vh; ">
                    <div style=" width: 95%; max-height: 620px; margin: 10px 0 0 0; border-radius: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.27);     ">
                        <div style="width: 100%; display: flex; margin-top: 10px;">
                            <div style="width: 80%;">
                                <div style="width: 80%; height: 40px; display: flex;  align-content: center; align-items: center">
                                    <select name="" id="" style=" margin: 0px 0px 0px 40px;width: 100px; height: 25px; font-size: 12px; font-weight: 600; border-radius: 5px;">
                                        <option value="">Quarter 1</option>
                                        <option value="">Quarter 2</option>
                                        <option value="">Quarter 3</option>
                                        <option value="">Quarter 4</option>

                                    </select>
                                    <div class="input_search-wrapper" style="margin-left: 40px;">
                                        <input type="search" class="search-input" placeholder="Search Book">
                                    </div>
                                </div>
                            </div>

                            <div style="width: 20%; height: 40px; display: flex; justify-content: flex-end; align-items: center; ">
                                <img style="width: 180px; margin-right: 20px;" src="../icons/pagination_sample.png" alt="" ;>
                            </div>
                        </div>

                        <div style="width: 100%; display: flex; justify-content: center; border-radius: 5px; margin-top: 10px; font-size: 12px;">
                            <table style="width: 95%; " class=" table text-center">
                                <thead>
                                    <tr>
                                        <th>BOOK ID</th>
                                        <th>TITLE</th>
                                        <th>AUTHOR</th>
                                        <th>ISBN</th>
                                        <th>CATEGORY</th>
                                        <th>BOOK COPIES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td>1</td>
                                        <td>The Adventures of Sherlock Holmes</td>
                                        <td>Arthur Conan Doyle</td>
                                        <td>1234567890</td>
                                        <td>Mystery</td>
                                        <td>5</td>
                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px;background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25); border-radius: 5px;">

                                        <td>2</td>
                                        <td>To Kill a Mockingbird</td>
                                        <td>Harper Lee</td>
                                        <td>2345678901</td>
                                        <td>Fiction</td>
                                        <td>3</td>



                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px;border: 1px solid rgba(0,0,0,0.25);">
                                        <td>3</td>
                                        <td>The Great Gatsby</td>
                                        <td>F. Scott Fitzgerald</td>
                                        <td>3456789012</td>
                                        <td>Classics</td>
                                        <td>7</td>



                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td>4</td>
                                        <td>Harry Potter and the Sorcerer's Stone</td>
                                        <td>J.K. Rowling</td>
                                        <td>4567890123</td>
                                        <td>Fantasy</td>
                                        <td>10</td>



                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td>5</td>
                                        <td>The Catcher in the Rye</td>
                                        <td>J.D. Salinger</td>
                                        <td>5678901234</td>
                                        <td>Literary Fiction</td>
                                        <td>4</td>



                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td>6</td>
                                        <td>1984</td>
                                        <td>George Orwell</td>
                                        <td>6789012345</td>
                                        <td>Dystopian</td>
                                        <td>5</td>
                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td>7</td>
                                        <td>The Hobbit</td>
                                        <td>J.R.R. Tolkien</td>
                                        <td>7890123456</td>
                                        <td>Fantasy</td>
                                        <td>8</td>



                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td>8</td>
                                        <td>Pride and Prejudice</td>
                                        <td>Jane Austen</td>
                                        <td>8901234567</td>
                                        <td>Romance</td>
                                        <td>6</td>



                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td>9</td>
                                        <td>The Hunger Games</td>
                                        <td>Suzanne Collins</td>
                                        <td>9012345678</td>
                                        <td>Science Fiction</td>
                                        <td>3</td>



                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>
                                    <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                        <td>10</td>
                                        <td>The Alchemist</td>
                                        <td>Paulo Coelho</td>
                                        <td>0123456789</td>
                                        <td>Inspirational</td>
                                        <td>9</td>



                                    </tr>
                                    <tr style="height: 10px">

                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>


        </div>


    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>


    <script>
        const ctx = document.getElementById('overallchart').getContext('2d');

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['First Quarter', 'Second Quarter', 'Third Quarter', 'Fourth Quarter'],
                datasets: [{
                        label: 'daily',
                        data: [40, 50, 60, 70],
                        backgroundColor: '#FF0000',
                        barThickness: 26,

                    },
                    {
                        label: 'weekly',
                        data: [200, 220, 230, 240],
                        backgroundColor: '#B50000',
                        barThickness: 26,

                    },
                    {
                        label: 'quarterly',
                        data: [260, 270, 280, 290],
                        backgroundColor: '#5A0202',
                        barThickness: 26,

                    }

                ]
            },
            options: {
                maintainAspectRatio: false,

                scales: {
                    x: {
                        grid: {
                            display: false,
                        }
                    },

                },
                plugins: {
                    legend: {
                        display: false,
                    },
                }

            }
        });
    </script>
    <script>
    // Get the <select> element
    const selectElement = document.getElementById('navigationSelect');

    // Define the URLs corresponding to each option
    const pageUrls = {
        overall: 'report.php',
        borrowed: 'report_borrowed_inventory.php',
        reserved: 'report_reserved_inventory.php',
        returned: 'report_returned_inventory.php',
        'book-copies': 'report_copies_inventory.php',
    };

    const currentPageUrl = window.location.pathname;

    // Find the corresponding option based on the URL
    const selectedOption = Object.entries(pageUrls).find(([option, url]) => currentPageUrl.endsWith(url));

    if (selectedOption) {
        selectElement.value = selectedOption[0];
    }

    // Add an event listener to detect changes
    selectElement.addEventListener('change', function() {
        // Get the selected option's value
        const selectedOption = selectElement.value;

        // Redirect the user to the selected page
        window.location.href = pageUrls[selectedOption];
    });

    // Define the page URLs for the buttons
    const buttonPageUrls = {
        bookInventoryButton: 'report.php',
        categoriesButton: 'report_categories_inventory.php',
        newUsersButton: 'report_users_inventory.php',
        bookStatusButton: 'report_book_status_inventory.php',
    };

    // Get the buttons by their IDs
    const bookInventoryButton = document.getElementById('bookInventoryButton');
    const categoriesButton = document.getElementById('categoriesButton');
    const newUsersButton = document.getElementById('newUsersButton');
    const bookStatusButton = document.getElementById('bookStatusButton');

    // Attach click event listeners to the buttons
    bookInventoryButton.addEventListener('click', () => {
        window.location.href = buttonPageUrls.bookInventoryButton;
    });

    categoriesButton.addEventListener('click', () => {
        window.location.href = buttonPageUrls.categoriesButton;
    });

    newUsersButton.addEventListener('click', () => {
        window.location.href = buttonPageUrls.newUsersButton;
    });

    bookStatusButton.addEventListener('click', () => {
        window.location.href = buttonPageUrls.bookStatusButton;
    });
</script>

</body>

</html>