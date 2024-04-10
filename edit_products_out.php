<?php
session_start();
include "function.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id_barang = $_GET['id_barang'];

$product = get_single_product('tb_barang_keluar', '*', $id_barang);

if (isset($_POST['submit'])) {
    if (update_product_out($_POST, $id_barang) > 0) {
        echo "
            <script>
                alert('Data berhasil diubah');
                document.location.href = 'products_out.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal diubah');
                document.location.href = 'products_out.php';
            </script>
        ";
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Inventaris App - Ubah Barang Keluar</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="./images/small-logo.png">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="assets/css/vendor/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/vendor/themify-icons.css">
    <link rel="stylesheet" href="assets/css/vendor/cryptocurrency-icons.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins/plugins.css">

    <!-- Helper CSS -->
    <link rel="stylesheet" href="assets/css/helper.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Custom Style CSS Only For Demo Purpose -->
    <link id="cus-style" rel="stylesheet" href="assets/css/style-primary.css">

</head>

<body>

    <div class="main-wrapper">


        <!-- Header Section Start -->
        <div class="header-section">
            <div class="container-fluid">
                <div class="row justify-content-between align-items-center">

                    <!-- Header Logo (Header Left) Start -->
                    <div class="header-logo col-auto">
                        <a href="index.php">
                            <img src="./images/logo.png" alt="logo">
                            <img src="assets/images/logo/logo-light.png" class="logo-light" alt="">
                        </a>
                    </div><!-- Header Logo (Header Left) End -->

                    <!-- Header Right Start -->
                    <div class="header-right flex-grow-1 col-auto">
                        <div class="row justify-content-between align-items-center">

                            <!-- Side Header Toggle & Search Start -->
                            <div class="col-auto">
                                <div class="row align-items-center">

                                    <!--Side Header Toggle-->
                                    <div class="col-auto"><button class="side-header-toggle"><i class="zmdi zmdi-menu"></i></button></div>



                                </div>
                            </div><!-- Side Header Toggle & Search End -->

                            <!-- Header Notifications Area Start -->
                            <div class="col-auto">

                                <ul class="header-notification-area">
                                    <!--User-->
                                    <li class="adomx-dropdown col-auto">
                                        <a class="toggle" href="#">
                                            <span class="user">
                                                <span class="avatar">
                                                    <img src="assets/images/avatar/avatar-1.jpg" alt="">
                                                    <span class="status"></span>
                                                </span>
                                                <span class="name"><?php echo $_SESSION['nama_lengkap']; ?></span>
                                            </span>
                                        </a>

                                        <!-- Dropdown -->
                                        <div class="adomx-dropdown-menu dropdown-menu-user">
                                            <div class="head">
                                                <h5 class="name"><a href="#"><?php echo $_SESSION['nama_lengkap']; ?></a></h5>
                                                <a class="mail" href="#"><?php echo $_SESSION['email']; ?></a>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
                            </div><!-- Header Notifications Area End -->

                        </div>
                    </div><!-- Header Right End -->

                </div>
            </div>
        </div><!-- Header Section End -->
        <!-- Side Header Start -->
        <div class="side-header show">
            <button class="side-header-close"><i class="zmdi zmdi-close"></i></button>
            <!-- Side Header Inner Start -->
            <div class="side-header-inner custom-scroll">

                <nav class="side-header-menu" id="side-header-menu">
                    <ul>
                        <li><a href="index.php"><i class="ti-home"></i> <span>Dashboard</span></a></li>
                        <li><a href="user_management.php"><i class="fa fa-user-o"></i> <span>Manajemen Pengguna</span></a></li>
                        <li><a href="products_in.php"><i class="fa fa-cart-plus"></i> <span>Kelola Barang Masuk</span></a></li>
                        <li><a href="products_out.php"><i class="fa fa-cart-arrow-down"></i> <span>Kelola Barang Keluar</span></a></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Keluar</span></a></li>
                    </ul>
                </nav>

            </div><!-- Side Header Inner End -->
        </div><!-- Side Header End -->

        <!-- Content Body Start -->
        <div class="content-body">

            <div class="row mbn-50">
                <!--Right Sidebar Start-->

                <div class="row mbn-30">
                    <!--Author Information Start-->
                    <div class="col-xlg-12 col-lg-6 col-12 mb-30">
                        <div class="box">
                            <div class="box-head">
                                <h3 class="title">Informasi Barang Keluar</h3>
                            </div>
                            <div class="box-body">
                                <div class="form">
                                    <form action="" method="post">
                                        <div class="row row-10 mbn-20">
                                            <input type="hidden" name="id_user" id="id_user" value="<?php echo $product['id_user']; ?>">
                                            <div class="col-12 mb-20"><input type="text" name="nama_barang" class="form-control" value="<?php echo $product['nama_barang']; ?>" placeholder="Nama Barang"></div>
                                            <div class="col-12 mb-20"><input type="text" name="jumlah_barang" class="form-control" value="<?php echo $product['jumlah_barang']; ?>" placeholder="Jumlah Barang"></div>
                                            <input type="hidden" name="tanggal_keluar" id="tanggal_keluar" value="<?php echo $product['tanggal_keluar']; ?>">
                                            <div class="col-12 mt-10 mb-20">
                                                <input type="submit" name="submit" class="button button-primary button-outline" value="Simpan Perubahan">
                                                <input type="reset" class="button button-danger button-outline" value="Kosongkan Formulir">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Author Information End-->
                </div>
                <!--Right Sidebar End-->

            </div>
        </div><!-- Content Body End -->

        <!-- Footer Section Start -->
        <div class="footer-section">
            <div class="container-fluid">

                <div class="footer-copyright text-center">
                    <p class="text-body-light">2024 &copy; <a href="">HC333</a></p>
                </div>

            </div>
        </div><!-- Footer Section End -->
    </div>

    <!-- JS
============================================ -->

    <!-- Global Vendor, plugins & Activation JS -->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <!--Plugins JS-->
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/tippy4.min.js.js"></script>
    <!--Main JS-->
    <script src="assets/js/main.js"></script>

    <!-- Plugins & Activation JS For Only This Page -->

    <!--Moment-->
    <script src="assets/js/plugins/moment/moment.min.js"></script>

    <!--Daterange Picker-->
    <script src="assets/js/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="assets/js/plugins/daterangepicker/daterangepicker.active.js"></script>

    <!--Echarts-->
    <script src="assets/js/plugins/chartjs/Chart.min.js"></script>
    <script src="assets/js/plugins/chartjs/chartjs.active.js"></script>

    <!--VMap-->
    <script src="assets/js/plugins/vmap/jquery.vmap.min.js"></script>
    <script src="assets/js/plugins/vmap/maps/jquery.vmap.world.js"></script>
    <script src="assets/js/plugins/vmap/maps/samples/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/plugins/vmap/vmap.active.js"></script>

</body>

</html>