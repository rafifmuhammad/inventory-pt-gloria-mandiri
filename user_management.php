<?php
session_start();
include('function.php');

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$users = query("SELECT * FROM tb_user");
$count_admin = count_total('Admin');
$count_user = count_all('tb_user');
$count_supplier = count_total('Supplier');

if (isset($_POST['submit'])) {
    if (add_user($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan');
                document.location.href = 'user_management.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan');
                document.location.href = 'user_management.php';
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
    <title>Inventaris App - Manajemen Pengguna</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

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
                            <img src="assets/images/logo/logo.png" alt="">
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

                                    <!--Header Search-->
                                    <div class="col-auto">

                                        <div class="header-search">

                                            <button class="header-search-open d-block d-xl-none"><i class="zmdi zmdi-search"></i></button>

                                            <div class="header-search-form">
                                                <form action="#">
                                                    <input type="text" placeholder="Search Here">
                                                    <button><i class="zmdi zmdi-search"></i></button>
                                                </form>
                                                <button class="header-search-close d-block d-xl-none"><i class="zmdi zmdi-close"></i></button>
                                            </div>

                                        </div>
                                    </div>

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
            <!-- Page Headings Start -->
            <div class="row justify-content-between align-items-center mb-10">

                <!-- Page Heading Start -->
                <div class="col-12 col-lg-auto mb-20">
                    <div class="page-heading">
                        <h3>Manajemen Pengguna</h3>
                    </div>
                </div><!-- Page Heading End -->

                <!-- Page Button Group Start -->
                <div class="col-12 col-lg-auto mb-20">
                    <div class="page-date-range">
                        <input type="text" class="form-control input-date-predefined">
                    </div>
                </div><!-- Page Button Group End -->

            </div><!-- Page Headings End -->

            <!-- Top Report Wrap Start -->
            <div class="row">
                <!-- Top Report Start -->
                <div class="col-xlg-3 col-md-6 col-12 mb-30">
                    <div class="top-report">

                        <!-- Head -->
                        <div class="head">
                            <h4>Pengguna</h4>
                            <a href="#" class="view"><i class="zmdi zmdi-eye"></i></a>
                        </div>

                        <!-- Content -->
                        <div class="content">
                            <h2><?php echo $count_user['total'] ?></h2>
                        </div>

                        <!-- Footer -->
                        <div class="footer">
                            <div class="progess">
                                <div class="progess-bar" style="width: 100%;"></div>
                            </div>
                            <p>Melihat laporan barang</p>
                        </div>

                    </div>
                </div><!-- Top Report End -->

                <!-- Top Report Start -->
                <div class="col-xlg-3 col-md-6 col-12 mb-30">
                    <div class="top-report">

                        <!-- Head -->
                        <div class="head">
                            <h4>Supplier</h4>
                            <a href="#" class="view"><i class="zmdi zmdi-eye"></i></a>
                        </div>

                        <!-- Content -->
                        <div class="content">
                            <h2><?php echo $count_supplier['total'] ?></h2>
                        </div>

                        <!-- Footer -->
                        <div class="footer">
                            <div class="progess">
                                <div class="progess-bar" style="width: 100%;"></div>
                            </div>
                            <p>Kelola barang masuk</p>
                        </div>

                    </div>
                </div><!-- Top Report End -->

                <!-- Top Report Start -->
                <div class="col-xlg-3 col-md-6 col-12 mb-30">
                    <div class="top-report">

                        <!-- Head -->
                        <div class="head">
                            <h4>Admin</h4>
                            <a href="#" class="view"><i class="zmdi zmdi-eye"></i></a>
                        </div>

                        <!-- Content -->
                        <div class="content">
                            <h2><?php echo $count_admin['total'] ?></h2>
                        </div>

                        <!-- Footer -->
                        <div class="footer">
                            <div class="progess">
                                <div class="progess-bar" style="width: 100%;"></div>
                            </div>
                            <p>Kelola pengguna dan barang</p>
                        </div>

                    </div>
                </div><!-- Top Report End -->
            </div><!-- Top Report Wrap End -->

            <div class="row mbn-30">
                <!--Default Data Table Start-->
                <div class="col-12 mb-30">
                    <div class="box">
                        <div class="box-head">
                            <h3 class="title">Data Pengguna</h3>
                        </div>
                        <div class="box-body">
                            <button type="button" data-toggle="modal" data-target="#exampleModal" class="button button-outline button-primary"><span>Tambah Pengguna</span></button>
                            <table class="table table-bordered data-table data-table-default">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No. HP</th>
                                        <th>Role</th>
                                        <th>Password</th>
                                        <th>Dibuat Pada</th>
                                        <th colspan="2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Query users -->
                                    <?php
                                    $i = 1;
                                    foreach ($users as $user) : ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $user['username'] ?></td>
                                            <td><?php echo $user['nama_lengkap'] ?></td>
                                            <td><?php echo $user['email'] ?></td>
                                            <td><?php echo $user['no_hp'] ?></td>
                                            <td><?php echo $user['role'] ?></td>
                                            <td><?php echo $user['password'] ?></td>
                                            <td><?php echo $user['created_at'] ?></td>
                                            <td><a class="button button-warning button-sm" href="edit_profile.php?id_user=<?php echo $user['id_user']; ?>"><span class="fa fa-pencil-square-o"></span></a></td>
                                            <td><a class="button button-danger button-sm" onclick="return confirm('Hapus pengguna?');" href="delete_user.php?id_user=<?php echo $user['id_user']; ?>"><span class="fa fa-trash"></span></a></td>
                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                            <button type="button" class="closeTambah Pengguna" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <!-- Input a new user -->
                                                <input type="text" name="username" id="username" class="col-12 mb-15 form-control" placeholder="Username">
                                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="col-12 mb-15 form-control" placeholder="Nama Lengkap">
                                                <input type="text" name="email" id="email" class="col-12 mb-15 form-control" placeholder="Email">
                                                <input type="number" name="no_hp" id="no_hp" class="col-12 mb-15 form-control" placeholder="No Handphone">
                                                <select name="role" id="role" class="col-12 mb-15 form-control">
                                                    <option value="Admin">Admin</option>
                                                    <option value="Supplier">Supplier</option>
                                                    <option value="User">User</option>
                                                </select>
                                                <input type="password" name="password" id="password" class="col-12 mb-15 form-control" placeholder="Password">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="button button-outline button-danger" data-dismiss="modal">Tutup</button>
                                            <button type="submit" name="submit" class="button button-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Default Data Table End-->
            </div><!-- Content Body End -->

            <!-- Footer Section Start -->
            <div class="footer-section">
                <div class="container-fluid">

                    <div class="footer-copyright text-center">
                        <p class="text-body-light">2019 &copy; <a href="https://themeforest.net/user/codecarnival">Codecarnival</a></p>
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