<?php

include 'header.php';
include 'netting/baglan.php';
$query=$db->prepare("SELECT * from kullanici WHERE id=:id");
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
                    <h1>Kullanıcılar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                        <li class="breadcrumb-item active">Kullanıcılar</li>
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
                <div class="card-header">
                    <h3 class="card-title">Kullanıcı Düzenleme</h3>
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></i></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $sor['id'];?> " >
                        <input type="text" name="ad" value="<?php echo $sor['ad'];?>" class="form-control" placeholder="Adı">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="soyad" value="<?php echo $sor['soyad'];?>" class="form-control" placeholder="Soyadı">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="kullanici_adi" value="<?php echo $sor['kullanici_adi'];?>" class="form-control" placeholder="Kullanıcı Adı">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                        </div>
                        <input type="text" name="email" value="<?php echo $sor['email'];?>" class="form-control" placeholder="Email">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="text" name="password" value="<?php echo $sor['password'];?>" class="form-control" placeholder="Password">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user-edit"></i></span>
                        </div>
                        <input type="text" name="yetki" value="<?php echo $sor['yetki'];?>" class="form-control" placeholder="Yetki">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" name="telefon" value="<?php echo $sor['telefon'];?>" class="form-control" placeholder="Telefon">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                        </div>
                        <input type="text" name="adres" value="<?php echo $sor['adres'];?>" class="form-control" placeholder="Adres">
                    </div>
                    <button type="submit" name="user_edit" class="btn btn-info">Onayla</button>
                </div>
            </div>
        </form>
    </section>
</div>
<?php

include 'sidebar.php';
include 'footer.php';
?>
