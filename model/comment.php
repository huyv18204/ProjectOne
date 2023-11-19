<?php
function insert_comment($id_user,$id_pro,$date_comment,$content)
{
    $sql = "insert into comment(id_comment,id_user,id_product,date_comment,content) values (NULL,'$id_user','$id_pro','$date_comment','$content')";
    pdo_execute($sql);
}

function coutn_comment($id)
{
    $sql = "SELECT COUNT(*) FROM comment where id_product = '$id'";
    $list = pdo_query_value($sql);
    return $list;
}

function select_all_comment()
{
    $sql = "select id, content, comment.id_user,user.id_user,id_pro,date_comment,id_sanpham,ten_sanpham,name from user inner join comment on comment.id_user = user.id_user inner join sanpham on id_pro = id_sanpham order by id desc ";
    $list = pdo_query($sql);
    return $list;
}

function del_comment($id)
{
    $sql = " delete from comment where id = '$id'";
    pdo_execute($sql);
}

function select_user_comment($id)
{
    $sql = "select  id_comment,id_product,date_comment, content,img_user, account ,password ,email, phone ,address ,role ,user.id_user, comment.id_user, name_user from comment inner join user on user.id_user = comment.id_user where id_product = '$id'";
    $list = pdo_query($sql);
    return $list;
}

?>