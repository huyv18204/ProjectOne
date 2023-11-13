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
?>