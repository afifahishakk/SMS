<?php
include "../conn/conn.php";
session_start();
$year = $_SESSION['year'];

echo $year;

$sql = mysql_query("SELECT *, MONTHNAME(p_date) AS bulan, SUM(p_amount) AS sum FROM profit WHERE YEAR(p_date) = '$year' GROUP BY MONTH(p_date)");

//$koneksi     = mysqli_connect("localhost", "root", "", "latihan");
//$bulan       = mysqli_query($koneksi, "SELECT *, MONTHNAME(bulan) AS bulan FROM penjualan WHERE YEAR(bulan)='2017' order by MONTH(bulan) asc");
//$penghasilan = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE YEAR(bulan)='2017' order by id asc");
?>
<html>
    <head>
        <title>ChartJS</title>
        <script src="Chart.bundle.js"></script>

        <style type="text/css">
            .container {
                width: 50%;
                margin: 15px auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <canvas id="myChart" width="100" height="100"></canvas>
        </div>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php while ($b = mysql_fetch_array($sql)) { echo '"' . $b['bulan'] . '",';}?>],
                    datasets: [{
                            label: 'Total Profit',
                            data: [<?php while ($p = mysql_fetch_array($sql)) { echo '"' . $p['sum'] . '",';}?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
    </body>
</html>