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
                    <h1>Kasa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                        <li class="breadcrumb-item active">Kasa</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Kasa Ekle<small></small></h3>
                        </div>
                        <?php

                        if (@$_GET['caseCreate']=='ok'){  ?>

                            <b style="color:green;">Kayıt Başarılı</b>

                        <?php }  elseif (@$_GET['caseCreate']=='no') {?>
                            <b style="color:red;">Kayıt Başarısız</b> <?php
                        } ?> </h2>


                        </h2><br>
                        <form action="netting/islem.php" method="post">
                            <div class="card-body">
                            <div class="input-group mb-3"style="width: 60%">
                                <div class="input-group-prepend"">
                                <span style="border-radius: 0px" class="input-group-text"><i class="fas fa-landmark"></i></span>
                            </div>
                            <input type="text" name="kasa_adi" class="form-control" id="exampleInputEmail1" placeholder="Case Name">

                            </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="kasa_ekle" class="btn btn-info">Kaydet</button>
                            </div>
                        </form>
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