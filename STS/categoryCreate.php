<?php
include 'header.php';
include 'netting/baglan.php';
$query = $db->prepare('select * from kategori order by id');
$query->execute();
$say = $query->rowCount();

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
                        <h1>Kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                            <li class="breadcrumb-item active">Kategori</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        <section class="content" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info" >
                            <div class="card-header" >
                                <h3 class="card-title">Kategori Ekle<small></small></h3>
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
                                        <label for="exampleInputEmail1">Kategori Adı</label>
                                        <div class="input-group mb-3"style="width: 60%">
                                                <div class="input-group-prepend">
                                                    <span style="border-radius: 0px" class="input-group-text"><i class="fas fa-list"></i></span>
                                                </div>
                                                <input type="text" name="kategori_adi" class="form-control" id="exampleInputEmail1" placeholder="Category Name">

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" name="kategori_ekle" class="btn btn-info">Ekle</button>
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