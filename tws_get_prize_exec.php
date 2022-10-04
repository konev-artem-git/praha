<?php

// select random prize

// input: $user_id

namespace kon\praha{

include "tws_functions.php";
$dbh = tws_db_connect();
   
$user_id = $_GET['user_id'];   
$token = $_GET['token'];
tws_check_token($token);

// save all results in $res_arr:
$res_arr = array();

$res_arr['user_id'] = $user_id;
$res_arr['token'] = $token;

// get random prize_type:
   list($type_id, $type_name) = tws_rand_prize_type();

$res_arr['type_id'] = $type_id;
$res_arr['type_name'] = $type_name;

// generate prize amount or good:

switch($type_name){

   case 'баллы':
      $res_arr['url'] = 'points';        // перенаправлять будем

      $points = tws_rand_points();      // get random points from interval
      $amount = $points;
      $res_arr['amount'] = $points;
      break;

   case 'деньги':
      $res_arr['url'] = 'money';        // перенаправлять будем

      $money = tws_rand_money();        // get random money from interval
      $amount = $money;
      $res_arr['amount'] = $money;
      
      // get bank accounts
      $our_acc = tws_get_our_acc();
      $res_arr['our_acc'] = $our_acc;  // 000-123456789/0100
      $user_acc = tws_get_user_acc($user_id);
      $res_arr['user_acc'] = $user_acc;  // 000-123456789/0100
      list($res_arr['to_pred'], $res_arr['to_acc'], $res_arr['to_bank']) = tws_split_bank_acc($user_acc);
      break;

   case 'предмет':
      $res_arr['url'] = 'good';        // перенаправлять будем

      list($good_id, $good_name) = tws_rand_good();      // get random good from the list
      $amount = $good_id;
      $res_arr['amount'] = $good_id;
      
      // get_user address
      $user_data = tws_get_user_data($user_id);   
         unset($user_data['password']);
      $res_arr = array_merge($res_arr, $user_data);
   
      break;
}

/*
// add prize to user_prize table
   $prize_id = tws_add_user_prize($user_id, $type_id, $amount);
      $res_arr['prize_id'] = $prize_id;

   if($type_name == 'баллы')          // points are "sent" automatically
      tws_set_prize_sent($prize_id);
*/

// Send data to next script
$req_str = http_build_query($res_arr);
header("Location: tws_show_results.php?$req_str");

}
?>
