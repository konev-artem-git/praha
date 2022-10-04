<?php

// проверка регистрации

// input:
//  - user_name
//  - password

namespace kon\praha{

include "tws_functions.php";

// DB Connect
   $dbh = tws_db_connect();
   

$user_id = tws_get_user_by_name(filter_input(INPUT_POST, 'user_name'));

if(!$user_id)
   tws_dyer('Имя пользователя не найденo');
// name ok
$password = filter_input(INPUT_POST, 'password');

$user_data = tws_get_user_data($user_id);

// compare password
if( !password_verify($password, $user_data['password']))
   tws_dyer("Пароль задан неправильно");

tws_db_disconnect($dbh);

// TODO: logged expires
$token = rand(1000, 9999);    // key as logged in cookie

header("Location: tws_get_prize.php?user_id=$user_id&token=$token");
setcookie('token', $token);

}
?>
