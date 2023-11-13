<?php
function select_account($account, $password)
{
    $sql = "select * from user where account = '$account' and password = '$password'";
    $list = pdo_query_one($sql);
    return $list;
}

function insert_account($account, $pass, $email)
{
    $sql = "insert into user( account, password , email) values ('$account','$pass','$email')";
    pdo_execute($sql);

}

function update_user($id_user,$img_user, $pass, $name, $email, $phone, $address)
{
if ($img_user != ""){
    $sql = "update user set img_user = '$img_user', img_user = '$img_user', password = '$pass',name_user = '$name',email = '$email',phone = '$phone',address ='$address' where id_user = '$id_user'";
}else{
    $sql = "update user set password = '$pass',name_user = '$name',email = '$email',phone = '$phone',address ='$address' where id_user = '$id_user'";
}
    pdo_execute($sql);
}
?>