<?php
function dashboard()
{
    $sql = " SELECT  SUM(dhct.quantity) as total,p.name_product FROM `orders` dh
    INNER JOIN orders_detail dhct ON dh.code_order=dhct.code_order
    INNER JOIN product p ON p.id_product = dhct.id_product where status = 4 or status = 5
    GROUP by p.name_product";
    $list = pdo_query($sql);
    return $list;

}
function select_statistical(){
    $sql = "SELECT category.name_category, COUNT(product.id_product) AS count
    FROM product
    INNER JOIN category ON product.id_category = category.id_category
    GROUP BY category.id_category,name_category";
    $list = pdo_query($sql);
    return $list;
}

function sumSales(){
    $sql = "SELECT SUM(total_money) AS sumSales
    FROM orders where status = 4 or status = 5";
    $list = pdo_query_one($sql);
    return $list;
}

function sumUsers(){
    $sql = "SELECT COUNT(id_user) AS sumUsers
    FROM user ";
    $list = pdo_query_one($sql);
    return $list;
}

function sumProducts(){
    $sql = "SELECT COUNT(id_product) AS sumProducts
    FROM product";
    $list = pdo_query_one($sql);
    return $list;
}

function sumOrders(){
    $sql = "SELECT COUNT(id_order) AS sumOrders
    FROM orders where status = 4 or status = 5";
    $list = pdo_query_one($sql);
    return $list;
}

