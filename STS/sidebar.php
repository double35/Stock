<?php
include 'netting/baglan.php';

$yetki = $_SESSION['kullanici_adi'];
$query=$db->query("SELECT * FROM kullanici where kullanici_adi='$yetki'");
$kullanicicek=$query->fetch(PDO::FETCH_ASSOC);
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
        <img src="image/2.png" alt="" class="brand-image-xs  elevation-3" >
        <span class="brand-text font-weight-light"> OZAN</span>
    </a>


    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Anasayfa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/category/view.php" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Kategori
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($kullanicicek['yetki']=="1") { ?>
                        <li class="nav-item">
                            <a href="categoryCreate.php" class="nav-link">
                                <p>Kategori Ekle</p>
                            </a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="categoryView.php" class="nav-link">
                                <p>Kategori Listele</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="productView.php" class="nav-link">
                        <i class="fas fa-box-open nav-icon"></i>
                        <p>
                            Ürünler
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($kullanicicek['yetki']=="1") { ?>
                        <li class="nav-item">
                            <a href="productCreate.php" class="nav-link">
                                <p>Ürün Ekle</p>
                            </a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="productView.php" class="nav-link">
                                <p>Ürün Listele</p>
                            </a>
                        </li>
                    </ul>
                <li class="nav-item">
                    <a href="stockView.php" class="nav-link">
                        <i class="fas fa-chart-line nav-icon"></i>
                        <p>
                            Stok
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($kullanicicek['yetki']=="1") { ?>
                        <li class="nav-item">
                            <a href="stockCreate.php" class="nav-link">
                                <p>Stok Ekle</p>
                            </a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="stockView.php" class="nav-link">
                                <p>Stok Listele</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="reportView.php" class="nav-link">
                                <p>Rapor</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="userView.php" class="nav-link">
                        <i class="fas fa-user-cog nav-icon" ></i>
                        <p>
                            Kullanıcı
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($kullanicicek['yetki']=="1") { ?>
                        <li class="nav-item">
                            <a href="userCreate.php" class="nav-link">
                                <p>Kullanıcı Kayıt</p>
                            </a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="userView.php" class="nav-link">
                                <p>Kullanıcı Profil</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="storeView.php" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"></i>
                        <p>
                            Depo
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($kullanicicek['yetki']=="1") { ?>
                        <li class="nav-item">
                            <a href="storeCreate.php" class="nav-link">
                                <p>Depo Ekle</p>
                            </a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="storeView.php" class="nav-link">
                                <p>Depo Listele</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="customerEdit.php" class="nav-link">
                        <i class="fas fa-user-tie fa-lg nav-icon"></i>
                        <p>
                            Müşteri
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($kullanicicek['yetki']=="1") { ?>
                        <li class="nav-item">
                            <a href="customerCreate.php" class="nav-link">
                                <p>Müşteri Kayıt</p>
                            </a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="customerView.php" class="nav-link">
                                <p>Müşteri Listesi</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="caseEdit.php" class="nav-link">
                        <i class="fas fa-landmark nav-icon"></i>
                        <p>
                            Kasa
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if ($kullanicicek['yetki']=="1") { ?>
                        <li class="nav-item">
                            <a href="caseCreate.php" class="nav-link">
                                <p>Kasa Oluştur</p>
                            </a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="caseView.php" class="nav-link">
                                <p>Kasa Listesi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                </li>
            </ul>
        </nav>
    </div>
</aside>
