<?php
// send MONEY

namespace kon\praha{

include "tws_functions.php";
   $dbh = tws_db_connect();
   tws_check_token($_POST['token']);

//var_dump($_POST); // TEST
//die; 
   
//  set user bank account
   $user_acc = $_POST['to_pred'].'-'.$_POST['to_acc'].'/'.$_POST['to_bank'];
   $res = tws_set_user_acc($_POST['user_id'], $user_acc);
   
// add prize to user_prize table
   $prize_id = tws_add_user_prize($_POST['user_id'], $_POST['type_id'], $_POST['amount']);
   
// decrease good amount (in this case - 'amount' = good_id)
   tws_decrease_money_amount($_POST['amount']);
  
   $rows = mysqli_affected_rows($dbh);    // TEST
   
header("Location: tws_final_page.php?msg=send_money");

}
?>
