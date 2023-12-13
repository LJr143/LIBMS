<?php
session_start();
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
include 'C:\wamp64\www\LIBMS\operations\authentication.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_user_data.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_books_data.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_staff_data.php';
include 'C:\wamp64\www\LIBMS\includes\fetch_superadmin_data.php';


$loggedAdmin = '';

$database = new Database();
$userAuth = new UserAuthentication($database);
$bookData = new BookData($database);
$userData = new UserData($database);
$adminData = new StaffData($database);
$superAdminData = new SuperAdminData($database);


$numberOfBooks = $bookData->getNumberOfBooks();
$numberOfUsers = $userData->getNumberOfUser();

//Authenticate
if ($userAuth->isAuthenticated()) {
} else {
    header('Location: ../index_admin.php');
    exit();
}
//Logout
if (isset($_POST['logout'])) {
    $userAuth->logout();
    header('Location: ../index_admin.php');
    exit();
}
//Check if the user logs and checks the access type
if (isset($_SESSION['user'])) {
    $adminUsername = $_SESSION['user'];

    if (isset($_SESSION['admin_role'])) {
        $accessType = $_SESSION['admin_role'];
        if ($accessType == 'Librarian') {
            $adminID = $superAdminData->getSuperadminIdByUsername($adminUsername);
            if (!empty($adminID)) {
                $admin = $superAdminData->getSuperadminById($adminID);
                $loggedAdmin = $admin[0];
            } else {
                echo 'SuperAdmin data not found.';
            }
        } else if ($accessType == 'Staff') {
            $adminID = $adminData->getStaffIdByUsername($adminUsername);
            if (!empty($adminID)) {
                $admin = $adminData->getStaffById($adminID);
                $loggedAdmin = $admin[0];
            } else {
                echo 'Admin data not found.';
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USeP | LMS</title>
    <link rel="icon" href="../icons/usep-logo.png">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/admin_dashboard.css">
    <link rel="stylesheet" href="../css/logout.css">
    <link rel="stylesheet" href="../css/side_bar.css">
    <style>

    </style>
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
                        <img style="border: 3px solid white; width: 60px; border-radius: 60px;" src="../img/<?= $loggedAdmin['img'] ?>" alt="">
                        <div style="position: absolute; top: 55px; right: 72px; background:#01d501; height: 15px; width: 15px; border-radius: 60px;"></div>
                    </div>
                    <div style="display: block; text-align: center; color: white; height: 20px;">

                    </div>
                </div>

                <div class="container mt-4">
                    <ul class="menu_icon">
                        <li class="active"><img class="custom_menu_icon" src="../icons/dashboard_icon.png" alt=""><span><a href="dashboard.php">Dashboard</a></span></li>
                        <li class="accordion-item">
                            <div class="headermenu">
                                <button  class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#studentCollapse" aria-expanded="false" aria-controls="studentCollapse">
                                    <img class="custom_menu_icon" src="../icons/staff_icon.png" alt="" style="margin-right: 10px; "> Student
                                </button>
                            </div>
                            <div id="studentCollapse" class="accordion-collapse collapse ms-4" data-bs-parent="#menuAccordion">
                                <div class="accordion-body">
                                    <a href="student.php">All Students</a><br>
                                    <a href="college.php">Colleges</a><br>
                                    <a href="course.php">Courses</a><br>
                                    <a href="section.php">Sections</a>
                                </div>
                            </div>
                        </li>
                        <li><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                        <li><img class="custom_menu_icon" src="../icons/admin_inventory_menu.png" alt=""><span><a href="inventory.php">Inventory</a></span></li>
                        <li>
                            <i class="bi bi-bookshelf custom_menu_icon" style="font-size: 20px; color:#fff"></i>
                            <span><a href="shelf.php">Shelf</a></span>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col" style=" width: 100%; height: 100vh; ">
                <div style="display: flex; justify-content: center; ">
                    <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                        <div style="width: 90%">
                            <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | DASHBOARD</p>
                        </div>
                          <!-- Notification Bell Icon -->
                        <?php include 'notification.php' ?>

                        <div class=" d-flex justify-content-end align-items-center" style="height: 50px; width: 6%; margin-right: 20px ">
                            <div class="dropdown" style=" margin-right: 0px; position: absolute">
                                <button style="background: none; border: none;" class=" dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../img/<?= $loggedAdmin['img'] ?>" alt="" width="35px" style="border-radius: 60px; border: 1px solid #4d0202">
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown_menu_setting aria-labelledby=" dropdownMenuButton2">
                                    <li><a style="font-size: 12px; color: white;" class="dropdown-item" href="profile.php"><img src="../icons/manage_account.png" alt="" class="custom_icon"><span>Manage Account</span></a></li>
                                    <li><a style="font-size: 12px; color: white;" class="dropdown-item" href="#"><img src="../icons/help.png" alt="" class="custom_icon"><span>Help</span></a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <form action="" method="post" style="margin-left: 20px;">

                                        <label for="logout"><img src="../icons/plug.png" style="width: 20px; " alt=""></label>
                                        <input id="logoutButton" style="font-size: 12px; color: white; background: none; border: none;" name="logout" type="submit" value="Logout">
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dash_cards" style="margin: 0px 35px; display: flex; justify-content: space-between; margin-top: 10px ">
                    <div class="card" style="width: 18rem; height: 140px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                        <div class="card-body">
                            <h6 class="card-title">No. of New Books</h6>
                            <h5>...</h5>
                            <div style="width: 100%; display: flex; justify-content: flex-end; margin-top: -40px; ">

                            </div>
                            <p class="card-text"></p>

                        </div>
                    </div>
                    <div class="card" style="width: 18rem; height: 140px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                        <div class="card-body">
                            <h6 class="card-title">Total No. of Books</h6>
                            <h5><?php echo $numberOfBooks ?></h5>
                            <div style="width: 100%; display: flex; justify-content: flex-end; margin-top: -40px; ">

                            </div>
                            <p class="card-text"></p>

                        </div>
                    </div>
                    <div class="card" style="width: 18rem; height: 140px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                        <div class="card-body">
                            <h6 class="card-title">No. of New Users</h6>
                            <h5>...</h5>
                            <div style="width: 100%; display: flex; justify-content: flex-end; margin-top: -40px; ">

                            </div>
                            <p class="card-text"></p>

                        </div>
                    </div>
                    <div class="card" style="width: 18rem; height: 140px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                        <div class="card-body">
                            <h6 class="card-title">Total No. of Users</h6>
                            <h5><?php echo $numberOfUsers  ?></h5>
                            <div style="width: 100%; display: flex; justify-content: flex-end; margin-top: -40px; ">

                            </div>
                            <p class="card-text"></p>

                        </div>
                    </div>
                </div>
                <div style="margin: 20px 15px 0px 35px; display: flex; justify-content: space-between;padding: 0;">
                    <div class="col">
                        <div class="card" style="width: 38.5rem; height: 300px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                            <div class="card-body">
                                <h6 class="card-title">MOST BORROWED CATEGORY</h6>
                                <div style="width: 100%; height: 230px; margin: 0px 10px;display: flex; justify-content: center;">
                                    <canvas id="borrowedCategory"></canvas>
                                </div>

                                <p class="card-text"></p>

                            </div>
                        </div>
                    </div>
                    <div class="col ">
                        <div class="card" style=" width: 38.5rem; height: 300px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                            <div class="card-body">
                                <h6 class="card-title">VISITORS & BORROWERS STATISTICS</h6>
                                <div style=" width: 100%; height: 230px;display: flex; justify-content: center;">
                                    <canvas id="visitorsCategory"></canvas>
                                </div>
                                <p class="card-text"></p>


                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin: 20px 35px 0px 35px; display: flex; justify-content: space-between;padding: 0;">
                    <div class="col col-md-12">
                        <div class="card" style=" height: 300px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                            <div class="card-body">
                                <h6 class="card-title">OVERDUE BOOKS</h6>
                                <div style="width: 100%; padding: 0; margin: 0; display: flex; justify-content: center">
                                    <table style="width: 100%" class=" table text-center">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>BOOK ID</th>
                                                <th>TITLE</th>
                                                <th>AUTHOR</th>
                                                <th>OVERDUE</th>
                                                <th>STATUS</th>
                                                <th>PENALTY</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="height: 10px">

                                            </tr>
                                            <tr style="box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.25); height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px">
                                                <td>2021-0001</td>
                                                <td>Sheena Marie Pagas</td>
                                                <td>880423897-57838</td>
                                                <td>IT</td>
                                                <td>Stephen King</td>
                                                <td>7 hours</td>
                                                <td>DELAY</td>
                                                <td>₱ 7.00</td>

                                            </tr>
                                            <tr style="height: 10px">

                                            </tr>
                                            <tr style="box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.25); height: 40px;background-color: rgb(246,246,246); margin-bottom: 10px">

                                                <td>2021-0002</td>
                                                <td>Lorjohn M. Raña</td>
                                                <td>880423897-57838</td>
                                                <td>IT</td>
                                                <td>Stephen King</td>
                                                <td>7 hours</td>
                                                <td>DELAY</td>
                                                <td>₱ 10.00</td>

                                            </tr>
                                            <tr style="height: 10px">

                                            </tr>
                                            <tr style="box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.25); height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px">
                                                <td>2021-0001</td>
                                                <td>Sheena Marie Pagas</td>
                                                <td>880423897-57838</td>
                                                <td>IT</td>
                                                <td>Stephen King</td>
                                                <td>7 hours</td>
                                                <td>DELAY</td>
                                                <td>₱ 7.00</td>

                                            </tr>
                                            <tr style="height: 10px">

                                            </tr>
                                            <tr style="box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.25); height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px">
                                                <td>2021-0001</td>
                                                <td>Sheena Marie Pagas</td>
                                                <td>880423897-57838</td>
                                                <td>IT</td>
                                                <td>Stephen King</td>
                                                <td>7 hours</td>
                                                <td>DELAY</td>
                                                <td>₱ 7.00</td>

                                            </tr>
                                            <tr style="height: 10px">

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <p class="card-text"></p>

                            </div>
                        </div>
                    </div>

                </div>
                <div style="margin: 20px 15px 0px 35px; display: flex; justify-content: space-between;padding: 0;">
                    <div class="col">
                        <div class="card" style="width: 38.5rem; height: 300px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                            <div class="card-body">
                                <h6 class="card-title">QUARTERLY REPORT ON BOOKS BORROWED AND RESERVED <span style="margin-left: 165px"><b>2023</b> <img src="../icons/menu_tables_charts.png" style="margin-top: -3px; margin-left: 5px;" alt=""></span></h6>
                                <p class="card-text"></p>
                                <div style=" width: 100%; height: 230px;display: flex; justify-content: center;">
                                    <canvas id="quarterlyCategory"></canvas>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col ">
                        <div class="card" style=" width: 38.5rem; height: 300px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                            <div class="card-body">
                                <h6 class="card-title">QUARTERLY REPORT ON NEW USERS AND VISITORS<span style="margin-left: 210px"><b>2023</b> <img src="../icons/menu_tables_charts.png" style="margin-top: -3px; margin-left: 5px;" alt=""></span></h6>

                                <p class="card-text"></p>
                                <div style=" width: 100%; height: 230px;display: flex; justify-content: center;">
                                    <canvas id="quarterlyVisitCategory"></canvas>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>


    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/swiper/swiper-bundle.min.js"></script>
    <script src="../node_modules/chart.js/dist/chart.umd.js"></script>


    <script src='../js/logout_script.js'></script>
    <script src="../js/navbar_select.js"></script>
    <script>
        const ctx = document.getElementById('borrowedCategory').getContext('2d');
        const ctx1 = document.getElementById('visitorsCategory').getContext('2d');
        const ctx2 = document.getElementById('quarterlyCategory').getContext('2d');
        const ctx3 = document.getElementById('quarterlyVisitCategory').getContext('2d');

        // Fetch data from the server
        fetch('../includes/fetch_borrow_counts_byCategory.php')
            .then(response => response.json())
            .then(data => {
                // Create the Chart.js chart
                const chart1 = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: data.map(item => item.category),
                        datasets: [{
                            label: '',
                            data: data.map(item => item.borrow_count),
                            backgroundColor: ['rgb(128,0,0)', 'rgb(94,0,0)', 'rgb(72,0,0)', 'rgb(54,0,0)', 'rgb(38,0,0)', 'rgb(16,0,0)', 'rgb(0,0,0)', 'rgb(181,0,0)', 'rgb(156,0,0)'],
                            cutout: '65%',
                            borderWidth: 1,
                            pointStyle: 'circle',
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'left',
                                labels: {
                                    usePointStyle: true
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);

                if (error instanceof Response && typeof error.text === 'function') {
                    return error.text(); // This will return the actual response body as text
                } else {
                    return 'Unable to retrieve error details';
                }
            })
            .then(errorMessage => console.log('Server Response:', errorMessage));



        const chart2 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['MON', 'TUE', 'WED', 'THUR', 'FRI'],
                datasets: [{
                        label: 'Visitors',
                        data: [70, 140, 210, 280, 350],
                        backgroundColor: 'rgba(147,38,38,100%)',
                        barThickness: 15,

                    },
                    {
                        label: 'Borrowers',
                        data: [50, 160, 200, 180, 150],
                        backgroundColor: 'rgba(37,37,37,100%)',
                        barThickness: 15,

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
                        position: 'bottom',
                        labels: {
                            usePointStyle: true
                        }
                    }
                }
            }
        });

       // Fetch data from the server
fetch('../includes/fetch_borrow_reserve_counts_quarterly.php')
    .then(response => response.json())
    .then(data => {
        // Create the Chart.js chart
        const chart3 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Q1', 'Q2', 'Q3', 'Q4'],
                datasets: [{
                    label: 'BORROWED',
                    data: data.borrows.map(item => item.borrow_count),
                    backgroundColor: 'rgba(147,38,38,100%)',
                    barThickness: 15,
                }, {
                    label: 'RESERVED',
                    data: data.reserves.map(item => item.reserve_count),
                    backgroundColor: 'rgba(37,37,37,100%)',
                    barThickness: 15,
                }]
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
                        position: 'bottom',
                        labels: {
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error fetching data:', error));




        const chart4 = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JLY', 'SEP', 'NOV', 'DEC'],
                datasets: [{
                        label: 'VISITORS',
                        data: [70, 140, 210, 280, 350, 200, 150, 90, 26, 10, 120, 120],
                        fill: false,
                        borderColor: 'rgba(147,38,38,100%)',
                        backgroundColor: 'rgba(147,38,38,100%)',
                        tension: 0.1


                    },
                    {
                        label: 'NEW USERS',
                        data: [50, 160, 200, 180, 150, 130, 140, 135, 60, 70, 50],
                        borderColor: 'rgba(37,37,37,100%)',
                        backgroundColor: 'rgba(37,37,37,100%)',
                        tension: 0.1

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
                        position: 'bottom',
                        labels: {
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    </script>
    <script>
        // Prevent the dropdown from closing when clicking on the buttons
        function handleButtonClick(event) {
            event.stopPropagation();
        }
    </script>
    <script src="../js/fetch_transaction.js"></script>



</body>

</html>