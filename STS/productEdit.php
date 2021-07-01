<?php

include 'header.php';
include 'netting/baglan.php';
$sorgu = $db->prepare('select * from kategori order by id');
$sorgu->execute();
$say = $sorgu->rowCount();
$query=$db->prepare("SELECT * from urunler WHERE id=:id");
$query->execute(array(
    'id' =>@$_GET['id']
));
$sor=$query->fetch(PDO::FETCH_ASSOC);

//yetki
$asd = $_SESSION['kullanici_adi'];
$sorguu=$db->query("SELECT * FROM kullanici where kullanici_adi='$asd'");
$kullanici=$sorguu->fetch(PDO::FETCH_ASSOC);

if ($kullanici['yetki']=="0") {
    header('Location:index.php');
}
?>
    <div class="content-wrapper">
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
            <?php

            if (@$_GET['durum']=='ok'){  ?>

                <b style="color:green;">Güncelleme Başarılı</b>

            <?php }  elseif (@$_GET['durum']=='no') {?>
                <b style="color:red;">Güncelleme Başarısız</b>
            <?php }
            ?>


            <br>
            <form method="post" enctype="multipart/form-data" action="netting/islem.php" data-parsley-validate class="form-horizontal form-label-left">
                <div class="card card-info">
                    <div class="card-header" >
                        <h3 class="card-title">Ürün Düzenleme</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group"style="width: 40%">
                            <div class="input-group">
                                <input type="hidden" id="first-name" value="<?php echo $sor['id'] ?>" required="required" name="id"  class="custom-file-input">
                                <div class="custom-file">
                                    <input type="file" id="first-name" value="<?php echo $sor['resim_yol'] ?>" required="required" name="resim_yol" class="custom-file-input" >
                                    <label class="custom-file-label"  for="first-name">Choose file <span class="required"></span></label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-upload"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input name="urun_no" type="text" value="<?php echo $sor['urun_no'] ?>" class="form-control" placeholder="Ürün No">
                        </div>
                        <div class="input-group mb-3">
                            <input name="urun_adi" type="text" value="<?php echo $sor['urun_adi'] ?>" class="form-control" placeholder="Ürün Adı">
                        </div>
                        <div class="input-group mb-3">
                            <input name="urun_marka" type="text" value="<?php echo $sor['urun_marka'] ?>" class="form-control" placeholder="Marka">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tags nav-icon"></i></span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input name="urun_fiyat" type="text" value="<?php echo $sor['urun_fiyat'] ?>" class="form-control" placeholder="Fiyat">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lira-sign"></i></span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input name="urun_barkod" type="text" value="<?php echo $sor['urun_barkod'] ?>" class="form-control" placeholder="BRkod">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-barcode nav-icon"></i></span>
                            </div>
                        </div>
                        <div class="card-columns">

                            <select name="kategori_id"  class="form-control" style="..." >
                                <?php
                                foreach ($sorgu as $key => $value) {?>
                                    <option <?php if ($sor['kategori_id']==$value['id']){ echo 'selected'; }?> value="<?=$value['id'];?>"><?=$value['kategori_adi'];?></option>
                                <?php  } ?>
                            </select>

                        </div>


                        <div class="form-group">
                            <h5 class="mt-4 mb-2">Ürün Hakkında</h5>
                            <textarea name="urun_aciklama"  class="form-control" rows="3" placeholder="Açıklama"><?php echo $sor['urun_aciklama'] ?></textarea>
                        </div>
                        <button name="urun_duzenle" type="submit" class="btn btn-info" >Onayla</button>
                    </div>
                </div>
            </form>
    </div>
    </section>
<?php

include 'sidebar.php';
include 'footer.php';
?>