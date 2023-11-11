<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include '../model/PDO.php';
include '../model/admin/user.php';
include 'views/header.php';

if(isset($_GET["act"])){
    $act = $_GET["act"];
    switch ($act){
        case "listCategory":
            include "views/category/listCategory.php";
            break;
        case "editCategory":
            include "views/category/editCategory.php";
            break;
        case "addCategory":
            include "views/category/addCategory.php";
            break;

        case "listProduct":
            include "views/product/listProduct.php";
            break;
        case "editProduct":
            include "views/product/editProduct.php";
            break;
        case "addProduct":
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