<?php

// регистрация нового пользователя

// input:
//  - name
//  - mail
//  - password

namespace kon\praha{

include "tws_functions.php";


// DB Connect
   $dbh = tws_db_connect();

$user_name = filter_input(INPUT_POST, 'user_name');

$mail = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);

$password = filter_input(INPUT_POST, 'password');


// имя уникльное должно быть.
// мэйл может быть одинаковым
$user_id = tws_get_user_by_name($user_name);
if($user_id)
   tws_dyer('Пользователь с таким именем уже зарегистрирован в базе данных', 'tws_registration.php');

$res = tws_add_user($user_name, $mail, $password);

if($res);
   tws_dyer('Пользователь успешно зарегистрирован', 'index.php');

}
?>
