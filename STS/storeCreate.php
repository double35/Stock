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
                        <h1>Depo</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                            <li class="breadcrumb-item active">Depo</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <?php
        if (@$_GET['durum']=='ok'){  ?>

            <b style="color:green;">Kayıt Başarılı</b>

        <?php }  elseif (@$_GET['durum']=='no') {?>
            <b style="color:red;">Kayıt Başarısız</b>
        <?php } ?>


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Depo Kaydet<small></small></h3>
                            </div>
                            <?php

                            if (@$_GET['categoryCreate']=='ok'){  ?>

                                <b style="color:green;">Kayıt Başarılı</b>

                            <?php }  elseif (@$_GET['categoryCreate']=='no') {?>
                                <b style="color:red;">Kayıt Başarısız</b> <?php
                            } ?> </h2>


                            </h2><br>
                            <form action="netting/islem.php" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Depo Bilgisi</label>
                                        <input type="text" style="width: 60%" name="depo_adi" class="form-control" id="exampleInputEmail1" placeholder="Depo Adı">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="depo_adres"  style="width: 60%" class="form-control" rows="3" placeholder="Adres"></textarea>
                                    </div>

                                    <div class="input-group" style="width: fit-content">
                                        <div class="input-group-append">
                                            <span class="input-group-text">İL</span>
                                        </div>
                                        <input name="depo_il" type="text"  class="form-control" >
                                        <div class="input-group-append" style="margin-left: 20px">
                                            <span  class="input-group-text" ">İLÇE</span>
                                        </div>
                                        <input name="depo_ilce" type="text"  class="form-control" >

                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" name="depo_kaydet" class="btn btn-info">Kaydet</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
        </section>
    </div>



<?php

include 'sidebar.php';


include 'footer.php';
?>