<body>
<div class="container-admin">
    <?php
    require_once 'views/sidebar.php';
    $sumSales = sumSales();
    extract($sumSales);
    $sumOrders = sumOrders();
    extract($sumOrders);
    $sumProducts = sumProducts();
    extract($sumProducts);
    $sumUsers = sumUsers();
    extract($sumUsers);
    ?>
    <div class="col-2-admin">
        <div class="commodities-title">
            <h4>Bảng điều khiển<h4>
        </div>
        <div class="dashboard">
            <div class="component-dashboard">
                <div class="child-dashboard red">
                    <div>
                        <h1>$ <?php if($sumSales != NULL){
                            echo number_format($sumSales, 0, '.', '.');
                            }else{
                            echo 0;
                            }?></h1>
                        <p>Doanh số</p>
                    </div>
                </div>
                <div class="child-dashboard blue">
                    <div>
                        <h1><?= $sumOrders?></h1>
                        <p>Đơn hàng</p>
                    </div>
                </div>
                <div class="child-dashboard orange">
                    <div>
                        <h1><?= $sumProducts?></h1>
                        <p>Sản phẩm</p>
                    </div>
                </div>
                <div class="child-dashboard green">
                    <div>
                        <h1><?= $sumUsers?></h1>
                        <p>Khách hàng</p>
                    </div>
                </div>
            </div>
            <div class="chart">
                <div class="chart-bar">
                    <canvas id="myChartBar" style="max-width:900px"></canvas>
                </div>
                <div></div>
                <div class="chart-area">
                    <canvas id="myChartArea" style="max-width:900px"></canvas>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
<?php
$dataDashboardTwo= select_statistical();
$dataTwo = [];
foreach ($dataDashboardTwo as $value) {
    $dataTwo[] = [
        'name' => $value['name_category'],
        'total' => $value['count'],
    ];
}
$listDataTwo = json_encode($dataTwo);




$dataDashboardOne = dashboard();
$dataOne = [];
foreach ($dataDashboardOne as $value) {
    $dataOne[] = [
'name' => $value['name_product'],
'total' => $value['total'],
];
}
$listDataOne = json_encode($dataOne);
?>
<script>
    const TdT = <?php echo $listDataOne; ?>;
    const labels = TdT.map(data => data.name);
    const data = {
        labels: labels,
        datasets: [{
            label: 'Số lượng đã bán',
            data: TdT.map(data => data.total),
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };
    new Chart("myChartBar", {
        type: 'bar',
        data,
        options: {
            indexAxis: 'y',
        }
    });


    const TdTTwo = <?php echo $listDataTwo; ?>;
    const dataArea = {
        labels: TdTTwo.map(data => data.name),
        datasets: [{
            label: 'Số lượng sản phẩm',
            data: TdTTwo.map(data => data.total),
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(75, 192, 192)',
                'rgb(255, 205, 86)',
                'rgb(201, 203, 207)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(255, 159, 64)'
            ]
        }]
    };

    new Chart("myChartArea", {
        type: 'polarArea',
        data: dataArea,
        options: {}
    });
</script>
