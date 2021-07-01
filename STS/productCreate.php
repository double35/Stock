<?php

include 'header.php';
include 'netting/baglan.php';
$query = $db->prepare('select * from kategori order by id');
$query->execute();
$say = $query->rowCount();

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

                <b style="color:green;">Kayıt Başarılı</b>

            <?php }  elseif (@$_GET['durum']=='no') {?>
                <b style="color:red;">Kayıt Başarısız</b>
            <?php } ?>


            <br>
            <form method="post" enctype="multipart/form-data" action="netting/islem.php" data-parsley-validate class="form-horizontal form-label-left">
                <div class="card card-info">
                    <div class="card-header" >
                        <h3 class="card-title">Ürün Kayıt</h3>
                    </div>
                    <div class="card-body" >
                        <div class="form-group"style="width: 40%">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="first-name"  required="required" name="resim_yol" class="custom-file-input" >
                                    <label class="custom-file-label"  for="first-name">Choose file <span class="required"></span></label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-upload"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3" style="width: 85%">
                            <input name="urun_no" type="text" class="form-control" placeholder="Ürün No">
                        </div>
                        <div class="input-group mb-3" style="width: 85%">
                            <input name="urun_adi" type="text" class="form-control" placeholder="Ürün Adı">
                        </div>
                        <div class="input-group mb-3" style="width: 85%">
                            <div class="input-group-prepend">
                                <span style="border-radius: 0%" class="input-group-text"><i class="fas fa-tags nav-icon"></i></span>
                            </div>
                            <input name="urun_marka" type="text" class="form-control" placeholder="Marka">
                        </div>
                        <div class="input-group mb-3" style="width: 85%">
                            <div class="input-group-prepend">
                                <span style="border-radius: 0%" class="input-group-text"><i class="fas fa-lira-sign"></i></span>
                            </div>
                            <input name="urun_fiyat" type="text" class="form-control" placeholder="Fiyat">
                        </div>
                        <div class="input-group mb-3" style="width: 85%" >
                            <div class="input-group-prepend">
                                <span style="border-radius: 0%" class="input-group-text"><i class="fas fa-barcode"></i></span>
                            </div>
                            <input name="urun_barkod"  type="text" class="form-control" placeholder="BRkod">

                        </div>
                        <h7>Kategori</h7>
                        <div class="card-columns">
                            <select name="kategori_id" class="form-control" style="..." >

                                <?php
                                foreach ($query as $key => $value) {?>
                                    <option  value="<?php echo $value['id']; ?>"><?php echo $value['kategori_adi']; ?></option>
                                <?php  } ?>
                            </select>

                        </div>


                        <div class="form-group"style="margin-top: 1%;
                            <h7 class="mt-4 mb-2"></h7>
                            <textarea name="urun_aciklama" style="width: 60%" class="form-control" rows="3" placeholder="Ürün Açıklama"></textarea>
                        </div>
                        <button name="urun_kaydet" type="submit" class="btn btn-info" >Kaydet</button>
                    </div>
                </div>
            </form>
    </div>
    </section>
<?php

include 'sidebar.php';
include 'footer.php';
?>