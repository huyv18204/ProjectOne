<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../model/comment.php';
include '../model/admin/category.php';
include '../model/admin/product.php';
include '../model/PDO.php';
include '../model/admin/user.php';
include '../model/admin/orders.php';
include '../model/admin/dashboard.php';
if($_SESSION['account']['role'] == 1) {
    include 'views/header.php';

    if (isset($_GET["act"])) {
        $act = $_GET["act"];
        switch ($act) {
            case "listCategory":
                $listdm = select_all_danhmuc();
                include "views/category/listCategory.php";
                break;
            case "editCategory":
                if (isset($_GET['id'])) {
                    $listdm = select_one_danhmuc($_GET['id']);
                }
                include "views/category/editCategory.php";
                break;
            case 'update-dm':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name_category = $_POST['name-category'];
                $id = $_POST['id'];
                    if (empty($name_category)) {
                        $_SESSION['error'] = "Không được bỏ trống tên danh mục.";
                        header("location:index.php?act=editCategory&id=$id");
                    } else {
                        update_danhmuc($name_category, $id);
                        header('location:index.php?act=listCategory');
                    }
                }
                break;
            case "addCategory":
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (empty($_POST['name-category'])) {
                        $_SESSION['error'] = "Không được bỏ trống tên danh mục.";
                    } else {
                        $name_category = $_POST['name-category'];
                        insert_danhmuc($name_category);
                        header('location:index.php?act=listCategory');
                    }
                }
                include "views/category/addCategory.php";
                break;
            case 'del-dm':
                if (isset($_GET['id'])) {
                    del_danhmuc($_GET['id']);
                }
                header("location:index.php?act=listCategory");
                break;
            case "listProduct":
                $listsp = select_all_sanpham();
                include "views/product/listProduct.php";
                break;
            case "editProduct":
                if (isset($_GET['id'])) {
                    $listsp = select_one_sanpham($_GET['id']);
                }
                $listdm = select_all_danhmuc();
                include "views/product/editProduct.php";
                break;
            case 'updateProduct':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $id_category = $_POST['category'];
                        $id_product = $_POST['id'];
                        $name_product = $_POST['name_product'];
                        $price = $_POST['price'];
                        if ($_POST['discount'] == "") {
                            $discount = 0;
                        } else {
                            $discount = $_POST['discount'];
                        }
                        $chip = $_POST['chip'];
                        $ram = $_POST['ram'];
                        $screen = $_POST['screen'];
                        $camera = $_POST['camera'];
                        $camera_selfie = $_POST['camera_selfie'];
                        $total = $_POST['total_quantity'];
                        $origin = $_POST['origin'];
                        $id = $_POST['id'];
                        $target_dir = "../upload/";
                        $target_file = $target_dir . basename($_FILES["img"]["name"]);
                        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                            $image = $_FILES["img"]["name"];
                        }
                        if($total < 0 ){
                            $_SESSION['error'] = "Số lượng không hợp lệ";
                            header("location:index.php?act=editProduct&id=$id_product");
                        }elseif($discount > $price || $discount < 0 || $price < 0){
                            $_SESSION['error'] = "Giá không hợp lệ";
                            header("location:index.php?act=editProduct&id=$id_product");
                        }elseif(empty($name_product) || empty($price) || empty($total) || empty($id_category)){
                            $_SESSION['error'] = "Vui lòng điền đủ thông tin sản phẩm";
                            header("location:index.php?act=editProduct&id=$id_product");
                        }else{
                            update_sanpham($name_product, $price, $discount, $image, $id_category, $chip, $ram, $screen, $camera, $camera_selfie, $origin,$total, $id);
                            header('location:index.php?act=listProduct');
                        }
                }
                $listdm = select_all_danhmuc();
                break;
            case 'deleteProduct':
                if (isset($_GET['id'])) {
                    del_sanpham($_GET['id']);
                }
                header("location:index.php?act=listProduct");
                break;
            case "addProduct":
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $id_category = $_POST['category'];
                    $name_product = $_POST['name-product'];
                    $price = $_POST['price'];
                    if ($_POST['discount'] == "") {
                        $discount = 0;
                    } else {
                        $discount = $_POST['discount'];
                    }
                    $chip = $_POST['chip'];
                    $ram = $_POST['ram'];
                    $screen = $_POST['screen'];
                    $camera = $_POST['camera'];
                    $camera_selfie = $_POST['camera_selfie'];
                    $origin = $_POST['origin'];
                    $total = $_POST['total_quantity'];
                    $img = $_FILES['img']['name'];
                    $target_dir = "../upload/";
                    $target_file = $target_dir . basename($_FILES["img"]["name"]);
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                        $image = $_FILES["img"]["name"];
                    } else {
                        $_SESSION['error'] = "Không thể upload file.";
                    }
                    if(empty($name_product) || empty($price) || empty($total) || empty($id_category) || empty($img)){
                        $_SESSION['error'] = "Vui lòng điền đủ thông tin sản phẩm.";
                    }elseif($discount > $price || $discount < 0 || $price < 0){
                        $_SESSION['error'] = "Giá không hợp lệ.";
                    }elseif($total < 0 ){
                        $_SESSION['error'] = "Số lượng không hợp lệ.";
                    } else {
                        insert_sanpham($name_product, $price, $discount, $img, $id_category, $chip, $ram, $screen, $camera, $camera_selfie, $origin,$total);
                        header('location:index.php?act=listProduct');
                    }
                }
                $listdm = select_all_danhmuc();
                include "views/product/addProduct.php";
                break;

            case "listUser":
                $listUser = select_all_user();
                include "views/user/listUser.php";
                break;
            case 'editUser' :
                if (isset($_GET['id'])) {
                    $list_user = select_one_user($_GET['id']);
                }
                include 'views/user/editUser.php';
                break;
            case 'updateUser':
                if (isset($_POST['btn-edit'])) {
                    $name_user = $_POST['name'];
                    $target_dir = "../upload/";
                    $target_file = $target_dir . basename($_FILES["img"]["name"]);
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                        $img_user = $_FILES["img"]["name"];
                    } else {
                        $_SESSION['error'] = "Không thể upload được file.";
                    }
                    $account = $_POST['account'];
                    $password = $_POST['pass'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];
                    if ($_POST['role'] == 1) {
                        $role = 1;
                    } else {
                        $role = 0;
                    }
                    $id = $_POST['id'];
                    if(empty($email)) {
                        $_SESSION['error'] = "Không thể để trống email.";
                        header("location:index.php?act=editUser&id=$id");
                    }else {
                        update_user($name_user, $img_user, $account, $password, $email, $phone, $address, $role, $id);
                        header('location:index.php?act=listUser');
                    }
                }
                break;
            case "addUser":
                if (isset($_POST['btn-add'])) {
                    $name_user = $_POST['name'];
                    $account = $_POST['account'];
                    $pass = $_POST['pass'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];
                    $target_dir = "../upload/";
                    $target_file = $target_dir . basename($_FILES["img"]["name"]);
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                        $img_user = $_FILES["img"]["name"];
                    } else {
                        $_SESSION['error'] = "Không thể upload file.";
                    }
                    if ($_POST['role'] == 1) {
                        $role = 1;
                    } else {
                        $role = 0;
                    }

                    if (empty($email) || empty($account) || empty($pass)) {
                        $_SESSION['error'] = "Không thể để trống thông tin.";
                    } else {
                        insert_user($name_user, $img_user, $account, $pass, $email, $phone, $address, $role);
                        header('location:index.php?act=listUser');
                    }
                }
                include "views/user/addUser.php";
                break;
            case "deleteUser":
                if (isset($_GET['id'])) {
                    del_user($_GET['id']);
                }
                header("location:index.php?act=listUser");
                break;

            case "listComment":
                $list_comment = select_all_comment();
                include "views/comment/listComment.php";
                break;
            case "deleteComment":
                if (isset($_GET['id'])) {
                    del_comment($_GET['id']);
                }
                header("location:index.php?act=listComment");
                break;
            case "listOrders":
                $listOrders = selectALlOrders();
                if(isset($_POST['btn-filter'])){
                    $options_status = $_POST['options_status'];
                    $filterStatus = select_status($options_status);
                }
                include 'views/orders/listOrders.php';
                break;
            case "detailOrders":
                if($_GET['codeOder']){
                    $code_order = $_GET['codeOder'];
                }
                $listOrdersDetail = selectALlOrdersDetail($code_order);
                include 'views/orders/detailOrders.php';
                break;
            case "updateStatus":
                if($_GET['codeOder']){
                    $code_order = $_GET['codeOder'];
                }
                if($_GET['status']){
                    $status = $_GET['status'];
                }
                $updateStatus = updateStatus($status,$code_order);
                header("location:index.php?act=listOrders");
                break;
                case "dashboard";
                include "views/dashboard/dashboard.php";
                break;
        }
    } else {
        include "views/product/listProduct.php";
    }

    include 'views/footer.php';
}else{
    require_once 'views/error.php';
}
?>