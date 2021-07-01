<?php
ob_start();
session_start();
include 'baglan.php';

//login

if (isset($_POST['loggin'])) {
    $kullanici_adi = $_POST['kullanici_adi'];
    $password = md5($_POST['password']);

    if ($kullanici_adi && $password) {
        $query = $db->prepare("SELECT * FROM kullanici where kullanici_adi=:kullanici_adi and password=:password");
        $query->execute(array(
            'kullanici_adi' => $kullanici_adi,
            'password' => $password
        ));
        $row = $query->rowCount();

        if ($row > 0) {
            $_SESSION['kullanici_adi'] = $kullanici_adi;
            header('Location:../index.php');
        }

        else {
            header('Location:../login.php?login=no');
        }

    }
}
//KullanıcıKayıt

if (isset($_POST['kullanici_kaydet'])) {

    $kullaniciQuery = $db->prepare('INSERT INTO kullanici(ad,soyad,kullanici_adi,email,password,yetki,telefon,adres) 
VALUES(:ad,:soyad,:kullanici_adi,:email,:password,:yetki,:telefon,:adres)');
    $kullanicikaydet = $kullaniciQuery->execute(array(
        'ad' => $_POST['ad'],
        'soyad' => $_POST['soyad'],
        'kullanici_adi' => $_POST['kullanici_adi'],
        'email' => $_POST['email'],
        'password' => md5($_POST['password']),
        'yetki' => $_POST['yetki'],
        'telefon' => $_POST['telefon'],
        'adres' => $_POST['adres'],


    ));
    if ($kullanicikaydet) {
        header('Location:../userCreate.php?durum=ok');
    } else {
        header('Location:../userCreate.php?durum=no');
    }

}
//KullanıcıDüzenleme

if (isset($_POST['user_edit'])) {
    $userduzenle = $db->prepare("UPDATE kullanici SET
         ad=:ad,
         soyad=:soyad,
         kullanici_adi=:kullanici_adi,
         email=:email,
         password=:password,
         yetki=:yetki,
         telefon=:telefon,
         adres=:adres

         WHERE id={$_POST['id']}");
    $update = $userduzenle->execute(array(
        'ad' => $_POST['ad'],
        'soyad' => $_POST['soyad'],
        'kullanici_adi' => $_POST['kullanici_adi'],
        'email' => $_POST['email'],
        'password' => md5($_POST['password']),
        'yetki' => $_POST['yetki'],
        'telefon' => $_POST['telefon'],
        'adres' => $_POST['adres']

    ));

    $id = $_POST['id'];
    if ($update) {
        header("Location:../userView.php?id=$id&durum=ok");
    } else {
        header("Location:../userEdit.php?durum=no");
    }
}
//KullanıcıSil

if ($_GET['user_sil'] == "ok") {

    $sil = $db->prepare("DELETE from kullanici WHERE id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['id']
    ));

    if ($kontrol) {

        header("Location:../userView?durum=ok");

    } else {
        header("Location:../userView?durum=no");

    }
}
//KategoriKayıt

if (isset($_POST['kategori_ekle'])) {
    $kategoriAdi = $_POST['kategori_adi'];
    if ($kategoriAdi) {
        $query = $db->prepare('INSERT INTO kategori(kategori_adi) VALUES(:kategori_adi)');
        $kaydet = $query->execute(array(
            'kategori_adi' => $_POST['kategori_adi']
        ));
        if ($kaydet) {
            header('Location:../categoryCreate.php?categoryCreate=ok');
        } else {
            header('Location:../categoryCreate.php?categoryCreate=no');
        }
    }
}
//KategoriDüzenle

if (isset($_POST['kategori_duzenle'])) {
    $kategoriDuzenle = $db->prepare("UPDATE kategori SET
         kategori_adi=:kategori_adi
         WHERE id={$_POST['id']}");
    $update = $kategoriDuzenle->execute(array(
        'kategori_adi' => $_POST['kategori_adi_duzenle'],

    ));

    $id = $_POST['id'];
    if ($update) {
        header("Location:../categoryView.php?id=$id&durum=ok");
    } else {
        header("Location:../categoryEdit.php?durum=no");
    }
}
//KategoriSil

if ($_GET['kategorisil'] == "ok") {


    $sil = $db->prepare("DELETE from kategori WHERE id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['id']
    ));

    if ($kontrol) {


        header("Location:../categoryView?durum=ok");

    } else {
        header("Location:../categoryView?durum=no");

    }


}
//ÜrünKayıt

if (isset($_POST['urun_kaydet'])) {

    $uploads_dir = '../image';
    @$tmp_name = $_FILES['resim_yol']["tmp_name"];
    @$name = $_FILES['resim_yol']["name"];
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $resimYol = substr($uploads_dir, 3) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
    $urunQuery = $db->prepare('INSERT INTO urunler(resim_yol,urun_adi,urun_marka,urun_no,urun_barkod,urun_fiyat,kategori_id,urun_aciklama) VALUES(:resim_yol,:urun_adi,:urun_marka,:urun_no,:urun_barkod,:urun_fiyat,:kategori_id,:urun_aciklama)');
    $urunKaydet = $urunQuery->execute(array(
        'urun_no' => $_POST['urun_no'],
        'urun_adi' => $_POST['urun_adi'],
        'urun_marka' => $_POST['urun_marka'],
        'urun_barkod' => $_POST['urun_barkod'],
        'urun_fiyat'=> $_POST['urun_fiyat'],
        'kategori_id' => $_POST['kategori_id'],
        'urun_aciklama' => $_POST['urun_aciklama'],
        'resim_yol' => $resimYol,

    ));
    if ($urunKaydet) {
        header('Location:../productCreate.php?durum=ok');
    } else {
        header('Location:../productCreate.php?durum=no');
    }

}
//ÜrünDüzenle

if (isset($_POST['urun_duzenle'])) {

    if ($_FILES['resim_yol']["size"] > 0) {
        $uploads_dir = '../image';
        @$tmp_name = $_FILES['resim_yol']["tmp_name"];
        @$name = $_FILES['resim_yol']["name"];
        $benzersizsayi1 = rand(20000, 32000);
        $benzersizsayi2 = rand(20000, 32000);
        $benzersizsayi3 = rand(20000, 32000);
        $benzersizsayi4 = rand(20000, 32000);
        $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
        $resimYol = substr($uploads_dir, 3) . "/" . $benzersizad . $name;
        @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
        $duzenle = $db->prepare("UPDATE urunler SET
        resim_yol=:resim_yol,
        urun_adi=:urun_adi,
        urun_marka =:urun_marka,
        urun_no=:urun_no,
        urun_barkod=:urun_barkod,
        urun_fiyat=:urun_fiyat,          
        kategori_id=:kategori_id,
        urun_aciklama=:urun_aciklama
        where id={$_POST['id']}");
        $update = $duzenle->execute(array(
            'urun_no' => $_POST['urun_no'],
            'urun_adi' => $_POST['urun_adi'],
            'urun_marka' => $_POST['urun_marka'],
            'urun_barkod' => $_POST['urun_barkod'],
            'urun_fiyat' => $_POST['urun_fiyat'],
            'kategori_id' => $_POST['kategori_id'],
            'urun_aciklama' => $_POST['urun_aciklama'],
            'resim_yol' => $resimYol,

        ));
        $id = $_POST['id'];
        if ($update) {
            header("Location:../productView.php?id=$id&durum=ok");
        } else {
            header("Location:../productEdit.php?durum=no");
        }

    } else {


        $duzenle = $db->prepare("UPDATE urunler SET 
        urun_adi=:urun_adi,
        urun_marka =:urun_marka,
        urun_no=:urun_no,
        urun_barkod=:urun_barkod,
        urun_fiyat=:urun_fiyat,
        kategori_id=:kategori_id,
        urun_aciklama=:urun_aciklama
    
        WHERE id={$_POST['id']}");

        $update = $duzenle->execute(array(
            'urun_no' => $_POST['urun_no'],
            'urun_adi' => $_POST['urun_adi'],
            'urun_marka' => $_POST['urun_marka'],
            'urun_fiyat' => $_POST['urun_fiyat'],
            'urun_barkod' => $_POST['urun_barkod'],
            'kategori_id' => $_POST['kategori_id'],
            'urun_aciklama' => $_POST['urun_aciklama']


        ));
        $id = $_POST['id'];

        if ($update) {
            header("Location:../productEdit.php?id=$id&durum=ok");
        } else {
            header("Location:../productEdit.php?durum=no");
        }

    }
}
//ÜrünSil

if ($_GET['urunsil'] == "ok" & isset($_GET['resim_yol'])) {


    $sil = $db->prepare("DELETE from urunler WHERE id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['id']
    ));
    $resimyol = $_GET['resim_yol'];
    $resimyolson = "../$resimyol";
    unlink($resimyolson);


    if ($kontrol) {


        header("Location:../productView?durum=ok");

    } else {
        header("Location:../productView?durum=no");

    }


}
//StokKayıt

if (isset($_POST['stok_kaydet'])) {
    $stokQuery = $db->prepare('INSERT INTO stok(urun_id,kasa_id,musteri_id,depo_id,islem_tipi,adet,fiyat,eklenme_tarihi)
 VALUES(:urun_id,:kasa_id,:musteri_id,:depo_id,:islem_tipi,:adet,:fiyat,:eklenme_tarihi)');
    $stokKaydet = $stokQuery->execute(array(
        'urun_id' => $_POST['urun_id'],
        'kasa_id' => $_POST['kasa_id'],
        'musteri_id' => $_POST['musteri_id'],
        'depo_id' => $_POST['depo_id'],
        'islem_tipi' => $_POST['islem_tipi'],
        'adet' => $_POST['adet'],
        'fiyat' => $_POST['fiyat'],
        'eklenme_tarihi'=>date('y-m-d')
    ));
    if ($stokKaydet) {
        Header('Location:../stockCreate.php?durum=ok');
    } else {
        header('Location:../stockCreate.php?durum=no');
    }

}
//StokDüzenle

if (isset($_POST['stok_guncelle'])) {
    $stokDuzenle = $db->prepare("UPDATE stok SET
         urun_id=:urun_id,
         kasa_id=:kasa_id,
         musteri_id=:musteri_id,
         depo_id=:depo_id,
         islem_tipi=:islem_tipi,
         adet=:adet,
         fiyat=:fiyat
         WHERE id={$_POST['id']}");
    $update = $stokDuzenle->execute(array(
        'urun_id' => $_POST['urun_id'],
        'kasa_id' => $_POST['kasa_id'],
        'musteri_id' => $_POST['musteri_id'],
        'depo_id' => $_POST['depo_id'],
        'islem_tipi' => $_POST['islem_tipi'],
        'adet' => $_POST['adet'],
        'fiyat' => $_POST['fiyat']

    ));

    $id = $_POST['id'];
    if ($update) {
        header("Location:../stockView.php?id=$id&durum=ok");
    } else {
        header("Location:../stockEdit.php?durum=no");
    }
}
//StokSil

if ($_GET['stoksil'] == "ok") {


    $sil = $db->prepare("DELETE from stok WHERE id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['id']
    ));

    if ($kontrol) {

        header("Location:../stockView?durum=ok");

    } else {
        header("Location:../stockView?durum=no");

    }
}
//DepoKayıt

if (isset($_POST['depo_kaydet'])) {
    $depoQuery = $db->prepare('INSERT INTO depo(depo_adi,depo_adres,depo_il,depo_ilce) VALUES(:depo_adi,:depo_adres,:depo_il,:depo_ilce)');
    $depoKaydet = $depoQuery->execute(array(
        'depo_adi' => $_POST['depo_adi'],
        'depo_adres' => $_POST['depo_adres'],
        'depo_il' => $_POST['depo_il'],
        'depo_ilce' => $_POST['depo_ilce'],

    ));
    if ($depoKaydet) {
        header('Location:../storeCreate.php?durum=ok');
    } else {
        header('Location:../storeCreate.php?durum=no');
    }

}
//DepoDüzenle

if (isset($_POST['depo_duzenle'])) {
    $depoDuzenle = $db->prepare("UPDATE depo SET
         depo_adi=:depo_adi,
         depo_adres=:depo_adres,
         depo_il=:depo_il,
         depo_ilce=:depo_ilce
         WHERE id={$_POST['id']}");
    $update = $depoDuzenle->execute(array(
        'depo_adi' => $_POST['depo_adi'],
        'depo_adres' => $_POST['depo_adres'],
        'depo_il' => $_POST['depo_il'],
        'depo_ilce' => $_POST['depo_ilce']

    ));

    $id = $_POST['id'];
    if ($update) {
        header("Location:../storeView.php?id=$id&durum=ok");
    } else {
        header("Location:../storeEdit.php?durum=no");
    }
}
//DepoSil

if ($_GET['depo_sil'] == "ok") {


    $sil = $db->prepare("DELETE from depo WHERE id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['id']
    ));

    if ($kontrol) {

        header("Location:../storeView?durum=ok");

    } else {
        header("Location:../storeView?durum=no");

    }
}
//MüşteriKayıt

if (isset($_POST['musteri_kaydet'])) {

    $musteriQuery = $db->prepare('INSERT INTO musteri(musteri_ad,musteri_soyad,musteri_sirket,musteri_email,musteri_tel,musteri_adres,musteri_il,musteri_ilce) VALUES(:musteri_ad,:musteri_soyad,:musteri_sirket,:musteri_email,:musteri_tel,:musteri_adres,:musteri_il,:musteri_ilce)');
    $musterikaydet = $musteriQuery->execute(array(
        'musteri_ad' => $_POST['musteri_ad'],
        'musteri_soyad' => $_POST['musteri_soyad'],
        'musteri_sirket' => $_POST['musteri_sirket'],
        'musteri_email' => $_POST['musteri_email'],
        'musteri_tel' => $_POST['musteri_tel'],
        'musteri_adres' => $_POST['musteri_adres'],
        'musteri_il' => $_POST['musteri_il'],
        'musteri_ilce' => $_POST['musteri_ilce'],


    ));
    if ($musterikaydet) {
        header('Location:../customerCreate.php?durum=ok');
    } else {
        header('Location:../customerCreate.php?durum=no');
    }

}
//MüşteriDüzenle

if (isset($_POST['musteri_duzenle'])) {
    $musteriDuzenle = $db->prepare("UPDATE musteri SET 
         musteri_ad=:musteri_ad,
            musteri_soyad=:musteri_soyad,
            musteri_sirket=:musteri_sirket,
            musteri_email=:musteri_email,
            musteri_tel=:musteri_tel,
            musteri_adres=:musteri_adres,
            musteri_il=:musteri_il,
            musteri_ilce=:musteri_ilce
         WHERE id={$_POST['id']}");
    $update = $musteriDuzenle->execute(array(
        'musteri_ad' => $_POST['musteri_ad'],
        'musteri_soyad'=> $_POST['musteri_soyad'],
        'musteri_sirket'=> $_POST['musteri_sirket'],
        'musteri_email'=> $_POST['musteri_email'],
        'musteri_tel'=> $_POST['musteri_tel'],
        'musteri_adres'=> $_POST['musteri_adres'],
        'musteri_il'=> $_POST['musteri_il'],
        'musteri_ilce'=> $_POST['musteri_ilce'],
    ));

    $id = $_POST['id'];
    if ($update) {
        header("Location:../customerView.php?id=$id&durum=ok");
    } else {
        header("Location:../customerEdit.php?durum=no");
    }
}
//MüşteriSil

if ($_GET['musterisil'] == "ok") {


    $sil = $db->prepare("DELETE from musteri WHERE id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['id']
    ));

    if ($kontrol) {


        header("Location:../customerView?durum=ok");

    } else {
        header("Location:../customerView?durum=no");

    }
}
//KasaKayıt

if (isset($_POST['kasa_ekle'])) {
    $kasaAdi = $_POST['kasa_adi'];
    if ($kasaAdi) {
        $query = $db->prepare('INSERT INTO kasa(kasa_adi) VALUES(:kasa_adi)');
        $kaydet = $query->execute(array(
            'kasa_adi' => $_POST['kasa_adi']
        ));
        if ($kaydet) {
            header('Location:../caseCreate.php?caseCreate=ok');
        } else {
            header('Location:../caseCreate.php?caseCreate=no');
        }
    }
}
//KasaDüzenle

if (isset($_POST['kasa_duzenle'])) {
    $kasaDuzenle = $db->prepare("UPDATE kasa SET
         kasa_adi=:kasa_adi
         WHERE id={$_POST['id']}");
    $update = $kasaDuzenle->execute(array(
        'kasa_adi' => $_POST['kasa_adi_duzenle'],

    ));

    $id = $_POST['id'];
    if ($update) {
        header("Location:../caseView.php?id=$id&durum=ok");
    } else {
        header("Location:../caseEdit.php?durum=no");
    }
}
//KasaSil

if ($_GET['kasasil'] == "ok") {


    $sil = $db->prepare("DELETE from kasa WHERE id=:id");
    $kontrol = $sil->execute(array(
        'id' => $_GET['id']
    ));

    if ($kontrol) {

        header("Location:../caseView?durum=ok");

    } else {
        header("Location:../caseView?durum=no");

    }
}