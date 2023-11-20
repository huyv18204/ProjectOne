<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'model/PDO.php';
include 'model/user/login.php';
include 'model/user/homepage.php';
// include 'model/admin/product.php';
include 'views/header.php';

if (isset($_GET["act"])) {
    $act = $_GET["act"];
    switch ($act) {
        case "home":
            $listsp = select_all_product();
            $listpk = select_all_phukien();
            include 'views/pages/home.php';
            break;
        case "product":
            break;
        case "deltailProduct":
            if (isset($_GET['id'])) {
                $id_product = $_GET['id'];
                $list_sp = select_one_sanpham($id_product);
                extract($list_sp);
                //                $list_samekind = select_sp_samekind($id_product, $id_category);
                $list_samekind = select_sp_samekind($id_product);
            }
            include "views/pages/detailProduct.php";
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
            if (isset($_POST['btn-submit'])) {

                $account = $_POST['account'];
                $pass = $_POST['pass'];
                $newPass = $_POST['newPass'];
                if ($pass == $_SESSION['account']['password']) {
                    change_pass($newPass, $_SESSION['account']['id_user']);
                    $_SESSION['account'] = select_account($account, $newPass);
                    $notify = "Cập nhật thành công";
                } else {
                    $notify = "Sai mật khẩu";
                }
            }
            include "views/login/changePass.php";
            break;
        case 'updateInformation':
            if (isset($_POST['btn-updateInfo'])) {
                $id_user = $_POST['id_user'];
                $target_dir = "upload/";
                $target_file = $target_dir . basename($_FILES["img"]["name"]);
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                    $img_user = $_FILES["img"]["name"];
                }
                $account = $_POST['account'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                update_user($id_user, $img_user, $pass, $name, $email, $phone, $address);
                $_SESSION['account'] = select_account($account, $pass);
                $notify = "Cập nhật thành công";

            }
            include "views/pages/updateInformation.php";
            break;
        case 'products':
            $list_sp = select_all_product();
            $list_category = select_all_danhmuc();
            include "views/pages/product.php";
            break;
        case 'cart':
            include "views/pages/cart.php";
            break;
        case 'order':
            include "views/pages/order.php";
            break;
        case 'resultSearch':
            if (isset($_POST['btn-search'])) {
                $search_sp = $_POST['search_sp'];
                $list_sp = search_sp($search_sp);
            }
            $list_dm = select_all_danhmuc();
            require_once 'views/pages/resultSearch.php';
            break;
        case 'category':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $list_sp = select_sp_by_dm($id);
            }
            $list_dm = select_all_danhmuc();
            require_once 'views/pages/category.php';
            break;


    }
} else {
    include 'views/pages/home.php';
}


include 'views/footer.php';
?>