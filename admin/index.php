<?php
//ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../model/admin/category.php';
include '../model/admin/product.php';
include '../model/PDO.php';
include '../model/admin/user.php';
include 'views/header.php';

if(isset($_GET["act"])){
    $act = $_GET["act"];
    switch ($act){
//danh muc        
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
                if (empty($_POST['name-category'])) {
                    $notify = "Không được bỏ trống tên danh mục";
                    header('location:index.php?act=editCategory');
                } else {
                    $name_category = $_POST['name-category'];
                    $id = $_POST['id'];
                    update_danhmuc($name_category, $id);
                    header('location:index.php?act=listCategory');
                }
            }
            break;
        case "addCategory":
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (empty($_POST['name-category'])) {
                    $notify = "Không được bỏ trống tên danh mục";
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
// San pham
        case "listProduct":
            $listsp= select_all_sanpham();
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
                         if (empty($_POST['name-product']) || empty($_POST['price'])) {
                         } else {
                             $id_category = $_POST['category'];
                             $name_product = $_POST['name-product'];
                             $price = $_POST['price'];
//                             $discount = $_POST['discount'];
                             if ($_POST['discount'] == ""){
                                 $discount = 0;
                             }else{
                                 $discount = $_POST['discount'];
                             }
                             $chip = $_POST['chip'];
                             $ram = $_POST['ram'];
                             $screen = $_POST['screen'];
                             $camera = $_POST['camera'];
                             $camera_selfie = $_POST['camera_selfie'];
                             $origin = $_POST['origin'];
                             $id = $_POST['id'];
                             $target_dir = "../upload/";
                             $target_file = $target_dir . basename($_FILES["img"]["name"]);
                             if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                                 $image = $_FILES["img"]["name"];
                             }
                             update_sanpham($name_product, $price, $discount, $image, $id_category, $chip, $ram, $screen, $camera, $camera_selfie, $origin, $id);
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
                if ($_POST['discount'] == ""){
                    $discount = 0;
                }else{
                    $discount = $_POST['discount'];
                }
                $chip = $_POST['chip'];
                $ram = $_POST['ram'];
                $screen = $_POST['screen'];
                $camera = $_POST['camera'];
                $camera_selfie = $_POST['camera_selfie'];
                $origin = $_POST['origin'];
                $img = $_FILES['img']['name'];
                $target_dir = "../upload/";
                $target_file = $target_dir . basename($_FILES["img"]["name"]);
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                    $image = $_FILES["img"]["name"];
                } else {
                    $notify = "Không thể upload file";
                }
                if(empty($name_product) || empty($price) || empty($id_category)){
                    $notify = "Không được để trống thông tin";
                }else{
                    insert_sanpham($name_product, $price,$discount, $img, $id_category, $chip,$ram,$screen,$camera,$camera_selfie,$origin);
                    $notify = "Không được để trống thông tin";
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
                    echo $notify = "Không thể upload file";
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
                update_user($name_user,$img_user, $account, $password, $email, $phone, $address, $role, $id);
                header('location:index.php?act=listUser');
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
                    echo $notify = "Không thể upload file";
                }
                if ($_POST['role'] == 1) {
                    $role = 1;
                } else {
                    $role = 0;
                }

                if (empty($email) || empty($account) || empty($pass)) {
                    $notify = "Vui lòng điền thông tin";
                } else {
                    insert_user($name_user,$img_user, $account, $pass, $email, $phone, $address, $role);
                        $notify = "Thêm thành công";
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
            include "views/comment/listComment.php";
            break;
    }
}else{
    include "views/product/listProduct.php";
}

include 'views/footer.php';
?>