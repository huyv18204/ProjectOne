<?php

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
            include "views/login/register.php";
            break;
        case 'login':
            include "views/login/login.php";
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