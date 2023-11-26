<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
ob_start();
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
include "model/user/cart.php";
include 'model/PDO.php';
include 'model/user/login.php';
include 'model/user/homepage.php';
include 'model/user/orders.php';
include 'mail/index.php';
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
                //$list_samekind = select_sp_samekind($id_product, $id_category);
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
            if (isset($_POST['abc'])) {
                $account = $_POST['account'];
                $email = $_POST['email'];
                $code = substr(rand(0,999999),0,6);
                $content = "Mã xác nhận của bạn là: " .$code;
                $title = "Forgot PassWord";
                sendMail($email, $title, $content);
                $_SESSION['email'] =$email;
                $_SESSION['code'] =$code;
                $_SESSION['account_forgot'] =$account;
                header("location:index.php?act=checkCode");
            }
            include "views/login/forgotPass.php";
            break;
        case 'checkCode':
            if(isset($_POST['check'])){
                $code = $_POST['code'];
                if($code == $_SESSION['code']){
                    header("location:index.php?act=resetPass");
                    unset($_SESSION['code']);
                }
            }
            include 'views/login/checkCode.php';
            break;
        case 'resetPass':
            if(isset($_POST['btn-submit'])){
                $pass = $_POST['pass'];
                $repass = $_POST['newPass'];
                if($pass = $repass){
                    reset_pass($repass,$_SESSION['account_forgot'],$_SESSION['email']);
                    unset($_SESSION['account_forgot']);
                    unset($_SESSION['email']);
                    header("location:index.php?act=login");
                }
            }
            include"views/login/resetPass.php";
            break;
        case 'changePassword':
            if(isset($_SESSION['account'])){
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
            }else{
                header("location:admin/views/error.php");
            }
            break;
        case 'updateInformation':
            if(isset($_SESSION['account'])) {
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
            }else{
                header("location:admin/views/error.php");
            }
            break;
        case 'products':
            $list_sp = select_all_product();
            $list_category = select_all_danhmuc();
            include "views/pages/product.php";
            break;
        case 'addToCart':
            if (isset($_POST['btnAddToCart'])){
                if(isset($_SESSION['account'])) {
                    $id_user = $_SESSION['account']['id_user'];
                    $id_product = $_POST['id_product'];
                    $name_product = $_POST['name_product'];
                    $img_product = $_POST['img_product'];
                    if (isset($_POST['discount'])) {
                        $price = $_POST['discount'];
                    } else {
                        $price = $_POST['price'];
                    }
                    $chip = $_POST['chip'];
                    $ram = $_POST['ram'];
                    $screen = $_POST['screen'];
                    $camera = $_POST['camera'];
                    $camera_selfie = $_POST['camera_selfie'];
                    $origin = $_POST['origin'];
                    $quantity = 1;

                    $product_exists = false;
                    foreach ($_SESSION['cart'] as &$product_in_cart) {
                        foreach ($product_in_cart as &$value) {
                            if ($value['id_product'] === $id_product && $value['id_user'] === $id_user) {
                                // Sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
                                $value['quantity'] += $quantity;
                                $product_exists = true;
                                break 2;
                            }
                        }
                    }
                    if (!$product_exists) {
                        $products = array(
                            array(
                                'id_user' => $id_user,
                                'id_product' => $id_product,
                                'name_product' => $name_product,
                                'img_product' => $img_product,
                                'price' => $price,
                                'chip' => $chip,
                                'ram' => $ram,
                                'screen' => $screen,
                                'camera' => $camera,
                                'camera_selfie' => $camera_selfie,
                                'origin' => $origin,
                                'quantity' => $quantity
                            )
                        );
                    }
                    array_push($_SESSION['cart'], $products);
                    header("location:index.php?act=cart");
                }else{
                    header("location:index.php?act=login");
                }
            }
            break;
        case 'cart':
            $id_product = $_POST['id_product'];
            if (isset($_POST['btnUpdateCart'])) {
                foreach ($_SESSION['cart'] as &$cart) {
                    foreach ($cart as &$value) {
                        if ($value['id_product'] === $id_product){
                        $value['quantity'] = isset($_POST['quantity']) ? $_POST['quantity'] : $value['quantity'];
                        }
                    }
                }
                header("location:index.php?act=cart");
                exit();
            }
            if(isset($_POST['btn-orders'])){
                if(isset($_SESSION['account'])){
                    if(!empty($_SESSION['cart'])){
                        header("location:index.php?act=order");
                    }
                }else{
                    header("location:index.php?act=login");
                }
            }
            if (isset($_POST['selectedProducts'])) {
                $selectedProducts = $_POST['selectedProducts'];
            }
                if(empty($_SESSION['cart'])){
                unset($_SESSION['cart']);
            }
            include "views/pages/cart.php";
            break;
        case 'deleteProductInCart':
            if (isset($_GET['id'])) {
                $productIdToRemove = $_GET['id'];
                foreach ($_SESSION['cart'] as $key => $cart) {
                    foreach ($cart as $index => $value) {
                        if ($value['id_product'] == $productIdToRemove) {
                            unset($_SESSION['cart'][$key][$index]);
                            if (empty($_SESSION['cart'][$key])) {
                                unset($_SESSION['cart'][$key]);
                            }
                            break 2;
                        }
                    }
                }
            }
            header("location:index.php?act=cart");
            break;

        case 'order':
            if (isset($_SESSION['account']) && isset($_SESSION['cart'])){
            if(isset($_POST['btn-submit'])){
                $nameOrder = $_POST['name_order'];
                $phoneOrder = $_POST['phone_order'];
                $emailOrder = $_POST['email_order'];
                $addressOrder = $_POST['address_order'];
                $takeNode = $_POST['takeNode'];
                $codeOrders = rand(0,9999);
                $pay = $_POST['pay'];
                $idUser = $_SESSION['account']['id_user'];
                $total = $_POST['total'];
                $dateOrder = date("d/m/Y");
                $status = 1;
                if(empty($nameOrder) || empty($phoneOrder) || empty($emailOrder) ||empty($addressOrder) || empty($pay) || empty($idUser) || empty($total)){
                insert_orders($codeOrders,$dateOrder,$pay,$status,$total,$nameOrder,$emailOrder,$phoneOrder,$addressOrder,$takeNode,$idUser);
                    foreach ($_SESSION['cart'] as $key => $cart){
                        foreach ($cart as $index => $value){
                        $idProduct = $value['id_product'];
                        $quantity = $value['quantity'];
                        $price = $value['price'] * $quantity;
                        insert_orders_detail($codeOrders,$idProduct,$quantity,$price);
//                        if($value['id_user'] == $idUser){
//                            unset($_SESSION['cart'][$key][$index]);
//                            if (empty($_SESSION['cart'][$key])) {
//                                unset($_SESSION['cart'][$key]);
//                            }
//                        }
                    }
                }
                    unset($_SESSION['cart']);
                    header('location:index.php?act=cart');
            }
            }
                include "views/pages/order.php";
            }else{
                header("location:admin/views/error.php");
            }
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
        case 'myOrders':


            if($_GET['status']){
                $id_status = $_GET['status'];
            }
            $listOrders = listOrders($id_status,$_SESSION['account']['id_user']);

            if(isset($_POST['btnSuccess'])){
                $id_order = $_POST['id_order'];
                StatusSuccess($id_order);
                header("location:index.php?act=myOrders&status=5");
            }

            if(isset($_POST['btnCancel'])){
                $id_order = $_POST['id_order'];
                StatusCancel($id_order);
                header("location:index.php?act=myOrders&status");
            }
            require_once 'views/pages/myOrders.php';
            break;
        case 'myOrdersDetail':
                $code_order= $_GET['codeOrder'];
                $lisProduct = OrdersDetail($code_order,);
            require_once 'views/pages/myOrdersDetail.php';
    }
} else {
    $listsp = select_all_product();
    $listpk = select_all_phukien();
    include 'views/pages/home.php';
}
include 'views/footer.php';
?>