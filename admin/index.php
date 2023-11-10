<?php

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
            include "views/user/listUser.php";
            break;
        case "editUser":
            include "views/user/editUser.php";
            break;
        case "addUser":
            include "views/user/addUser.php";
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