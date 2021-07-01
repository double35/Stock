<?php

include 'header.php';
include 'netting/baglan.php';

//yetki
$asd = $_SESSION['kullanici_adi'];
$sorgu=$db->query("SELECT * FROM kullanici where kullanici_adi='$asd'");
$kullanici=$sorgu->fetch(PDO::FETCH_ASSOC);

if ($kullanici['yetki']=="0") {
    header('Location:index.php');
}
?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Müşteri</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                            <li class="breadcrumb-item active">Müşteri</li>
                        </ol>
                    </div>
                </div>
            </div>
            <?php
            if (@$_GET['durum']=='ok'){  ?>

                <b style="color:green;">Kayıt Başarılı</b>

            <?php }  elseif (@$_GET['durum']=='no') {?>
                <b style="color:red;">Kayıt Başarısız</b>
            <?php } ?>


            <form method="post" enctype="multipart/form-data" action="netting/islem.php" data-parsley-validate class="form-horizontal form-label-left">
                <div class="card card-info">
                    <div class="card-header" >
                        <h3 class="card-title">Müşteri Bilgisi</h3>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3"style="width: 85%">
                            <div class="input-group-append" >
                                <span class="input-group-text"><i class="fas fa-user"></i></i></span>
                            </div>
                            <input type="text"  name="musteri_ad" class="form-control" placeholder="Adı">
                        </div>
                        <div class="input-group mb-3"style="width: 85%">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="musteri_soyad" class="form-control" placeholder="Soyadı">
                        </div>
                        <div class="input-group mb-3"style="width: 85%">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-building"></i></span>
                            </div>
                            <input type="text" name="musteri_sirket" class="form-control" placeholder="Şirket">
                        </div>
                        <div class="input-group mb-3"style="width: 85%">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input type="text" name="musteri_email" class="form-control" placeholder="Email">
                        </div>
                        <div class="input-group mb-3"style="width: 85%">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" name="musteri_tel" class="form-control" placeholder="Telefon">
                        </div>
                        <div class="input-group mb-3"style="width: 85%">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                            </div>
                            <input type="text" name="musteri_adres" class="form-control" placeholder="Adres">
                        </div>
                        <div class="input-group" style="width: fit-content">
                            <div class="input-group-append">
                                <span class="input-group-text">İL</span>
                            </div>
                            <input name="musteri_il" type="text"  class="form-control" >
                            <div class="input-group-append" style="margin-left: 20px">
                                <span  class="input-group-text" ">İLÇE</span>
                            </div>
                            <input name="musteri_ilce" type="text"  class="form-control" >

                        </div>
                        <div style="margin-top: 20px">
                        <button type="submit" name="musteri_kaydet" class="btn btn-info" >Kaydet</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
<?php

include 'sidebar.php';
include 'footer.php';
?>