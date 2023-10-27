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
    <link rel="stylesheet" href="../css/user_wishlist.css">
    <style>


        .chartCard {
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .chartBox {
            display: flex;
            justify-content: center;
            align-items: center;
            align-content: center;
            width: 400px;
            height: 300px;
            padding: 20px;
            border-radius: 20px;
            border: solid 3px rgb(103, 7, 7);

        }
        .scrollable-div {
            width: 300px; /* Set the desired width */
            height: 300px; /* Set the desired height */
            overflow: auto; /* Make the div scrollable */
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
            <li class="nav-item ">
                <a class="nav-link" href="wishlist.php">WISHLIST</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="penalties.php">PENALTIES</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link " href="credit_score.php"  >CREDIT SCORE</a>
            </li>
        </ul>
    </div>
    <div class="main-content">
        <div class="container-fluid">
            <p class="text-main"">CREDIT SCORE</p>
        </div>
        <div class="row search-by">
        </div>
        <div class="container mt-4 card " style="min-height: 70vh; max-height: 100vh; width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <div style=" margin-top: 10px">
            <p style="font-size: 12px; font-weight: bold; font-style: italic">Your Current Credit Score</p>
                <div class="row container">
                    <div class="col mb-3 mt-3" style="width: 50%; height: 40vh;">
                        <div class="chartMenu">
                        </div>
                        <div class="chartCard">
                            <div class="chartBox mt-5 mb-5">
                                <canvas id="creditScore"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3 mt-3" style="width: 50%; height: 50vh;">
                        <p style="font-size: 12px; font-weight: bold; font-style: italic">Borrowing History</p>

                     <div class="scrollable-div" style="width: 100%; height: 50vh; padding: 10px 10px;">
                        
                         <div class="card d-flex justify-content-between mb-2" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); height: 8vh">
                             <div class="d-flex justify-content-between align-items-center p-3">
                                 <span>A Cat in the City</span>
                                 <span class="text-success">RETURNED</span>
                             </div>
                         </div>
                         <div class="card d-flex justify-content-between mb-2" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); height: 8vh">
                             <div class="d-flex justify-content-between align-items-center p-3">
                                 <span>A Cat in the City</span>
                                 <span class="text-success">RETURNED</span>
                             </div>
                         </div>
                         <div class="card d-flex justify-content-between mb-2" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); height: 8vh">
                             <div class="d-flex justify-content-between align-items-center p-3">
                                 <span>A Cat in the City</span>
                                 <span class="text-success">RETURNED</span>
                             </div>
                         </div>
                         <div class="card d-flex justify-content-between mb-2" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); height: 8vh">
                             <div class="d-flex justify-content-between align-items-center p-3">
                                 <span>A Cat in the City</span>
                                 <span class="text-success">RETURNED</span>
                             </div>
                         </div>
                         <div class="card d-flex justify-content-between mb-2" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); height: 8vh">
                             <div class="d-flex justify-content-between align-items-center p-3">
                                 <span>A Cat in the City</span>
                                 <span class="text-success">RETURNED</span>
                             </div>
                         </div>
                     </div>

                    </div>
                </div>

        </div>
    </div>

    </div>

