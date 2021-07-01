<?php
include 'header.php';
include 'netting/baglan.php';
if (isset($_POST['arama'])) {
    $aranan = $_POST['aranan'];
    $query = $db->prepare("SELECT * from kullanici where ad LIKE '%$aranan%' order by id ASC limit 25");
    $query->execute();
    $say = $query->rowCount();
} else {
    $query = $db->prepare('select * from kullanici order by id');
    $query->execute();
    $say = $query->rowCount();
}

//yetki
$yetki = $_SESSION['kullanici_adi'];
$sorgu=$db->query("SELECT * FROM kullanici where kullanici_adi='$yetki'");
$kullanicicek=$sorgu->fetch(PDO::FETCH_ASSOC);
?>
    <style>
        .mm {
            transition: 0.5s;
        }

        .mm:hover {
            box-shadow: -5px 5px 10px black;

        }
    </style>

    <div class="content-wrapper">

        <div class="form-group">

            <?php while ($sor = $query->fetch(PDO::FETCH_ASSOC)) { ?>

                <div class="card hovercard mm" style="width: 25%;float: left;margin-left: 30px;margin-top: 10px;">

                    <div class="cardheader">
                        <div class="avatar" style="padding-left: 35%">
                            <img alt="" style="height: 100px;height: 100px;border-radius: 50px" src="image/user.png">
                        </div>
                    </div>
                    <div class="card-body info ">
                        <div class="form-group">
                            <div class="title" style="text-align: center;size;font-family:Bahnschrift;font-size: 21px">
                                <a><?php echo $sor['ad']; ?> <?php echo $sor['soyad']; ?></a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="desc"><i class="fas fa-at"></i> <?php echo $sor['email']; ?></div>
                        </div>

                        <div class="form-group">
                            <div class="desc"><i class="fas fa-home"></i> <?php echo $sor['adres']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="desc"><i class="fas fa-phone-alt"></i> <?php echo $sor['telefon']; ?>
                            </div>
                        </div>
                    </div>
                    <div style="margin-left: 70%;margin-bottom: 5px" >
                        <?php if ($kullanicicek['yetki']=="1") { ?>
                        <th class="text-center "><a href="userEdit.php?id=<?php echo $sor['id']; ?>"> <button style="border-radius: 250px" class="btn btn-primary btn-xm" ><i  class="success fa fa-pencil-alt"adia-hideden="true"></i> </button></a>
                            <a onclick="return ShowConfirm();" href="netting/islem.php?user_sil=ok&id=<?php echo $sor['id']; ?>"><button style="border-radius: 250px" class="btn btn-danger btn-xm" ><i  class="success fa fa-trash-alt"adia-hideden="true"></i> </button></th>
                        <?php   } ?>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>


<?php
include 'sidebar.php';
include 'footer.php';
?>