<?php

// input: GET
/* from:
   -  tws_show_results,php
   - tws_reject_money.php
*/

namespace kon\praha{
include "tws_functions.php";
tws_check_token($_GET['token']);
$dbh = tws_db_connect();

$user_id = $_GET['user_id'];
$points = $_GET['amount'];

   // add won points to total user points
   $res = tws_add_user_points($user_id, $points);
   $total_points = tws_get_user_points($user_id);

   // add prize to user_prize table
   $prize_id = tws_add_user_prize($user_id, $_GET['type_id'], $_GET['amount']);

   // points are "sent" automatically
   tws_set_prize_sent($prize_id);
   
header("Location: tws_final_page.php?msg='send_points'");

      
}
?>
