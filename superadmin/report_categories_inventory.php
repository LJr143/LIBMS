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

    <div class="main-content d-flex" >
        <div class="col col-md-2 side_bar">
            <div style="margin-bottom: 25px;height: 10vh; background-color: #740000; display: flex; justify-content: flex-start; align-items: center">
                <div style="margin-left: 35px"><img style="width: 35px;" src="../icons/admin_icon.png"  alt=""><span style="font-size: 12px; color: white; margin-left: 10px">Lorjohn M. Rana</span></div>
            </div>
            <div>
                <ul class="menu_icon">
                    <li><img class="custom_menu_icon" src="../icons/dashboard_icon.png" alt=""><span><a href="dashboard.php">Dashboard</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/staff_icon.png" alt=""><span><a href="staff.php">Staff</a></span></li>
                    <li class="active"><img class="custom_menu_icon" src="../icons/reports_icon.png" alt=""><span><a href="report.php">Reports</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/logs_icon.png" alt=""><span><a href="logs.php">Logs</a></span></li>
                    <li><img class="custom_menu_icon" src="../icons/feedback_icon_dashboard.png" alt=""><span><a href="feedback.php">Feedback</a></span></li>
                </ul>
            </div>

        </div>
        <div class="col" style=" width: 100%; height: 100vh; ">
            <div style="display: flex; justify-content: center; ">
                <div style="background-color: white; width: 95%; height: 45px; margin: 15px; border-radius: 5px;display: flex; box-shadow: 0px 4px 8px rgba(0,0,0,0.27)">
                    <p style="font-size: 10px; font-weight: 600; margin: 14px">HOME | REPORTS</p>
                </div>
            </div>
            <div style="display: flex; justify-content: center; ">
                <div style="background-color: white; width: 95%; height: 40px; margin: 0px; border-radius: 5px;display: flex;  align-items: center; align-content: center;">
                <div style="width: 60%; display: flex; justify-content: space-between">
                    <button style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/book_inventory_report_icon.png" alt=""><span style="margin-left: 10px;">Book Inventory</span></button>
                    <button style=" font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/categories_report_icon.png" alt=""><span style="margin-left: 10px;">Categories</span></button>
                    <button style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/newuser_report_icon.png" alt=""><span style="margin-left: 10px;">New Users/Visitors</span></button>
                    <button style="background-color: white; font-size: 12px; width: 170px; height: 35px; border-radius: 5px; border: none; box-shadow: 0px 4px 8px rgba(0,0,0,0.27);"><img style="width: 20px;" src="../icons/book_status_icon.png" alt=""><span style="margin-left: 10px;">Book Status</span></button>

                </div>
                    <div style="width: 40%; display: flex; justify-content: flex-end; align-items: center; height: 35px;">
                       <div style="margin-right: 50px;"> <button style="border: none; background-color: transparent;"><img  style="width: 20px;" src="../icons/export_icon.png" alt=""></button></div>
                    </div>
                </div>
                </div>
            <div style="display: flex; justify-content: center; ">
                <div style=" width: 95%; height: 50px; margin: 10px 0 0 0; border-radius: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.27);    ">
                <div style=" margin: 15px 30px; display: flex; ">
                    <div style="width: 85%;"><h6 style="font-size: 12px; font-weight: 700;">QUARTERLY REPORTS</h6></div>
                    <div style="width: 15%; display: flex; justify-content: flex-end">
                        <select name="" id="" style="font-size: 12px; width: 150px; height: 28px; padding: 2px 5px; border-radius: 5px">
                            <option value="option">Search Categories</option>
                            <option value="option">Environment and Forestry</option>
                            <option value="option">Agriculture and Agriculture Engineering</option>
                            <option value="option">Usepiana</option>
                            <option value="option">General Information</option>
                            <option value="option">Filipiñiana </option>
                            <option value="option">Educational</option>
                            <option value="option"> Video Tapes</option>
                            <option value="option"> Special Education</option>
                            <option value="option">Others</option>
                        </select>
                    </div>
                </div>
                </div>
                </div>
            <div style="display: flex; justify-content: center; width: 100%; height: 440px; ">
                <div style=" width: 95%; max-height: 620px; margin: 10px 0 0 0; border-radius: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.27);     ">


                  <div style="width: 100%; display: flex; justify-content: center; border-radius: 5px; margin-top: 10px; font-size: 12px;">
                            <table style="width: 95%; " class=" table text-center">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>QUARTER 1</th>
                                    <th>QUARTER 2</th>
                                    <th>QUARTER 3</th>
                                    <th>QUARTER 4</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                    <td>TOTAL BOOKS</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px;background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25); border-radius: 5px;">

                                    <td>RESERVED</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                    <td>1200</td>



                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px;border: 1px solid rgba(0,0,0,0.25);">
                                    <td>BORROWED</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                    <td>1200</td>



                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                    <td>RETURNED</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                    <td>1200</td>



                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                    <td>UNRETURNED</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                    <td>1200</td>



                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                    <td>DAMAGED</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                </tr>
                                <tr style="height: 10px">

                                </tr>
                                <tr style=" height: 40px; background-color: rgb(246,246,246); margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.25);">
                                    <td>LOST</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                    <td>1200</td>
                                    <td>1200</td>
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
                data: [40,50,60,70],
                backgroundColor: '#FF0000',
                barThickness: 26,

            },
                {
                    label: 'weekly',
                    data: [200,220,230,240],
                    backgroundColor: '#B50000',
                    barThickness: 26,

                },
                {
                    label: 'quarterly',
                    data: [ 260,270,280,290],
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

</body>
</html>