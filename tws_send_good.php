<?php
// user interface
// send GOOD
?>

<!DOCTYPE html>
<html>
<head>
   <title>send GOOD</title>
</head>

<body>

<h2>Введите Ваше имя, е-мэйл и почтовый адрес:</h2>

<form action='tws_send_good_exec.php' method='POST'>
   <?php
   foreach($_GET as $key=>$val)
      echo "<input type='hidden' name='$key' value='$val'>\n";
   ?>

   Имя:<br>
   <input type='text' name='full_name' value="<?=$_GET['full_name']?>"><br><br>

   Е-мэйл:<br>
   <input type='text' name='email' value="<?=$_GET['email']?>"><br><br>

   Адрес:<br>
   <textarea name='address' rows=10 cols=50><?=$_GET['address']?></textarea><br>
   <br>
   <br>
   <input type='submit' action='tws_send_good_exec.php' value='Подтвердить'>
</form>



</body>
</html>
