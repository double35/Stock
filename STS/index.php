<?php
include 'header.php';
include 'netting/baglan.php';
if (isset($_POST['arama'])) {
    $aranan = $_POST['aranan'];
    $query = $db->prepare("SELECT * from stok where urun_id LIKE '%$aranan%' order by id ASC limit 25");
    $query->execute();
    $say = $query->rowCount();
} else {
    $query = $db->prepare('select * from stok order by id');
    $query->execute();
    $say = $query->rowCount();
}
//Stock List
$urun = $db->prepare('select * from urunler order by id');
$urun->execute();
$usay = $urun->rowCount();

$kasa = $db->prepare('select * from kasa order by id');
$kasa->execute();
$ksay = $kasa->rowCount();

$depo = $db->prepare('select * from depo order by id');
$depo->execute();
$dsay = $depo->rowCount();

$musteri = $db->prepare('select * from musteri order by id');
$musteri->execute();
$msay = $musteri->rowCount();

$kullanici = $db->prepare('select * from kullanici order by id');
$kullanici->execute();
$kusay = $kullanici->rowCount();

$fiyatG = $db->prepare("select SUM(fiyat*adet) as toplam from stok where urun_id  and islem_tipi = '0'");
$fiyatG->execute();
$say = $fiyatG->rowCount();
$fiyatGG = $fiyatG->fetch(PDO::FETCH_ASSOC);

$fiyatC = $db->prepare("select SUM(fiyat*adet) as toplam from stok where urun_id  and islem_tipi = '1'");
$fiyatC->execute();
$say = $fiyatC->rowCount();
$fiyatCC = $fiyatC->fetch(PDO::FETCH_ASSOC);

$sorgu = $db->prepare('select * from urunler order by id');
$sorgu->execute();
$sorgusay = $sorgu->rowCount();

