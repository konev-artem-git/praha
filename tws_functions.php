<?php

namespace kon\praha{

require_once "tws_inc.php";

// DB Connection

function tws_db_connect(){
   global $dbh, $hostname, $username, $password, $database;

   $dbh = mysqli_connect($hostname, $username, $password, $database);
   if (!$dbh)
      tws_dyer("db connection fail: ". mysqli_connect_error());
   return $dbh;
}


function tws_db_disconnect($dbh){
   mysqli_close($dbh);
}


/*********************       User Data       *********************/ 
         
// get user data by id
function tws_get_user_data($user_id){
   global $dbh;

   $query  = "
      SELECT   user_id, user_name, email, full_name, address, password
      FROM     users
      WHERE    user_id = $user_id
      ";

   $res = tws_exec_query($dbh, $query);

   $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

   if(empty($row ))
      return false;
   return $row ;
}

   // set user data by id
function tws_set_user_data($user_id, $full_name, $email, $address){
   global $dbh;

   $query  = "
      UPDATE  users
      SET full_name = '$full_name', email = '$email', address = '$address'
      WHERE    user_id = $user_id
      ";

   $res = tws_exec_query($dbh, $query);

   return $res;
}

      // get user id by mail
function tws_get_user_by_mail($user_mail){
   global $dbh;

   $query  = "
      SELECT   user_id
      FROM     users
      WHERE    email = '$user_mail'
      ";

   $res = tws_exec_query($dbh, $query);

   $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

   if(empty($row ))
      return false;
   return $row['id'];
}

      // get user by name
function tws_get_user_by_name($user_name){
   global $dbh;

   $query  = "
      SELECT   user_id
      FROM     users
      WHERE    user_name = '$user_name'
      ";

   $res = tws_exec_query($dbh, $query);

   $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

   if(empty($row ))
      return false;
   return $row['user_id'];
}

function tws_add_user($user_name, $mail, $password){
   global $dbh;

   $password = crypt($password, '');

   $query  = "
      INSERT INTO   users(user_name, email, password)
      VALUES('$user_name', '$mail', '$password')
      ";

   $res = tws_exec_query($dbh, $query);
   
   $user_id = mysqli_insert_id($dbh);
   return $user_id;
}

// get user bank acc
function tws_get_user_acc($user_id){
   global $dbh;
   
   $query  = "
      SELECT   user_acc
      FROM     users
      WHERE    user_id = $user_id
      ";

   $res = tws_exec_query($dbh, $query);
   $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

   return $row['user_acc'];
}

// set user bank acc
function tws_set_user_acc($user_id, $user_acc){
   global $dbh;
   
   $query  = "
      UPDATE   users
      SET      user_acc = '$user_acc'
      WHERE    user_id = $user_id
      ";

   $res = tws_exec_query($dbh, $query);
   return $res;
}

/*********************       Prize Types       *********************/ 


   // get random prize type
function tws_rand_prize_type(){

   $prize_types = tws_get_prize_types();

   // проверить наличие
   $m_limit = tws_get_money_limit();
   $g_limit = tws_get_goods_limit();
   
   if($m_limit <1){     // деньги вычеркиваем
      $key = array_search('деньги', $prize_types);
      if($key)    //    формальность
         unset($prize_types[$key]);
   }
   if($g_limit <1){     // товар вычеркиваем
      $key = array_search('предмет', $prize_types);
      if($key) //    --//--
         unset($prize_types[$key]);
   }
   
   $keys = array_keys($prize_types);
   $rand_key = array_rand($keys);

//$rand_key = 0; // TEST   good
//$rand_key = 1; // TEST   money
//$rand_key = 2; // TEST   points

   $type_id = $keys[$rand_key];
   $type_name = $prize_types[$type_id];

   $res = array($type_id, $type_name);
   return $res;
}

// get all prize types (or by name)
function tws_get_prize_types($type_name=null){
   global $dbh;

   $query  = "
      SELECT id, name
      FROM prize_types
   ";
   if(!empty($type_name))
      $query  .= "
         WHERE name = '$type_name'
      ";
   $res = tws_exec_query($dbh, $query);
   $ret = array();

   while($row = mysqli_fetch_array($res, MYSQLI_ASSOC))
      $ret[$row['id']] = $row['name'];

   if(empty($ret))
      tws_dyer("prize_types table is empty");

   return $ret;
}


/*       Points       */ 

