<?php

include 'header.php';
include 'netting/baglan.php';
$query=$db->prepare("SELECT * from kasa WHERE id=:id");
$query->execute(array(
    'id' =>@$_GET['id']
));
$sor=$query->fetch(PDO::FETCH_ASSOC);

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
                                <h3 class="card-title">Kasa Düzenleme<small></small></h3>
                            </div>
                            <?php

                            if (@$_GET['durum']=='ok'){  ?>

                                <b style="color:green;">Güncelleme Başarılı</b>

                            <?php }  elseif (@$_GET['durum']=='no') {?>
                                <b style="color:red;">Güncelleme Başarısız</b> <?php
                            } ?> </h2>


                            </h2><br>

                            <form action="netting/islem.php" method="post">
                                <div class="card-body">
                                    <div class="input-group mb-3"style="width: 60%">
                                        <div class="input-group-prepend"">
                                            <span style="border-radius: 0px" class="input-group-text"><i class="fas fa-landmark"></i></span>
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $sor['id']; ?>"/>
                                        <input type="text" value="<?php echo $sor['kasa_adi']; ?>" name="kasa_adi_duzenle" class="form-control" id="exampleInputEmail1" placeholder="...">
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" name="kasa_duzenle" class="btn btn-info">Onayla</button>
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