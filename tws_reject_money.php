<?php

namespace kon\praha{
include "tws_functions.php";
 tws_check_token($_GET['token']);
$dbh = tws_db_connect();

// перевод денег в баллы
   $res_arr = array();
   parse_str($_SERVER['QUERY_STRING'], $res_arr);
   
   $res_arr['amount'] = tws_reject_money($_GET['amount']);   // points for money

   $tmp_arr = tws_get_prize_types('баллы');
   
   $type_id = $res_arr['type_id'] = array_key_first($tmp_arr);
   $res_arr['type_name'] = $tmp_arr[$type_id];
   
   $q_str = http_build_query($res_arr);

   header("Location: tws_send_points.php?$q_str");

}
?>