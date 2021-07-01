<?php

include 'header.php';
include 'netting/baglan.php';
$urun = $db->prepare('select * from urunler order by id');
$urun->execute();
$u = $urun->rowCount();

$depo = $db->prepare('select * from depo order by id');
$depo->execute();
$d = $depo->rowCount();

$musteri = $db->prepare('select * from musteri order by id');
$musteri->execute();
$k = $musteri->rowCount();

$kasa = $db->prepare('select * from kasa order by id');
$kasa->execute();
$m = $kasa->rowCount();


$query=$db->prepare("SELECT * from stok WHERE id=:id");
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
            <?php

            if (@$_GET['durum']=='ok'){  ?>

                <b style="color:green;">Kayıt Başarılı</b>

            <?php }  elseif (@$_GET['durum']=='no') {?>
                <b style="color:red;">Kayıt Başarısız</b>
            <?php } ?>
            <br>
            <form method="post" action="netting/islem.php" class="form-horizontal form-label-left">
                <div class="card card-info">
                    <div class="card-header" >
                        <h3 class="card-title">Stok Düzenleme</h3>
                    </div>

                    <div class="input-group" style="width: 70%;margin-top: 5px;margin-left: 5px">
                        <label class="input-group-text" style="border-radius: 0%;width: 10%" >Ürün </label>
                        <input type="hidden" name="id" value="<?php echo $sor['id']; ?>">
                        <select name="urun_id" class="form-control" style="...">
                            <?php
                            foreach ($urun as $key => $value) { ?>
                                <option <?php if ($sor['urun_id']==$value['id']){ echo 'selected'; }?> value="<?php echo $value['id']; ?>"><?php echo $value['urun_adi']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <br>
                    <div class="input-group mb-3" style="width: 70%;margin-left: 5px">
                        <label class="input-group-text"style="border-radius: 0%;width: 10%" >Kasa</label>
                        <select name="kasa_id" class="form-control" style="...">
                            <?php
                            foreach ($kasa as $key => $value) { ?>
                                <option <?php if ($sor['kasa_id']==$value['id']){ echo 'selected'; }?> value="<?php echo $value['id']; ?>"><?php echo $value['kasa_adi']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <br>
                    <div class="input-group mb-3" style="width: 70%;margin-left: 5px">
                        <label class="input-group-text" style="border-radius: 0%;width: 10%">Müşteri</i></label>
                        <select name="musteri_id" class="form-control" style="...">
                            <?php
                            foreach ($musteri as $key => $value) { ?>
                                <option <?php if ($sor['musteri_id']==$value['id']){ echo 'selected'; }?> value="<?php echo $value['id']; ?>"><?php echo $value['musteri_ad']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <br>
                    <div class="input-group mb-3 " style="width: 70%;margin-left: 5px">
                        <label class="input-group-text" style="border-radius: 0%;width: 10%">Depo</i></label>
                        <select name="depo_id" class="form-control" style="...">
                            <?php
                            foreach ($depo as $key => $value) { ?>
                                <option <?php if ($sor['depo_id']==$value['id']){ echo 'selected'; }?> value="<?php echo $value['id']; ?>"><?php echo $value['depo_adi']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <br>
                    <div class="input-group mb-3"style="width: 70%">
                        <label class="input-group-text" style="border-radius: 0%;margin-left: 5px;width: 10%">İşlem Türü</label>
                        <select name="islem_tipi" id="" class="form-control">
                            <option value="0">Stok Giriş</option>
                            <option value="1">Stok Çıkış</option>
                        </select>
                    </div>
                    <br>
                    <div class="input-group mb-3"style="width: 70%">
                        <label class="input-group-text" style="border-radius: 0%;margin-left: 5px;width: 10%">Miktar</i></label>
                        <input type="text" value="<?php echo $sor['adet']; ?>" name="adet" value="" class="form-control"
                               placeholder="...">
                    </div>
                    <br>
                    <div class="input-group mb-3" style="width: 70%">
                        <label class="input-group-text" style="border-radius: 0%;margin-left: 5px;width: 10%">Fiyat</i></label>
                        <input type="text" name="fiyat" value="<?php echo $sor['fiyat']; ?>" class="form-control"
                               placeholder="...">
                    </div>
                    <button name="stok_guncelle" type="submit" class="btn btn-info" style="width:10%;margin-bottom:10px;margin-left: 10px">Onayla</button>
                </div>

            </form>
    </div>
    </section>


<?php

include 'sidebar.php';
include 'footer.php';
?>