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
    <link rel="stylesheet" href="../css/admin_inventory.css">
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
            <div style="margin-bottom: 25px;height: 10vh; background-color: #740000; display: flex; justify-content: flex-start; align-items: center">
                <div style="margin-left: 35px"><img style="width: 35px;" src="../icons/admin_icon.png"  alt=""><span style="font-size: 12px; color: white; margin-left: 10px">Lorjohn M. Rana</span></div>
            </div>
            <div>
                <ul class="menu_icon">
                    <li><img class="custom_menu_icon" src="../icons/dashboard_icon.png" alt=""><span><a href="#">Dashboard</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/staff_icon.png" alt=""><span><a href="staff.php">Student</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                    <li class="active"><img class="custom_menu_icon" src="../icons/admin_inventory_menu.png" alt=""><span><a href="inventory.php">Inventory</a></span></li>

                </ul>
            </div>

        </div>
        <div class="col" style=" width: 100%; height: 100vh; ">
            <div style="display: flex; justify-content: center; ">
                <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27)">
                    <p style="font-size: 10px; font-weight: 600; margin: 14px">HOME | DASHBOARD</p>
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



</script>


</body>
</html>