   // get random points amount from interval
function tws_rand_points(){
   global $dbh;

   $query  = "
      SELECT   min, max
      FROM     points_interval
   ";

   $res = tws_exec_query($dbh, $query);
   $row = mysqli_fetch_array($res);

   if(empty($row))
      tws_dyer("points_interval table is empty");

   $points = rand($row['min'], $row['max']);
   return $points;
}


//    get current user points amount
function tws_get_user_points($user_id){
   global $dbh;

   $query  = "
      SELECT   points
      FROM     user_points
      WHERE    user_id = $user_id
   ";

   $res = tws_exec_query($dbh, $query);
   $row = mysqli_fetch_array($res);

   if(empty($row))
      $points = 0;
   else $points = $row['points'];

   return  $points;
}


// add $points points to user $user_id
function tws_add_user_points($user_id, $points){
   global $dbh;

  $query  = "
      UPDATE   user_points
      SET      points = (points + $points)
      WHERE user_id = $user_id
   ";
   $res = tws_exec_query($dbh, $query);
   return $res;
}

// insert user_id into table user_points
function tws_add_user_to_points($user_id){
   global $dbh;

   $query  = "
      INSERT INTO    user_points(user_id, points)
      VALUES         ($user_id, 0)
   ";
   $res = tws_exec_query($dbh, $query);
   return $res;
}


/*       Money       */ 

// get random money amount from interval
function tws_rand_money(){
   global $dbh;

   $query  = "
      SELECT min, max, m_limit
      FROM money_interval
   ";

   $res = tws_exec_query($dbh, $query);
   $row = mysqli_fetch_array($res);

// предполагаем, что интервал и лимит денег устанавлены. В Админ секции должна быть возможность.
   if(empty($row))  
      tws_dyer("Денежные призы не установлены. Обратитесь к Администратору");

   $$m_limit = $row['m_limit'];
   $min = $row['min'];
   $max = $row['max'];
   if($max > $$m_limit)
      $max = $$m_limit;
   
   $money = rand($min, $max);
   return $money;
}


function tws_get_money_limit(){
   global $dbh;

   $query  = "
      SELECT m_limit
      FROM money_interval
   ";

   $res = tws_exec_query($dbh, $query);
   $row = mysqli_fetch_array($res);   
   
   if(empty($row))
      tws_dyer("money_interval table is empty");

   return $row['m_limit'];
}


// decrease_money_amount($good_id)
function tws_decrease_money_amount($amount){
   global $dbh;

   $query  = "
      UPDATE money_interval
      SET m_limit = (m_limit -$amount)
   ";

   $res = tws_exec_query($dbh, $query);
   return mysqli_affected_rows($dbh);
}


// Convert money to points
function tws_reject_money($amount){
   global $dbh;

   $query  = "
      SELECT max, m_coef
      FROM points_interval
   ";
   
   $res = tws_exec_query($dbh, $query);
   $row = mysqli_fetch_array($res);   
   
   if(empty($row))
      tws_dyer("points_interval table is empty");
   
   $points = $amount * $row['m_coef'];
      
   return $points;
}

// split user banc account '000-123456/0100'
function tws_split_bank_acc($user_acc){
   list($acc_pred, $user_acc) = explode('-', $user_acc);
   list($user_acc, $bank_kod) = explode('/', $user_acc);
   return array($acc_pred, $user_acc, $bank_kod);
}

// get our bank account
// предполагается что он один...
function tws_get_our_acc(){
   global $dbh;

   $query  = "
      SELECT pred_acc, acc_num, bank_kod
      FROM bank_acc
   ";
   
   $res = tws_exec_query($dbh, $query);
   $row = mysqli_fetch_array($res);   
   
   if(empty($row))
      tws_dyer("bank_acc table is empty");
   
   $our_acc = $row['pred_acc'].'-'.$row['acc_num'].'/'.$row['bank_kod'];
      
   return $our_acc;
   
}




/*       Good       */ 

// get random good from the list
function tws_rand_good(){

   $goods = tws_get_good();

   $keys = array_keys($goods);
   $rand_key = array_rand($keys);

   $good_id = $keys[$rand_key];
   $good_name = $goods[$good_id];

   $res = array($good_id, $good_name);
   return $res;
}


//    Get goods list or certain good if $good_id sent
function tws_get_good($good_id=null){
   global $dbh;

   $query = "
      SELECT   id, name, g_limit
      FROM     goods
      WHERE    g_limit >0
   ";
   if(!empty($good_id))
      $query .= "
      AND id = $good_id
      ";
   $res = tws_exec_query($dbh, $query);

   $goods = array();
   while($row = mysqli_fetch_array($res, MYSQLI_ASSOC))
      $goods[$row['id']] = $row['name'];
   return $goods;
}


function tws_get_goods_limit(){
   global $dbh;

   $query  = "
      SELECT SUM(g_limit) g_limit
      FROM goods
   ";

   $res = tws_exec_query($dbh, $query);
   $row = mysqli_fetch_array($res);   
   
   if(empty($row))
      tws_dyer("goods table is empty");

   return $row['g_limit'];
}


// decrease_good_amount($good_id)
function tws_decrease_good_amount($good_id){
   global $dbh;

   $query  = "
      UPDATE goods
      SET g_limit = (g_limit -1)
      WHERE id = $good_id
   ";

   $res = tws_exec_query($dbh, $query);
   return mysqli_affected_rows($dbh);
}

/*        Send Prize        */

// add prize into table user_prize
function tws_add_user_prize($user_id, $type_id, $amount){
   global $dbh;

   $query  = "
      INSERT INTO    user_prize(user_id, prize_type, prize_number)
      VALUES         ($user_id, $type_id, $amount)
   ";
   $res = tws_exec_query($dbh, $query);

   $prize_id = mysqli_insert_id($dbh);

   return $prize_id;
}


// mark prize $prize_id as sent to user
function tws_set_prize_sent($prize_id){
   global $dbh;

   $query  = "
      UPDATE   user_prize
      SET      prize_sent = true
      WHERE    prize_id = $prize_id
   ";
   $res = tws_exec_query($dbh, $query);
}

// reject good prize
function tws_reject_good($prize_id){
   global $dbh;

   $query  = "
      DELETE   user_prize
      WHERE    prize_id = '$prize_id'
   ";
   $res = tws_exec_query($dbh, $query);
   return $res;
}


/* -------------------------
      common functions
   ------------------------- */

function tws_exec_query($dbh, $query){

   $res = mysqli_query($dbh, $query);
   if(!$res)
      tws_dyer("Error executing query: $query. <br>". mysqli_error($dbh));

   return $res;
}


// check logged
function tws_check_token($token){
   if($_COOKIE['token'] != $token)
      tws_dyer('что-то пошло не так', 'index.php');
}


//    Errors handling

function tws_dyer($msg, $redirect='index.php'){

   tws_error($msg);

   echo "<br>in $_SERVER[PHP_SELF]:<br>";
   echo "<br><br><input type='button' value='OK' onclick='window.location.replace(\"$redirect\")'>";

   die;
}

function tws_error($msg){
   echo "$msg<br>";
   tws_log($msg);
}

function tws_log($msg){
   // TODO: add $msg to log
}

}
?>