?>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4><?php echo $msay ?> </h4>
                                <p>Müşteriler</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-tie fa-lg nav-icon"></i>
                            </div>
                            <a href="customerCreate.php" class="small-box-footer">Yeni Kayıt <i
                                        class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4><?php echo $dsay ?> </h4>

                                <p>Depolar</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-warehouse nav-icon"></i>
                            </div>
                            <a href="storeCreate.php" class="small-box-footer">Yeni Kayıt <i
                                        class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">

                                <h4><?php echo $ksay ?> </h4>
                                <p>Kasalar</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-landmark nav-icon"></i>
                            </div>
                            <a href="caseCreate.php" class="small-box-footer">Yeni Kayıt <i
                                        class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">

                                <h4><?php echo $kusay ?> </h4>
                                <p>Kullanıcılar</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-cog"></i>
                            </div>
                            <a href="userCreate.php" class="small-box-footer">Yeni Kayıt <i
                                        class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <div class="content-wrapper" style="margin-left: 5px;width:70%">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">


                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="" method="post">
                            <div class="card-header">
                                <h3 class="card-title">Stok Listesi</h3>
                                <div class="input-group" style="width: fit-content;margin-left: 60%">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Girdi</span>
                                    </div>
                                    <input disabled name="girdi" value="<?php echo $fiyatCC['toplam'] ?>" type="text"
                                           class="form-control">
                                    <div class="input-group-append" style="margin-left: 20px">
                                        <span class="input-group-text" ">Çıktı</span>
                                    </div>
                                    <input disabled name="cikti" value="<?php echo -$fiyatGG['toplam'] ?>" type="text"
                                           class="form-control">

                                </div>

                        </form>
                    </div>
                    <script>
                        function ShowConfirm() {
                            var confirmation = confirm("Emin misiniz?");
                            if (confirmation) {
                                alert("Kayıt Silinmiştir.");
                            }
                            return confirmation;
                        };
                    </script>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>Ürün Adı</th>
                                <th>Kasa Adı</th>
                                <th>Müşteri Adı</th>
                                <th>Depo Adı</th>
                                <th>İşlem Türü</th>
                                <th>Adet</th>
                                <th>fiyat</th>
                                <th>Maaliyet</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            while ($sor = $query->fetch(PDO::FETCH_ASSOC)) {
                                $u = $urun->fetch(PDO::FETCH_ASSOC);
                                if ($sor['urun_id'] == $u['id']) {
                                    $ur = $u['urun_adi'];
                                }

                                $k = $kasa->fetch(PDO::FETCH_ASSOC);
                                if ($sor['kasa_id'] == $k['id']) {
                                    $ka = $k['kasa_adi'];
                                }

                                $m = $musteri->fetch(PDO::FETCH_ASSOC);
                                if ($sor['musteri_id'] == $m['id']) {
                                    $mu = $m['musteri_ad'];
                                }

                                $d = $depo->fetch(PDO::FETCH_ASSOC);
                                if ($sor['depo_id'] == $d['id']) {
                                    $de = $d['depo_adi'];
                                }


                                if ($sor['islem_tipi'] == 0) {
                                    $islem = "Stok Giriş";
                                    $toplamfiyat = "-" . $sor['adet'] * $sor['fiyat'];
                                } else {
                                    $islem = "Stok Çıkış";
                                    $toplamfiyat = $sor['adet'] * $sor['fiyat'];
                                }
                                ?>

                                <tr>

                                    <td><?php echo $ur; ?></td>
                                    <td><?php echo $ka; ?></td>
                                    <td><?php echo $mu; ?></td>
                                    <td><?php echo $de; ?></td>
                                    <td><?php echo $islem; ?></td>
                                    <td><?php echo $sor['adet']; ?></td>
                                    <td><?php echo $sor['fiyat']; ?></td>
                                    <td><?php echo $toplamfiyat; ?></td>
                                </tr>
                                <?php
                            }

                            ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="stockCreate.php" style="margin-left: 90%" class="badge badge-success">Yeni Kayıt <i
                                    class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <style>

                .container {
                    margin: 30px auto;

                    display: flex;
                    flex-wrap: wrap;
                    text-align: center;

                }

                .box {
                    margin: 20px 30px;
                    width: 230px;
                    height: 400px;

                }

                .pht {
                    width: 100%;
                    height: 50%;

                }

                .tex {

                    width: 100%;
                    height: 50%;

                }

                img {
                    width: 100%;


                }

                .mpht {
                    background-color: rgb(214, 214, 214);
                    padding: 20px 20px 15px 20px;
                    transition: 0.5s;

                }

                .mpht:hover {
                    padding: 0;
                    transition: 0.5s;

                }

                .box:hover {
                    box-shadow: 1px 1px 20px black;
                    transition: 0.5s;

                }

                .link {
                    background-color: greenyellow;
                }


            </style>

                    <div class="card-footer" style="width: 2000px">
                        <div class="card card-btn" style="width: 100px;margin-left: 800px">
                            <a href="productCreate.php" class="badge badge-success">Yeni Kayıt <i class="fas fa-plus"></i></a>
                        </div>
                            <div class="container">
                                <?php while ($sorgusay = $sorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <div class="form-group">


                                        <div class="box" style="background-color: skyblue">
                                            <div class="pht">
                                                <div class="mpht">
                                                    <img style="max-width: 100%;height: auto"
                                                         src="<?php echo $sorgusay['resim_yol']; ?>" alt="">
                                                </div>
                                            </div>

                                            <div class="tex">
                                                <div class="text-area" style="margin-top: 40px">
                                                    <p style="font-size: 20px"><?php echo $sorgusay['urun_adi'] ?> </p>
                                                    <p><?php echo $sorgusay['urun_aciklama'] ?></p>
                                                    <p style="font-size: large"><?php echo $sorgusay['urun_fiyat'] ?> <i
                                                                class="fas fa-lira-sign"></i></p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php } ?>

                            </div>

                    </div>
            </div>
        </div>
</div>



<?php
include 'sidebar.php';
include 'footer.php';
?>