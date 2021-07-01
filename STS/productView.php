<?php
include 'header.php';
include 'netting/baglan.php';
if (isset($_POST['arama'])) {
    $aranan=$_POST['aranan'];
    $query=$db->prepare("SELECT * from urunler where urun_no LIKE '%$aranan%' order by id ASC limit 25");
    $query->execute();
    $say=$query->rowCount();
} else {
    $query = $db->prepare('select * from urunler order by id');
    $query->execute();
    $say = $query->rowCount();
}

//yetki
$yetki = $_SESSION['kullanici_adi'];
$sorgu=$db->query("SELECT * FROM kullanici where kullanici_adi='$yetki'");
$kullanicicek=$sorgu->fetch(PDO::FETCH_ASSOC);
?>
    <div class="content-wrapper">
        <script>
            function ShowConfirm() {
                var confirmation = confirm("Emin misiniz?");
                if (confirmation) {
                    alert("Kayıt Silinmiştir.");
                }
                return confirmation;
            };
        </script>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ürünler</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                            <li class="breadcrumb-item active">Ürünler</li>
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
                            <h3 class="card-title">Ürün Listesi</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="aranan" class="form-control float-right"
                                           placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" name="arama" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Ürün</th>
                            <th>Ürün No</th>
                            <th>Ürün Adı</th>
                            <th>Marka</th>
                            <th>Fiyat</th>
                            <th>Açıklama</th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php while($sor=$query->fetch(PDO::FETCH_ASSOC)) {?>
                            <tr>

                                <td><img style="width: 100px;height: 100px" src="<?php echo $sor['resim_yol']; ?>" alt=""></td>
                                <td><?php echo $sor['urun_no']; ?></td>
                                <td><?php echo $sor['urun_adi']; ?></td>
                                <td><?php echo $sor['urun_marka']; ?></td>
                                <td><?php echo $sor['urun_fiyat']; ?></td>
                                <td><?php echo $sor['urun_aciklama']; ?></td>

                                <td><?php if ($kullanicicek['yetki']=="1") { ?>
                                    <a href="productEdit.php?id=<?php echo $sor['id']; ?>"> <button style="border-radius: 250px" class="btn btn-primary btn-xm" ><i  class="success fa fa-pencil-alt"adia-hideden="true"></i> </button> </a>
                                    <a onclick="return ShowConfirm();" href="netting/islem.php?urunsil=ok&id=<?php echo $sor['id']; ?>&resim_yol=<?php echo $sor['resim_yol']; ?>"><button style="border-radius: 250px" class="btn btn-danger btn-xm" ><i  class="success fa fa-trash-alt"adia-hideden="true"></i> </button></a>
                                    <?php   } ?>
                                </td>
                            </tr>
                        <?php  } ?>
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