</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
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
    // setup
    const data = {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
            label: 'Weekly Sales',
            data: [10, 10, 10, 10, 10, 10],
            backgroundColor: [
                'rgba(255, 26, 104, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            // borderColor: [
            //     'rgba(255, 26, 104, 1)',
            //     'rgba(54, 162, 235, 1)',
            //     'rgba(255, 206, 86, 1)',
            //     'rgba(75, 192, 192, 1)',
            //     'rgba(153, 102, 255, 1)',
            //     'rgba(255, 159, 64, 1)'
            // ],
            borderWidth: 1,
            circumference: 180,
            rotation: 270,
            cutout: '90%',
            needleValue: 10
        }]
    };
    // Create gradient for the background
    const ctx = document.getElementById('creditScore').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 400, 400, 400); // Adjust the coordinates as needed
    gradient.addColorStop(0, 'rgba(228, 63, 45, 1)');
    gradient.addColorStop(0.4, 'rgba(250, 219, 3, 1)');
    gradient.addColorStop(1, 'rgba(37, 205, 107, 1)');


    data.datasets[0].backgroundColor = gradient;
    const gaugeNeedle = {
        id: 'gaugeNeedle',
        afterDatasetsDraw(chart,args,plugins){
            const {ctx,data} = chart;

            ctx.save();
            console.log(chart.getDatasetMeta(0).data[0].x);
            const xCenter = chart.getDatasetMeta(0).data[0].x;
            const yCenter = chart.getDatasetMeta(0).data[0].y;
            const outerRadius = chart.getDatasetMeta(0).data[0].outerRadius;
            const innerRadius = chart.getDatasetMeta(0).data[0].innerRadius;

            const widthSlice = (outerRadius-innerRadius) / 2;
            const radius = 15;
            const angle = Math.PI / 180;

            const needleValue = data.datasets[0].needleValue;

            const  dataTotal = data.datasets[0].data.reduce((a,b) => a + b, 0);
            const circumference = ((chart.getDatasetMeta(0).data[0].circumference / Math.PI) /data.datasets[0].data[0]) * needleValue;



            ctx.translate(xCenter,yCenter);
            ctx.rotate(Math.PI * (circumference + 1.5));

            //needle
            ctx.beginPath();
            ctx.strokeStyle = 'grey';
            ctx.fillStyle = 'grey';
            ctx.lineWidth = 1;
            ctx.moveTo(0-15,0);
            ctx.lineTo(0,0-innerRadius - widthSlice);
            ctx.lineTo(0+15,0);
            ctx.closePath();
            ctx.stroke();
            ctx.fill();


            //dot
            ctx.beginPath();
            ctx.arc(0, 0 ,radius, angle * 0, angle * 360, false);
            ctx.fill();
            ctx.restore();
        }
    }
    // gaugeFlowMeter plugin block

    const  gaugeFlowMeter = {
        id: 'gaugeFlowMeter',
        afterDatasetsDraw(chart, args, plugins) {
            const { ctx, data} = chart;
            ctx.save();
            const needleValue = data.datasets[0].needleValue;
            const xCenter = chart.getDatasetMeta(0).data[0].x;
            const yCenter = chart.getDatasetMeta(0).data[0].y;

            const circumference = ((chart.getDatasetMeta(0).data[0].circumference / Math.PI) /data.datasets[0].data[0]) * needleValue;
            const percentageValue = circumference * 100;
            //flowMeter
            ctx.font = 'bold 30px sans-serif';
            ctx.fillStyle = 'grey';
            ctx.textAlign = 'center';
            ctx.fillText(`${percentageValue.toFixed(1)}%`, xCenter, yCenter + 50);
        }
    }
    // gauseLabels
    const gaugeLabels = {
        id: 'gaugeLabels',
        afterDatasetsDraw(chart, args, plugins){
            const { ctx, chartArea: {left, right} } = chart;
            const yCenter = chart.getDatasetMeta(0).data[0].y;
            const xCenter = chart.getDatasetMeta(0).data[0].x;
            const outerRadius = chart.getDatasetMeta(0).data[0].outerRadius;
            const innerRadius = chart.getDatasetMeta(0).data[0].innerRadius;
            const widthSlice = (outerRadius-innerRadius) / 2;

            ctx.translate(xCenter, yCenter);
            ctx.font = 'bold 15px sans-serif';
            ctx.fillStyle = 'black';
            ctx.textAlign = 'center';
            ctx.fillText('Bad', 0 - innerRadius - widthSlice,0 + 20);

            ctx.font = 'bold 15px sans-serif';
            ctx.fillStyle = 'black';
            ctx.textAlign = 'center';
            ctx.fillText('Good', 0 + outerRadius - widthSlice,0 + 20);

            ctx.restore();


        }
    }


    // config
    const config = {
        type: 'doughnut',
        data,
        options: {
            layout: {
                padding: {
                    bottom: 50
                }
            },
            aspectRatio: 1.8,
            plugins: {
                legend: {
                    display:false
                },
                tooltip: {
                    enable: false
                }
            }
        },
        plugins: [gaugeNeedle, gaugeFlowMeter, gaugeLabels]
    };

    // render init block
    const myChart = new Chart(
        document.getElementById('creditScore'),
        config
    );

    // Instantly assign Chart.js version
    const chartVersion = document.getElementById('chartVersion');
    chartVersion.innerText = Chart.version;



</script>
</body>


</html>
