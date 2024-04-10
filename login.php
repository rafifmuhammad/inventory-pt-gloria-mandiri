<?php
session_start();
include 'function.php';

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");

    // Check username
    if (mysqli_num_rows($result) == 1) {

        // Check password
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            // Set session
            $_SESSION['login'] = true;
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['id_user'] = $row['id_user'];

            header('Location: index.php');
            exit;
        } else {
            echo "
                <script>
                    alert('Username atau password salah!');
                </script>
            ";
        }
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Inventaris App - Login</title>
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
    <style>
        .login-register-wrap {
            padding: 0 15px;
        }

        /*Login & Resister BG*/
        .login-register-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5),
                    rgba(0, 0, 0, 0.5)),
                url('./images/login-register-bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            min-height: 100vh;
            height: 100%;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .login-register-bg .content {
            display: none;
            max-width: 420px;
            padding: 100px 30px;
        }

        .login-register-bg .content h1 {
            font-weight: 300;
            line-height: 1;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .login-register-bg .content p {
            margin-bottom: 0;
            color: #ffffff;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        only screen and (max-width: 767px) {
            .login-register-bg {
                min-height: auto;
            }

            .login-register-bg .content {
                display: block;
            }
        }

        @media only screen and (max-width: 767px) {
            .login-register-bg .content {
                padding-top: 50px;
                padding-bottom: 50px;
            }

            .login-register-bg .content h1 {
                font-size: 30px;
            }
        }

        /*Login & Resister Form Wrapper*/
        .login-register-form-wrap {
            max-width: 420px;
            padding: 50px 15px;
        }

        .login-register-form-wrap .content h1 {
            font-weight: 300;
            line-height: 1;
            margin-bottom: 15px;
        }

        .login-register-form-wrap .content p {
            margin-bottom: 30px;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        only screen and (max-width: 767px) {
            .login-register-form-wrap .content {
                display: none;
            }
        }

        @media only screen and (max-width: 767px) {
            .login-register-form-wrap .content h1 {
                font-size: 30px;
            }
        }

        /*Login & Resister Form*/
        .login-register-form {
            max-width: 370px;
        }

        .login-register-form a {
            color: #428bfa;
        }

        .login-register-form a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="main-wrapper">

        <!-- Content Body Start -->
        <div class="content-body m-0 p-0">

            <div class="login-register-wrap">
                <div class="row">

                    <div class="d-flex align-self-center justify-content-center order-2 order-lg-1 col-lg-5 col-12">
                        <div class="login-register-form-wrap">

                            <div class="content">
                                <h1>Masuk</h1>
                                <p>Sistem informasi inventory barang PT. Gloria Mandiri Teknik Kota Pekanbaru</p>
                            </div>

                            <div class="login-register-form">
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-12 mb-20"><input class="form-control" name="username" type="text" placeholder="Username"></div>
                                        <div class="col-12 mb-20"><input class="form-control" name="password" type="password" placeholder="Password"></div>
                                        <div class="col-12 mt-10"><button name="submit" type="submit" class="button button-primary button-outline">sign in</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="login-register-bg order-1 order-lg-2 col-lg-7 col-12">
                        <div class="content">
                            <h1>Masuk</h1>
                            <p>Sistem informasi inventory barang PT. Gloria Mandiri Teknik Kota Pekanbaru</p>
                        </div>
                    </div>

                </div>
            </div>

        </div><!-- Content Body End -->

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

</body>

</html>