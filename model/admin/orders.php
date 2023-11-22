<?php
function selectALlOrders(){
    $sql = "Select * from orders order by id_order desc ";
    $list = pdo_query($sql);
    return $list;
}

function selectALlOrdersDetail($code_order){
    $sql = "Select *, name_product from orders_detail inner join product 
                       on orders_detail.id_product = product.id_product 
                       where code_order = '$code_order'";
    $list = pdo_query($sql);
    return $list;
}

function updateStatus($code_order)
{
    $sql = "update orders set status = 1 where code_order = '$code_order'";
    pdo_execute($sql);
}
?>