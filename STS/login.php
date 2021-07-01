<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="template/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="template/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box" style="margin-top: -350px">
    <div class="login-logo">
        <a href="index.php"><b>Stok Takip Sistemi</b></a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">

                <?php
                if (@$_GET['login']=="no"){
                    echo " Kullanıcı Adı yada Şifre hatalı";
                }
                ?>

            </p>

            <form action="netting/islem.php" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="kullanici_adi" placeholder="Kullanıcı Adı">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Şifre">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <button type="submit" name="loggin" class="btn btn-primary btn-block">Giriş Yap</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="template/plugins/jquery/jquery.min.js"></script>
<script src="template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="template/dist/js/adminlte.min.js"></script>
</body>
</html>

