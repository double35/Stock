<?php
ob_start();
session_start();
include 'netting/baglan.php';
$query=$db->prepare("SELECT * FROM kullanici where kullanici_adi=:kullanici_adi");
@$query->execute(array(
    'kullanici_adi' => $_SESSION['kullanici_adi']
));
$row=$query->rowCount();

if ($row==0) {
    header('Location:login.php?durum=izinsiz-giris');
}
$kullanicicek=$query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>M.Furkan OZAN</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="template/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="template/https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="template/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="template/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="template/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="template/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index.php" class="nav-link">Anasayfa</a>
            </li>

        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="logout.php"  class="btn btn-sm btn-info"><?php echo $kullanicicek['ad']?> <i class="fas fa-sign-out-alt"></i></a>
            </li>
        </ul>
    </nav>
