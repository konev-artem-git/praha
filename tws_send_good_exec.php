<?php

// send GOOD

namespace kon\praha{

include "tws_functions.php";

 $dbh = tws_db_connect();
 tws_check_token($_POST['token']);

//  Update user data
   $res = tws_set_user_data($_POST['user_id'], $_POST['full_name'], $_POST['email'], $_POST['address']);
   
// add prize to user_prize table
   $prize_id = tws_add_user_prize($_POST['user_id'], $_POST['type_id'], $_POST['amount']);
   
// decrease good amount (in this case - 'amount' = good_id)
   tws_decrease_good_amount($_POST['amount']);
  
   $rows = mysqli_affected_rows($dbh);    // TEST
   
   $msg='send_good';
   header("Location: tws_final_page.php?msg=$msg");

}
?>
