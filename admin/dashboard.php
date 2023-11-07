<?php


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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/admin_dashboard.css">
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

    <div class="main-content d-flex" >
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
                    <li class="active"><img class="custom_menu_icon" src="../icons/dashboard_icon.png" alt=""><span><a href="dashboard.php">Dashboard</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/staff_icon.png" alt=""><span><a href="student.php">Student</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/admin_inventory_menu.png" alt=""><span><a href="inventory.php">Inventory</a></span></li>

                </ul>
            </div>

        </div>
        <div class="col" style=" width: 100%; height: 100vh; ">
            <div style="display: flex; justify-content: center; ">
                <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27); align-content: center; align-items: center">
                    <div style="width: 90%">
                        <p style="font-size: 10px; font-weight: 700; margin: 14px">HOME | DASHBOARD</p>
                    </div>
                    <div class=" d-flex justify-content-end align-items-center" style="height: 50px; width: 10%; margin-right: 20px ">
                        <div class="dropdown" style=" margin-right: 0px; position: absolute">
                            <button style="background: none; border: none;" class=" dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../img/me_sample_profile.jpg" alt="" width="35px" style="border-radius: 60px; border: 1px solid #4d0202">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown_menu_setting aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="profile.php"><img src="../icons/manage_account.png" alt="" class="custom_icon"><span>Manage Account</span></a></li>
                            <li><a class="dropdown-item" href="#"><img src="../icons/help.png" alt="" class="custom_icon"><span>Help</span></a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a id="logoutButton" class="dropdown-item" href=""><img src="../icons/plug.png" alt="" class="custom_icon"><span>Logout</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dash_cards" style="margin: 0px 35px; display: flex; justify-content: space-between; margin-top: 10px ">
                <div class="card" style="width: 18rem; height: 140px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                    <div class="card-body">
                        <h6 class="card-title">No. of New Books</h6>
                        <h5>251</h5>
                        <div style="width: 100%; display: flex; justify-content: flex-end; margin-top: -40px; ">

                        </div>
                        <p class="card-text"></p>

                    </div>
                </div>
                <div class="card" style="width: 18rem; height: 140px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                    <div class="card-body">
                        <h6 class="card-title">Total No. of Books</h6>
                        <h5>251</h5>
                        <div style="width: 100%; display: flex; justify-content: flex-end; margin-top: -40px; ">

                        </div>
                        <p class="card-text"></p>

                    </div>
                </div>
                <div class="card" style="width: 18rem; height: 140px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                    <div class="card-body">
                        <h6 class="card-title">No. of New Users</h6>
                        <h5>251</h5>
                        <div style="width: 100%; display: flex; justify-content: flex-end; margin-top: -40px; ">

                        </div>
                        <p class="card-text"></p>

                    </div>
                </div>
                <div class="card" style="width: 18rem; height: 140px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                    <div class="card-body">
                        <h6 class="card-title">Total No. of Users</h6>
                        <h5>251</h5>
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
                                <canvas  id="borrowedCategory"></canvas>
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
                                <canvas  id="visitorsCategory"></canvas>
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
                            <h6 class="card-title">QUARTERLY REPORT ON BOOKS BORROWED AND RESERVED <span style="margin-left: 165px"><b>2023</b> <img
                                            src="../icons/menu_tables_charts.png" style="margin-top: -3px; margin-left: 5px;" alt=""></span></h6>
                            <p class="card-text"></p>
                            <div style=" width: 100%; height: 230px;display: flex; justify-content: center;">
                                <canvas  id="quarterlyCategory"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card" style=" width: 38.5rem; height: 300px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                        <div class="card-body">
                            <h6 class="card-title">QUARTERLY REPORT ON NEW USERS AND VISITORS<span style="margin-left: 210px"><b>2023</b> <img
                                            src="../icons/menu_tables_charts.png" style="margin-top: -3px; margin-left: 5px;" alt=""></span></h6>

                            <p class="card-text"></p>
                            <div style=" width: 100%; height: 230px;display: flex; justify-content: center;">
                                <canvas  id="quarterlyVisitCategory"></canvas>
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
<script>
    const listItems = document.querySelectorAll('li');
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
    const ctx = document.getElementById('borrowedCategory').getContext('2d');
    const ctx1 = document.getElementById('visitorsCategory').getContext('2d');
    const ctx2 = document.getElementById('quarterlyCategory').getContext('2d');
    const  ctx3 = document.getElementById('quarterlyVisitCategory').getContext('2d');

    const chart1 = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Environment and Forestry', 'Agriculture and Agricultural Engineering','Usepiana', 'General Information','Filipiñiana', 'Educational','Video Tapes','Special Education', 'Others'],
            datasets: [{
                label: '',
                data: [12,12,10,24,67,98,25, 65, 90],
                backgroundColor: ['rgb(128,0,0)', 'rgb(94,0,0)', 'rgb(72,0,0)','rgb(54,0,0)','rgb(38,0,0)','rgb(16,0,0)','rgb(0,0,0)','rgb(181,0,0)','rgb(156,0,0)'],
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

    const chart2 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['MON', 'TUE', 'WED', 'THUR', 'FRI'],
            datasets: [{
                label: 'Visitors',
                data: [ 70, 140, 210, 280, 350],
                backgroundColor: 'rgba(147,38,38,100%)',
               barThickness: 15,

            },
                {
                    label: 'Borrowers',
                    data: [ 50, 160, 200, 180, 150],
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

    const chart3 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY','JUN', 'JLY', 'SEP', 'NOV', 'DEC'],
            datasets: [{
                label: 'BORROWED',
                data: [ 70, 140, 210, 280, 350, 200, 150,90, 26, 10, 120, 120],
                backgroundColor: 'rgba(147,38,38,100%)',
                barThickness: 15,

            },
                {
                    label: 'RESERVED',
                    data: [ 50, 160, 200, 180, 150, 130, 140, 135, 60, 70, 50],
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
    const chart4 = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY','JUN', 'JLY', 'SEP', 'NOV', 'DEC'],
            datasets: [{
                label: 'VISITORS',
                data: [ 70, 140, 210, 280, 350, 200, 150,90, 26, 10, 120, 120],
                fill: false,
                borderColor: 'rgba(147,38,38,100%)',
                backgroundColor: 'rgba(147,38,38,100%)',
                tension: 0.1


            },
                {
                    label: 'NEW USERS',
                    data: [ 50, 160, 200, 180, 150, 130, 140, 135, 60, 70, 50],
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
    $(document).ready(function() {
        // Handle the logout button click event
        $("#logoutButton").click(function() {
            $.ajax({
                url: '../operations/logout_admin.php',
                type: 'POST',
                dataType: 'json',
                success: function(data) {

                    if (data.success) {
                        window.location.href = 'login.php';
                    }
                },
                error: function() {
                    alert('Logout failed. Please try again.');
                }
            });
        });
    });
</script>


</body>
</html>