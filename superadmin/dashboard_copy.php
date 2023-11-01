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
    <link rel="stylesheet" href="../css/superadmin_dashboard.css">
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
            <div style="height: 10vh; background-color: #740000; display: flex; justify-content: flex-start; align-items: center">
                <div style="margin-left: 35px"><img style="width: 35px;" src="../icons/admin_icon.png"  alt=""><span style="font-size: 12px; color: white; margin-left: 10px">Lorjohn M. Rana</span></div>
            </div>
            <div>
                <ul class="menu_icon">
                    <li><img class="custom_menu_icon" src="../icons/dashboard_icon.png" alt=""><span><a href="">Dashboard</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/staff_icon.png" alt=""><span><a href="">Staff</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="">Reports</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="">Logs</a></span></li>
                </ul>
            </div>

        </div>
        <div class="col" style=" width: 100%; height: 100vh; ">
            <div style="display: flex; justify-content: center; ">
                <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27)">
                    <p style="font-size: 10px; font-weight: 600; margin: 14px">HOME | DASHBOARD</p>
                </div>
            </div>
            <div style="margin: 0px 35px; display: flex; justify-content: space-between; margin-top: 10px ">
                <div class="card" style="width: 18rem; height: 140px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                    <div class="card-body">
                        <h6 class="card-title">New Books</h6>
                        <h5>251</h5>
                        <p class="card-text"></p>

                    </div>
                </div>
                <div class="card" style="width: 18rem; height: 140px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                    <div class="card-body">
                        <h6 class="card-title">Total Books</h6>
                        <h5>251</h5>
                        <p class="card-text"></p>

                    </div>
                </div>
                <div class="card" style="width: 18rem; height: 140px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                    <div class="card-body">
                        <h6 class="card-title">New Users</h6>
                        <h5>251</h5>
                        <p class="card-text"></p>

                    </div>
                </div>
                <div class="card" style="width: 18rem; height: 140px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                    <div class="card-body">
                        <h6 class="card-title">Total Users</h6>
                        <h5>251</h5>
                        <p class="card-text"></p>

                    </div>
                </div>
            </div>
            <div style="margin: 20px 15px 0px 35px; display: flex; justify-content: space-between;padding: 0;">
                <div class="col">
                    <div class="card" style="width: 38.5rem; height: 300px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                        <div class="card-body">
                            <h6 class="card-title"></h6>
                            <p class="card-text"></p>

                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card" style=" width: 38.5rem; height: 300px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                        <div class="card-body">
                            <h6 class="card-title"></h6>
                            <p class="card-text"></p>

                        </div>
                    </div>
                </div>
            </div>
            <div style="margin: 20px 35px 0px 35px; display: flex; justify-content: space-between;padding: 0;">
                <div class="col col-md-12">
                    <div class="card" style=" height: 300px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                        <div class="card-body">
                            <h6 class="card-title"></h6>
                            <p class="card-text"></p>

                        </div>
                    </div>
                </div>

            </div>
            <div style="margin: 20px 15px 0px 35px; display: flex; justify-content: space-between;padding: 0;">
                <div class="col">
                    <div class="card" style="width: 38.5rem; height: 300px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                        <div class="card-body">
                            <h6 class="card-title"></h6>
                            <p class="card-text"></p>

                        </div>
                    </div>
                </div>
                <div class="col ">
                    <div class="card" style=" width: 38.5rem; height: 300px; box-shadow: 0px 3px 6px rgba(0,0,0,0.26)">
                        <div class="card-body">
                            <h6 class="card-title"></h6>
                            <p class="card-text"></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>