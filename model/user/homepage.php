<?php
function search_sp($value)
{
    $sql = " SELECT * FROM product WHERE name_product LIKE '%$value%'";
    $list = pdo_query($sql);
    return $list;
}

function select_all_danhmuc()
{
    $sql = 'select * from category';
    $list = pdo_query($sql);
    return $list;
}
?>