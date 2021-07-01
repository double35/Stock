<?php

include 'header.php';
include 'netting/baglan.php';
$exp = '';
$rev = '';

$urun = $db->prepare("select SUM(adet) from stok where urun_id  and islem_tipi = '0'");
$urun->execute();
$say = $urun->rowCount();
$giris = $urun->fetch(PDO::FETCH_ASSOC);

$cikisU = $db->prepare("select SUM(adet) from stok where urun_id  and islem_tipi = '1'");
$cikisU->execute();
$say = $cikisU->rowCount();
$cikis = $cikisU->fetch(PDO::FETCH_ASSOC);

$fiyatG = $db->prepare("select SUM(fiyat*adet) as toplam from stok where urun_id  and islem_tipi = '0'");
$fiyatG->execute();
$say = $fiyatG->rowCount();
$fiyatGG = $fiyatG->fetch(PDO::FETCH_ASSOC);

$fiyatC = $db->prepare("select SUM(fiyat*adet) as toplam from stok where urun_id  and islem_tipi = '1'");
$fiyatC->execute();
$say = $fiyatC->rowCount();
$fiyatCC = $fiyatC->fetch(PDO::FETCH_ASSOC);

?>


<div class="content-wrapper" >
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">

                    <!-- DONUT CHART -->
                    <div class="card card-info">
                        <div class="card-header" >
                            <h3 class="card-title">Stok Raporu</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="donutChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>

                    </div>


                    <!-- PIE CHART -->
                    <div class="card card-info">
                        <div class="card-header" >
                            <h3 class="card-title" >Maaliyet Raporu</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </section>
</div>


<?php

include 'sidebar.php';
include 'footer.php';


?>
<script>
    $(function () {

        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Stok Giriş',
                'Stok Çıkış'
            ],
            datasets: [
                {
                    <?php

                    ?>
                    data: [<?php echo $giris['SUM(adet)']?>,<?php echo $cikis['SUM(adet)']?>],


                    backgroundColor: ['#00A7FF', '#F5D41E', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }
            ]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        var donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })


        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData = {
            labels: [
                'Gider',
                'Gelir'
            ],
            datasets: [
                {
                    <?php


                    ?>
                    data: [<?php echo $fiyatCC['toplam']?>,<?php echo -$fiyatGG['toplam']?>],


                    backgroundColor: ['#1CE882', '#F59914', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }
            ]
        }
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }

        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        })
    })
</script>
