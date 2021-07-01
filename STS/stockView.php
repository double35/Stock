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
$urun = $db->prepare('select * from urunler order by id');
$urun->execute();
$say = $urun->rowCount();

$kasa = $db->prepare('select * from kasa order by id');
$kasa->execute();
$say = $kasa->rowCount();

$depo = $db->prepare('select * from depo order by id');
$depo->execute();
$say = $depo->rowCount();

$musteri = $db->prepare('select * from musteri order by id');
$musteri->execute();
$say = $musteri->rowCount();

//yetki
$yetki = $_SESSION['kullanici_adi'];
$sorgu = $db->query("SELECT * FROM kullanici where kullanici_adi='$yetki'");
$kullanicicek = $sorgu->fetch(PDO::FETCH_ASSOC);
?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Stok</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                            <li class="breadcrumb-item active">Stok</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="" method="post">
                        <div class="card-header" style="background-color: #28a745 ">
                            <h3 class="card-title">Stok Listesi</h3>


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
                <!-- /.card-header -->
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
                                <?php if ($kullanicicek['yetki'] == "1") { ?>
                                    <td class="text-center "><a href="stockEdit.php?id=<?php echo $sor['id']; ?>">
                                            <button style="border-radius: 250px" class="btn btn-primary btn-xm"><i
                                                        class="success fa fa-pencil-alt" adia-hideden="true"></i>
                                            </button>
                                        </a>
                                        <a onclick="return ShowConfirm();"
                                           href="netting/islem.php?stoksil=ok&id=<?php echo $sor['id']; ?>">
                                            <button style="border-radius: 250px" class="btn btn-danger btn-xm"><i
                                                        class="success fa fa-trash-alt" adia-hideden="true"></i>
                                            </button></td>
                                <?php } ?>
                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

<?php

include 'sidebar.php';
include 'footer.php';
?>