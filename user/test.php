<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Getting Started with Chart JS with www.chartjs3.com</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }
        .chartMenu {
            width: 100vw;
            height: 40px;
            background: #1A1A1A;
            color: rgba(54, 162, 235, 1);
        }
        .chartMenu p {
            padding: 10px;
            font-size: 20px;
        }
        .chartCard {
            width: 100vw;
            height: calc(100vh - 40px);
            background: rgba(54, 162, 235, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .chartBox {
            width: 700px;
            padding: 20px;
            border-radius: 20px;
            border: solid 3px rgba(54, 162, 235, 1);
            background: white;
        }
    </style>
</head>
<body>
<div class="chartMenu">
    <p>WWW.CHARTJS3.COM (Chart JS <span id="chartVersion"></span>)</p>
</div>
<div class="chartCard">
    <div class="chartBox">
        <canvas id="myChart"></canvas>
    </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
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
    const ctx = document.getElementById('myChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 400, 400, 400); // Adjust the coordinates as needed
    gradient.addColorStop(0, 'rgba(228, 63, 45, 1)');
    gradient.addColorStop(0.7, 'rgba(250, 219, 3, 1)');
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
                ctx.fillText('Danger', 0 - innerRadius - widthSlice,0 + 20);

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
        document.getElementById('myChart'),
        config
    );

    // Instantly assign Chart.js version
    const chartVersion = document.getElementById('chartVersion');
    chartVersion.innerText = Chart.version;
</script>

</body>
</html>