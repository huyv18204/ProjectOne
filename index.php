<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'model/PDO.php';
include 'model/user/login.php';
include 'views/header.php';

if(isset($_GET["act"])){
    $act = $_GET["act"];
    switch ($act){
        case "home":
            include 'views/pages/home.php';
            break;
        case "product":
            break;
        case "detailProduct":
            include "views/pages/detailProduct.php";
            break;
        case 'resultSearch':
            break;
        case 'register':
            if (isset($_POST['btn-register'])) {
                $account = $_POST['account'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $repass = $_POST['repass'];
                if (empty($account) || empty($email) || empty($pass) || empty($repass)) {
                    $notify = "Vui lòng điền thông tin";
                } else {
                    if ($pass == $repass) {
                        insert_account($account, $pass, $email);
                        $notify = "Đăng kí thành công";
                        header("location:index.php?act=login");
                    } else {
                        $notify = "Mật khẩu không khớp";
                    }
                }
            }
            include "views/login/register.php";
            break;
        case 'login':
            if (isset($_POST['btn-login'])) {
                $account = $_POST['account'];
                $pass = $_POST['password'];
                if (!empty($account) && !empty($pass)) {
                    $login = select_account($account, $pass);
                    if (is_array($login)) {
                        $_SESSION['account'] = $login;
                        header("location:index.php?act=home");
                        exit;
                    } else {
                        $notify = "Tài khoản hoặc mật khẩu không chính xác";
                    }
                } else {
                    $notify = "Không được bỏ trống thông tin";
                }
            }
            include "views/login/login.php";
            break;
        case 'logout':
            if (isset($_SESSION['account'])) {
                unset($_SESSION['account']);
            }
            header("Location: $_SERVER[REQUEST_URI]");
            header("location:index.php?act=home");
            break;
        case 'forgotPassword':
            include "views/login/forgotPass.php";
            break;
        case 'changePassword':
            include "views/login/changePass.php";
            break;
        case 'updateInformation':
            include "views/login/updateInformation.php";
            break;
        case 'products':
            include "views/pages/product.php";
            break;
        case 'cart':
            include "views/pages/cart.php";
            break;
        case 'order':
            include "views/pages/order.php";
            break;


    }
}else{
    include 'views/pages/home.php';
}


include 'views/footer.php';
?>