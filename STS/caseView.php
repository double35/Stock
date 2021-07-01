<?php
include 'header.php';
include 'netting/baglan.php';
if (isset($_POST['arama'])) {
    $aranan=$_POST['aranan'];
    $query=$db->prepare("SELECT * from kasa where kasa_adi LIKE '%$aranan%' order by id ASC limit 25");
    $query->execute();
    $say=$query->rowCount();
} else {
    $query = $db->prepare('select * from kasa order by id');
    $query->execute();
    $say = $query->rowCount();
}
//yetki
$yetki = $_SESSION['kullanici_adi'];
$sorgu=$db->query("SELECT * FROM kullanici where kullanici_adi='$yetki'");
$kullanicicek=$sorgu->fetch(PDO::FETCH_ASSOC);
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="" method="post">
                        <div class="card-header" style="background-color: #28a745 " >
                            <h3 class="card-title">Kasa Listesi</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="aranan" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" name="arama" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
                <script>
                    function ShowConfirm() {
                        var confirmation = confirm("Emin misiniz?");
                        if (confirmation) {
                            alert("Kayıt Silinmiştir.");
                        }
                        return confirmation;
                    };
                </script>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kasa</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php while($sor=$query->fetch(PDO::FETCH_ASSOC)) {?>

                            <tr>
                                <td><?php echo $sor['id']; ?></td>
                                <td><?php echo $sor['kasa_adi']; ?></td>
                                <?php if ($kullanicicek['yetki']=="1") { ?>
                                <td class="text-center "><a href="caseEdit.php?id=<?php echo $sor['id']; ?>"> <button style="border-radius: 250px" class="btn btn-primary btn-xm" ><i  class="success fa fa-pencil-alt"adia-hideden="true"></i> </button></a>
                                    <a onclick="return ShowConfirm();" href="netting/islem.php?kasasil=ok&id=<?php echo $sor['id']; ?>"><button style="border-radius: 250px" class="btn btn-danger btn-xm" ><i  class="success fa fa-trash-alt"adia-hideden="true"></i> </button></td>
                                <?php  } } ?>
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